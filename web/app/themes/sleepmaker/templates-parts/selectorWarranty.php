<?php
 $warrantyBlock = get_field('warranty_block');
 ?>
<?php if ($warrantyBlock['enabled']) :?>
<div class="container">
    <div class="wrap-in">
        <div class="long-card-wrap">
            <div class="long-card">
                <div class="long-card__info" style="background:#002e5d; color:#ffffff">
                    <div class="long-card__info-inner">
                        <div class="long-card__title"><?= $warrantyBlock['first_title'] ?></div>
                        <p><?= $warrantyBlock['first_description'] ?></p><a class="bttn bttn--inverse" href="<?= $warrantyBlock['first_button']['link'] ?>"><?= $warrantyBlock['first_button']['label'] ?></a>
                    </div>
                </div>
                <div class="long-card__image"><img src="<?= $warrantyBlock['first_bg_image']['url'] ?>" alt="long-img-1"/></div>
            </div>
            <div class="long-card">
                <div class="long-card__info" style="background:#002e5d; color:#ffffff">
                    <div class="long-card__info-inner">
                        <div class="long-card__title"><?= $warrantyBlock['second_title'] ?></div>
                        <p><?= $warrantyBlock['second_description'] ?></p><a class="bttn bttn--inverse" href="<?= $warrantyBlock['second_button']['link'] ?>"><?= $warrantyBlock['second_button']['label'] ?></a>
                    </div>
                </div>
                <div class="long-card__image"><img src="<?= $warrantyBlock['second_bg_image']['url'] ?>" alt="long-img-2"/></div>
            </div>
        </div>
    </div>
</div>
<?php endif;?>