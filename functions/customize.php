<?php

if (!function_exists('easel_sandbox_body_class')) {
	add_action('customize_register', 'easel_customize_register');
	add_action('customize_preview_init', 'easel_customize_preview_js');
	add_action('wp_head', 'easel_customize_wp_head');
	add_filter('body_class', 'easel_customize_body_class');
}

function easel_customize_body_class($classes = array()){
	$option = get_option('easel-customize-select');
	$scheme = (isset($option['select-scheme'])) ? $option['select-scheme'] : '';
	$checkbox_rounded = (isset($option['checkbox-rounded'])) ? $option['checkbox-rounded'] : '';
	$checkbox_comic_in_column = (isset($option['comic-in-column'])) ? $option['comic-in-column'] : '';
	if (!empty($scheme))
		$classes[] = 'scheme-'.$scheme;
	if (!empty($checkbox_rounded)) 
		$classes[] = 'rounded-posts';
	if (function_exists('ceo_pluginfo') && !empty($checkbox_comic_in_column))
		$classes[] = 'cnc';
	return $classes;
}

function easel_customize_register( $wp_customize ) {
	$wp_customize->add_section('easel-scheme-options' , array('title' => __('Options','easel')));	
	$wp_customize->add_section('easel-background-colors' , array('title' => __('Background Colors','easel')));
	$wp_customize->add_section('easel-text-colors' , array('title' => __('Text Colors','easel')));	
	$wp_customize->add_section('easel-link-colors' , array('title' => __('Link Colors','easel')));
	$css_array = array(
			// Background Colors
			array('slug' => 'easel_page_background', 'default' => '', 'label' => '#page', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_header_background', 'default' => '', 'label' => '#header', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_menubar_background', 'default' => '', 'label' => '#menubar-wrapper', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_menubar_submenu_background', 'default' => '', 'label' => '.menu ul li ul li a', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_menubar_mouseover_background', 'default' => '', 'label' => '.menu ul li a:hover', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_breadcrumb_background', 'default' => '', 'label' => '#breadcrumb-wrapper', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_content_wrapper_background', 'default' => '', 'label' => '#content-wrapper', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_subcontent_wrapper_background', 'default' => '', 'label' => '#subcontent-wrapper', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_narrowcolumn_widecolumn_background', 'default' => '', 'label' => '.narrowcolumn/.widecolumn', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_post_page_navigation_background', 'default' => '', 'label' => '.uentry, #comment-wrapper, #wp-paginav', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_post_info_background', 'default' => '', 'label' => '.post-info', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_comment_background', 'default' => '', 'label' => '.comment, #comment-wrapper #wp-paginav', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_comment_meta_data_background', 'default' => '', 'label' => '.comment-meta-data', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_bypostauthor_background', 'default' => '', 'label' => '.bypostauthor', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_bypostauthor_meta_data_background', 'default' => '', 'label' => '.bypostauthor .comment-meta-data', 'section' => 'easel-background-colors'),
			array('slug' => 'easel_footer_background', 'default' => '', 'label' => '#footer', 'section' => 'easel-background-colors'),
			// Text Colors 
			array('slug' => 'easel_content_text_color', 'default' => '', 'label' => 'body', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_header_textcolor', 'default' => '', 'label' => '#header', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_breadcrumb_textcolor', 'default' => '', 'label' => '#breadcrumb-wrapper', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_lrsidebar_widgettitle_textcolor', 'default' => '', 'label' => 'h2.widgettitle', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_lrsidebar_textcolor', 'default' => '', 'label' => '.sidebar', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_posttitle_textcolor', 'default' => '', 'label' => 'h2.post-title', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_pagetitle_textcolor', 'default' => '', 'label' => 'h2.page-title', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_postinfo_textcolor', 'default' => '', 'label' => '.post-info', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_post_page_navigation_textcolor', 'default' => '', 'label' => '.uentry, #comment-wrapper, #wp-paginav', 'section' => 'easel-text-colors'),
			array('slug' => 'easel_footer_copyright_textcolor', 'default' => '', 'label' => '.footer-text', 'section' => 'easel-text-colors'),
			// Link Colors
			array('slug' => 'easel_content_link_color', 'default' => '', 'label' => 'body', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_header_title_acolor', 'default' => '', 'label' => '#header h1 a', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_header_title_hcolor', 'default' => '', 'label' => '#header h1 a:hover', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_menubar_top_acolor', 'default' => '', 'label' => '.menu ul li a:link, .menu ul li a:visited, .mininav-prev a, .mininav-next a', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_menubar_hcolor', 'default' => '', 'label' => '.menu ul li a:hover, .menu ul li a.selected, .menu ul li ul li a:hover', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_menubar_sub_acolor', 'default' => '', 'label' => '.menu ul li ul li a:link, .menu ul li ul li a:visited', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_breadcrumb_acolor', 'default' => '', 'label' => '.breadcrumbs a', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_breadcrumb_hcolor', 'default' => '', 'label' => '.breadcrumbs a:hover', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_sidebar_acolor', 'default' => '', 'label' => '.sidebar .widget a', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_sidebar_hcolor', 'default' => '', 'label' => '.sidebar .widget a:hover', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_postpagenav_acolor', 'default' => '', 'label' => '.entry a, .blognav a, #paginav a', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_postpagenav_hcolor', 'default' => '', 'label' => '.entry a:hover, .blognav a:hover, #paginav a:hover', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_footer_copyright_acolor', 'default' => '', 'label' => '.footer-text a', 'section' => 'easel-link-colors'),
			array('slug' => 'easel_footer_copyright_hcolor', 'default' => '', 'label' => '.footer-text a:hover', 'section' => 'easel-link-colors'),
			);
	// Additions for Comic Easel
	if (function_exists('ceo_pluginfo')) {
		$css_array[] = array('slug' => 'easel_comic_wrap_background', 'default' => '', 'label' => '#comic-wrap', 'section' => 'easel-background-colors');
		$css_array[] = array('slug' => 'easel_comic_wrap_textcolor', 'default' => '', 'label' => '#comic-wrap', 'section' => 'easel-text-colors');
		$css_array[] = array('slug' => 'easel_comic_nav_background', 'default' => '', 'label' => 'table#comic-nav-wrapper', 'section' => 'easel-background-colors');
	}
	foreach ($css_array as $setinfo) {
		$setinfo_register_name = 'easel-customize['.$setinfo['slug'].']';
		$wp_customize->add_setting($setinfo_register_name, array('default' => $setinfo['default'], 'type' => 'option', 'capability' => 'edit_theme_options'));
		$wp_customize->add_control(
				new WP_Customize_Color_Control(
					$wp_customize,
					$setinfo['slug'], 
					array('label' => $setinfo['label'], 'section' => $setinfo['section'], 'settings' => $setinfo_register_name)
					)
				);
	}
	$wp_customize->add_setting( 'easel-customize-select[select-scheme]', array(
				'default' => 'mecha',
				'capability' => 'edit_theme_options',
				'type' => 'option'
				));
	
	$wp_customize->add_control( 'easel-scheme-options-select-scheme' , array(
				'label' => 'Choose a default scheme.',
				'settings' => 'easel-customize-select[select-scheme]',
				'section' => 'easel-scheme-options',
				'type' => 'select',
				'choices' => array(
					'none' => 'No Scheme',
					'boxed' => 'Boxed',
					'sandy' => 'Sandy',
					'mecha' => 'Mecha',
					'high' => 'High Society'
					)
				)); 
	
	$wp_customize->add_setting( 'easel-customize-select[checkbox-rounded]', array(
				'default' => false,
				'capability' => 'edit_theme_options',
				'type' => 'option'
				));
	
	$wp_customize->add_control( 'easel-scheme-options-rounded-post', array(
				'settings' => 'easel-customize-select[checkbox-rounded]',
				'label'    => __( 'Rounded corners on Post/Page Navigation Sections','comiceasel'),
				'section'  => 'easel-scheme-options',
				'type'     => 'checkbox'
				));
				
	if (function_exists('ceo_pluginfo')) {
		$wp_customize->add_setting( 'easel-customize-select[comic-in-column]', array(
					'default' => false,
					'capability' => 'edit_theme_options',
					'type' => 'option'
					));
		
		$wp_customize->add_control( 'easel-scheme-options-comic-in-column', array(
					'settings' => 'easel-customize-select[comic-in-column]',
					'label'    => __('Put the Comic in the content column?','easel'),
					'section'  => 'easel-scheme-options',
					'type'     => 'checkbox'
					));
	}
}

function easel_customize_preview_js() {
	//	wp_enqueue_script( 'easel-boxed-customizer', get_stylesheet_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '20130226', true );
}

function easel_customize_wp_head() {
	$important = '';
	$settings_array = array(
			// background colors
			array('slug' => 'easel_page_background', 'element' => '#page', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_header_background', 'element' => '#header', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_menubar_background', 'element' => '#menubar-wrapper', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_menubar_submenu_background', 'element' => '.menu ul li ul li a', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_menubar_mouseover_background', 'element' => '.menu ul li a:hover, .menu ul li a.selected', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_breadcrumb_background', 'element' => '#breadcrumb-wrapper', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_content_wrapper_background', 'element' => '#content-wrapper', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_subcontent_wrapper_background', 'element' => '#subcontent-wrapper', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_narrowcolumn_widecolumn_background', 'element' => '.narrowcolumn, .widecolumn', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_post_page_navigation_background', 'element' => '.uentry, #comment-wrapper, #wp-paginav, .blognav', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_post_info_background', 'element' => '.post-info', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_comment_background', 'element' => '.comment, #comment-wrapper #wp-paginav', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_comment_meta_data_background', 'element' => '.comment-meta-data', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_bypostauthor_background', 'element' => '.bypostauthor', 'style' => 'background-color', 'important' => true),
			array('slug' => 'easel_bypostauthor_meta_data_background', 'element' => '.bypostauthor .comment-meta-data', 'style' => 'background-color', 'important' => false),
			array('slug' => 'easel_footer_background', 'element' => '#footer', 'style' => 'background-color', 'important' => false),
			// text colors
			array('slug' => 'easel_content_text_color', 'element' => 'body', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_header_textcolor', 'element' => '#header', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_breadcrumb_textcolor', 'element' => '#breadcrumb-wrapper', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_lrsidebar_widgettitle_textcolor', 'element' => 'h2.widgettitle', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_lrsidebar_textcolor', 'element' => '.sidebar', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_posttitle_textcolor', 'element' => 'h2.post-title', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_pagetitle_textcolor', 'element' => 'h2.page-title', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_postinfo_textcolor', 'element' => '.post-info', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_post_page_navigation_textcolor', 'element' => '.uentry, #comment-wrapper, #wp-paginav', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_footer_copyright_textcolor', 'element' => '.footer-text', 'style' => 'color', 'important' => false),
			// link colors
			array('slug' => 'easel_content_link_color', 'element' => 'a:link, a:visited', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_header_title_acolor', 'element' => '#header h1 a:link, #header h1 a:visited', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_header_title_hcolor', 'element' => '#header h1 a:hover', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_menubar_top_acolor', 'element' => '.menu ul li a:link, .menu ul li a:visited, .mininav-prev a, .mininav-next a', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_menubar_hcolor', 'element' => '.menu ul li a:hover, .menu ul li a.selected, .menu ul li ul li a:hover', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_menubar_sub_acolor', 'element' => '.menu ul li ul li a:link, .menu ul li ul li a:visited', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_breadcrumb_acolor', 'element' => '.breadcrumbs a', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_breadcrumb_hcolor', 'element' => '.breadcrumbs a:hover', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_sidebar_acolor', 'element' => '.sidebar .widget a', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_sidebar_hcolor', 'element' => '.sidebar .widget a:hover', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_postpagenav_acolor', 'element' => '.entry a, .blognav a, #paginav a', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_postpagenav_hcolor', 'element' => '.entry a:hover, .blognav a:hover, #paginav a:hover', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_footer_copyright_acolor', 'element' => '.footer-text a', 'style' => 'color', 'important' => false),
			array('slug' => 'easel_footer_copyright_hcolor', 'element' => '.footer-text a:hover, .blognav a:hover, #paginav a:hover', 'style' => 'color', 'important' => false),
			);
	if (function_exists('ceo_pluginfo')) {
		$settings_array[] = array('slug' => 'easel_comic_wrap_background', 'element' => '#comic-wrap', 'style' => 'background-color', 'important' => true);
		$settings_array[] = array('slug' => 'easel_comic_wrap_textcolor', 'element' => '#comic-wrap', 'style' => 'color', 'important' => true);
		$settings_array[] = array('slug' => 'easel_comic_nav_background', 'element' => 'table#comic-nav-wrapper', 'style' => 'background-color', 'important' => true);
	}
	
	$output = '';
	$style_output = '';
	foreach ($settings_array as $setting) {
		$options = get_option('easel-customize');
		if (!empty($options) && isset($options[$setting['slug']]) && (($content = $options[$setting['slug']]) == true)) {
			if (empty($content)) $content = $content['default'];
			$important = ($setting['important']) ? '!important' : '';
			if (!empty($content)) $style_output .= $setting['element'].' { '.$setting['style'].': '.$content.$important.'; } ';
		}	
	}
	if (!empty($style_output)) {
		$output = '<style type="text/css">'."\r\n";
		$output .= $style_output;
		$output .= "\r\n</style>\r\n";
		echo $output;
	}
}