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
    <div class="wide-decor" style="background-image:url(<?php echo get_template_directory_uri();?>/static/build/img/bg/home.png)">
        <div class="wide-decor__inner">
            <div class="content">
                <h2><?= $title; ?></h2>
                <?php if (!empty($fields['hero']['description'])) : ?>
                    <p><?= $fields['hero']['description'] ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="wrap-in">
            <div class="size-guide">
                <div class="size-guide-content">
                    <?php if (!empty($content) && !empty($content['enable']) && !empty($content['items'])) : ?>
                        <?php foreach ($content['items'] as $key => $item) : ?>
                            <?php
                            $content = '<div class="content">';

                            $title = '';
                            if (!empty($item['title'])) {
                                $title = '<h3>'.$item['title'].'</h3>';
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
                                $mobileContent .= $content.'<div></div>';
                            }
                            ?>
                            <?= $content; ?>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <?php if (!empty($sizes) && !empty($sizes['enable'])) : ?>
                <div class="size-guide-wrap">
                    <?php if (!empty($sizes['items'])) : ?>
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
                    <?php endif; ?>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php get_footer() ?>