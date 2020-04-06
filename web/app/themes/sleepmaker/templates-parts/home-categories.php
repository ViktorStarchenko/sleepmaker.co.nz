<?php
$bg = "";
if (!empty($data['background'])) {
    $bg = $data['background']['url'];
}

$title = "";
if (!empty($data['title'])) {
    $title = $data['title'];
}
?>
<div class="decor-block" style="background-image: url(<?= $bg ?>)">
    <div class="container">
        <div class="sheep-advantages">
            <?php if (!empty($data['image'])) : ?>
            <img class="sheep-advantages__logo"
                 src="<?= $data['image']['large'] ?>"
                 srcset="<?= $data['image']['url'] ?>"
                 alt="<?= $title ?>"
            />
            <?php endif; ?>
            <?php if ($title) : ?>
            <h2 class="sheep-advantages__title"><?= $title ?></h2>
            <?php endif; ?>
            <?php if (!empty($data['icons'])) : ?>
            <div class="advantages-wrap">
                <?php foreach ($data['icons'] as $icon) : ?>
                <div class="advantages">
                    <?php
                        $iconTitle = "";
                        if (!empty($icon['title'])) {
                            $iconTitle = $icon['title'];
                        }
                    ?>
                    <?php if (!empty($icon['image'])) : ?>
                    <div class="advantages__logo">
                        <img
                            src="<?= $icon['image']['large'] ?>"
                            srcset="<?= $icon['image']['url'] ?>"
                            alt="<?= $iconTitle ?>"
                        />
                    </div>
                    <?php endif; ?>
                    <?php if (!empty($iconTitle)) : ?>
                    <div class="advantages__text"><?= $iconTitle ?></div>
                    <?php endif; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div>
<div class="container">
    <div class="wrap-in">
        <div class="home-category-slider">
            <div class="swiper-container js-home-category-slider">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <div class="home-category-card">
                            <div class="home-category-card__bg"><img class="home-category-card__img" src="app/themes/sleepmaker/static/build/img/home-category/home-category-1.png" srcset="/img/home-category/home-category-1@2x.png 2x" alt="home-category-1"/>
                            </div>
                            <div class="home-category-card__info">
                                <div class="home-category-card__title" style="color:#00263e">Together Alone</div>
                                <p>Do you often wake up uncomfortable with a back ache?</p>
                                <div class="home-category-card__bttn"><a class="bttn" href="#">Learn More</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="home-category-card">
                            <div class="home-category-card__bg"><img class="home-category-card__img" src="app/themes/sleepmaker/static/build/img/home-category/home-category-2.png" srcset="/img/home-category/home-category-2@2x.png 2x" alt="home-category-2"/>
                            </div>
                            <div class="home-category-card__info">
                                <div class="home-category-card__title" style="color:#768692">Miracoil Advance</div>
                                <p>Do you often wake up uncomfortable with a back ache?</p>
                                <div class="home-category-card__bttn"><a class="bttn" href="#">Learn More</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="home-category-card">
                            <div class="home-category-card__bg"><img class="home-category-card__img" src="app/themes/sleepmaker/static/build/img/home-category/home-category-1.png" srcset="/img/home-category/home-category-1@2x.png 2x" alt="home-category-1"/>
                            </div>
                            <div class="home-category-card__info">
                                <div class="home-category-card__title" style="color:#86c8a9">Miracoil Classic</div>
                                <p>Do you often wake up uncomfortable with a back ache?</p>
                                <div class="home-category-card__bttn"><a class="bttn" href="#">Learn More</a></div>
                            </div>
                        </div>
                    </div>
                    <div class="swiper-slide">
                        <div class="home-category-card">
                            <div class="home-category-card__bg"><img class="home-category-card__img" src="app/themes/sleepmaker/static/build/img/home-category/home-category-2.png" srcset="/img/home-category/home-category-2@2x.png 2x" alt="home-category-2"/>
                            </div>
                            <div class="home-category-card__info">
                                <div class="home-category-card__title" style="color:#a4c8e1">Lifestyle</div>
                                <p>Do you often wake up uncomfortable with a back ache?</p>
                                <div class="home-category-card__bttn"><a class="bttn" href="#">Learn More</a></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="slider-button slider-button--prev js-home-category-prev">
                    <div class="slider-button__icon">
                        <svg class="icon left-arrow">
                            <use xlink:href="#left-arrow"></use>
                        </svg>
                    </div>
                </div>
                <div class="slider-button slider-button--next js-home-category-next">
                    <div class="slider-button__icon">
                        <svg class="icon left-arrow">
                            <use xlink:href="#left-arrow"></use>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<hr class="devider">