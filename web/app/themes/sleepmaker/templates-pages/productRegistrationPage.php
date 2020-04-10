<?php
/*
 * Template Name: Product Registration
 * Template Post Type: page
 */
?>
<?php get_header(); ?>

    <div class="container">
        <div class="wrap-in">
            <div class="page-grid">
                <section class="page-grid__main">
                    <div class="content">
                        <h1 class="inner-page__title"><?= get_the_title() ?></h1>
                        <?php  $id=get_the_ID();
                        $post = get_post($id);
                        $content = apply_filters('the_content', $post->post_content);
                        echo $content; ?>
                    </div>
                    <div class="contacts-form">
                        <div class="form-scale">
                            <?= do_shortcode('[gravityform id="2" title="false" description="false" ajax="true"]'); ?>
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