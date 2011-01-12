<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> 
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<title><?php 
	bloginfo('name'); 
	if (is_home () ) {
		echo ' - '; bloginfo('description');
	} elseif (is_category() ) {
		echo ' - '; single_cat_title();
	} elseif (is_single() || is_page() ) { 
		echo ' - '; single_post_title();
	} elseif (is_search() ) { 
		echo __(' search results: ','easel'); echo esc_html($s);
	} else { 
		echo ' - '; wp_title('',true);
	}
  ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
<?php if (!easel_themeinfo('disable_default_design') && !is_child_theme()) { ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style-default.css" type="text/css" media="screen" />
<?php } ?>
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<meta name="Easel" content="<?php echo easel_themeinfo('version'); ?>" />
	<?php if ( is_singular() && get_option( 'thread_comments' ) && !easel_themeinfo('disable_comment_javascript')) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page-head"><?php do_action('easel-page-head'); ?></div>
<div id="page-wrap">
	<div id="page">
		<?php easel_get_sidebar('above-header'); ?>
		<div id="header">
			<div class="description"><?php bloginfo('description') ?></div>
			<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name') ?></a></h1>
			<?php easel_get_sidebar('header'); ?>
			<div class="clear"></div>
		</div>

<?php 
if (!easel_themeinfo('disable_default_menubar') && function_exists('easel_menubar')) easel_menubar();
easel_get_sidebar('menubar');
easel_display_layout('head');
?>