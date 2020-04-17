<?php
/*
 * Template Name: Blog page
 * Template Post Type: page
 */
?>
<?php get_header(); ?>

<?php
    $fields = get_fields();

    $excludedPosts = [];

    if ( !empty($fields["main_article"]) ) {
        $excludedPosts[] = $fields["main_article"]->ID;
    }

    $posts_per_page = !empty( $fields["post_per_page"] ) ? $fields["post_per_page"] : 6;
    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    global $wp_query;

    $wp_query = new WP_Query(array(
        'category_name' => 'blog',
        'posts_per_page' => $posts_per_page,
        'paged' => $paged,
        'post__not_in' => $excludedPosts
    ));

    $title = get_the_title();
    if ( !empty($fields["title"]) ) {
        $title = $fields["title"];
    }

    $content = "";
    if ( !empty($fields["content"]) ) {
        $content = $fields["content"];
    }
?>
 <div class="container">
    <div class="wrap-in">
       <?php if ( $paged == 1) : ?>

        <div class="text-row text-row--center">
            <?php if (!empty($title)) : ?>
            <h1 class="text-row__title"><?= $title ?></h1>
            <?php endif; ?>
            <?php if (!empty($title)) : ?>
            <div class="text-row__text"><?= $content ?></div>
            <?php endif; ?>
        </div>
        <?php if (!empty($fields["main_article"])) : ?>
        <?php
            $article = $fields["main_article"];

            $articleID = $article->ID;
            $title = $article->post_title;
            $url = get_permalink($articleID);
            $excerpt = $article->post_excerpt;
            $cta = "Read more";
            $imageUrl = "#";
            $imageData = [];
            if (has_post_thumbnail( $articleID ) ) {
                $imageData = wp_get_attachment_image_src( get_post_thumbnail_id( $articleID ), 'large' );
                $imageUrl = $imageData[0];
            }

            $preview = get_field('preview' , $articleID);
            if (!empty($preview)) {
                $imageUrl = $preview['url'];
            }
        ?>
        <div class="long-card-wrap">
            <div class="long-card">
                <div class="long-card__info" style="background:#002e5d; color:#ffffff">
                    <div class="long-card__info-inner">
                        <?php if (!empty($title)) : ?>
                        <div class="long-card__title"><?= $title ?></div>
                        <?php endif; ?>
                        <?php if (!empty($excerpt)) : ?>
                        <p><?= $excerpt ?></p>
                        <?php endif; ?>
                        <a class="bttn bttn--inverse" href="<?= $url ?>"><?= $cta ?></a>
                    </div>
                </div>
                <div class="long-card__image"><img src="<?= $imageUrl ?>" alt="long-img-1"/></div>
            </div>
        </div>
        <?php endif; ?>

        <?php endif; ?>

        <div class="article-card-wrap">
            <?php while( have_posts() ) : ?>
                <?php
                    the_post();
                    $title = get_the_title();
                    $cta = "Read more";
                    $image[0] = '';
                    if (has_post_thumbnail()) {
                        $image = wp_get_attachment_image_src( get_post_thumbnail_id(), 'large' );
                    }

                    $preview = get_field('preview', get_the_ID());
                    if (!empty($preview)) {
                        $image[0] = $preview['url'];
                    }
                ?>
                <div class="article-card">
                    <div class="article-card__img">
                        <img
                            src="<?= $image[0] ?>"
                            alt="<?= $title ?>"
                        />
                    </div>
                    <div class="article-card__info">
                        <div class="article-card__title"><?= $title ?></div>
                        <?php $excerpt = get_the_excerpt(); ?>
                        <?php if($excerpt) : ?>
                            <p><?= $excerpt ?></p>
                        <?php endif; ?>
                    </div>
                    <a class="bttn" href="<?= get_permalink() ?>"><?= $cta ?></a>
                </div>
            <?php endwhile; ?>
        </div>
        <?php
        $args = [
            'screen_reader_text' => '',
            'type' => 'array',
            'prev_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="20" stroke-width="1.5" d="M6.485.67v0L1.33 6.006v0l5.155 5.33v0"></path></svg>',
            'next_text' => '<svg xmlns="http://www.w3.org/2000/svg" width="8" height="12" viewBox="0 0 8 12"><path fill="none" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="20" stroke-width="1.5" d="M6.485.67v0L1.33 6.006v0l5.155 5.33v0"></path></svg>'
        ];

        $pagination =  paginate_links($args);
        ?>
        <?php if (!empty($pagination)) : ?>
            <div class="article-pagination">
                <ul class="article-pagination__pages">
                <?php foreach ($pagination as $item) : ?>
                    <li class="article-pagination__number"> <?= $item; ?></li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
    </div>
    </div>
</div>


<?php get_footer();