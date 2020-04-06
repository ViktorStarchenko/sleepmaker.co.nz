<?php
    $articles = [];
    if (!empty($data['show_last'])) {
        $blogCategory = get_category_by_slug('blog');
        $articles = get_posts([
            'category'   => $blogCategory->cat_ID,
            'posts_per_page'   => 3,
            'offset'           => 0,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_status'      => 'publish'
        ]);
    } else if(!empty($data['custom_list'])) {
        $articles = $data['custom_list'];
    }
?>
<div class="bg-gray">
    <div class="container">
        <div class="blog-card-slider">
            <?php if (!empty($data["title"])) : ?>
            <h2 class="h1 blog-card-title"><?= $data["title"] ?></h2>
            <?php endif; ?>
            <?php if (!empty($articles)) : ?>
            <div class="swiper-container js-blog-card-slider">
                <div class="swiper-wrapper">
                    <?php foreach ($articles as $key => $article) : ?>
                    <?php
                        $articleID = 0;
                        $title = "";
                        $url = "#";
                        $imageUrl = "";
                        $imageData = [];
                        $excerpt = "";
                        $cta = "Read more";
                        if (!empty($article)) {
                            $articleID = $article->ID;
                            $title = $article->post_title;
                            $excerpt = $article->post_excerpt;
                            $url = get_permalink($articleID);
                        }

                        if (has_post_thumbnail( $articleID ) ) {
                            $imageData = wp_get_attachment_image_src( get_post_thumbnail_id( $articleID ), 'large' );
                            $imageUrl = $imageData[0];
                        }

                        $preview = get_field('preview' , $articleID);
                        if (!empty($preview)) {
                            $imageUrl = $preview['url'];
                        }
                    ?>
                    <div class="blog-card swiper-slide">
                        <?php if (!empty($imageUrl)) : ?>
                        <div class="blog-card__img">
                            <img
                                src="<?= $imageUrl ?>"
                                alt="<?= $title ?>"
                            />
                        </div>
                        <?php endif; ?>
                        <div class="blog-card__info">
                            <?php if (!empty($title)) : ?>
                            <div class="blog-card__title"><?= $title ?></div>
                            <?php endif; ?>
                            <?php if (!empty($excerpt)) : ?>
                            <p><?= $excerpt ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="blog-card__btn">
                            <a class="bttn bttn--accent" href="<?= $url ?>"><?= $cta ?></a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="blog-card-slider__pagination js-blog-card-slider-pagination"></div>
            <?php endif; ?>
        </div>
    </div>
</div>


