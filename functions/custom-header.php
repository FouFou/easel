<?php

add_filter('easel_header_image_width', 'easel_change_header_width');

function easel_change_header_width($width) {
	if (easel_themeinfo('custom_image_header_width')) $width = easel_themeinfo('custom_image_header_width');
	return (int)$width;
}

add_filter('easel_header_image_height', 'easel_change_header_height');

function easel_change_header_height($height) {
	if (easel_themeinfo('custom_image_header_height')) $width = easel_themeinfo('custom_image_header_height');
	return (int)$height;
}

// Custom Image Header Defaults
define('HEADER_TEXTCOLOR', '');
define('HEADER_IMAGE', ''); // %s is theme dir
define('NO_HEADER_TEXT', true);

define( 'HEADER_IMAGE_WIDTH', apply_filters( 'easel_header_image_width', '980') );
define( 'HEADER_IMAGE_HEIGHT', apply_filters( 'easel_header_image_height', '100') );
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

?>