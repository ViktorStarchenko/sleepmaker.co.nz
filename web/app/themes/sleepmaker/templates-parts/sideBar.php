<?php
$data = get_field('sidebar', 'option');
?>
<?php if (!empty($data['enable'])) : ?>
<div class="contacts-sidebar">
    <?php if (!empty($data['items'])) : ?>
        <?php foreach ($data['items'] as $item) : ?>
            <div class="contacts">
                <?php if (!empty($item['title'])) : ?>
                <div class="contacts__title"><?= $item['title'] ?></div>
                <?php endif; ?>
                <?php if (!empty($item['description'])) : ?>
                    <?= $item['description'] ?>
                <?php endif; ?>
                <?php if (!empty($item['phone']) || !empty($item['email']) || !empty($item['onlinechat'])) : ?>
                <ul class="contacts__links">
                    <?php if (!empty($item['phone'])) : ?>
                    <li>
                        <?php
                            $phone = str_replace(' ', '', $item['phone']);
                            $phone = str_replace('-', '', $phone);
                        ?>
                        <a href="tel:<?= $phone ?>">
                            <span class="contacts__links-icon">
                                <svg class="icon phone">
                                    <use xlink:href="#phone"></use>
                                </svg>
                            </span><?= $item['phone'] ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['email'])) : ?>
                    <li>
                        <a href="mailto:<?= $item['email'] ?>">
                            <span class="contacts__links-icon">
                                <svg class="icon email">
                                    <use xlink:href="#email"></use>
                                </svg>
                            </span><?= $item['email'] ?>
                        </a>
                    </li>
                    <?php endif; ?>
                    <?php if (!empty($item['onlinechat'])) : ?>
                    <li>
                        <a href="#">
                            <span class="contacts__links-icon">
                                <svg class="icon message">
                                    <use xlink:href="#message"></use>
                                </svg>
                            </span>Use our live chat
                        </a>
                    </li>
                    <?php endif; ?>
                </ul>
                <?php endif; ?>
                <?php if (!empty($item['address'])) : ?>
                    <?= $item['address'] ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
<?php endif; ?>