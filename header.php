<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>> 
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type') ?>; charset=<?php bloginfo('charset') ?>" />
	<title><?php wp_title(); ?></title>
	<link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>" type="text/css" media="screen" />
	<link rel="pingback" href="<?php bloginfo('pingback_url') ?>" />
	<meta name="Easel" content="<?php echo easel_themeinfo('version'); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
$hgWidth = 'span12';
$sWidth = '';
if(is_active_sidebar('sidebar-header')){
	$hgWidth = "span6";
	$sWidth = "span6";
}
?>
<div id="page-wrap">
	<div id="page" class="container-fluid">
		
		<header id="header" class="">
			<div class="container-fluid">
				<div class="row-fluid">
					<hgroup class="header-info <?php echo $hgWidth; ?>">
						<h1><a href="<?php echo home_url(); ?>"><?php bloginfo('name') ?></a></h1>
						<h3 class="description"><?php bloginfo('description') ?></h2>
					</hgroup>
					<aside class="<?php $sWidth ?>">
						<?php easel_get_sidebar('header'); ?>
					</aside>
				</div>
			</div>
		</header>

<?php 
if (!easel_themeinfo('disable_default_menubar') && function_exists('easel_menubar')) easel_menubar();
if (easel_themeinfo('enable_breadcrumbs')) easel_breadcrumbs();
easel_get_sidebar('menubar');
get_template_part('layout', 'head');
?>