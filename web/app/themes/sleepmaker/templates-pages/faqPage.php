<?php
/*
 * Template Name: FAQ page
 * Template Post Type: page
 */
?>
<?php get_header() ?>
<?php
    $data = get_field('faq');
    $sideBarEnable = get_field('side_bar_enable');

    $title = get_the_title();
    if ( !empty($data['title']) ) {
        $title = $data['title'];
    }
?>

<div class="container">
    <div class="wrap-in">
        <div class="page-grid">
                <section class="page-grid__main">
                        <div class="content">
                            <h1 class="inner-page__title"><?= $title ?></h1>
                        </div>
                        <?php if (!empty($data['enable']) && !empty($data['faq'])) : ?><div class="accordion-wrap">
                            <?php
                                $cnt = count($data['faq']) - 1;
                                foreach ($data['faq'] as $key => $items) : ?>
                                <?php if (!empty($items['title'])) : ?>
                                <h3 class="accordion-title"><?= $items['title']; ?></h3>
                                <?php endif; ?>
                                <?php if (!empty($items['questions'])) : ?>
                                <ul class="accordion js-acc">
                                    <?php foreach ($items['questions'] as $question) : ?>
                                        <li class="accordion-item">
                                            <?php if (!empty($question['question'])) : ?>
                                            <a class="accordion__quest js-acc-trig" href=""><?= $question['question'] ?><span class="accordion__quest-icon"></span></a>
                                            <?php endif; ?>
                                            <?php if (!empty($question['answer'])) : ?>
                                            <div class="accordion__answer js-acc-targ">
                                                <?= $question['answer'] ?>
                                            </div>
                                            <?php endif; ?>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                                <?php if ($cnt > $key) : ?>
                                <hr class="content-devider">
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <?php endif; ?>
                </section>

            <?php if (!empty($sideBarEnable)) : ?>
            <aside class="page-grid__sidebar">
                    <?php
                    echo template_part('sideBar', []);
                    ?>
            </aside>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer() ?>