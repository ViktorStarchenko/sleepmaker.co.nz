<?php
/*
 * Template Name: Technologies page
 * Template Post Type: page
 */
?>
<?php get_header() ?>
<?php
    $fields = get_fields();
    $title = "";
    $description = "";
    if (!empty($fields['title'])) {
        $title = $fields['title'];
    }
    if (!empty($fields['description'])) {
        $description = $fields['description'];
    }

    $technologiesCategory = get_category_by_slug('technologies');
    $taxonomyName = 'category';

    $childCategoriesID = get_term_children( $technologiesCategory->term_id, $taxonomyName );

    foreach ($childCategoriesID as $childID) {
        $childTerms[] = get_term_by( 'id', $childID, $taxonomyName );
    }

    $args = [
        "category"   => $technologiesCategory->term_id,
        "post_status" => "publish",
        "numberposts" => -1
    ];

    $categoryID = NULL;

    if( !empty($_GET[$taxonomyName]) ){
        $categoryID = (int) $_GET[$taxonomyName];
        $args["category"] = (int) $_GET[$taxonomyName];
    }

    $technologies = get_posts($args);
    $technologies = array_reverse($technologies);
    ?>
<div class="container">
				<div class="wrap-in">
					<div class="content-sidebar">
						<div class="content">
                            <?php if (!empty($title)) : ?>
							    <h1><?= $title; ?></h1>
                            <?php endif; ?>
                            <?php if (!empty($description)) : ?>
							    <p><?= $description; ?>:</p>
                            <?php endif; ?>
                        </div>
					</div>
					<div class="page-grid page-grid--top">
						<aside class="page-grid__content">
							<div class="content-sidebar" data-sticky-container>
								<div class="show-desktop">
									<div class="technologies-anchor-wrap js-sticky" data-sticky-class="is-sticky" data-margin-top="150" data-sticky-for="768">
                                        <?php foreach ($technologies as $technology) : ?>
                                            <div class="technologies-anchor"><a class="js-scroll-to" href="#<?= $technology->post_name; ?>"><?= $technology->post_title; ?></a></div>
                                        <?php endforeach;?>
									</div>
								</div>
								<div class="show-mobile">
									<div class="technologies-slider swiper-container js-technologies-slider">
										<div class="swiper-wrapper">
                                            <?php foreach ($technologies as $technology) : ?>
                                                <div class="swiper-slide"><a class="js-scroll-to" href="#<?= $technology->post_name; ?>"><?= $technology->post_title; ?></a></div>
                                            <?php endforeach;?>
										</div>
									</div>
								</div>
							</div>
						</aside>
						<section class="page-grid__main">
							<div class="content-restriction">
                                <?php  foreach ($technologies as $technology) :
                                    $icon = get_field("icon", $technology->ID);
                                    $itemDescription = get_field("description", $technology->ID);
                                    ?>
                                    <div class="technologies-card" id="<?= $technology->post_name; ?>">
                                        <div class="technologies-card__head">
                                            <div class="technologies-card__icon"><img src="<?= $icon['url']?>" alt="tech-logo"/></div>
                                            <div class="technologies-card__description">
                                                <h3 class="technologies-card__tilte"><?= $technology->post_title; ?></h3>
                                                <p><?= $itemDescription; ?></p>
                                            </div>
                                        </div>
                                        <div class="technologies-card__body">
                                            <figure class="video">
                                                <video poster="<?= get_template_directory_uri() ?>/static/build/img/technologies/poster.png">
                                                    <source src="<?= get_template_directory_uri() ?>/static/build/img/technologies/movie.mp4" type="video/mp4"/>
                                                </video>
                                                <button class="video__button js-video-button" type="button"></button>
                                            </figure>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
							</div>
						</section>
					</div>
				</div>
			</div>

<?php get_footer(); ?>