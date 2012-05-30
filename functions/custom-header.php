<?php

if ( ( ! function_exists( 'wp_get_theme' ) ) || wp_get_theme('version') < '3.4' ) {
	$custom_header_args = array();
	
	add_theme_support( 'custom-header', array(
				// Header image default
				'default-image'			=> false,
				// Header text display default
				'header-text'			=> false,
				// Header text color default
				'default-text-color'		=> '000',
				// Header image width (in pixels)
				'width'				=> easel_themeinfo('custom_image_header_width'),
				// Header image height (in pixels)
				'height'			=> easel_themeinfo('custom_image_header_height'),
				// Header image random rotation default
				'random-default'		=> false,
				// Template header style callback
				'wp-head-callback'		=> 'easel_header_style',
				// Admin header style callback
				'admin-head-callback'		=> 'easel_admin_header_style',
				// Admin preview style callback
				'admin-preview-callback'	=> 'easel_admin_header_style'
				) );
	
	function easel_admin_header_style() { ?>
		<style type="text/css">
		#headimg {
		width: <?php echo get_custom_header()->width; ?>px;
		height: <?php echo get_custom_header()->height; ?>px;
		background: url(<?php header_image(); ?>) no-repeat center;	
		}
		
		#headimg h1, #headimg .description {
		display: none;
		}
		</style>
		<?php
	}
	
	function easel_header_style() { 
		if (get_header_image()) { ?>
			<style type="text/css">
			#header {
			width: <?php echo HEADER_IMAGE_WIDTH; ?>px; 
			/* height: <?php echo HEADER_IMAGE_HEIGHT; ?>px; */
			background: url(<?php header_image(); ?>) top center no-repeat;
			overflow: hidden;
			}
			#header h1 { padding: 0; }
			#header h1 a { 
			display: block;
			width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
			height: <?php echo HEADER_IMAGE_HEIGHT-1; ?>px;
			text-indent: -9999px;
			}
			#header .description { display: none; }
			</style>
		<?php }
	}

} else {

	add_filter('easel_header_image_width', 'easel_change_header_width');

	function easel_change_header_width($width) {
		if (easel_themeinfo('custom_image_header_width')) $width = easel_themeinfo('custom_image_header_width');
		return (int)$width;
	}

	add_filter('easel_header_image_height', 'easel_change_header_height');

	function easel_change_header_height($height) {
		if (easel_themeinfo('custom_image_header_height')) $height = easel_themeinfo('custom_image_header_height');
		return (int)$height;
	}

	// Custom Image Header Defaults
	define('HEADER_TEXTCOLOR', '');
	define('HEADER_IMAGE', ''); // %s is theme dir
	define('NO_HEADER_TEXT', true);

	define( 'HEADER_IMAGE_WIDTH', apply_filters( 'easel_header_image_width', 980) );
	define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'easel_header_image_height', 100) );

	set_post_thumbnail_size( HEADER_IMAGE_WIDTH, HEADER_IMAGE_HEIGHT, true );

	add_custom_image_header('easel_header_style', 'easel_admin_header_style');

	function easel_admin_header_style() { ?>
	<style type="text/css">
	#headimg {
		width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
		height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
		background: url(<?php header_image(); ?>) no-repeat center;	
	}
		
	#headimg h1, #headimg .description {
		display: none;
	}
	</style>

		<?php
	}
		
	function easel_header_style() { 
		if (get_header_image()) { ?>
	<style type="text/css">
		#header {
			width: <?php echo HEADER_IMAGE_WIDTH; ?>px; 
			height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
			background: url(<?php header_image(); ?>) top center no-repeat;
			overflow: hidden;
		}

		#header h1 { padding: 0; }
		#header h1 a { 
			display: block;
			width: <?php echo HEADER_IMAGE_WIDTH; ?>px;
			height: <?php echo HEADER_IMAGE_HEIGHT; ?>px;
			text-indent: -9999px;
		}
		#header .description { display: none; }
	</style>

		<?php }
	}
}

?>