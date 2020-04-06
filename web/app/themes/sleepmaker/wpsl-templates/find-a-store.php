<?php
global $wpsl_settings, $wpsl;
$autoload_class = (!$wpsl_settings['autoload']) ? 'wpsl-not-loaded' : '';

$selectedRetailerId = null;
if (isset($_GET['retailer_id'])) {
    $selectedRetailerId = $_GET['retailer_id'];
}

$postId = null;
if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];
} else if (isset($_GET['range'])) {
    $rangePost = get_page_by_path( $_GET['range'], OBJECT, 'post' );
    if (!is_null($rangePost)) {
        $postId = $rangePost->ID;
    }
}

$collectionId = null;
if (isset($_GET['collection_id'])) {
    $collectionId = $_GET['collection_id'];
} else if (isset($_GET['collection'])) {
    $collectionPost = get_page_by_path( $_GET['collection'], OBJECT, 'post' );
    if (!is_null($collectionPost)) {
        $collectionId = $collectionPost->ID;
    }
}

$query = null;
if (isset($_GET['address'])) {
    $query = $_GET['address'];
}

$retailersGroupCategory = get_category_by_slug('retailer-groups');
$metaQuery = [
    [
        'key'     => 'enable',
        'value'   => true,
        'compare' => '=',
    ],
];

/*
if ($postId) {
    $metaQuery[] = [
        [
            'key'     => 'range',
            'value'   => '"' . $postId . '"',
            'compare' => 'LIKE',
        ],
    ];
}
if ($collectionId) {
    $metaQuery[] = [
        [
            'key'     => 'collections',
            'value'   => '"' . $collectionId . '"',
            'compare' => 'LIKE',
        ],
    ];
}*/

$args = [
    'numberposts'   => -1,
    'category'      => $retailersGroupCategory->cat_ID,
    'post__in'      => get_field('retailers_groups_filter_order'),
    'meta_query'    => $metaQuery,
    'orderby'       => 'post__in'
];

$retailers = get_posts($args);

/*

$matressesCategory = get_category_by_slug('Beds');
$matresses = get_posts(['numberposts' => -1, 'category' => $matressesCategory->cat_ID]);

$collectionsCategory = get_category_by_slug('sleep-collections');
$collections = get_posts(['numberposts' => -1, 'category' => $collectionsCategory->cat_ID]);
*/

ob_start();
?>
    <style>
        #wpsl-stores {
            display: block !important;
        }
        #wpsl-direction-details {
            display: none !important;
        }
    </style>

     <?php /*
                        <div class="app-store-filter__title"><span>Mattresses</span></div>
                        <div class="app-store-filter__list">
                            <?php foreach ($matresses as $matresse): ?>
                                <ul class="app-store-filter__list-nav">
                                    <li><label class="app-button-filter _inline<?= $matresse->ID == $postId ? ' active' : '' ?>"><?= $matresse->post_title ?>
                                            <input type="checkbox" name="range" value="<?= $matresse->ID ?>" <?= $matresse->ID == $postId ? ' checked="checked"' : '' ?> style="display: none;"/>
                                        </label></li>

                                    <?php $subRanges = get_field('sub_ranges', $matresse); ?>
                                    <?php foreach ($subRanges as $subRange): ?>
                                        <?php $lowerCase = preg_match('/([0-9]+)i/', $subRange->post_title) ?>
                                        <li>
                                            <label  class="app-button-filter _inline<?= $lowerCase ? ' _lower-case' : '' ?>">&#8985; &nbsp;<?= $subRange->post_title ?>
                                                <input type="checkbox" name="sub_range" value="<?= $subRange->ID ?>" style="display: none;"/>
                                            </label></li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                        */ ?>
     <?php /*
                        <div class="app-store-filter__title"><span>Collections</span></div>
                        <div class="app-store-filter__list">
                            <?php foreach ($collections as $collection): ?>
                                <ul class="app-store-filter__list-nav">
                                    <li><label class="app-button-filter _inline<?= $collection->ID == $collectionId ? ' active' : '' ?>"><?= $collection->post_title ?>
                                            <input type="checkbox" name="collections" value="<?= $collection->ID ?>" <?= $collection->ID == $collectionId ? ' checked="checked"' : '' ?> style="display: none;"/>
                                        </label>
                                    </li>
                                </ul>
                            <?php endforeach; ?>
                        </div>
                        */ ?>

<?php /*
<?php foreach ($retailers as $retailer): ?>
    <label class="app-button-filter filter-item  <?= $retailer->ID == $selectedRetailerId ? 'active' : null ?>">
        <span class="filter-item__text"><?= get_field('name', $retailer->ID) ?></span>
        <span class="filter-item__icon"></span>
        <input class="retailer-filter-button" type="checkbox" name="retailer" data-name="<?= $retailer->post_name ?>" value="<?= $retailer->ID ?>" style="display: none;" <?= $retailer->ID == $selectedRetailerId ? 'checked="checked"' : null ?>/>
    </label>
<?php endforeach; ?>
 */ ?>

    <div class="container">
        <div class="inner-page">
            <h1><?= get_the_title() ?></h1>
            <div class="map-greed">
                <div class="map-greed__side">
                    <div class="map-search">
                        <form action="" class="search-form">
                            <div class="input-search">
                                <input id="wpsl-search-input" type="text" value="<?= $query ?>" placeholder="Search by suburb, city or postcode" name="wpsl-search-input">
                                <button id="wpsl-search-btn" class="input-search__btn">
                                    <span class="input-search__btn-icon">
												<svg class="icon search">
													<use xlink:href="#search"></use>
												</svg></span>
                                </button>
                            </div>
                        </form>
                        <!--<div class="show-mobile">
                            <div class="current-position">
                                <div class="current-position__title">OR</div><a class="current-position__link" href="#"><span class="current-position__link-icon">
												<svg class="icon pin">
													<use xlink:href="#pin"></use>
												</svg></span>Use my current location</a>
                            </div>
                        </div>-->
                    </div>
                    <div class="map-result">
                        <div id="wpsl-result-list">
                            <div class="search-list" id="wpsl-stores"></div>
                            <div id="wpsl-direction-details" style="display: none;">
                                <ul></ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="map-greed__base">
                    <div class="map-wrap">
                        <div class="map">
                            <div id="wpsl-gmap" class="wpsl-gmap-canvas app-map-big displaysNoneTabs"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php return ob_get_clean();