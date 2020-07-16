<?php
/*
 * Template Name: History page
 * Template Post Type: page
 */
?>
<?php
$bg = "";
$bgMobile = "";
$title = get_the_title();
$sub_title = "";

$fields = get_fields();

if (!empty($fields['hero']['title'])) {
    $title = $fields['hero']['title'];
}

if (!empty($fields['hero']['background'])) {
    $bg = $fields['hero']['background']['url'];
}

if (!empty($fields['hero']['background_mobile'])) {
    $bgMobile = $fields['hero']['background_mobile']['url'];
}

if (!empty($fields['hero']['sub_title'])) {
    $sub_title = $fields['hero']['sub_title'];
}

?>
<?php get_header(); ?>
<div class="screen-hero" style="background-image: url(<?= getMobileBackground($bg, $bgMobile) ?>)"></div>
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
<?php if (!empty($fields['history']['enable'])) : ?>
<div class="history-wrap">
    <?php if (!empty($fields['history']['items'])) : ?>
        <div class="history">
            <?php foreach ($fields['history']['items'] as $item) : ?>
                <div class="history-item">
                    <div class="history-item__info">
                        <?php if (!empty($item['year'])) : ?>
                            <div class="history-item__date"><?= $item['year'] ?></div>
                        <?php endif; ?>
                        <?php if (!empty($item['title'])) : ?>
                            <div class="history-item__title"><?= $item['title'] ?></div>
                        <?php endif; ?>
                        <?php if (!empty($item['description'])) : ?>
                            <div class="history-item__text"><?= $item['description'] ?></div>
                        <?php endif; ?>
                    </div>
                    <div class="history-item__image">
                        <div class="history-item__decor">
                            <div class="history-item__decor-inner"></div>
                        </div>
                        <?php if (!empty($item['image'])) : ?>
                        <img src="<?= $item['image']['url'] ?>" alt="<?= $item['image']['alt'] ? $item['image']['alt'] : $item['image']['title'] ?>"/>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>
<?php get_footer();