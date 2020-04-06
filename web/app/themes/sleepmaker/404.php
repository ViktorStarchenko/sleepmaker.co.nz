<?php
get_header();
$data = get_field( 'page404', 'option');
?>
<div class="container">
    <div class="inner-page error404">
        <div class="inner-page__side">
            <?php if (!empty($data['title'])) : ?>
            <h1 class="inner-page__title"><?= $data['title'] ?></h1>
            <?php endif; ?>
            <?php if (!empty($data['text'])) : ?>
            <div class="content">
                <p><?= $data['text'] ?></p>
            </div>
            <?php endif; ?>
            <?php if (!empty($data['buttons'])) : ?>
                <?php foreach ($data['buttons'] as $button) : ?>
                    <?php if (!empty($button['link'])) : ?>
                        <a class="link-top" href="<?= $button['link']['url'] ?>" target="<?= $button['link']['target'] ?>"><?= $button['link']['title'] ?></a>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="inner-page__base"></div>
    </div>
</div>
<?php
get_footer();
