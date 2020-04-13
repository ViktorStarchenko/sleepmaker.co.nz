<?php
/*
 * Template Name: Article post
 * Template Post Type: post
 */
?>
<?php

    $blogPageID = 164;

    $excludedPosts = [
        get_the_ID()
    ];

    global $wp_query;

    $wp_query = new WP_Query(array(
        'category_name' => 'blog',
        'posts_per_page' => 3,
        'post__not_in' => $excludedPosts
    ));
    $icons = get_field('social_icons', get_the_ID());
?>
<?php get_header(); ?>
    <?php
        $image[0] = '';
        if (has_post_thumbnail( $post->ID ) ) {
            $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' );
        }
    ?>
    <div class="screen-hero" style="background-image: url(<?= $image[0] ?>)"></div>
    <div class="container">
        <div class="wrap-in">
            <article class="article">
                <h1><?= get_the_title() ?></h1>
                <div class="content">
                    <?php  $id=get_the_ID();
                    $post = get_post($id);
                    $content = apply_filters('the_content', $post->post_content);
                    echo $content; ?>
                </div>
            </article>
        </div>
    </div>
    <div class="share-wrap">
        <div class="container">
            <div class="share">
                <div class="share-item share-item--social">
                    <div class="share-item__title">Share via:</div>
                    <div class="flex-center">
                        <ul class="share-social share-item__list">
                            <?php foreach ($icons as $icon){
                                switch($icon['type']) {
                                    case 'fb':
                                        ?>
                                        <li class="share-social__item"><a class="share-social__link" href="<?= $icon['link']?>"><img class="share-social__img share-social__facebook" src="<?= $icon['icon']['url']?>" alt="facebook"/></a></li>
                                     <?php break;
                                    case 'tw': ?>
                                        <li class="share-social__item"><a class="share-social__link" href="<?= $icon['link']?>"><img class="share-social__img share-social__twitter" src="<?= $icon['icon']['url']?>" alt="twitter"/></a></li>
                                    <?php break;
                                    default: ?>
                                        <li class="share-social__item">
                                            <a class="share-social__link" href="mailto:?subject=I wanted you to see this site&amp;body=Check out this site <?= $_SERVER['WP_HOME'] ?>">
                                                <img class="share-social__img share-social__envelope" src="<?= $icon['icon']['url']?>" alt="envelope"/>
                                            </a>
                                        </li>
                                    <?php
                                }
                            }
                                ?>

                        </ul>
                    </div>
                </div>
                <div class="share-item share-item--helpful">
                    <div class="share-item__title">Was this article helpful?</div>
                    <?= do_shortcode("[rating-system-posts]"); ?>
                </div>
            </div>
        </div>
    </div>
    <?php if ( have_posts() && !empty(get_field('other_posts')) ) : ?>
        <div class="container">
            <h2 class="h1 article-card-title"><?= get_field('other_posts_title') ?></h2>
            <div class="article-card-slider">
                <div class="swiper-container js-article-card-slider">
                    <div class="swiper-wrapper">
                        <?php while( have_posts() ) : ?>
                            <?php
                                the_post();
                                $cta = "Read more";
                                $image[0] = '';
                                if (has_post_thumbnail() ) {
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                                }

                                $preview = get_field('preview', get_the_ID());
                                if (!empty($preview)) {
                                    $image[0] = $preview['url'];
                                }
                            ?>
                            <div class="article-card swiper-slide">
                                <?php if (!empty($image[0])) : ?>
                                <div class="article-card__img">
                                    <img src="<?= $image[0] ?>" alt="<?= get_the_title() ?>"/>
                                </div>
                                <?php endif; ?>
                                <div class="article-card__info">
                                    <div class="article-card__title"><?= get_the_title() ?></div>
                                    <?php $excerpt = get_the_excerpt(); ?>
                                    <?php if($excerpt) : ?>
                                        <p><?= $excerpt ?></p>
                                    <?php endif; ?>
                                </div><a class="link-top" href="<?= get_permalink() ?>"><?= $cta ?></a>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
                <div class="article-card-slider__pagination js-article-card-slider-pagination"></div>
            </div>
            <a class="button button--accent view-all-articles" href="<?= get_permalink($blogPageID) ?>"><?= get_field('other_posts_button') ?></a>
        </div>
        <?php
            wp_reset_query();
        ?>
    <?php endif; ?>
<?php get_footer();
