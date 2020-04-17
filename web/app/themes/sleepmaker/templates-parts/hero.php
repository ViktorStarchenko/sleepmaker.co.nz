<?php
$bg = "";
$bgMobile = "";
if (!empty($data['background'])) {
    $bg = $data['background']['url'];
}
if (!empty($data['background_mobile'])) {
    $bgMobile = $data['background_mobile']['url'];
}
?>
<div class="wide-decor" style="background-image:url(<?= getMobileBackground($bg, $bgMobile) ?>)">
    <div class="wide-decor__inner">
        <h2 class="wide-decor__subtitle"><?= $data['title'] ?></h2>
        <h1 class="wide-decor__title-top"><?= $data['subtitle'] ?></h1>
        <div class="wide-decor__bttns">
            <?php foreach ($data['buttons'] as $button) : ?>
                <?php if (!empty($button['link'])) : ?>
                    <a class="bttn" href="<?= $button['link']['url'] ?>" target="<?= $button['link']['target'] ?>"><?= $button['link']['title'] ?></a>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>