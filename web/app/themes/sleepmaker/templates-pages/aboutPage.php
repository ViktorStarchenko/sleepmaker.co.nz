<?php
/*
 * Template Name: About page
 * Template Post Type: page
 */
?>
<?php get_header() ?>
<?php
    $fields = get_fields();
    $bg = "";
    $title = get_the_title();
    $sub_title = "";

    if (!empty($fields['hero']['title'])) {
        $title = $fields['hero']['title'];
    }

    if (!empty($fields['hero']['background'])) {
        $bg = $fields['hero']['background']['url'];
    }

    if (!empty($fields['hero']['sub_title'])) {
        $sub_title = $fields['hero']['sub_title'];
    }
?>

<div class="screen-hero" style="background-image: url(<?= $bg ?>)"></div>
    <div class="container">
        <div class="wrap-in">
            <article class="article">
                <div class="content">
                    <h1><?= $title; ?></h1>
                    <?php if (!empty($fields['hero']['description'])) : ?>
                    <p><?= $fields['hero']['description'] ?></p>
                    <?php endif; ?>
                </div>
            </article>
        </div>
    </div>

<?php if (!empty($fields['tabs']['enable']) && !empty($fields['tabs']['tabs'])) : ?>
<div class="container">
    <div class="tabs js-tabs-wrapper">
        <div class="tabs__container">
            <div class="swiper-container tabs__header js-row-slider">
                <ul class="swiper-wrapper tabs__list">
                    <?php foreach ($fields['tabs']['tabs'] as $key => $item) : ?>
                        <?php
                            $active = " ";

                            if (!empty($_REQUEST['tab'])) {
                                if($_REQUEST['tab']==$key) {
                                    $active = " active ";
                                }
                            } else {
                                if ($key == 0) {
                                    $active = " active ";
                                }
                            }
                        ?>
                        <li class="swiper-slide tabs__item"><a class="tabs__link js-tab-trigger <?= $active ?>" href="#about-<?= $key ?>"><?= $item['title'] ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="tabs__body">
            <?php foreach ($fields['tabs']['tabs'] as $key => $item) : ?>
                <?php
                    $active = " ";
                    if (!empty($_REQUEST['tab'])) {
                        if($_REQUEST['tab']==$key) {
                            $active = " active ";
                        }
                    } else {
                        if ($key == 0) {
                            $active = " active ";
                        }
                    }
                ?>
                <div class="tabs__content js-tab-content <?= $active ?>" id="about-<?= $key ?>">
                    <div class="about-content">
                        <?php if (!empty($item['text'])) : ?>
                        <div class="about-content__text">
                            <div class="content">
                                <?= $item['text'] ?>
                            </div>
                        </div>
                        <?php endif; ?>
                        <?php if (!empty($item['image'])) : ?>
                        <div class="about-content__img">
                            <img src="<?= $item['image']['url'] ?>" alt="<?= $item['title'] ?>">
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>
<?php get_footer() ?>