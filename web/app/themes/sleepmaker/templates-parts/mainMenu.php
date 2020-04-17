<div class="header__nav">
    <nav class="header-nav">
        <?php foreach ( $data['menu'] as $key => $item ) : ?>
            <?php

            if ($item['right_menu'] != $data['right']) {
                continue;
            }

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