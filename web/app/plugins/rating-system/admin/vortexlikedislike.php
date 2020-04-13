<?php

    if ( ! class_exists( 'Sse' ) ) {
        return;
    }

    // This is your option name where all the Redux data is stored.
    $opt_name = "vortex_like_dislike";
	$dir = plugin_dir_url( __FILE__ );
	$domain = 'vortex_system_ld';
	$style = __('Style',$domain);
	
    $args = array(
		"page-title"=>"Rating System",
		"menu-title"=>"Rating System",
		"capability"=>'manage_options',
		"menu-slug"=>$opt_name,
		"icon"=>"dashicons-admin-generic",
		"position"=>"81" // set your owm possition
    );
	
	Sse::setArgs($opt_name,$args);
	
    // -> START Basic Fields
    Sse::setSection( $opt_name, array(
        'title'  => __( 'Settings for posts and pages', $domain ),
        'id'     => 'basic',
        'desc'   => __( 'Here you can customize the settings only for posts and pages.For comments go to Settings for Comments.', $domain ),
        'fields' => array(
           array(
			'id'       => 'v-switch-posts',
			'type'     => 'switch', 
			'title'    => __('Turn on like or dislike for posts or pages', $domain),
			'default'  => false,
			),array(
				'id'       => 'v_button_visibility',
				'type'     => 'checkbox',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Buttons position', $domain), 
				'subtitle' => __('Where should the buttons appear?', $domain),
				'desc'     => __('You can check them both if you want.', $domain),
			 
				//Must provide key => value pairs for multi checkbox options
				'options'  => array(
					'1' => __('Before content',$domain),
					'2' => __('After content',$domain),
				),
			 
				//See how default has changed? you also don't need to specify opts that are 0.
				'default' => array(
					'1' => '1',
					'2' => '0', 
				)
			),array(
				'id'       => 'vortex-button-align',
				'type'     => 'select',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Buttons alignment',$domain), 
				'options'  => array(
					'1' => __('Left',$domain),
					'2' => __('Center',$domain),
					'3' => __('Right',$domain)
				),
				'default'  => '1',
			),array(
				'id'       => 'v_button_show',
				'type'     => 'checkbox',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Display buttons on:', $domain), 
				'subtitle' => __('Select where the buttons should be displayed.', $domain),
				'desc'	   =>__('Custom post type single must be checked for bbPress support.Posts Index refers to that page where your post(s) show up with an excerpt and a read more button.',$domain),
			 
				//Must provide key => value pairs for multi checkbox options
				'options'  => array(
					'1' => __('Pages',$domain),
					'2' => __('Posts Index',$domain),
					'3' => __('Single post',$domain),
					'4' => __('Custom post type Index',$domain),
					'5' => __('Custom post type single',$domain),
				),
			 
				//See how default has changed? you also don't need to specify opts that are 0.
				'default' => array(
					'1' => '0', 
					'2' => '1', 
					'3' => '1',
					'4' => '0',
					'5' => '0',
				)
			),array(
				'id'       => 'v_button_style',
				'type'     => 'image_select',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Buttons style', $domain), 
				'subtitle' => __('Here you can change the icons of the buttons.', $domain),
				'options'  => array(
						'1'      => array(
							'alt'   => ''.$style.' 1', 
							'img'   => $dir.'images/1.png'
						),
						'2'      => array(
							'alt'   => ''.$style.' 2', 
							'img'   => $dir.'images/2.png'
						),
						'3'      => array(
							'alt'   => ''.$style.' 3', 
							'img'   => $dir.'images/3.png'
						),
						'4'      => array(
							'alt'   => ''.$style.' 4', 
							'img'   => $dir.'images/4.png'
						),
						'5'      => array(
							'alt'   => ''.$style.' 5', 
							'img'   => $dir.'images/5.png'
						),
						'6'      => array(
							'alt'  => ''.$style.' 6', 
							'img'   => $dir.'images/6.png'
						),
						'7'      => array(
							'alt'   => ''.$style.' 7', 
							'img'   => $dir.'images/7.png'
						),
						'8'      => array(
							'alt'   => ''.$style.' 8', 
							'img'   => $dir.'images/8.png'
						),
						'9'      => array(
							'alt'   => ''.$style.' 9', 
							'img'   => $dir.'images/9.png'
						),
						'10'      => array(
							'alt'   => ''.$style.' 10', 
							'img'   => $dir.'images/10.png'
						),
						'11'      => array(
							'alt'  => ''.$style.' 11', 
							'img'  => $dir.'images/11.png'
						),
						'12'      => array(
							'alt'   => ''.$style.' 12', 
							'img'   => $dir.'images/12.png'
						),
						'13'      => array(
							'alt'   => ''.$style.' 13', 
							'img'   => $dir.'images/13.png'
						),
						'14'      => array(
							'alt'   => ''.$style.' 14', 
							'img'   => $dir.'images/14.png'
						)
					),
				'default' => '1'
			),array(
			'id'       => 'v-switch-columns',
			'type'     => 'switch', 
			'required' => array('v-switch-posts','equals','1'),
			'title'    => __('Likes & Dislikes in columns', $domain),
			'subtitle' => __('Show the number of likes and dislikes at "All Posts" in custom columns.',$domain),
			'default'  => false,
			),array(
			'id'       => 'v-switch-dislike',
			'type'     => 'switch', 
			'required' => array('v-switch-posts','equals','1'),
			'title'    => __('Disable dislike', $domain),
			'subtitle' => __('Turn on this if you want like button only.',$domain),
			'default'  => false,
			),array(
			'id'       => 'v-switch-anon',
			'type'     => 'switch',
			'required' => array('v-switch-posts','equals','1'),
			'title'    => __('Anonymous users', $domain),
			'subtitle' => __('If you want to allow anonymous users to vote turn this on.',$domain),
			'desc'	   => __('If you allow anonymous users to like or dislike , results may not be 100% accurate meaning that a person could like or dislike twice or more because it\'s impossible for this plugin to track anonymous users over the internet.The IP of the user is stored also a cookie is seted in the browser.If he changes the IP and deletes the cookie he can vote again.',$domain),
			'default'  => false,
			),array(
			'id'       => 'v-switch-anon-counter',
			'type'     => 'switch',
			'required' => array('v-switch-posts','equals','1'),
			'title'    => __('Anonymous counter',$domain),
			'subtitle' => __('Hide the counter(number of likes or dislikes) for anonymous users.',$domain),
			'default'  => false,
			),array(
				'id'          => 'vortex-buttons-size',
				'type'        => 'number',
				'required' => array('v-switch-posts','equals','1'),
				'title'       => __('Buttons size', $domain),
				'subtitle'    => __('Here you can change the buttons size in pixels(px).', $domain),
				'default'     => "16",
			),array(
				'id'       => 'v_default_color',
				'type'     => 'color',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Default color', $domain), 
				'subtitle' => __('Default color of buttons', $domain),
				'default'  => '#828384',
			),array(
				'id'       => 'v_like_color',
				'type'     => 'color',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Like button ',$domain),
				'subtitle' => __('Like button mouse over color', $domain),
				'default'  => '#4898D6',
			),array(
				'id'       => 'v_like_active_color',
				'type'     => 'color',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Like button ', $domain), 
				'subtitle' => __('Like button active color', $domain),
				'default'  => '#1B7FCC',
			),array(
				'id'       => 'v_dislike_color',
				'type'     => 'color',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Dislike button ', $domain), 
				'subtitle' => __('Dislike button mouse over color', $domain),
				'default'  => '#0a0101',
			),array(
				'id'       => 'v_dislike_active_color',
				'type'     => 'color',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Dislike button ', $domain), 
				'subtitle' => __('Dislike button active color', $domain),
				'default'  => '#0a0101',
			),array(
			'id'       => 'v_exclude_category',
			'type'     => 'select',
			'required' => array('v-switch-posts','equals','1'),
			'multi'	   => true,
			'title'    => __('Exclude categories', $domain), 
			'subtitle' => __('Here you can exclude categories where you DON\'T want the buttons to show. ',$domain),
			'desc'	   => __('Only categories that have at least 1 post will be shown.',$domain),
			'data'	   => 'category',
			),array(
			'id'       => 'v_exclude_post_types-p',
			'type'     => 'select',
			'required' => array('v-switch-posts','equals','1'),
			'multi'	   => true,
			'title'    => __('Exclude post types', $domain), 
			'subtitle' => __('Here you can exclude post types where you DON\'T want the buttons, custom columns and the box to show. ',$domain),
			'data'	   => 'post_types',
			),array(
				'id'       => 'v_custom_text',
				'type'     => 'switch', 
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Custom text', $domain),
				'subtitle' => __('Display custom text when user is voting', $domain),
				'default'  => false,
			),array(
				'id'       => 'v_custom_text_post_like',
				'type'     => 'text', 
				'required' => array(array('v-switch-posts','equals','1'),array('v_custom_text','equals','1')),
				'title'    => __('Custom text for like', $domain),
				'default'  => 'Thank you for voting',
			),array(
				'id'       => 'v_custom_text_post_dislike',
				'type'     => 'text',
				'required' => array(array('v-switch-posts','equals','1'),array('v_custom_text','equals','1')),
				'title'    => __('Custom text for dislike', $domain),
				'default'  => 'Thank you for voting',
			),array(
				'id'       => 'v_custom_text_post_keep',
				'type'     => 'switch',
				'required' => array(array('v-switch-posts','equals','1'),array('v_custom_text','equals','1')),
				'title'    => __('Keep custom text', $domain),
				'subtitle' => __('When a user voted and refreshes the page keep showing the custom text for the vote and don\'t display the counter',$domain),
				'default'  => false,
			),array(
				'id'       => 'v_enable_bbpress',
				'type'     => 'switch',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Enable bbPress support', $domain),
				'subtitle' => __('Custom post type single must be checked for bbPress support.',$domain),
				'default'  => false,
			),array(
				'id'       => 'v_enable_buddybpress',
				'type'     => 'switch',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Enable buddyPress support', $domain),
				'subtitle' => __('Enable support for buddyPress activities.',$domain),
				'default'  => false,
			),array(
				'id'       => 'v_enable_delete',
				'type'     => 'switch',
				'required' => array('v-switch-posts','equals','1'),
				'title'    => __('Enable Auto delete post', $domain),
				'default'  => false,
			),array(
				'id'       => 'v_delete_number',
				'type'     => 'text',
				'required' => array(array('v-switch-posts','equals','1'),array('v_enable_delete','equals','1')),
				'title'    => __('Number of dislikes:', $domain),
				'subtitle' => __('Auto delete post at a given number of dislikes', $domain),
				'default'  => '10'
			)
			
		)
			
    ) );
	
		Sse::setSection( $opt_name, array(
        'title'  => __( 'Settings for comments', $domain ),
        'id'     => 'comments',
        'desc'   => __( 'Here you can customize the settings only for comments.For posts and pages go to Settings for Posts and Pages.', $domain ),
			'fields' => array(
				array(
					'id'       => 'v-switch-comments',
					'type'     => 'switch',
					'title'    => __('Turn on like or dislike for comments', $domain),
					'default'  => false,
				),array(
				'id'       => 'v_button_visibility_comments',
				'type'     => 'checkbox',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Buttons position', $domain), 
				'subtitle' => __('Where should the buttons appear?', $domain),
				'desc'     => __('You can check them both if you want.',$domain),
			 
				//Must provide key => value pairs for multi checkbox options
				'options'  => array(
					'1' => __('Before comment',$domain),
					'2' => __('After comment',$domain),
				),
			 
				//See how default has changed? you also don't need to specify opts that are 0.
				'default' => array(
					'1' => '1', 
					'2' => '0', 
				)
			),array(
				'id'       => 'vortex-button-align-comment',
				'type'     => 'select',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Buttons alignment', $domain), 
				'options'  => array(
					'1' => __('Left',$domain),
					'2' => __('Center',$domain),
					'3' => __('Right',$domain)
				),
				'default'  => '1',
			),array(
				'id'       => 'v_button_style_comment',
				'type'     => 'image_select',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Buttons style', $domain), 
				'subtitle' => __('Here you can change the icons of the buttons.',$domain),
				'options'  => array(
						'1'      => array(
							'alt'   => ''.$style.' 1', 
							'img'   => $dir.'images/1.png'
						),
						'2'      => array(
							'alt'   => ''.$style.' 2', 
							'img'   => $dir.'images/2.png'
						),
						'3'      => array(
							'alt'   => ''.$style.' 3', 
							'img'   => $dir.'images/3.png'
						),
						'4'      => array(
							'alt'   => ''.$style.' 4', 
							'img'   => $dir.'images/4.png'
						),
						'5'      => array(
							'alt'   => ''.$style.' 5', 
							'img'   => $dir.'images/5.png'
						),
						'6'      => array(
							'alt'  => ''.$style.' 6', 
							'img'   => $dir.'images/6.png'
						),
						'7'      => array(
							'alt'   => ''.$style.' 7', 
							'img'   => $dir.'images/7.png'
						),
						'8'      => array(
							'alt'   => ''.$style.' 8', 
							'img'   => $dir.'images/8.png'
						),
						'9'      => array(
							'alt'   => ''.$style.' 9', 
							'img'   => $dir.'images/9.png'
						),
						'10'      => array(
							'alt'   => ''.$style.' 10', 
							'img'   => $dir.'images/10.png'
						),
						'11'      => array(
							'alt'  => ''.$style.' 11', 
							'img'   => $dir.'images/11.png'
						),
						'12'      => array(
							'alt'   => ''.$style.' 12', 
							'img'   => $dir.'images/12.png'
						),
						'13'      => array(
							'alt'   => ''.$style.' 13', 
							'img'   => $dir.'images/13.png'
						),
						'14'      => array(
							'alt'   => ''.$style.' 14', 
							'img'   => $dir.'images/14.png'
						)
					),
				'default' => '1'
			),array(
			'id'       => 'v-switch-columns-comment',
			'type'     => 'switch', 
			'required' => array('v-switch-comments','equals','1'),
			'title'    => __('Likes & Dislikes in columns', $domain),
			'subtitle' => __('Show the number of likes and dislikes at "Comments" in custom columns.',$domain),
			'default'  => false,
			),array(
			'id'       => 'v-switch-dislike-comment',
			'type'     => 'switch', 
			'required' => array('v-switch-comments','equals','1'),
			'title'    => __('Disable dislike', $domain),
			'subtitle' => __('Turn on this if you want like button only.',$domain),
			'default'  => false,
			),array(
			'id'       => 'v-switch-anon-comment',
			'type'     => 'switch',
			'required' => array('v-switch-comments','equals','1'),
			'title'    => __('Anonymous users', $domain),
			'subtitle' => __('If you want to allow anonymous users to vote turn this on.',$domain),
			'desc'	   => __('If you allow anonymous users to like or dislike , results may not be 100% accurate meaning that a person could like or dislike twice or more because it\'s impossible for this plugin to track anonymous users over the internet.The IP of the user is stored also a cookie is seted in the browser.If he changes the IP and deletes the cookie he can vote again.',$domain),
			'default'  => false,
			),array(
			'id'       => 'v-switch-anon-counter-comment',
			'type'     => 'switch',
			'required' => array('v-switch-comments','equals','1'),
			'title'    => __('Anonymous counter', $domain),
			'subtitle' => __('Hide the counter(number of likes or dislikes) for anonymous users.',$domain),
			'default'  => false,
			),array(
				'id'          => 'vortex-buttons-size-comment',
				'type'        => 'number',
				'required' => array('v-switch-comments','equals','1'),
				'title'       => __('Buttons size', $domain),
				'subtitle'    => __('Here you can change the buttons size in pixels (px).',$domain),
				'default'     => "16",
			),array(
				'id'       => 'v_default_color_comment',
				'type'     => 'color',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Default color', $domain), 
				'subtitle' => __('Default color of buttons', $domain),
				'default'  => '#828384',
			),array(
				'id'       => 'v_like_color_comment',
				'type'     => 'color',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Like button ', $domain),
				'subtitle' => __('Like button mouse over color',$domain),
				'default'  => '#4898D6',
			),array(
				'id'       => 'v_like_active_color_comment',
				'type'     => 'color',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Like button ', $domain), 
				'subtitle' => __('Like button active color', $domain),
				'default'  => '#1B7FCC',
			),array(
				'id'       => 'v_dislike_color_comment',
				'type'     => 'color',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Dislike button ', $domain), 
				'subtitle' => __('Dislike button mouse over color', $domain),
				'default'  => '#0a0101',
			),array(
				'id'       => 'v_dislike_active_color_comment',
				'type'     => 'color',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Dislike button ', $domain), 
				'subtitle' => __('Dislike button active color',$domain),
				'default'  => '#0a0101',
			),array(
			'id'       => 'v_exclude_category_comment',
			'type'     => 'select',
			'required' => array('v-switch-comments','equals','1'),
			'multi'	   => true,
			'title'    => __('Exclude categories', $domain), 
			'subtitle' => __('Here you can exclude post types where you DON\'T want the buttons, custom columns and the box to show. ',$domain),
			'desc'	   => __('Only categories that have at least 1 post will be shown.',$domain),
			'data'	   => 'category',
			),array(
			'id'       => 'v_exclude_post_types',
			'type'     => 'select',
			'required' => array('v-switch-comments','equals','1'),
			'multi'	   => true,
			'title'    => __('Exclude post types', $domain), 
			'subtitle' => __('Here you can exclude post types where you DON\'T want the buttons to show. ',$domain),
			'data'	   => 'post_types',
			),array(
				'id'       => 'v_custom_text_com',
				'type'     => 'switch', 
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Custom text', $domain),
				'subtitle' => __('Display custom text when user is voting', $domain),
				'default'  => false,
			),array(
				'id'       => 'v_custom_text_com_like',
				'type'     => 'text', 
				'required' => array(array('v-switch-comments','equals','1'),array('v_custom_text_com','equals','1')),
				'title'    => __('Custom text for like', $domain),
				'default'  => 'Thank you for voting',
			),array(
				'id'       => 'v_custom_text_com_dislike',
				'type'     => 'text',
				'required' => array(array('v-switch-comments','equals','1'),array('v_custom_text_com','equals','1')),
				'title'    => __('Custom text for dislike', $domain),
				'default'  => 'Thank you for voting',
			),array(
				'id'       => 'v_custom_text_com_keep',
				'type'     => 'switch',
				'required' => array(array('v-switch-comments','equals','1'),array('v_custom_text_com','equals','1')),
				'title'    => __('Keep custom text', $domain),
				'subtitle' => __('When a user voted and refreshes the page keep showing the custom text for the vote and don\'t display the counter',$domain),
				'default'  => false,
			),array(
				'id'       => 'v_enable_epoch',
				'type'     => 'switch',
				'required' => array('v-switch-comments','equals','1'),
				'title'    => __('Enable Epoch Support', $domain),
				'default'  => false,
			)
			
			)
		));

	    Sse::setSection( $opt_name, array(
        'title'  => __( 'Translation', $domain ),
        'id'     => 'translation',
        'desc'   => __( 'Here you can translate some basic text.', $domain ),
			'fields' => array(
				array(
					'id'       => 'v-singular-text',
					'type'     => 'text',
					'title'    => __('Singular like  for widget', $domain),
					'subtitle' => __('This appers next to the number of likes in the widget only when the likes equals to 1.', $domain),
					'default'  => 'like'
				),array(
					'id'       => 'v-plural-text',
					'type'     => 'text',
					'title'    => __('Plural like  for widget', $domain),
					'subtitle' => __('This appers next to the number of likes in the widget only when the likes is equals to 2 or bigger.', $domain),
					'default'  => 'likes'
				),array(
					'id'       => 'v-login-text',
					'type'     => 'text',
					'title'    => __('Require user to login', $domain),
					'subtitle' => __('This appears when the user is not logged in and the anonymous user voting is not allowed.', $domain),
					'default'  => 'You must be logged in to vote.'
				)
			)
		));
		
		if(file_exists(plugin_dir_path(__FILE__).'documentation.html')){
			Sse::setSection( $opt_name, array(
			'title'  => __( 'Documentation', $domain ),
			'id'     => 'documentation',
			'fields' => array(),
			'html'   => plugin_dir_path(__FILE__).'documentation.html',
			));
		}