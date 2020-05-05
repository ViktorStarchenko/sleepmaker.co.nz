<?php
include 'libs/src/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderFactory;
use Box\Spout\Common\Type;
add_action('admin_menu', 'import_supplier_companies_plugin_setup_menu');

function import_supplier_companies_plugin_setup_menu(){
    add_menu_page( 'Import supplier companies', 'Import store', 'manage_options', 'import-supplier-companies-plugin', 'import_supplier_companies_init' );
}

function import_supplier_companies_init() {
    import_supplier_companies_from_file();

    echo '<h1>There you can import stories from csv, odc or xlsx files!</h1>';
    echo '<h2>Upload a File</h2>';
    echo '<form  method="post" enctype="multipart/form-data">';
    echo '<input type="file" id="supplier_companies_upload_csv" name="supplier_companies_upload_csv"></input>';
    submit_button('Upload');
    echo '</form>';
}
// The functions which is going to do the job
function import_supplier_companies_from_file() {
    $allowed_file_types = [
        'xlsx',
        'csv',
        'ods'
    ];

    if(isset($_FILES['supplier_companies_upload_csv'])){

        $csv = $_FILES['supplier_companies_upload_csv'];

        $uploaded = media_handle_upload('supplier_companies_upload_csv', 0);
        // Error checking using WP functions
        if(is_wp_error($uploaded)){
            echo "Error uploading file: " . $uploaded->get_error_message();
        } else {
            $data = array();
            $errors = array();
            set_time_limit(0);

            // Require some Wordpress core files for processing images
            require_once(ABSPATH . 'wp-admin/includes/media.php');
            require_once(ABSPATH . 'wp-admin/includes/file.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');
            require_once(ABSPATH . 'wp-admin/includes/image.php');

            // Download and parse the xlsx
            $filePath = get_attached_file( $uploaded );

            $paramms = array(
                'retailer'=>0,
                'name'=>1,
                'address'=>2,
                'city'=>3,
                'state'=>4,
                'zip'=>5,
                'country'=>6,
                'lat'=>7,
                'lng'=>8,
                'phone'=>9,
                'bedding'=>10,
                'prestige'=>11,
                'miracoil_advance'=>12,
                'miracoil_classic'=>13,
                'lifestyle_deluxe'=>14,
                'lifestyle_home'=>15
            );

            $retailers = [
              '100% NZ' => 2240,
              'Bedpost' => 2242,
              'Harvey Norman NZ' => 2244,
              'SleepMode' => 2246,
              'McKenzie & Willis' => 2248,
              'National NZ (SM)' => 2250,
              'Target' => 2252,
              'Bed Bath & Beyond' => 2254,
            ];

            $ext = pathinfo($csv['name'], PATHINFO_EXTENSION);
            if (!in_array($ext, $allowed_file_types)) {
                $errors[] = 'Import allowed only for .xlsx, .csv and .ods files';
            } else {
                if ( is_readable( $filePath ) ) {
                    $type = Type::XLSX;
                    switch($ext) {
                        case 'xlsx';
                            $type = Type::XLSX;
                            break;
                        case 'csv';
                            $type = Type::CSV;
                            break;
                        case 'ods';
                            $type = Type::ODS;
                            break;
                        default;
                            $type = Type::XLSX;
                            break;
                    }

                    $reader = ReaderFactory::createFromType($type);
                    $reader->open($filePath);
                    $i = 0;
                    foreach ($reader->getSheetIterator() as $sheet) {
                        $y = 0;
                        foreach ($sheet->getRowIterator() as $r) {
                            $row = $r->toArray();

                            if ($row[0] == 'retailer') {
                                continue;
                            }

                            $retailerID = $retailers[trim($row[$paramms['retailer']])];
                            $mattrassesID = [];

                            if ($row[$paramms['bedding']] === 'Y' ) {
                                $mattrassesID[] = 2256;
                            }

                            if ($row[$paramms['prestige']] === 'Y' ) {
                                $mattrassesID[] = 374;
                            }

                            if ($row[$paramms['miracoil_advance']] === 'Y' ) {
                                $mattrassesID[] = 153;
                            }

                            if ($row[$paramms['miracoil_classic']] === 'Y' ) {
                                $mattrassesID[] = 153;
                            }

                            if ($row[$paramms['lifestyle_deluxe']] === 'Y' ) {
                                $mattrassesID[] = 1578;
                            }

                            if ($row[$paramms['lifestyle_home']] === 'Y' ) {
                                $mattrassesID[] = 630;
                            }

                            dump($row);
                            dump($retailerID);
                            dump($mattrassesID);

                            $postCreated = [
                                'post_title'    => trim($row[$paramms['name']]),
                                'post_status'   => 'publish',
                                'post_type'     => 'wpsl_stores'
                            ];

                            $post = get_page_by_title($row[$paramms['name']], 'OBJECT', 'wpsl_stores');

                            if(isset($post->ID)){
                                $ID = $post->ID;
                            }
                            else{
                                unset($ID);
                            }

                            if (isset($ID)) {
                                echo "Post ".$row[$paramms['name']]." (".$ID.") already exists. Update.<br>";
                                if (get_post_type( $ID ) == 'wpsl_stores') {
                                    //$errors[] = "Post with id ".$r[$paramms['supplier_name']]." (".$ID.") already exists. Update.<br>";
                                }
                            } else {
                                $ID = wp_insert_post( $postCreated );
                                echo "Post ".$row[$paramms['name']]." (".$ID.") insert.<br>";
                            }

                            if(update_post_meta( $ID, 'wpsl_address', $row[$paramms['address']] )) echo '';
                            if(update_post_meta( $ID, 'wpsl_city', $row[$paramms['city']] )) echo '';
                            if(update_post_meta( $ID, 'wpsl_state', $row[$paramms['state']] )) echo '';
                            if(update_post_meta( $ID, 'wpsl_zip', $row[$paramms['zip']] )) echo '';
                            if(update_post_meta( $ID, 'wpsl_country', $row[$paramms['country']] )) echo '';
                            if(update_post_meta( $ID, 'wpsl_phone', $row[$paramms['phone']] )) echo '';
                            if(update_post_meta( $ID, 'wpsl_lat', $row[$paramms['lat']] )) echo '';
                            if(update_post_meta( $ID, 'wpsl_lng', $row[$paramms['lng']] )) echo '';

                            update_field( 'field_5cf0e537c5f8f', $retailerID, $ID );
                            update_field( 'field_5cf0e6aba94dd', $mattrassesID, $ID );

                            $y++;
                        }
                        $i++;
                    }

                    $reader->close();

                } else {
                    $errors[] = "File '$filePath' could not be opened. Check the file's permissions to make sure it's readable by your server.";
                }

                if ( ! empty( $errors ) ) {
                    foreach ($errors as $error) {
                        echo $error;
                    }
                } else {
                    echo 'Import succesfully finished!';
                }
            }
        }
    }
}

?>
