<?php
/*
 * Template Name: Product
 * Template Post Type: post
 */
?>
<?php
$ID = get_the_ID();
?>
<?php get_header(); ?>
<?php
    $hero = get_field('hero', $ID);
?>
<?php if (!empty($hero['enable'])) : ?>
    <?php
        $title = "";
        $bg = "";
        if (!empty($hero['title'])) {
            $title = $hero['title'];
        }

        if (!empty($hero['background'])) {
            $bg = $hero['background']['url'];
        }
    ?>
    <div class="first-screen" style="background-image: url(<?= $bg ?>)">
        <div class="container">
            <?php if (!empty($hero['icon'])) : ?>
            <img class="first-screen__logo" src="<?= $hero['icon']['url'] ?>" alt="<?= $title ?>">
            <?php endif; ?>
            <?php if (!empty($title)) : ?>
            <h1 class="first-screen__title first-screen__title--category"><?= $title ?></h1>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php
    $advantages = get_field('advantages', $ID);
    if (!empty($advantages['enable'])) {
        echo template_part('advantages', $advantages);
    }

    $content = get_field('tabs', $ID);
?>
<?php if (!empty($content['enable'])) : ?>
    <div class="container">
        <?php if (!empty($content['title'])) : ?>
        <h2 class="h1 product-title"><?= $content['title'] ?></h2>
        <?php endif; ?>
        <?php if (!empty($content['items'])) : ?>
            <div class="tabs js-tabs-wrapper">
                <div class="tabs__container">
                    <div class="swiper-container tabs__header js-row-slider">
                        <ul class="swiper-wrapper tabs__list">
                            <?php foreach ($content['items'] as $key => $item ) : ?>
                                <?php
                                    $active = "";
                                    if ($key == 0) {
                                        $active = " active ";
                                    }
                                    $shortTitle = "";
                                    if (!empty($item['short_title'])) {
                                        $shortTitle = $item['short_title'];
                                    }
                                ?>
                                <li class="swiper-slide tabs__item">
                                    <a class="tabs__link js-tab-trigger <?= $active ?>" href="#perfect-sleep-<?= $key ?>"><?= $shortTitle ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
                <div class="tabs__body">
                    <?php foreach ($content['items'] as $key => $item ) : ?>
                        <?php
                        $active = "";
                        if ($key == 0) {
                            $active = " active ";
                        }
                        $title = "";
                        if (!empty($item['title'])) {
                            $title = $item['title'];
                        }
                        ?>
                        <div class="tabs__content js-tab-content <?= $active ?>" id="perfect-sleep-<?= $key ?>">
                            <div class="product-info">
                                <?php if (!empty($item['image'])) : ?>
                                <div class="product-info-img">
                                    <img src="<?= $item['image']['url'] ?>" alt="<?= $title ?>"/>
                                </div>
                                <?php endif; ?>
                                <div class="product-info-desc">
                                    <?php if (!empty($title)) : ?>
                                    <h3 class="h1 product-info__title"><?= $title ?></h3>
                                    <?php endif; ?>
                                    <?php if (!empty($item['description'])) : ?>
                                        <div class="product-info__text">
                                            <?= $item['description'] ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if (!empty($item['icons'])) : ?>
                                        <?php foreach ($item['icons'] as $icon) : ?>
                                        <div class="product-info-detail">
                                            <?php if (!empty($icon['icon'])) : ?>
                                            <div class="product-info-detail__icon">
                                                <img src="<?= $icon['icon']['url'] ?>" alt=""/>
                                            </div>
                                            <?php endif; ?>
                                            <?php if (!empty($icon['content'])) : ?>
                                                <?= $icon['content'] ?>
                                            <?php endif; ?>
                                        </div>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                    <?php if (!empty($item['link'])) : ?>
                                    <a class="product-info__link button button--accent" href="<?= $item['link']['url'] ?>" target="<?= $item['link']['target'] ?>"><?= $item['link']['title'] ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php
    $specifications = get_field('specifications', $ID);
    $title = "";
    if (!empty($specifications['title'])) {
        $title = $specifications['title'];
    }
?>
<?php if (!empty($specifications['enable'])) : ?>
    <div class="bg-gray">
        <div class="container">
            <div class="pdoduct-specifications">
                <?php if (!empty($title)) : ?>
                        <h2 class="h1 pdoduct-specifications__title"><?= $title ?></h2>
                <?php endif; ?>
                <?php if (!empty($specifications['description'])) : ?>
                <div class="pdoduct-specifications__text">
                    <?= $specifications['description'] ?>
                </div>
                <?php endif; ?>
                <div class="accordion-wrap">
                <?php if (!empty($specifications['items'])) : ?>
                    <div class="accordion-inner">
                        <ul class="accordion js-acc">
                            <?php foreach ($specifications['items'] as $item) : ?>
                                <li class="accordion-item">
                                    <?php if (!empty($item['title'])) : ?>
                                        <a class="accordion__quest js-acc-trig" href=""><?= $item['title'] ?><span class="accordion__quest-icon"></span></a>
                                    <?php endif; ?>
                                    <?php if (!empty($item['content'])) : ?>
                                        <div class="accordion__answer js-acc-targ">
                                            <?= $item['content'] ?>
                                        </div>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                    <?php if (!empty($specifications['image'])) : ?>
                        <div class="accordion-decor">
                            <img class="accordion-decor__img" src="<?= $specifications['image']['url'] ?>" alt="<?= $title ?>"/>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php
    $faq = get_field('faq', $ID);
?>
<?php if (!empty($faq['enable'])) : ?>
    <div class="container">
        <div class="pdoduct-specifications">
            <div class="accordion-wrap">
                <?php if (!empty($faq['title'])) : ?>
                <div class="accordion-title">
                    <h2 class="h1 pdoduct-specifications__title"><?= $faq['title'] ?></h2>
                </div>
                <?php endif; ?>
                <?php if (!empty($faq['items'])) : ?>
                <div class="accordion-inner">
                    <ul class="accordion js-acc">
                        <?php foreach ($faq['items'] as $item) : ?>
                        <li class="accordion-item">
                            <?php if (!empty($item['title'])) : ?>
                            <a class="accordion__quest js-acc-trig" href=""><?= $item['title'] ?><span class="accordion__quest-icon"></span></a>
                            <?php endif; ?>
                            <?php if (!empty($item['content'])) : ?>
                            <div class="accordion__answer js-acc-targ">
                                <?= $item['content'] ?>
                            </div>
                            <?php endif; ?>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php get_footer();