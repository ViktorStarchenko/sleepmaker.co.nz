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
<div class="svg-icon" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><symbol id="cross"><path fill-rule="evenodd" clip-rule="evenodd" d="M12.158 1.55L11.45.843 6.5 5.793 1.552.843l-.707.707 4.95 4.95-4.95 4.95.707.707 4.95-4.95 4.95 4.95.707-.707-4.95-4.95 4.95-4.95z" fill="#939393"/></symbol><symbol id="email"><path fill="currentColor" d="M.61.75h16.78c.338 0 .611.267.611.596v10.808c0 .33-.273.596-.61.596H.61a.604.604 0 01-.61-.596V1.346C0 1.016.273.75.61.75zm8.76 7.262a.623.623 0 01-.738 0l-7.41-5.483v9.029H16.78V2.529zM9 6.789l6.55-4.847H2.45z"/></symbol><symbol id="info-icon"><path d="M17.14 9A8.14 8.14 0 11.86 9a8.14 8.14 0 0116.28 0z" stroke="#454545" stroke-miterlimit="10" stroke-linecap="round"/><path d="M8.56 5.847c-.077 0-.128-.052-.128-.13v-.942c0-.077.05-.13.128-.13h.878c.078 0 .13.053.13.13v.942c0 .078-.053.13-.13.13H8.56zm.027 7.578c-.078 0-.13-.051-.13-.128V7.37c0-.077.053-.129.13-.129h.826c.078 0 .129.052.129.13v5.926c0 .077-.052.128-.13.128h-.825z" fill="#454545"/></symbol><symbol id="menu-arrow"><path fill="none" stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-miterlimit="50" stroke-width="1.5" d="M1 1v0l4 4.502v0L1 10v0"/></symbol><symbol id="message"><path fill="currentColor" d="M13.864 7.887c-.503 0-.912-.444-.912-.991 0-.548.409-.992.912-.992.504 0 .913.444.913.992 0 .547-.409.99-.913.99zm-4.56 0c-.504 0-.912-.444-.912-.991 0-.548.408-.992.912-.992.503 0 .912.444.912.992 0 .547-.409.99-.912.99zm-4.56 0c-.505 0-.913-.444-.913-.991 0-.548.408-.992.912-.992s.912.444.912.992c0 .547-.408.99-.912.99zm-3.72 5.704C.457 13.59 0 13.083 0 12.468V1.873C0 1.257.457.75 1.025.75h15.95C17.543.75 18 1.257 18 1.873v10.595c0 .615-.456 1.123-1.025 1.123h-2.129l-3.126 2.92a.87.87 0 01-.595.239c-.504 0-.912-.444-.912-.991V13.59zm.253-11.453v10.065H11.49v2.692l2.883-2.692h2.35V2.138z"/></symbol><symbol id="phone"><path fill="currentColor" d="M17.984 13.728c.07.448-.096.9-.431 1.198l-2.335 2.19c-.177.18-.39.326-.605.418a2.464 2.464 0 01-.695.209l-.1.007h-.354a8.845 8.845 0 01-3.162-.697A16.342 16.342 0 017.74 15.72a18.71 18.71 0 01-3.02-2.393 19.36 19.36 0 01-2.12-2.283 16.293 16.293 0 01-1.368-2.02 10.904 10.904 0 01-.786-1.722 8.72 8.72 0 01-.361-1.339A4.41 4.41 0 010 5.023v-.33L.008 4.6a2.08 2.08 0 01.211-.64c.108-.223.26-.424.435-.577l2.344-2.206A1.47 1.47 0 014.032.75c.291-.002.576.087.802.251.183.13.339.29.486.512l1.899 3.373c.183.311.236.676.156 1-.067.323-.234.62-.48.853l-.704.663a2.4 2.4 0 00.21.47c.176.314.378.613.607.901.349.448.736.868 1.177 1.273.411.411.857.79 1.332 1.13.301.215.62.408.964.585.147.08.305.142.415.174l.023.004.875-.842a1.751 1.751 0 011.149-.428 1.68 1.68 0 01.845.184l3.395 1.898c.287.152.513.384.649.66.077.083.132.19.152.317zm-1.316.266a.239.239 0 00-.134-.164l-3.38-1.893a.36.36 0 00-.186-.029.439.439 0 00-.27.083l-1.045 1.005a.96.96 0 01-.38.19l-.164.02h-.116l-.125-.012-.274-.052a3.467 3.467 0 01-.747-.296 8.947 8.947 0 01-1.116-.679 11.95 11.95 0 01-1.473-1.248 11.608 11.608 0 01-1.296-1.404 8.02 8.02 0 01-.708-1.051 3.58 3.58 0 01-.392-1.005 1.042 1.042 0 01.014-.38.924.924 0 01.23-.39l.868-.82a.436.436 0 00.126-.24.197.197 0 00-.026-.15l-1.88-3.346a.569.569 0 00-.147-.148l-.006-.001c-.036 0-.07.014-.109.053L1.557 4.273a.67.67 0 00-.162.22.942.942 0 00-.09.253v.29c-.005.236.016.47.063.71.074.395.178.785.314 1.166.188.529.422 1.042.699 1.531.372.65.794 1.275 1.264 1.868.6.762 1.263 1.476 1.998 2.151a17.44 17.44 0 002.827 2.244c.743.476 1.531.886 2.36 1.229.845.36 1.755.56 2.657.591h.276c.094-.017.187-.047.29-.096a.705.705 0 00.228-.16l2.367-2.224a.147.147 0 00.025-.029.648.648 0 01-.005-.023z"/></symbol><symbol id="pin"><path fill="currentColor" d="M11.46 7.265c0-1.804-1.52-3.25-3.377-3.25-1.857 0-3.377 1.446-3.377 3.25 0 1.803 1.52 3.25 3.377 3.25 1.857 0 3.377-1.447 3.377-3.25zm-5.254 0c0-.958.833-1.75 1.877-1.75 1.045 0 1.877.792 1.877 1.75s-.832 1.75-1.877 1.75c-1.044 0-1.876-.792-1.876-1.75zm8.46.534a6.057 6.057 0 01-.937 3.218l-5.024 7.466a.75.75 0 01-1.244 0L2.425 11A6.042 6.042 0 011.5 7.79c.075-3.537 3.014-6.359 6.568-6.289 3.581-.07 6.519 2.748 6.598 6.298zM8.068.002C3.716-.085.093 3.394 0 7.776a7.57 7.57 0 001.17 4.043l5.046 7.502a2.25 2.25 0 003.734 0l5.035-7.484a7.572 7.572 0 001.182-4.044v-.017a7.943 7.943 0 00-8.1-7.774z"/></symbol><symbol id="search"><path d="M7.94 7.942a4.156 4.156 0 01-5.88 0 4.16 4.16 0 010-5.883 4.156 4.156 0 015.88 0 4.16 4.16 0 010 5.883zM1.463 1.465a5 5 0 006.723 7.389l3.004 3.007a.475.475 0 00.67.001.471.471 0 00.001-.667l-3.007-3.01a5 5 0 00-7.39-6.72z" fill="currentColor"/></symbol></svg></div>
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
    <div class="header__nav">
        <nav class="header-nav">
            <?php foreach ( $headerMenu as $key => $item ) : ?>
                <?php
                $dropdownClass = "";
                $dropdownFlag = false;
                if ( !empty($item["dropdown"]) ) {
                    $dropdownClass = "header-nav__item--drop";
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
                <div class="header-nav__item <?= $dropdownClass ?>">
                    <?php if (!empty($title)) : ?>
                        <a class="header-nav__link " <?= $url ?> <?= $target ?> ><?= $title ?></a>
                    <?php endif; ?>
                    <?php if ($dropdownFlag) : ?>
                    <div class="header-nav__drop">
                        <div class="header-nav__drop-nav">
                        <!--<a class="header-nav__drop-section" href="#"><?php /*echo $item['sublinks_title']*/?></a>-->
                        <ul class="header-nav__list">
                            <?php foreach ( $item['links'] as $link ) : ?>
                                <?php if (!empty($link['sublink'])) : ?>
                                    <li class="header-nav__list-item"><a class="header-nav__list-link" href="<?= $link['sublink']['url'] ?>"><?= $link['sublink']['title'] ?></a></li>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </ul>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </nav>
    </div>
    <div class="header__logo">
        <div class="header-logo" style="background-image:url(<?php echo get_template_directory_uri();?>/static/build/img/oval.svg)"><a class="header-logo__link" href="<?= get_home_url(); ?>"><img class="header-logo__img" src="<?php echo $headerLogo['header']['url'];?>" alt="logo"/></a></div>
    </div>
    <?php if (!empty($headerFindButton)) : ?>
    <div class="header__find">
        <div class="header-support"><a class="header-support__link" href="#">Support</a></div>
        <div class="header-find"><a class="bttn header-find__button" href="<?=$headerFindButton['url']?>"><?=$headerFindButton['title']?></a><a class="header-find__pin" href="<?=$headerFindButton['url']?>"><svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" viewBox="0 0 30 30">
                    <path fill="none" stroke="#002e5d" stroke-miterlimit="20" d="M1 15C1 7.268 7.268 1 15 1h0c7.732 0 14 6.268 14 14v0c0 7.732-6.268 14-14 14h0C7.268 29 1 22.732 1 15z"/>
                    <path fill="#002e5d" d="M18.439 12.17c0-1.591-1.34-2.868-2.977-2.868-1.637 0-2.976 1.277-2.976 2.868s1.34 2.868 2.976 2.868c1.637 0 2.977-1.277 2.977-2.868zm-4.629 0c0-.845.733-1.544 1.652-1.544.92 0 1.652.699 1.652 1.544 0 .845-.732 1.544-1.652 1.544-.92 0-1.652-.699-1.652-1.544zm7.46.471a5.345 5.345 0 0 1-.827 2.84l-4.432 6.588a.662.662 0 0 1-1.098 0l-4.442-6.604a5.332 5.332 0 0 1-.817-2.831c.066-3.121 2.66-5.611 5.795-5.55 3.16-.061 5.75 2.425 5.821 5.557zm-5.82-6.88c-3.84-.076-7.038 2.994-7.12 6.86a6.679 6.679 0 0 0 1.032 3.567l4.453 6.62a1.985 1.985 0 0 0 3.294 0l4.443-6.604a6.681 6.681 0 0 0 1.043-3.568v-.015a7.009 7.009 0 0 0-7.146-6.86z"/>
                    <path fill="none" stroke="#002e5d" stroke-miterlimit="20" d="M1 15C1 7.268 7.268 1 15 1h0c7.732 0 14 6.268 14 14v0c0 7.732-6.268 14-14 14h0C7.268 29 1 22.732 1 15z"/>
                </svg></a></div>
    </div>
    <?php endif; ?>
</header>
<main class="main">