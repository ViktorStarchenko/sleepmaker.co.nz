<?php

    function register_acf_block_types() {

        #Promo Banner
        /*
        acf_register_block_type(array(
            'name'              => 'promoBanner',
            'title'             => __('Promo banner'),
            'description'       => __('A custom Promo banner block.'),
            'render_template'   => 'templates-parts/promoBanner.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'banner', 'promo', 'promo banner' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));
        */

        #Home page Hero
        acf_register_block_type(array(
            'name'              => 'homePageHero',
            'title'             => __('Home page Hero'),
            'description'       => __('A custom Home page Hero block.'),
            'render_template'   => 'templates-parts/homePageHero.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'hero', 'banner', 'home' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));

        #Home page Technology
        acf_register_block_type(array(
            'name'              => 'homePageTechnology',
            'title'             => __('Home page Technology'),
            'description'       => __('A custom Home page Technology block.'),
            'render_template'   => 'templates-parts/homePageTechnology.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'technology', 'home' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));

        #Home page Quiz
        acf_register_block_type(array(
            'name'              => 'homePageQuiz',
            'title'             => __('Home page Quiz'),
            'description'       => __('A custom Home page Quiz block.'),
            'render_template'   => 'templates-parts/homePageQuiz.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'quiz', 'home' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));

        #Home page Ranges
        acf_register_block_type(array(
            'name'              => 'homePageRanges',
            'title'             => __('Home page Ranges'),
            'description'       => __('A custom Home page Ranges block.'),
            'render_template'   => 'templates-parts/homePageRanges.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'ranges', 'home' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));

        #Home page Blog
        acf_register_block_type(array(
            'name'              => 'homePageBlog',
            'title'             => __('Home page Blog'),
            'description'       => __('A custom Home page Blog block.'),
            'render_template'   => 'templates-parts/homePageBlog.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'blog', 'home' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));

        #Home page Banner
        acf_register_block_type(array(
            'name'              => 'homePageBanner',
            'title'             => __('Home page Banner'),
            'description'       => __('A custom Home page Banner block.'),
            'render_template'   => 'templates-parts/homePageBanner.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'banner', 'home' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));

        #History page
        acf_register_block_type(array(
            'name'              => 'historyPage',
            'title'             => __('History page'),
            'description'       => __('A custom History page'),
            'render_template'   => 'templates-parts/historyPage.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'history' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));

        #FAQ page
        acf_register_block_type(array(
            'name'              => 'faqPage',
            'title'             => __('FAQ page'),
            'description'       => __('A custom FAQ page'),
            'render_template'   => 'templates-parts/faqPage.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'faq', 'info' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));

        #mattressSizes
        acf_register_block_type(array(
            'name'              => 'mattressSizes',
            'title'             => __('Mattress Sizes'),
            'description'       => __('A custom Mattress Sizes'),
            'render_template'   => 'templates-parts/mattressSizes.php',
            'category'          => 'formatting',
            'icon'              => 'admin-comments',
            'keywords'          => array( 'size', 'info', 'mattress' ),
            'preview'           => true,
            'supports'          => array( 'align' => false ),
        ));
    }

    if( function_exists('acf_register_block_type') ) {
        add_action('acf/init', 'register_acf_block_types');
    }

    function acf_block_render( $block ) {

        $slug = str_replace('acf/', '', $block['name']);

        if( file_exists( get_theme_file_path("/templates-parts/{$slug}.php") ) ) {
            include( get_theme_file_path("/templates-parts/{$slug}.php") );
        }
    }

?>