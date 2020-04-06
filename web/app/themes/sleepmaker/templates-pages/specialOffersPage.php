<?php
/*
 * Template Name: Special Offers
 * Template Post Type: page
 */
?>
<?php get_header(); ?>
<?php

    $productID = null;
    if( isset($_GET['product']) ){
        $productID = $_GET['product'];
    }

    $retailerID = null;
    if( isset($_GET['retailer_id']) ){
        $retailerId = $_GET['retailer'];
    }

    $specialOffersCategory = get_category_by_slug('special-offers');
    $promotionsCategory = get_category_by_slug('promotions');
    $retailerGroups = get_field('retailer_groups_order');
    $rangesCategory = get_category_by_slug('ranges');
    $filtersOrder = get_field('filter_order');

    $promotions = get_posts([
        'category'   => $promotionsCategory->cat_ID,
        'post_status' => 'publish',
        'numberposts' => -1
    ]);

    $tz = get_option('timezone_string');
    $timestamp = time();
    $dt = new DateTime("now", new DateTimeZone($tz));
    $dt->setTimestamp($timestamp);
    $date =  $dt->format('Y-m-d');

    $baseQuery = [
        'relation' => 'AND',
        [
            'key'     => 'start_date',
            'value'   => $date,
            'compare' => '<=',
            'type'    => 'DATE',
        ],
        [
            'key'     => 'end_date',
            'value'   => $date,
            'compare' => '>=',
            'type'    => 'DATE',
        ],
    ];

    $metaQuery = $baseQuery;

    if ($productID) {
        $metaQuery[] = [
            'key'     => 'product',
            'value'   => '"' . $productID . '"',
            'compare' => 'LIKE',
        ];
    }

    if ($retailerID) {
        $metaQuery[] = [
            'key'     => 'retailer_groups',
            'value'   => '' . $retailerID . '',
            'compare' => '=',
        ];
    }

    $posts = get_posts([
        'category'   => $specialOffersCategory->cat_ID,
        'meta_query' => $metaQuery,
        'numberposts' => -1
    ]);

    $orderedPosts = [];
    foreach ($posts as $post) {
        $retailers = [];
        if(get_field('not_all_stores_in_participate', $post->ID)){
            $stores = get_field('stores', $post->ID);
            foreach ($stores as $store){
                $retailers[] = get_field('retailer', $store->ID);
            }
        }
        else{
            $retailers[0] = get_field('retailer_groups', $post->ID);
        }

        $promolink = get_field("link", $post->ID);

        foreach ($retailers as $retailer){

            $key = array_search($retailer->ID, $retailerGroups);
            $retailerID = $retailer->ID;
            $link = '#';
            if( !empty($promolink) ){
                $link = $promolink;
            }
            else{
                $link = get_field('url',$retailerID);
            }

            $range = get_field('product', $post->ID);

            $rID = '';
            if( isset($range[0]->ID) ){
                $rID = $range[0]->ID;
            }

            if ($key !== false) {
                $orderedPosts[$key][$post->ID] = [
                    'post' => $post,
                    'retailer_id' => $retailerID,
                    'promo_url' => $link,
                    'product' => $rID
                ];
            } else {
                $key = count($retailerGroups) + 1;
                $orderedPosts[$key][$post->ID] = [
                    'post' => $post,
                    'retailer_id' => $retailerID,
                    'promo_url' => $link,
                    'product' => $rID
                ];
            }
        }
    }

    ksort($orderedPosts);
    wp_reset_postdata();

    $title = get_the_title();
    $description = get_the_content();
?>

    <div class="container">
        <div class="inner-page">
            <div class="inner-page__side">
                <h1 class="inner-page__title"><?= $title ?></h1>
                <?php if (!empty($description)) : ?>
                <div class="content">
                    <?= $description ?>
                </div>
                <?php endif; ?>
                <!-- Filter -->
                <div class="filters">
                    <div class="filters-title js-filter-title">Filter By:
                        <div class="filters-title__icon"></div>
                    </div>
                    <div class="filters-wrap js-filter-content">
                        <?php
                        $activeAll = '';
                        if ( $productID == null){
                            $activeAll = ' active ';
                        }
                        ?>
                        <div>
                            <a href="<?= get_permalink( get_the_ID() ) ?>" class="filter-item <?= $activeAll ?>">
                                <span class="filter-item__text">All</span>
                                <span class="filter-item__icon"></span>
                            </a>
                        </div>
                        <?php if (!empty($filtersOrder)) : ?>
                            <?php foreach ( $filtersOrder as $filter ) : ?>
                                <?php
                                $args = [
                                    'category'   => $specialOffersCategory->cat_ID,
                                    'meta_query' => array_merge($baseQuery, [[
                                        'key'     => 'product',
                                        'value'   => '"' . $filter->ID . '"',
                                        'compare' => 'LIKE',
                                    ]]),
                                ];
                                $hasOffers = get_posts($args);
                                if (empty($hasOffers)) {
                                    continue;
                                }
                                $active = '';
                                if ( $productID == $filter->ID ){
                                    $active = ' active ';
                                }
                                ?>
                                <div >
                                    <a href="?product=<?= $filter->ID ?>" class="filter-item <?= $active ?>">
                                        <span class="filter-item__text"><?= $filter->post_title ?></span>
                                        <span class="filter-item__icon"></span>
                                    </a>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </div>
                </div>
                <!-- Filter -->
            </div>
            <div class="inner-page__base">
                <?php if ( !empty($promotions) ) : ?>
                    <?php foreach ( $promotions as $promotion) : ?>
                        <?php $image[0] = ''; ?>
                        <?php if (has_post_thumbnail( $promotion->ID ) ): ?>
                            <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $promotion->ID ), 'large' ); ?>
                        <?php endif; ?>
                        <div style="background-image: url(<?= $image[0]; ?>)" class="promo-banner" >
                            <div class="h1 promo-banner__title"><?= $promotion->post_title ?></div>
                            <div class="promo-banner__text"><?= get_field('note', $promotion->ID) ?></div>
                            <div class="promo-banner__btns"><a href="<?= get_permalink( $promotion->ID ) ?>" class="button">Find Out More</a></div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div class="promo-card-wrap">
                    <!-- Posts -->
                    <?php foreach ($retailerGroups as $retailer) : ?>
                        <?php foreach ($orderedPosts as $posts): ?>
                            <?php foreach ($filtersOrder as $filter) : ?>
                                <?php foreach ($posts as $data): $post = $data['post']; setup_postdata($post); ?>
                                    <?php if( $data['retailer_id'] == $retailer ) : ?>
                                        <?php if( $data['product'] == $filter->ID ) : ?>
                                            <?php $fields = get_fields($post->ID); ?>
                                            <?php $title = !empty( $fields["title"] ) ? $fields["title"] :  $post->post_title; ?>
                                            <?php $description = get_the_excerpt($post->ID); ?>
                                            <?php $date = new DateTime($fields["end_date"], new DateTimeZone($tz)); ?>
                                            <?php $cta = !empty( $fields["cta_button"] ) ? $fields["cta_button"] : "Find out more"; ?>
                                            <?php $url = !empty( $data['promo_url'] ) ? $data['promo_url'] : "#"; ?>
                                            <div class="promo-card">
                                                <?php $image[0] = ''; ?>
                                                <?php if (has_post_thumbnail( $post->ID ) ): ?>
                                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'large' ); ?>
                                                <?php endif; ?>
                                                <?php if (!empty($image[0])) : ?>
                                                    <div class="promo-card__image"><img src="<?= $image[0]; ?>" alt="<?= $title ?>"/></div>
                                                <?php endif; ?>
                                                <?php $image[0] = ''; ?>
                                                <?php if (has_post_thumbnail( $data['retailer_id'] ) ): ?>
                                                    <?php $image = wp_get_attachment_image_src( get_post_thumbnail_id( $data['retailer_id'] ), 'large' ); ?>
                                                <?php endif; ?>
                                                <?php if (!empty($image[0])) : ?>
                                                    <div class="promo-card__logo"><img src="<?= $image[0]; ?>" alt="<?= $title ?>"/></div>
                                                <?php endif; ?>
                                                <div class="promo-card__title"><?= $title ?></div>
                                                <?php if($description) : ?>
                                                <p class="promo-card__text"><?= $description; ?></p>
                                                <?php endif; ?>
                                                <div class="promo-card__btn"><a class="button button--accent" href="<?= $url ?>"><?= $cta ?></a></div>
                                                <p class="promo-card__period">Offer ends <?php echo $date->format('d F Y'); ?></p>
                                            </div>
                                        <?php  endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            <?php endforeach;
                            wp_reset_postdata(); ?>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                    <!-- Posts -->
                </div>
            </div>
        </div>
    </div>
<?php get_footer();
