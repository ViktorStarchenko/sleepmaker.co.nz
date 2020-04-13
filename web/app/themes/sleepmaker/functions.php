<?php

show_admin_bar(false);
//include "include/acfBlocks.php";
include "include/acfAdminPanel.php";
include "include/gfCsvGenerate.php";
include "include/findStore.php";

if (!session_id()){
    session_start();
}

if (!is_admin()) {
    checkPromoPage();
}

function checkPromoPage(){
    if ( !empty($_SERVER['REQUEST_URI']) ) {
        $links = get_field('hideOnPages', 'option');

        $showFlag = true;
        if ( !empty($links) ) {
            foreach( $links as $link ) {
                if( !empty($link['item']) ){
                    $pos = strpos($_SERVER['REQUEST_URI'], $link['item']);
                    if ($pos === false) {

                    } else {
                        $showFlag = false;
                    }
                }
            }
        }

        if ($showFlag) {
            define('SHOW_PROMOBANNER', true);
        } else {
            define('SHOW_PROMOBANNER', false);
        }

    } else {
        define('SHOW_PROMOBANNER', true);
    }
}

function serta_wp_scripts(){
    if (!is_admin()) {
        enqueue_versioned_style('theme-styles', '/static/build/css/app.css');
        enqueue_versioned_style('custom-styles', '/style.css');

        enqueue_versioned_script( 'theme-js',  '/static/build/js/app.js', array('jquery'), true);

        wp_enqueue_script( 'retailers', get_template_directory_uri() . '/include/js/retailers.min.js', ['jquery'], false, true);
        wp_localize_script( 'retailers', 'ajax_variables', ['ajax_url' => admin_url( 'admin-ajax.php' ), 'entity_id' => !empty($_GET['entry_id']) ? $_GET['entry_id'] : ''] );
    }
}

add_action( 'wp_enqueue_scripts', 'serta_wp_scripts' );

add_theme_support( 'post-thumbnails' );
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}

add_filter('upload_mimes', 'cc_mime_types');

function template_part($template, $data = array()){

    extract($data);
    ob_start();
    require get_stylesheet_directory() . '/templates-parts/' . $template . '.php';

    return ob_get_clean();
}

add_filter( 'wpseo_breadcrumb_output', 'custom_wpseo_breadcrumb_output' );
function custom_wpseo_breadcrumb_output( $output ){

    $output = str_replace("<span><span>", "", $output);
    $output = str_replace("</span></span>", "", $output);

    return $output;
}

function dump($data, $exit = false){
    echo "<pre>";
    print_r($data);
    echo "</pre>";

    if($exit){
        exit();
    }
}

function add_reviews_js()
{
    echo '<script type="text/javascript"> (function e(){var e=document.createElement("script");e.type="text/javascript",e.async=!0, e.src="//staticw2.yotpo.com/LbHnsJOaWwOCqFGSSJNpFFQqrJ29IFEDgaGCglgu/widget.js";var t=document.getElementsByTagName("script")[0]; t.parentNode.insertBefore(e,t)})(); </script>';
}
/*
    function add_reviews_js()
    {
        echo '<script type="text/javascript"> (function e(){var e=document.createElement("script");e.type="text/javascript",e.async=!0, e.src="//staticw2.yotpo.com/nTvdl5HFT1TU7SIJWaQU9c4b0n2gzJx11sDi0L8B/widget.js";var t=document.getElementsByTagName("script")[0]; t.parentNode.insertBefore(e,t)})(); </script>';
    }
*/

function enqueue_versioned_script( $handle, $src = false, $deps = array(), $in_footer = false ) {
    wp_enqueue_script( $handle, get_stylesheet_directory_uri() . $src, $deps, filemtime( get_stylesheet_directory() . $src ), $in_footer );
}

function enqueue_versioned_style( $handle, $src = false, $deps = array(), $media = 'all' ) {
    wp_enqueue_style( $handle, get_stylesheet_directory_uri() . $src, $deps = array(), filemtime( get_stylesheet_directory() . $src ), $media );
}

function updateStore() {

    $retailerID = 524;

    $stores = get_posts([
        'post_type' => 'wpsl_stores',
        'post_status' => 'publish',
        'numberposts' => -1
    ]);

    $rangesCategory = get_category_by_slug('ranges');

    $rangesData = get_posts([
        'category'   => $rangesCategory->cat_ID,
        'post_status' => 'publish',
        'numberposts' => -1
    ]);

    $ranges = [];

    foreach ($rangesData as $item) {
        $ranges[] = $item->ID;
    }

    foreach ($stores as $store) {

        //update_post_meta($store->ID, 'retailer', $retailerID);
        //update_post_meta($store->ID, 'ranges', $ranges);

        //ACF function
        update_field( "field_5cf0e537c5f8f", $retailerID, $store->ID );
        update_field( "field_5cf0e6aba94dd", $ranges, $store->ID );
    }
}

?>