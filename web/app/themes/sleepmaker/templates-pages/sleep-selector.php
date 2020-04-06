<?php
/*
 * Template Name: Sleep Selector Page V1
 * Template Post Type: page
 */

?>

<?php get_header(); ?>

    <!-- These files always load from our main server-->

    <script src="https://selector.thecomfortgroup.co/pub/media/js/sleepmaker_serta.js"></script>
    <script src="https://selector.thecomfortgroup.co/pub/media/js/sleepsaas_serta.js"></script>
    <script src="https://selector.thecomfortgroup.co/pub/media/js/main.js"></script>

    <!-- These files always load from the local web site-->
    <link rel="stylesheet" href="/assets/css/vendor.css">
    <link rel="stylesheet" href="/assets/css/style.css">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">

    <div id="tcg_selector_container" style="margin: 0px !important;"></div>
    <script>
        tcg_init_selector('e54496e8be9520c2a82855a55520af71', 1);

    </script>
<?php get_footer();
