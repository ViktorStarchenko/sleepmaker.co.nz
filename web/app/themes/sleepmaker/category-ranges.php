<?php

    $term = get_queried_object();
    $title = get_field( 'title',  $term);
    $description = get_field( 'short_description',  $term);
    $hero = get_field( 'hero',  $term);

    if ( empty($title) ) {
        $title = $term->name;
    }

    $bg = "";
    if (!empty($hero['background'])) {
        $bg = $hero['background']['url'];
    }

    $heroTitle = $title;
    if (!empty($hero['title'])) {
        $heroTitle = $hero['title'];
    }

    $products = get_posts([
        'category'   => $term->term_id,
        'status' => 'publish',
        'numberposts' => -1
    ]);

    //dump($posts);
?>
<?php get_header(); ?>

    <div class="first-screen" style="background-image: url(<?= $bg ?>)">
        <div class="container">
            <?php if (!empty($hero['icon'])) : ?>
            <img class="first-screen__logo" src="<?= $hero['icon']['url'] ?>" alt="<?= $heroTitle ?>">
            <?php endif; ?>
            <h1 class="first-screen__title first-screen__title--category"><?= $heroTitle ?></h1>
        </div>
    </div>

    <div class="container">
        <div class="text-row">
            <h2 class="h1 text-row__title"><?= $title ?></h2>
            <div class="text-row__text">
                <?= $description ?>
            </div>
        </div>
        <?php if (!empty($products)) : ?>
        <div class="category-card-wrap">
            <?php foreach ($products as $key => $product) : ?>
                <?php
                    $cta = "Learn more";
                    $title = "";
                    $url = "";
                    $image[0] = "";
                    $width = "category-card--w50";
                    $productData = get_field('product', $product->ID);
                    $details = [];

                    if (!empty($product)) {
                        $url = get_permalink($product->ID);
                        $title = $product->post_title;

                        if (has_post_thumbnail($product->ID) ) {
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id($product->ID), 'full' );
                        }

                        if (!empty($productData["category_image"])) {
                            $image[0] = $productData["category_image"]["url"];
                        }
                    }

                    if ($key == 0) {
                        $width = "category-card--w100";
                    }

                    if (!empty($productData['short_details'])) {
                        $details = $productData['short_details'];
                    }
                ?>
                <div class="category-card <?= $width ?>">
                    <?php if (!empty($image[0])) : ?>
                    <div class="category-card__img">
                        <img src="<?= $image[0] ?>" alt="<?= $title ?>"/>
                    </div>
                    <?php endif; ?>
                    <div class="category-card__title"><?= $title ?></div>
                    <?php if (!empty($details)) : ?>
                    <div class="category-card__short js-hide-info" data-count="1" data-elem="p">
                        <?php foreach ($details as $detail) : ?>
                            <?php if (!empty($detail['text'])) : ?>
                                <p><?= $detail['text'] ?></p>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    <div class="category-card__btns"><a class="button button--accent" href="<?= $url ?>"><?= $cta ?></a></div>
                </div>
            <?php endforeach; ?>
        </div>
        <hr class="section-devider">
        <?php endif; ?>
        <div class="long-card-wrap">
            <?php
            $quiz = get_field('quiz_banner_enable', $term);
            if (!empty($quiz)) {
                echo template_part('cardBanner', ['data'=>'quiz']);
            }
            $warranty = get_field('warranty_banner_enable', $term);
            if (!empty($warranty)) {
                echo template_part('cardBanner', ['data'=>'warranty']);
            }
            ?>
        </div>
    </div>
<?php get_footer();