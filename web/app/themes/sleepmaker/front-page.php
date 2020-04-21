<?php get_header() ?>
<?php
    $ID = get_the_ID();

    $hero = get_field('hero', $ID);
    if (!empty($hero['enable'])) {
        echo template_part('hero', $hero);
    }

    $homeCategories = get_field('home_categories', $ID);
    if (!empty($homeCategories['enable'])) {
        echo template_part('home-categories', $homeCategories);
    }

    $homeProducts= get_field('products', $ID);
    if (!empty($homeProducts['enable'])) {
        echo template_part('products', $homeProducts);
    }

    echo template_part('selectorWarranty');
    $blog = get_field('blog', $ID);
    if (!empty($blog['enable'])) {
        echo template_part('blogSlider', $blog);
    }



    if ( have_posts() ) {
        while ( have_posts() ) {
            the_post();
            the_content();
        }
    }
?>
<?php get_footer() ?>