<?php
/*
 * Template Name: Contact Us
 * Template Post Type: page
 */
?>
<?php get_header(); ?>
    <div class="container">
        <div class="inner-page inner-page--reverse">
            <div class="inner-page__side">
                <?php
                    echo template_part('sideBar', []);
                ?>
            </div>
            <div class="inner-page__base">
                <h1 class="inner-page__title"><?= get_the_title(); ?></h1>
                <?php $description = get_the_content(); if ( $description ) : ?>
                    <div class="content">
                        <?= $description ?>
                    </div>
                <?php endif; ?>
                <div class="contacts-form">
                    <div class="form-scale" >
                        <?= do_shortcode('[gravityform id="1" title="false" description="false" ajax="true"]'); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php get_footer();