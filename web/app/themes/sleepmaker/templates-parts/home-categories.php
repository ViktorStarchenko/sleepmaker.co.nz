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