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
    <div class="inner-page inner-page--reverse">
        <?php if (!empty($sideBarEnable)) : ?>
        <div class="inner-page__side">
            <?php
                echo template_part('sideBar', []);
            ?>
        </div>
        <?php endif; ?>
        <div class="inner-page__base">
            <h1 class="inner-page__title"><?= $title ?></h1>
            <?php if (!empty($data['enable']) && !empty($data['faq'])) : ?>
            <div class="content content--bottom">
                <?php
                    $cnt = count($data['faq']) - 1;
                    foreach ($data['faq'] as $key => $items) : ?>
                    <?php if (!empty($items['title'])) : ?>
                    <h2><?= $items['title']; ?></h2>
                    <?php endif; ?>
                    <?php if (!empty($items['questions'])) : ?>
                    <ul class="accordion js-acc accordion--content">
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
        </div>
    </div>
</div>
<?php get_footer() ?>