<?php
/*
 * Template Name: Reviews Page
 * Template Post Type: page
 */

add_action('wp_head', 'add_reviews_js');
?>
<?php get_header(); ?>

    <section id="container" class="app-wrapper__flex">
        <?php
        $catId = get_query_var('cat_id', null);

        $matressesCategory = get_category_by_slug('ranges');
        $matresses = get_posts(
            [
            'category' => $matressesCategory->cat_ID,
            'posts_per_page' => -1
            ]
        );

        ?>

        <div class="article-news-box">
            <div class="app-container">
                <h1 class="page-h1">Reviews</h1>
                <div class="_bottom-tools">
                    <a href="<?= get_the_permalink(); ?>" class="app-button-filter _inline <?php echo $catId === null ? 'active' : ''; ?>">All</a>
                    <?php foreach ($matresses as $matresse) : ?>
                        <?php
                        $showReviews =  true; //get_field('yotpo_show_reviews', $matresse->ID);
                        $yotpoProductId = $matresse->ID; //get_field('yotpo_product_id', $matresse->ID);
                        ?>
                        <?php if ($showReviews) : ?>
                            <a href="?cat_id=<?= $yotpoProductId; ?>" class="app-button-filter _inline <?php echo $catId == $yotpoProductId ? 'active' : ''; ?>"><?= $matresse->post_title; ?></a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="app-container">
            <div class="page-content">
                <?php if ($catId === null) : ?>
                    <div id='yotpo-testimonials-custom-tab' data-mode="questions"></div>
                <?php else: ?>
                    <?php $post = get_post($catId); ?>
                    <?php $postImage = get_field('review_image', $catId); ?>
                    <div class="yotpo yotpo-main-widget"

                         data-product-id="<?= $catId; ?>"

                         data-name="<?= $post->post_title; ?>"

                         data-url="<?= get_post_permalink($catId) ?>"
                        <?php if ($postImage) : ?>
                            data-image-url="<?= $postImage ?>"
                        <?php endif; ?>
                         data-description="<?= $post->post_excerpt; ?>"

                         data-mode="questions"></div>
                <?php endif; ?>
            </div>
        </div>
    </section>

<?php get_footer();