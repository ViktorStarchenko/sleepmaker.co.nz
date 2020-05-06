<?php
/*
 * Template Name: Sleep Selector Page V1
 * Template Post Type: page
 */

?>

<?php get_header(); ?>

<style>
    .main{
        background-color: #F7F6F6;
    }
</style>

    <!-- These files always load from our main server-->

    <script src="https://selector.thecomfortgroup.co/pub/media/js/sleepmaker_sleepmakernz.js"></script>
    <script src="https://selector.thecomfortgroup.co/pub/media/js/sleepsaas_sleepyheadau.js"></script>
    <script src="https://selector.thecomfortgroup.co/pub/media/js/main.js"></script>

    <!-- These files always load from the local web site-->
    <link rel="stylesheet" href="/app/themes/sleepmaker/style.css?ver=1587461522">
    <link href="https://fonts.googleapis.com/css?family=PT+Serif" rel="stylesheet">

    <div id="tcg_selector_container" style="margin: 0px !important;"></div>
    <script>
        tcg_init_selector('09b419a7af87a518e4fe6ed939340597', 1);

    </script>
<?php get_footer();
