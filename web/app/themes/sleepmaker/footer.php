<!-- Footer-->
<?php
$ID = get_the_ID();

$footerLogo = get_field( 'logo', 'option');
$bottomLinks = get_field( 'bottom_links', 'option');
$mobileMenu = get_field( 'header_navigation', 'option');
$mobileButton = get_field( 'mobile_button', 'option');

$footerBanner = get_field( 'footer_banner', 'option');
$footerBannerEnable = get_field( 'footer_banner_enable', $ID);

$logo = "";
if (!empty($footerBanner) && !empty($footerBanner['logo'])) {
    $logo = $footerBanner['logo']['url'];
}

if (is_category()) {
    $term = get_queried_object();
    $footerBannerEnable = get_field( 'footer_banner_enable', $term);
}
?>
<?php if (!empty($footerBanner) && !empty($footerBannerEnable)) : ?>
<?php
    $title = "";
    if (!empty($footerBanner['title'])) {
        $title = $footerBanner['title'];
    }
    $bg = "";
    if (!empty($footerBanner['background'])) {
        $bg = $footerBanner['background']['url'];
    }
?>
    <div class="wide-decor" style="background-image:url(<?= $bg;?>)">
        <div class="wide-decor__inner"><img class="wide-decor__logo" src="<?= $logo;?>" alt="logo">
            <h2 class="wide-decor__title-bottom"><?= $title;?></h2>
            <div class="wide-decor__bttns">
               <?php if(!empty($footerBanner['buttons'])): ?>
                    <?php foreach ($footerBanner['buttons'] as $button) : ?>
                       <a class="bttn" href="<?= $button['link']['url']?>"><?= $button['link']['title']?></a>
                    <?php endforeach;?>
                <?php endif;?>
            </div>
        </div>
    </div>
<?php endif; ?>
</main>
<footer class="footer">
    <div class="footer-inner">
        <?php if (!is_front_page()) : ?>
        <div class="footer__current">
            <?php
                if ( function_exists('yoast_breadcrumb') ) {
                    yoast_breadcrumb( '<p class="footer-current">', '</p>' );
                }
            ?>
        </div>
        <?php endif; ?>
        <div class="footer-row">
            <div class="footer__nav">
                <?php if (!empty($bottomLinks)) : ?>
                <nav class="footer-nav">
                    <?php foreach ( $bottomLinks as $bLink ) : ?>
                        <?php if (!empty($bLink['bottom_link'])) : ?>
                            <div class="footer-nav__item">
                                <a class="footer-nav__link" href="<?= $bLink['bottom_link']['url'] ?>"><?= $bLink['bottom_link']['title'] ?></a>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </nav>
                <?php endif; ?>
            </div>
            <div class="footer__rights">
                <a class="footer-logo" href=""><img class="footer-logo__img" src="<?= $logo;?>" alt="logo"/></a>
                <div class="footer-rights">
                    <?= get_field( 'bottom_text', 'option') ?>
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Menu mobile-->
<div class="menu-mob is-hidden js-menu-mob">
    <div class="menu-mob__inner content">

        <?php if (!empty($mobileMenu)) : ?>
            <div class="menu-mob__body">
                <div class="menu-mob__nav">
                    <nav class="menu-mob-nav">
                        <ul class="menu-mob-nav__list">
                            <?php foreach ( $mobileMenu as $key => $item ) : ?>
                                <?php
                                $dropdownClass = "";
                                $dropdownDataLvl = "";
                                $dropdownFlag = false;;
                                if (!empty($item['dropdown'])) {
                                    $dropdownClass = "js-menu-lvl-trig";
                                    $dropdownDataLvl = "data-trig-lvl='lvl-item-".$key."'";
                                    $dropdownFlag = true;
                                }

                                $title = "";
                                $url = "";
                                $target = "";
                                if (!empty($item["link"])) {
                                    $title = $item["link"]['title'];
                                    $url = " href='".$item["link"]['url']."' ";
                                    $target = "_target='".$item["link"]['target']."'";
                                }

                                if (!empty($item["title"])) {
                                    $title = $item["title"];
                                }
                                ?>
                                <li class="menu-mob-nav__list-item <?= $dropdownClass ?>" <?= $dropdownDataLvl ?>>
                                    <a class="menu-mob-nav__link" <?= $url ?> <?= $target ?>><?= $title ?></a>
                                    <?php if ($dropdownFlag) : ?>
                                    <span class="menu-mob-nav__icon">
                                        <svg>
                                            <use xlink:href="#menu-arrow"></use>
                                        </svg>
                                    </span>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </nav>
                </div>
                <div class="menu-mob__lvl">
                    <?php foreach ( $mobileMenu as $key => $item ) : ?>
                        <?php
                        $dropdownClass = "";
                        $dropdownDataLvl = "";
                        $dropdownFlag = false;;
                        if (!empty($item['dropdown'])) {
                            $dropdownClass = "js-menu-lvl-trig";
                            $dropdownDataLvl = "data-trig-lvl='lvl-item-'.$key.'";
                            $dropdownFlag = true;
                        }

                        $title = "";
                        $url = "";
                        $target = "";
                        if (!empty($item["link"])) {
                            $title = $item["link"]['title'];
                            $url = " href='".$item["link"]['url']."' ";
                            $target = "_target='".$item["link"]['target']."'";
                        }

                        if (!empty($item["title"])) {
                            $title = $item["title"];
                        }
                        ?>
                        <?php if ($dropdownFlag) : ?>
                            <div class="menu-mob-lvl js-menu-lvl-targ" data-targ-lvl="lvl-item-<?= $key ?>">
                                <div class="menu-mob-lvl__head">
                                    <button class="menu-mob-lvl__back js-menu-lvl-close lvl-begin"><span class="menu-mob-lvl__icon">
										<svg class="icon menu-arrow">
											<use xlink:href="#menu-arrow"></use>
										</svg></span>Back</button>
                                    <div class="menu-mob-lvl__title"><?= $title ?></div>
                                </div>
                                <?php if (!empty($item['links'])) : ?>
                                <div class="menu-mob-lvl__body">
                                    <div class="menu-mob-lvl-nav">
                                        <ul class="menu-mob-lvl-nav__list">
                                            <?php foreach ($item['links'] as $subItem) : ?>
                                                <?php if (!empty($subItem['sublink'])) : ?>
                                                    <li class="menu-mob-lvl-nav__item"><a class="menu-mob-lvl-nav__link" href="<?= $subItem['sublink']['url'] ?>"><?= $subItem['sublink']['title'] ?></a></li>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <?php if (!empty($mobileButton)) : ?>
            <a class="menu-mob__bottom-btn bttn" href="<?= $mobileButton['url'] ?>" target="<?= $mobileButton['target'] ?>"><?= $mobileButton['title'] ?></a>
        <?php endif; ?>
    </div>
</div>

<div class="modal-container is-hidden js-modal-container">
    <div class="modal is-hidden" id="modal" style="max-width:1160px">
        <div class="modal__body js-modal-set-html"></div>
        <button class="modal-close-btn js-modal-close">✕</button>
    </div>
</div>
<!-- Modals-->
<?php wp_footer(); ?>
</body>
</html>
