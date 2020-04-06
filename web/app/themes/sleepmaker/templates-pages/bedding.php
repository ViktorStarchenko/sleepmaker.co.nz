<?php
/*
 * Template Name: Bedding page
 * Template Post Type: page
 */

    $beddingCategory = get_category_by_slug('bedding');
    $taxonomyName = 'category';

    $childCategoriesID = get_term_children( $beddingCategory->term_id, $taxonomyName );

    foreach ($childCategoriesID as $childID) {
        $childTerms[] = get_term_by( 'id', $childID, $taxonomyName );
    }

    $args = [
        "category"   => $beddingCategory->term_id,
        "post_status" => "publish",
        "numberposts" => -1
    ];

    $categoryID = NULL;

    if( !empty($_GET[$taxonomyName]) ){
        $categoryID = (int) $_GET[$taxonomyName];
        $args["category"] = (int) $_GET[$taxonomyName];
    }

    $posts = get_posts($args);
?>
<?php get_header(); ?>

    <div class="container">
        <div class="inner-page">
            <div class="inner-page__side">
                <h1 class="inner-page__title"><?= get_the_title() ?></h1>
                <div class="content">
                    <?= get_the_content() ?>
                </div>
                <!-- Filter -->
                <div class="filters">
                    <div class="filters-title js-filter-title">Filter By:
                        <div class="filters-title__icon"></div>
                    </div>
                    <div class="filters-wrap js-filter-content">
                        <?php
                            $activeAll = '';
                            if ( $categoryID == NULL) {
                                $activeAll = ' active ';
                            }
                        ?>
                        <div >
                            <a href="<?= get_permalink( get_the_ID() ) ?>" class="filter-item <?= $activeAll ?>">
                                <span class="filter-item__text">All</span>
                                <span class="filter-item__icon"></span>
                            </a>
                        </div>
                        <?php foreach ( $childTerms as $term ) : ?>
                            <?php
                            $active = '';
                            if ( $categoryID == $term->term_id) {
                                $active = ' active ';
                            }
                            ?>
                            <div >
                                <a href="?<?= $taxonomyName ?>=<?= $term->term_id ?>" class="filter-item <?= $active ?>">
                                    <span class="filter-item__text"><?= $term->name ?></span>
                                    <span class="filter-item__icon"></span>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Filter -->
            </div>
            <?php if (!empty($posts)) : ?>
            <div class="inner-page__base">
                <div class="bedding-card-wrap">
                <!-- Posts -->
                <?php foreach ( $posts as $key => $post ) : ?>
                    <?php
                        $cta = "Learn more";
                        $postTitle = $post->post_title;
                        $postImage = "";
                        $postExcerpt = $post->post_excerpt;
                        $image[0] = "";
                        if (has_post_thumbnail($post->ID)) {
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'large' );
                            $postImage = $image[0];
                        }
                        $postData = get_field("modal", $post->ID);
                    ?>
                    <div class="bedding-card">
                        <?php if (!empty($postImage)) : ?>
                        <div class="bedding-card__image">
                            <img src="<?= $postImage ?>" alt="<?= $postTitle ?>"/>
                        </div>
                        <?php endif; ?>
                        <div class="bedding-card__title"><?= $postTitle ?></div>
                        <?php if (!empty($postExcerpt)) : ?>
                        <div class="bedding-card__text">
                            <p><?= $postExcerpt ?></p>
                        </div>
                        <?php endif; ?>
                        <button class="bedding-card__link js-modal-open" data-modal-id="modal" data-modal-html="#bedding-content-<?= $key ?>"><?= $cta ?></button>
                        <div class="get-content" id="bedding-content-<?= $key ?>" style="display:none; visibility: hidden;">
                            <div class="modal-content">
                                <h4 class="h1 modal-content__title"><?= $postTitle ?></h4>
                                <div class="modal-info">
                                    <div class="modal-info__text">
                                        <?php if (!empty($postData['content'])) : ?>
                                        <div class="content">
                                            <?php foreach ($postData['content'] as $item) : ?>
                                                <h3><?= $item['title'] ?></h3>
                                                <?= $item['text'] ?>
                                            <?php endforeach; ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <?php if (!empty($postData['image'])) : ?>
                                    <div class="modal-info__img"><img src="<?= $postData['image']['url'] ?>" alt="<?= $postTitle ?>"/></div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php if (!empty($postData['buttons'])) : ?>
                            <div class="modal-footer">
                                <?php foreach ($postData['buttons'] as $button) : ?>
                                    <div class="modal-footer__item"><a class="modal-footer__link" href="<?= $button['link']['url'] ?>" target="<?= $button['link']['target'] ?>"><?= $button['link']['title'] ?></a></div>
                                <?php endforeach; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; wp_reset_postdata(); ?>
                <!-- Posts -->
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer();
