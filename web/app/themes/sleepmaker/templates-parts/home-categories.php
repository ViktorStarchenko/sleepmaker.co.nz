<?php
$bg = "";
if (!empty($data['background'])) {
    $bg = $data['background']['url'];
}

$title = "";
if (!empty($data['title'])) {
    $title = $data['title'];
}
?>
<div class="decor-block" style="background-image: url(<?= $bg ?>)">
    <div class="container">
        <div class="sheep-advantages">
            <?php if (!empty($data['image'])) : ?>
            <img class="sheep-advantages__logo"
                 src="<?= $data['image']['large'] ?>"
                 srcset="<?= $data['image']['url'] ?>"
                 alt="<?= $title ?>"
            />
            <?php endif; ?>
            <?php if ($title) : ?>
            <h2 class="sheep-advantages__title"><?= $title ?></h2>
            <?php endif; ?>
            <?php if (!empty($data['icons'])) : ?>
            <div class="advantages-wrap">
                <?php foreach ($data['icons'] as $icon) : ?>
                <div class="advantages">
                    <?php
                        $iconTitle = "";
                        if (!empty($icon['title'])) {
                            $iconTitle = $icon['title'];
                        }
                    ?>
                    <?php if (!empty($icon['image'])) : ?>
                    <div class="advantages__logo">
                        <img
                            src="<?= $icon['image']['large'] ?>"
                            srcset="<?= $icon['image']['url'] ?>"
                            alt="<?= $iconTitle ?>"
                        />
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($iconTitle)) : ?>
                    <div class="advantages__text"><?= $iconTitle ?></div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php

 $ranges = get_category_by_slug('ranges');
 $posts = get_posts([
     'category'   => $ranges->cat_ID,
     'numberposts' => -1
 ]);
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