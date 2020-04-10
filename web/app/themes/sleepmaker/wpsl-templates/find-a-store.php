<?php
global $wpsl_settings, $wpsl;
$autoload_class = (!$wpsl_settings['autoload']) ? 'wpsl-not-loaded' : '';

$selectedRetailerId = null;
if (isset($_GET['retailer_id'])) {
    $selectedRetailerId = $_GET['retailer_id'];
}

$selectedRangeId = null;
if (isset($_GET['range_id'])) {
    $selectedRangeId = $_GET['range_id'];
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
$rangesCategory = get_category_by_slug('ranges');
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
    'category'      => $rangesCategory->cat_ID,
];

$ranges = get_posts($args);

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
        #wpsl-gmap{
            width: 100%;
        }
        #wpsl-result-list{
            width: 100%;
            /*border-bottom: 0;*/
        }
        #wpsl-stores{
            height: 100%;
        }
        #wpsl-search-input{
            width: 100%;
            font-size: 14px;
            padding: 16px 45px 16px 24px;
        }
        #wpsl-search-btn{
            border: 0;
            background-color: unset;
            background-image: none;
            box-shadow: unset;
            color: black;
            padding: unset;
            margin-right: unset;
        }
    </style>

<?php /*
<?php foreach ($retailers as $retailer): ?>
    <label class="app-button-filter filter-item  <?= $retailer->ID == $selectedRetailerId ? 'active' : null ?>">
        <span class="filter-item__text"><?= get_field('name', $retailer->ID) ?></span>
        <span class="filter-item__icon"></span>
        <input class="retailer-filter-button" type="checkbox" name="retailer" data-name="<?= $retailer->post_name ?>" value="<?= $retailer->ID ?>" style="display: none;" <?= $retailer->ID == $selectedRetailerId ? 'checked="checked"' : null ?>/>
    </label>
<?php endforeach; ?>

                    <div class="filter-store">
                        <div class="filter-store__title">Filter by:</div>
                        <div class="filter filter-store__elems">
                            <input class="filter__input" type="checkbox" name="" id="find-store">
                            <label class="filter__label" for="find-store">Memory</label>
                        </div>
                    </div>

 */ ?>
<?php $fields = get_fields(get_page_by_path('find-a-store')->ID); ?>
    <main class="main">
        <div class="container">
            <div class="wrap-in">
                <div class="page-grid">
                    <aside class="page-grid__content">
                        <div class="map-greed__title">
                            <h1><?= $fields['title'] ?></h1>
                            <p><?= $fields['text'] ?></p>
                        </div>
                        <div class="map-search">
                            <form class="find-form" action="/">
                                <div class="find-form__row">
                                    <div class="find-form__item">
                                        <div class="find-form__field">
                                            <input id="wpsl-search-input" type="search" name="findSearch" placeholder="Search by suburb, city or postcode">
                                            <button class="find-form__submit" type="button"></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="find-form__row">
                                    <div class="find-form__item">
                                        <div class="find-form__field">
                                            <div class="find-filter js-drop-filter">
                                                <div class="find-filter__select js-drop-filter-trigger" data-select="Filter by range">
                                                    <div class="find-filter__select-title"><span class="js-drop-filter-selected">Search by range</span></div>
                                                    <div class="find-filter__select-icon"></div>
                                                </div>
                                                <div class="find-filter__drop">
                                                    <ul class="filter-drop">

                                                        <?php foreach ($ranges as $range): ?>
                                                            <li class="filter-drop__item js-drop-filter-item">
                                                                <input  class="filter-drop__check" type="checkbox" id="<?= $range->ID ?>" name="range" value="<?= $range->ID ?>" style="display: none;" <?= $range->ID == $selectedRangeId ? 'checked="checked"' : null ?>/>
                                                                <label class="filter-drop__label  <?= $range->ID == $selectedRangeId ? 'active' : null ?>" for="<?= $range->ID ?>"><?=  $range->post_title;  ?></label>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="find-form__item">
                                        <div class="find-form__field">
                                            <div class="find-filter js-drop-filter">
                                                <div class="find-filter__select js-drop-filter-trigger" data-select="Filter by retailer">
                                                    <div class="find-filter__select-title"><span class="js-drop-filter-selected">Search by retailer</span></div>
                                                    <div class="find-filter__select-icon"></div>
                                                </div>
                                                <div class="find-filter__drop">
                                                    <ul class="filter-drop">
                                                        <?php foreach ($retailers as $retailer): ?>
                                                            <li class="filter-drop__item js-drop-filter-item">
                                                                <input  class="filter-drop__check" id="<?= $retailer->ID ?>" type="checkbox" name="retailer" value="<?= $retailer->ID ?>" style="display: none;" <?= $retailer->ID == $selectedRetailerId ? 'checked="checked"' : null ?>/>
                                                                <label class="filter-drop__label <?= $retailer->ID == $selectedRetailerId ? 'active' : null ?>"  for="<?= $retailer->ID ?>"><?= get_field('name', $retailer->ID);  ?></label>
                                                            </li>
                                                        <?php endforeach; ?>

                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </form>

                        </div>
                        <div class="tabs-find js-tabs-wrapper">
                            <div class="tabs-find__result"></div>
                            <div class="tabs-find__container">
                                <div class="tabs-find__list">
                                    <div class="tabs-find__item"><a class="tabs-find__link js-tab-trigger active" href="#tab-1">RETAIL STORES</a></div>
                                    <div class="tabs-find__item"><a class="tabs-find__link js-tab-trigger" href="#tab-2">ONLINE STORES</a></div>
                                </div>
                            </div>
                            <div class="tabs-find__body">
                                <div class="tabs-find__content js-tab-content" id="tab-1">
                                    <div id="wpsl-result-list" >
                                        <div class="search-list" id="wpsl-stores"></div>
                                        <div id="wpsl-direction-details" style="display: none;">
                                            <ul></ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </aside>
                    <section class="page-grid__main">
                        <div class="content-restriction">
                            <div class="map-wrap">
                                <div class="map">
                                    <div id="wpsl-gmap" class="map-wrap wpsl-gmap-canvas"></div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>




<?php return ob_get_clean();
