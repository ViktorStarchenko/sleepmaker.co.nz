<?php
/*
 * Template Name: Size page
 * Template Post Type: page
 */
?>
<?php get_header() ?>
<?php
$fields = get_fields();
$bg = "";
$title = get_the_title();
$sub_title = "";
$sizes = [];
$content = [];

if (!empty($fields['hero']['title'])) {
    $title = $fields['hero']['title'];
}

if (!empty($fields['hero']['background'])) {
    $bg = $fields['hero']['background']['url'];
}

if (!empty($fields['hero']['sub_title'])) {
    $sub_title = $fields['hero']['sub_title'];
}

if (!empty($fields['sizes'])) {
    $sizes = $fields['sizes'];
}

if (!empty($fields['content'])) {
    $content = $fields['content'];
}

$mobileContent = "";
?>

    <div class="decor-block" style="background-image: url(<?= $bg ?>)">
        <div class="container">
            <div class="sheep-advantages">
                <div class="decor-block-content">
                    <h1><?= $title; ?></h1>
                    <?php if (!empty($fields['hero']['description'])) : ?>
                        <p><?= $fields['hero']['description'] ?></p>
                    <?php endif; ?>
                </div>
                <div class="advantages-wrap advantages-wrap--center">
                    <div class="advantages">
                        <?php if ($fields['hero']['icon']) : ?>
                            <div class="advantages__logo"><img src="<?= $fields['hero']['icon']['url'] ?>" alt="<?= $sub_title ?>"/></div>
                        <?php endif; ?>
                        <?php if (!empty($sub_title)) : ?>
                            <div class="advantages__text"><?= $sub_title ?></div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="inner-page inner-page--full">
            <?php if (!empty($content) && !empty($content['enable']) && !empty($content['items'])) : ?>
            <div class="inner-page__side">
                <div class="content-sidebar">
                    <?php foreach ($content['items'] as $key => $item) : ?>
                        <?php
                            $content = '<div class="content">';

                            $title = '';
                            if (!empty($item['title'])) {
                                $title = '<h2>'.$item['title'].'</h2>';
                            }

                            $text = '';
                            if (!empty($item['text'])) {
                                $text = $item['text'];
                            }

                            $link = '';
                            if (!empty($item['link'])) {
                                $link = '<a class="link-top" href="'.$item['link']['url'].'" target="'.$item['link']['target'].'">'.$item['link']['title'].'</a>';
                            }

                            $content .= $title.$text.'</div>'.$link;
                            if ($key > 0) {
                                $mobileContent .= $content.'<div style="margin-bottom: 30px"></div>';
                            }
                        ?>
                        <?php if ($key == 0) : ?>
                            <?= $content; ?>
                        <?php else : ?>
                                <div class="show-desktop">
                                    <hr class="content-devider">
                                    <?= $content; ?>
                                </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
            <?php endif; ?>
            <?php if (!empty($sizes) && !empty($sizes['enable'])) : ?>
            <div class="inner-page__base">
                <div class="size-guide">
                    <?php if (!empty($sizes['items'])) : ?>
                        <div class="size-guide-wrap">
                            <?php foreach ($sizes['items'] as $item) : ?>
                                <?php
                                    $sizeTitle = "";
                                    $sizeValue = "";
                                    $sizeImage = "";
                                    if (!empty($item['title'])) {
                                        $sizeTitle = $item['title'];
                                    }

                                    if (!empty($item['size'])) {
                                        $sizeValue = $item['size'];
                                    }

                                    if (!empty($item['image'])) {
                                        $sizeImage = $item['image']['url'];
                                    }
                                ?>
                                <div class="size-guide-card">
                                    <?php if (!empty($sizeTitle)) : ?>
                                        <div class="size-guide-card__img"><img src="<?= $sizeImage ?>" alt="<?= $sizeTitle ?>"/></div>
                                    <?php endif; ?>
                                    <?php if (!empty($sizeTitle)) : ?>
                                        <div class="size-guide-card__name"><?= $sizeTitle ?></div>
                                    <?php endif; ?>
                                    <?php if (!empty($sizeValue)) : ?>
                                        <div class="size-guide-card__size"><?= $sizeValue ?></div>
                                    <?php endif; ?>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <div class="show-mobile">
                        <?= $mobileContent ?>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </div>
<?php get_footer() ?>