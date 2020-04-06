<?php
/*
 * Template Name: Promotion post
 * Template Post Type: post
 */
?>
<?php

    $fields = get_fields();

?>
<?php get_header(); ?>
<?php $image[0] = ''; ?>
<?php if (has_post_thumbnail() ): ?>
    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' ); ?>
<?php endif; ?>

<div class="container">
        <div class="inner-page inner-page--reverse">
            <div class="inner-page__side">
                <?php if ( $fields['retailers'] ) : ?>
                    <?php foreach ( $fields['retailers'] as $retailer) : ?>
                        <?php $retailerFields = get_fields( $retailer->ID ); ?>
                        <?php $image[0] = ''; ?>
                        <?php if (has_post_thumbnail($retailer->ID) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($retailer->ID), 'large' ); ?>
                        <?php endif; ?>
                        <div class="find-out-more-logo"><a href="<?= $retailerFields['default_url'] ?>"><img src="<?= $image[0] ?>" alt="<?= $retailer->post_title ?>"></a></div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
            <div class="inner-page__base">
                <h1 class="inner-page__title"><?= get_the_title() ?></h1>
                <div class="content">
                    <?= get_the_content() ?>
                </div>
            </div>
        </div>
        <div class="find-out-more">
            <div class="form-scale" >
                <?php
                $formID = "";
                if ( !empty($fields["formID"]) ) {
                    $formID = $fields["formID"];
                }
                ?>
                <?php if (!empty($formID)) : ?>
                <?= do_shortcode('[gravityform id="'.$formID.'" title="false" description="true" ajax="true"]'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php get_footer();