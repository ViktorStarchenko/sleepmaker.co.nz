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
    <div class="wide-decor wide-decor--product" style="background-image:url(<?= $bg ?>)">
        <div class="wide-decor__inner">
            <?php if (!empty($hero['icon'])) : ?>
            <img class="wide-decor__logo-top" src="<?= $hero['icon']['url'] ?>" alt="<?= $title ?>">
            <?php endif; ?>
            <?php if (!empty($title)) : ?>
            <h1 class="wide-decor__title-top"><?= $title ?></h1>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php
    $advantages = get_field('home_categories', $ID);
    if (!empty($advantages['enable'])) {
        echo template_part('home-categories', $advantages);
    }

    $content = get_field('tabs', $ID);
?>
<?php if (!empty($content['enable'])) : ?>
    <div class="container">
      <div class="wrap-in">
        <?php if (!empty($content['title'])) : ?>
            <div class="tabs__title">
                <h2><?= $content['title'] ?></h2>
            </div>
        <?php endif; ?>
        <?php if (!empty($content['items'])) : ?>
            <div class="tabs js-tabs-wrapper">
                <?php if (count($content['items']) > 1) : ?>
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
                                        <a class="tabs__link js-tab-trigger <?= $active ?>" style="color: <?= $item['tabs_color']; ?>" href="#perfect-sleep-<?= $key ?>"><?= $shortTitle ?></a>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
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
                          <div class="product-card">
                            <div class="product-card-img">
                                <?php if (!empty($item['image'])) : ?>
                                        <img src="<?= $item['image']['url'] ?>" alt="<?= $title ?>"/>
                                <?php endif; ?>
                            </div>
                              <div class="product-card-info">
                                <div class="product-info">
                                    <div class="product-info__title"><?= $title ?></div>
                                    <div class="product-info__description"> <?= $item['description'] ?></div>
                                    <div class="product-info__features">
                                        <?php if (!empty($item['icons'])) : ?>
                                            <?php foreach ($item['icons'] as $icon) : ?>
                                            <div class="product-features">
                                                <?php if (!empty($icon['icon'])) : ?>
                                                <div class="product-features__icon">
                                                    <img class="product-features__img" src="<?= $icon['icon']['url'] ?>" alt=""/>
                                                </div>
                                                <?php endif; ?>
                                                <?php if (!empty($icon['content'])) : ?>
                                                <div class="product-features__desc <?php if (empty($icon['icon'])) : ?> no-padding  <?php endif; ?>">
                                                    <div class="product-features__title"><?= $icon['feature_title'] ?></div>
                                                    <div class="product-features__info">
                                                        <?= $icon['content'] ?>
                                                    </div>
                                                <?php endif; ?>
                                                </div>
                                            </div>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                        <?php if (!empty($item['link'])) : ?>
                                            <div class="product-info__bttns">
                                                <a class="bttn" href="<?= $item['link']['url'] ?>" target="<?= $item['link']['target'] ?>"><?= $item['link']['title'] ?></a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                              </div>
                          </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
      </div>
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
            <div class="wrap-in">
                <div class="product-additionally product-additionally--reverse">
                    <div class="product-additionally__content">
                        <div class="content">
                            <?php if (!empty($title)) : ?>
                                <h2><?= $title ?></h2>
                            <?php endif; ?>
                            <?php if (!empty($specifications['description'])) : ?>
                            <div>
                                <p><?= $specifications['description'] ?></p>
                            </div>
                            <?php endif; ?>
                        </div>
                            <div class="accordion-wrap accordion-wrap--product">
                            <?php if (!empty($specifications['items'])) : ?>
                                    <ul class="accordion js-acc accordion--product">
                                        <?php foreach ($specifications['items'] as $item) : ?>
                                            <li class="accordion-item">
                                                <?php if (!empty($item['title'])) : ?>
                                                    <a class="accordion__quest js-acc-trig" href="" ><?= $item['title'] ?><span class="accordion__quest-icon"></span></a>
                                                <?php endif; ?>
                                                <?php if (!empty($item['content'])) : ?>
                                                    <div class="accordion__answer js-acc-targ">
                                                        <?= $item['content'] ?>
                                                    </div>
                                                <?php endif; ?>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>

                            <?php endif; ?>
                            </div>


                    </div>
                    <div class="product-additionally__aside">
                        <ul class="product-icons">
                            <?php if(!empty($specifications['icons'])) : ?>
                                <?php foreach($specifications['icons'] as $icon):?>
                                    <li class="product-icons__item"><img class="product-icons__img" src="<?= $icon['icon']['url']?>" alt=""></li>
                                <?php endforeach;?>
                            <?php endif;?>
                          </ul>
                    </div>

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
        <div class="wrap-in">
            <div class="product-additionally">
                    <?php if (!empty($faq['title'])) : ?>
                        <div class="product-additionally__aside">
                            <div class="content">
                                <h2><?= $faq['title'] ?></h2>
                            </div>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($faq['items'])) : ?>
                    <div class="product-additionally__content">
                        <div class="accordion-wrap accordion-wrap--produc">
                            <ul class="accordion js-acc accordion--product">
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
                    </div>
                    <?php endif; ?>
            </div>
            <?php
                $selectorBlock = get_field('selector_block', get_the_ID());
                if ($selectorBlock['enabled']):?>
                <div class="long-card-wrap">
                    <div class="long-card">
                        <div class="long-card__info" style="background:#002e5d; color:#ffffff">
                            <div class="long-card__info-inner">
                                <div class="long-card__title"><?= $selectorBlock['title'] ?></div>
                                <p><?= $selectorBlock['description'] ?></p><a class="bttn bttn--inverse" href="<?= $selectorBlock['button']['link'] ?>"><?= $selectorBlock['button']['label'] ?></a>
                            </div>
                        </div>
                        <div class="long-card__image"><img src="<?= $selectorBlock['bg_image']['url'] ?>" alt="long-img-1"/></div>
                    </div>
                </div>
                <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
<?php get_footer();