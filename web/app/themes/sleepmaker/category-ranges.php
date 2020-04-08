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
    var_dump($bg);
    $heroTitle = $title;
    if (!empty($hero['title'])) {
        $heroTitle = $hero['title'];
    }

    $products = get_posts([
        'category'   => $term->term_id,
        'status' => 'publish',
        'numberposts' => -1
    ]);

?>
<?php get_header(); ?>


    <div class="wide-decor wide-decor--expanded" style="background-image:url(<?= $bg ?>)">
        <div class="wide-decor__inner">
            <h2 class="wide-decor__title-top"><?= $title ?></h2>
            <p><?= $description ?></p>
        </div>
    </div>

    <div class="container">
      <div class="wrap-in">
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
                    <div class="category-card__btns"><a class="bttn" href="<?= $url ?>"><?= $cta ?></a></div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php endif; ?>
        <div class="long-card-wrap">
            <?php
            echo template_part('selectorWarranty');
            ?>
        </div>
      </div>
    </div>
<?php get_footer();