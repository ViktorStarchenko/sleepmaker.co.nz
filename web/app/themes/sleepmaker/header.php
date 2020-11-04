<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta name="description" content="description"/>
    <?php wp_head(); ?>
</head>
<?php
$headerMenu = get_field( 'header_navigation', 'option');
$headerLogo = get_field( 'logo', 'option');
$headerFindButton = get_field( 'right_button', 'option');
$bodyClass = "body";
?>
<body <?= body_class($bodyClass) ?>>
<!-- SVG Sprite-->
<div class="svg-icon" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <symbol id="menu-arrow" width="8" height="12" viewBox="0 0 8 12">
            <path fill="none" stroke="currentColor" stroke-miterlimit="20" stroke-width="1" d="M6.488 11.333v0L1.333 5.998v0L6.488.667v0" />
        </symbol>
        <symbol width="8" height="12" viewBox="0 0 8 12" id="left-arrow">
            <path fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="20" stroke-width="1.5" d="M6.485.67v0L1.33 6.006v0l5.155 5.33v0"></path>
        </symbol>
    </svg>
</div>
<!-- Header-->
<header class="header">
    <div class="header__burger">
        <div class="header-burger">
            <div class="header-burger__item"></div>
            <div class="header-burger__item"></div>
            <div class="header-burger__item"></div>
            <button class="header-burger__button header-burger__button--close js-menu-mob-close" aria-label="menu close"></button>
            <button class="header-burger__button header-burger__button--open js-menu-mob-open" aria-label="menu open"></button>
        </div>
    </div>
    <?php
        if (!empty($headerMenu)) {
            $data = [
                'right' => false,
                'menu' => $headerMenu
            ];
            echo template_part('mainMenu', $data);
        }
    ?>
    <div class="header__logo">
        <div class="header-logo" style="background-image:url(<?php echo get_template_directory_uri();?>/static/build/img/oval.png)"><a class="header-logo__link" href="<?= get_home_url(); ?>"><img class="header-logo__img" src="<?php echo $headerLogo['header']['url'];?>" alt="logo"/></a></div>
    </div>
    <?php if (!empty($headerFindButton)) : ?>
    <div class="header__find">
        <?php
            if (!empty($headerMenu)) {
                $data = [
                    'right' => true,
                    'menu' => $headerMenu
                ];
                echo template_part('mainMenu', $data);
            }
        ?>
        <div class="header-find"><a class="bttn header-find__button" href="<?=$headerFindButton['url']?>"><?=$headerFindButton['title']?></a><a class="header-find__pin" href="<?=$headerFindButton['url']?>"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                    <path fill="none" stroke="#308ba1" stroke-miterlimit="20" d="M1 15C1 7.268 7.268 1 15 1h0c7.732 0 14 6.268 14 14v0c0 7.732-6.268 14-14 14h0C7.268 29 1 22.732 1 15z"/>
                    <path fill="#308ba1" d="M18.439 12.17c0-1.591-1.34-2.868-2.977-2.868-1.637 0-2.976 1.277-2.976 2.868s1.34 2.868 2.976 2.868c1.637 0 2.977-1.277 2.977-2.868zm-4.629 0c0-.845.733-1.544 1.652-1.544.92 0 1.652.699 1.652 1.544 0 .845-.732 1.544-1.652 1.544-.92 0-1.652-.699-1.652-1.544zm7.46.471a5.345 5.345 0 0 1-.827 2.84l-4.432 6.588a.662.662 0 0 1-1.098 0l-4.442-6.604a5.332 5.332 0 0 1-.817-2.831c.066-3.121 2.66-5.611 5.795-5.55 3.16-.061 5.75 2.425 5.821 5.557zm-5.82-6.88c-3.84-.076-7.038 2.994-7.12 6.86a6.679 6.679 0 0 0 1.032 3.567l4.453 6.62a1.985 1.985 0 0 0 3.294 0l4.443-6.604a6.681 6.681 0 0 0 1.043-3.568v-.015a7.009 7.009 0 0 0-7.146-6.86z"/>
                    <path fill="none" stroke="#308ba1" stroke-miterlimit="20" d="M1 15C1 7.268 7.268 1 15 1h0c7.732 0 14 6.268 14 14v0c0 7.732-6.268 14-14 14h0C7.268 29 1 22.732 1 15z"/>
                </svg></a></div>
    </div>
    <?php endif; ?>
</header>
<main class="main">