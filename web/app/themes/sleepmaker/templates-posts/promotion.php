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
    <div class="wrap-in">
        <div class="page-grid">
            <section class="page-grid__main">
                <div class="inner-page inner-page--reverse">
                    <div class="content">
                        <h1 class="inner-page__title"><?= get_the_title() ?></h1>
                        <p>
                            <?php $id=get_the_ID();
                            $post = get_post($id);
                            $content = apply_filters('the_content', $post->post_content);
                            echo $content; ?>
                        </p>

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
            </section>

                <aside class="page-grid__sidebar">
                    <?php
                    echo template_part('sideBar', []);
                    ?>
                </aside>

        </div>
    </div>
</div>

<?php get_footer();