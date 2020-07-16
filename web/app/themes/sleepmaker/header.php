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
<div class="svg-icon" style="display: none;">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
        <symbol id="menu-arrow" width="8" height="12" viewBox="0 0 8 12">
            <path fill="none" stroke="#002e5d" stroke-miterlimit="20" stroke-width="1" d="M6.488 11.333v0L1.333 5.998v0L6.488.667v0" />
        </symbol>
        <symbol id="phone" width="18" height="18">
            <path fill="#002e5d" d="M17.984 13.728c.07.448-.096.9-.431 1.198l-2.335 2.19c-.177.18-.39.326-.605.418a2.464 2.464 0 0 1-.695.209l-.1.007h-.354a8.845 8.845 0 0 1-3.162-.697A16.342 16.342 0 0 1 7.74 15.72a18.71 18.71 0 0 1-3.02-2.393 19.36 19.36 0 0 1-2.12-2.283 16.293 16.293 0 0 1-1.368-2.02 10.904 10.904 0 0 1-.786-1.722 8.72 8.72 0 0 1-.361-1.339A4.41 4.41 0 0 1 0 5.023v-.33L.008 4.6a2.08 2.08 0 0 1 .211-.64c.108-.223.26-.424.435-.577l2.344-2.206A1.47 1.47 0 0 1 4.032.75c.291-.002.576.087.802.251.183.13.339.29.486.512l1.899 3.373c.183.311.236.676.156 1-.067.323-.234.62-.48.853l-.704.663a2.4 2.4 0 0 0 .21.47c.176.314.378.613.607.901.349.448.736.868 1.177 1.273.411.411.857.79 1.332 1.13.301.215.62.408.964.585.147.08.305.142.415.174l.023.004.875-.842a1.751 1.751 0 0 1 1.149-.428 1.68 1.68 0 0 1 .845.184l3.395 1.898c.287.152.513.384.649.66.077.083.132.19.152.317zm-1.316.266a.239.239 0 0 0-.134-.164l-3.38-1.893a.36.36 0 0 0-.186-.029.439.439 0 0 0-.27.083l-1.045 1.005a.96.96 0 0 1-.38.19l-.164.02h-.116l-.125-.012-.274-.052a3.467 3.467 0 0 1-.747-.296 8.947 8.947 0 0 1-1.116-.679 11.95 11.95 0 0 1-1.473-1.248 11.608 11.608 0 0 1-1.296-1.404 8.02 8.02 0 0 1-.708-1.051 3.58 3.58 0 0 1-.392-1.005 1.042 1.042 0 0 1 .014-.38.924.924 0 0 1 .23-.39l.868-.82a.436.436 0 0 0 .126-.24.197.197 0 0 0-.026-.15l-1.88-3.346a.569.569 0 0 0-.147-.148l-.006-.001c-.036 0-.07.014-.109.053L1.557 4.273a.67.67 0 0 0-.162.22.942.942 0 0 0-.09.253v.29c-.005.236.016.47.063.71.074.395.178.785.314 1.166.188.529.422 1.042.699 1.531.372.65.794 1.275 1.264 1.868.6.762 1.263 1.476 1.998 2.151a17.44 17.44 0 0 0 2.827 2.244c.743.476 1.531.886 2.36 1.229.845.36 1.755.56 2.657.591h.276c.094-.017.187-.047.29-.096a.705.705 0 0 0 .228-.16l2.367-2.224a.147.147 0 0 0 .025-.029.648.648 0 0 1-.005-.023z"></path>
        </symbol>
        <symbol id="email" width="18" height="13">
            <path fill="#002e5d" d="M.61.75h16.78c.338 0 .611.267.611.596v10.808c0 .33-.273.596-.61.596H.61a.604.604 0 0 1-.61-.596V1.346C0 1.016.273.75.61.75zm8.76 7.262a.623.623 0 0 1-.738 0l-7.41-5.483v9.029H16.78V2.529zM9 6.789l6.55-4.847H2.45z"></path>
        </symbol>
        <symbol id="message" width="18" height="18">
            <path fill="#002e5d" d="M13.864 7.887c-.503 0-.912-.444-.912-.991 0-.548.409-.992.912-.992.504 0 .913.444.913.992 0 .547-.409.99-.913.99zm-4.56 0c-.504 0-.912-.444-.912-.991 0-.548.408-.992.912-.992.503 0 .912.444.912.992 0 .547-.409.99-.912.99zm-4.56 0c-.505 0-.913-.444-.913-.991 0-.548.408-.992.912-.992s.912.444.912.992c0 .547-.408.99-.912.99zm-3.72 5.704C.457 13.59 0 13.083 0 12.468V1.873C0 1.257.457.75 1.025.75h15.95C17.543.75 18 1.257 18 1.873v10.595c0 .615-.456 1.123-1.025 1.123h-2.129l-3.126 2.92a.87.87 0 0 1-.595.239c-.504 0-.912-.444-.912-.991V13.59zm.253-11.453v10.065H11.49v2.692l2.883-2.692h2.35V2.138z"></path>
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
        <div class="header-logo" style="background-image:url(<?php echo get_template_directory_uri();?>/static/build/img/oval.svg)"><a class="header-logo__link" href="<?= get_home_url(); ?>"><img class="header-logo__img" src="<?php echo $headerLogo['header']['url'];?>" alt="logo"/></a></div>
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
                    <path fill="none" stroke="#002e5d" stroke-miterlimit="20" d="M1 15C1 7.268 7.268 1 15 1h0c7.732 0 14 6.268 14 14v0c0 7.732-6.268 14-14 14h0C7.268 29 1 22.732 1 15z"/>
                    <path fill="#002e5d" d="M18.439 12.17c0-1.591-1.34-2.868-2.977-2.868-1.637 0-2.976 1.277-2.976 2.868s1.34 2.868 2.976 2.868c1.637 0 2.977-1.277 2.977-2.868zm-4.629 0c0-.845.733-1.544 1.652-1.544.92 0 1.652.699 1.652 1.544 0 .845-.732 1.544-1.652 1.544-.92 0-1.652-.699-1.652-1.544zm7.46.471a5.345 5.345 0 0 1-.827 2.84l-4.432 6.588a.662.662 0 0 1-1.098 0l-4.442-6.604a5.332 5.332 0 0 1-.817-2.831c.066-3.121 2.66-5.611 5.795-5.55 3.16-.061 5.75 2.425 5.821 5.557zm-5.82-6.88c-3.84-.076-7.038 2.994-7.12 6.86a6.679 6.679 0 0 0 1.032 3.567l4.453 6.62a1.985 1.985 0 0 0 3.294 0l4.443-6.604a6.681 6.681 0 0 0 1.043-3.568v-.015a7.009 7.009 0 0 0-7.146-6.86z"/>
                    <path fill="none" stroke="#002e5d" stroke-miterlimit="20" d="M1 15C1 7.268 7.268 1 15 1h0c7.732 0 14 6.268 14 14v0c0 7.732-6.268 14-14 14h0C7.268 29 1 22.732 1 15z"/>
                </svg></a></div>
    </div>
    <?php endif; ?>
</header>
<main class="main">