<?php
/*
 * Template Name: Find a store page
 * Template Post Type: page
 */
?>
<?php
    wp_enqueue_script('wpsl-js', get_template_directory_uri() . '/include/js/wpsl-gmap-custom.min.js', ['jquery'], WPSL_VERSION_NUM, true);
    wp_localize_script( 'wpsl-js', 'wpslAjaxVariables', ['retailers' => get_retailers_list(), 'retailers_groups' => get_retailers_groups() ] );
?>

<?php get_header(); ?>
<?= do_shortcode('[wpsl]'); ?>
<?php get_footer();
