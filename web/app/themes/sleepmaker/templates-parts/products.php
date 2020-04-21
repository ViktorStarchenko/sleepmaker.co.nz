<?php
if(!empty($data['show_last'])) {
    $ranges = get_category_by_slug('ranges');
    $posts = get_posts([
        'category'   => $ranges->cat_ID,
        'numberposts' => -1
    ]);
} else {
    $posts = $data['custom_list'];
}
?>
<div class="container">
    <div class="wrap-in">
        <div class="home-category-slider">
            <div class="swiper-container js-home-category-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($posts as $post):
                        $product_details = get_field('product', $post->ID);
                        ?>
                        <div class="swiper-slide">
                            <div class="home-category-card">
                                <div class="home-category-card__bg"><img class="home-category-card__img" src="<?= $product_details['category_image']['url']; ?>" srcset="/img/home-category/home-category-1@2x.png 2x" alt="home-category-1"/>
                                </div>
                                <div class="home-category-card__info">
                                    <div class="home-category-card__title" style="color: <?= $product_details['title_color']; ?>"><?= $post->post_title; ?></div>
                                    <p><?= $product_details['short_details'][0]['text']; ?></p>
                                    <div class="home-category-card__bttn"><a class="bttn" href="<?= $product_details['link']['url']?>"><?= $product_details['link']['label']; ?></a></div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="slider-button slider-button--prev js-home-category-prev">
                    <div class="slider-button__icon">
                        <svg class="icon left-arrow">
                            <use xlink:href="#left-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="slider-button slider-button--next js-home-category-next">
                    <div class="slider-button__icon">
                        <svg class="icon left-arrow">
                            <use xlink:href="#left-arrow"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="devider">