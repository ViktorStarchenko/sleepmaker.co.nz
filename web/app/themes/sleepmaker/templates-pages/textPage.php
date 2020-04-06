<?php
/*
 * Template Name: Text page
 * Template Post Type: page
 */
?>
<?php get_header() ?>
<?php
$fields = get_fields();
$sideBarEnable = get_field('side_bar_enable');

$title = get_the_title();
if ( !empty($data['title']) ) {
    $title = $data['title'];
}
?>
    <div class="container">
        <div class="inner-page inner-page--reverse">
            <?php if (!empty($sideBarEnable)) : ?>
                <div class="inner-page__side">
                    <?php
                    echo template_part('sideBar', []);
                    ?>
                </div>
            <?php endif; ?>
            <div class="inner-page__base">
                <h1 class="inner-page__title"><?= $title ?></h1>
                <div class="content content--bottom">
                    <?php

                    if ( have_posts() ) {
                        while ( have_posts() ) {
                            the_post();
                            the_content();
                        }
                    }

                    ?>
                </div>
            </div>
        </div>
    </div>
<?php get_footer() ?>