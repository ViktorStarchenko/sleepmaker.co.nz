<?php

    function gfPostSave( $postID ){

        if(empty($_POST['acf'])){
            return ;
        }

    }

    add_action('save_post', 'gfPostSave', 1);

    add_action( 'gform_chained_selects_input_choices', 'ajaxCheck', 10, 5 );
    add_action( 'gform_chained_selects_input_choices_23_8_3', 'add_other_choise_3', 10, 5 );
    add_action( 'gform_chained_selects_input_choices_23_8_4', 'add_other_choise_4', 10, 5 );

    add_filter( 'gform_pre_render_2', 'checkChainedSelect' );
    add_filter( 'gform_pre_validation_2', 'checkChainedSelect' );
    add_filter( 'gform_admin_pre_render_2', 'checkChainedSelect' );
    add_filter( 'gform_pre_submission_filter_2', 'checkChainedSelect' );

    add_filter( 'gform_pre_render_3', 'checkChainedSelect' );
    add_filter( 'gform_pre_validation_3', 'checkChainedSelect' );
    add_filter( 'gform_admin_pre_render_3', 'checkChainedSelect' );
    add_filter( 'gform_pre_submission_filter_3', 'checkChainedSelect' );

    // Check if form has chained select
    function checkChainedSelect( $form ){

        global $wpdb;

        $params = [];
        foreach ( $form["fields"] as $field ){

            if( $field->type == "chainedselect" ){

                $params = $field;
                // Обнуляем значения ... Пока не понятно зачем ))
                //$field->choices = array();

                if ( !defined('PATH') ){
                    define('PATH', dirname(__FILE__) . '/');
                }

                $import = array();

                $path = PATH.'../../../uploads/wp_ranges_export.csv';

                generateCsv( $path, $params );

                $handle = fopen( $path, 'r+' );
                $stats = fstat( $handle );
                fclose( $handle );

                $importFileInfo = array();

                $importFileInfo['gfcsFile'] = [
                    'dateUploaded' => time(),
                    'name' => basename($path),
                    'size' => $stats['size'],
                    'type' => 'text/csv',
                    'isFromFilter' => true
                ];

                /*
                $sql = "SELECT field_id, `preset` from {$wpdb->prefix}od_gf_filters WHERE field_type = %s AND form_id = %d";
                $sql = $wpdb->prepare($sql, $field->type, $form['id']);
                $results = $wpdb->get_results($sql);

                foreach($results as $value){
                    $arr_presets[$value->field_id] = $value->preset;
                }
                */

                $import = [];
                $field->inputs = [];
                $field->choices = [];

                $arr_presets = [];

                $import = import_csv_choices($path, $field, $arr_presets);

                $field->inputs = $import['inputs'];
                $field->choices = $import['choices'];

                $field->gfcsFile = $importFileInfo['gfcsFile'];
            }
        }
        return $form;
    }

    function generateCsv( $fileName, $params ){

        $args = [
            'post_type' => 'wpsl_stores',
            'meta_key' => 'wpsl_state',
            'orderby' => 'meta_value',
            'order' => 'ASC',
            'numberposts' => -1
        ];

        $stores = get_posts($args);
        $regions = [];
        $ranges = [];
        $retailers = [];

        $data[] = [
            "region" => "Region",
            "retailer" => "Retailer",
            "store" => "Store",
            "range" => "Range",
        ];

        foreach ( $stores as $store ){

            $acfFields = get_fields( $store->ID );
            $region = get_post_meta( $store->ID,'wpsl_state');
            $retailers[ $acfFields["retailer"]->ID ] = $acfFields["retailer"]->post_title;

            $regions[] = $region[0];

            if( !empty($acfFields["ranges"]) ){
                foreach ( $acfFields["ranges"] as $range ) {
                    $ranges[ $range->ID ] = $range->post_title;

                    $data[] = [
                        "region" => $region[0],
                        "retailer" => $acfFields["retailer"]->post_title,
                        "store" => $store->post_title,
                        "range" => $range->post_title,
                    ];

                }
            }

        }

        $regions =  array_unique( $regions );

        sort( $regions );
        sort( $retailers );
        sort( $ranges );

        if(!file_exists($fileName)){
            file_put_contents($fileName, '');
        }

        $fp = fopen($fileName, 'w');

        foreach ($data as $row) {
            fputcsv($fp, $row);
        }

        fclose($fp);
    }

    function import_csv_choices( $path, $field, $arr_presets) {
        $choices = array();
        $inputs = array();
        $first_key = 0;
        $handle = fopen( $path, 'r' );
        if( $handle !== false ) {
            $k = 1;
            while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                // filter out empty rows
                $row = array_filter($row);
                if (empty($row)) {
                    continue;
                }
                // save the headers as inputs
                if (empty($inputs)) {
                    $i = 1;
                    $j = 0;
                    foreach ($row as $index => $item) {
                        if ($i % 10 == 0) {
                            $i++;
                        }
                        if ($i == 1) {
                            $first_key = $field->id . '.' . $i;
                        }
                        //Debug: Nikolai: Field Name
                        $inputs[] = array(
                            'id' => $field->id . '.' . $i,
                            'label' => $item,
                            'name' => (isset($field->inputs[$j]['name']) ? $field->inputs[$j]['name'] : (array_key_exists("{$field->id}.{$i}", $arr_presets)) ? $arr_presets["{$field->id}.{$i}"] : "")
                        );
                        $i++;
                        $j++;
                    }
                    continue;
                }
                $parent = null;
                foreach ($row as $item) {
                    if ($parent === null) {
                        $parent = &$choices;
                    }
                    if (!isset($parent[$item])) {
                        $item = sanitize_csv_choice_value($item);
                        //Debug: Nikolai: Field Name
                        $sel = in_array($item, $arr_presets);
                        $parent[$item] = array(
                            'text' => $item,
                            'value' => $item,
                            'isSelected' => false,
                            'choices' => array()
                        );
    //                        break;
                    }
                    $parent = &$parent[$item]['choices'];
                }
            }

            fclose($handle);
        }
        //dump($choices);
        // convert associative array to numeric indexes
        csv_array_values_recursive( $choices );
        return compact('inputs','choices' );
    }

    function sanitize_csv_choice_value( $value ) {
        $allowed_protocols = wp_allowed_protocols();
        $value = wp_kses_no_null( $value, array( 'slash_zero' => 'keep' ) );
        $value = wp_kses_hook( $value, 'post', $allowed_protocols );
        $value = wp_kses_split( $value, 'post', $allowed_protocols );
        return $value;
    }

    function csv_array_values_recursive( &$choices, $prop = 'choices' ) {
        $choices = array_values( $choices );
        for( $i = 0; $i <= count( $choices ); $i++ ) {
            if( ! empty( $choices[ $i ][ $prop ] ) ) {
                $choices[ $i ][ $prop ] = csv_array_values_recursive( $choices[ $i ][ $prop ], $prop );
            }
        }
        return $choices;
    }

    function ajaxCheck( $input_choices, $form_id, $field, $input_id, $chain_value ) {

        global $wpdb;

        $filteredChoices = $input_choices;
        $filteredNames = [];

        if (!is_null($field) && $field->type == 'chainedselect') {

            // For Product Registration
            if( $form_id == 2 || $form_id == 3 ){ //Form ID

                if ( !defined('PATH') ){
                    define('PATH', dirname(__FILE__) . '/');
                }

                $path = PATH.'../../../uploads/wp_ranges_export.csv';

                $arr_presets = [];

                $import = [];
                $field->inputs = [];
                $field->choices = [];

                $import = import_csv_choices($path, $field, $arr_presets);

                $handle = fopen( $path, 'r+' );
                $stats = fstat( $handle );
                fclose( $handle );

                $import_file_info = array();

                $import_file_info['gfcsFile'] = array(
                    'dateUploaded' => time(),
                    'name' => basename($path),
                    'size' => $stats['size'],
                    'type' => 'text/csv',
                    'isFromFilter' => true
                );

                $field->inputs = $import['inputs'];
                $field->choices = $import['choices'];
                $field->gfcsFile =  $import_file_info['gfcsFile'];

                $choices_value = [];
                $i = 0;
                foreach ($chain_value as $value){
                    if(!empty($value)) {
                        $choices_value[$i] = $value;
                    }
                    $i++;
                }

                $data = [];

                $i = 0;
                $count = count($choices_value);
                foreach ($choices_value as $value){
                    switch ($i){
                        case 0:
                            foreach ($field->choices as $arr){
                                if($arr['text'] === $value){
                                    $data[1] = $arr;
                                    break;
                                }
                            }
                            break;
                        case 1:
                        case 2:
                        case 3:
                            foreach ($data[$i]['choices'] as $arr){
                                if($arr['text'] == $value){
                                    $data[$i+1] = $arr;
                                    break;
                                }
                            }
                            break;
                    }
                    $i++;
                }

                switch ($count){
                    case 1: return $data[1]['choices']; break;
                    case 2: return $data[2]['choices']; break;
                    case 3: return $data[3]['choices']; break;
                    case 4: return $data[4]['choices']; break;
                }
            }

            if (empty($field->inputs)) {
                return $input_choices;
            }

            foreach ($field->inputs as $key => $inputField) {



                $results = [];
                foreach($results as $value){
                    if($inputField['id'] == $value->field_id) {
                        $inputField['name'] = $value->preset;
                    }
                }

                if ($inputField['id'] == $input_id && !empty($inputField['name']))  {
                    $filteredNames = explode(',', $inputField['name']);

                }

            }
            if (!empty($filteredNames)) {
                foreach ($filteredChoices as $key => $item) {
                    if (!in_array($item['text'], $filteredNames)) {
                        unset($filteredChoices[$key]);
                    }
                }
            }
        }

        return array_values($filteredChoices);
    }

    function add_other_choise_3($input_choices, $form_id, $field, $input_id, $chain_value) {
        $input_choices[] = [
            'text'       => 'Other',
            'value'      => 'other',
            'isSelected' => false
        ];

        return $input_choices;
    }
    function add_other_choise_4($input_choices, $form_id, $field, $input_id, $chain_value) {
        if ($chain_value['8.3'] == 'other') {
            $matressesCategory = get_category_by_slug('ranges');
            $matresses = get_posts([
                'category' => $matressesCategory->cat_ID,
                'post_status'   => 'publish',
                'posts_per_page' => -1
            ]);

            foreach ($matresses as $matress) {
                $input_choices[] = [
                    'text'       => $matress->post_title,
                    'value'      => $matress->post_title,
                    'isSelected' => false
                ];
            }

        }
        $input_choices[] = [
            'text'       => 'Other',
            'value'      => 'other',
            'isSelected' => false
        ];

        return $input_choices;
    }
?>