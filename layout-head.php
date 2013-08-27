<?php 
$comicSidebars = '';
$comicSidebarCount = 0;
if (is_active_sidebar('ceo-sidebar-left-of-comic')) {
	$comicSidebars = $comicSidebars . 'leftSidebar ';
	$comicSidebarCount += 1;
}
if (is_active_sidebar('ceo-sidebar-right-of-comic')) {
	$comicSidebars = $comicSidebars . 'rightSidebar ';
	$comicSidebarCount += 1;
}
?>
<div id="content-wrapper" class="container-fluid">
	<div class="row-fluid <?php echo $comicSidebars;?> comicSidebars<?php echo $comicSidebarCount ?>">
		<?php do_action('easel-content-area'); ?>
		<?php if (!easel_comic_position_in_column()) do_action('comic-area'); ?>
	</div>
	<div id="subcontent-wrapper" class="row-fluid">
<?php
if (!easel_is_signup() && !easel_sidebars_disabled()) {
		if (easel_is_layout('2cl,2clw,3c,3cl')) easel_get_sidebar('left');
		if (easel_is_layout('3cl')) easel_get_sidebar('right');
}
?>
		<div id="content-column" class="<?php echo (easel_is_layout('2clw,2clr,3c,3cl,3cr')) ? 'span8' : 'span12'; ?>">
			<?php if (easel_comic_position_in_column()) do_action('comic-area'); ?>
			<div id="content" class="narrowcolumn">
				<?php do_action('comic-blog-area'); ?>
				<?php do_action('easel-narrowcolumn-area'); ?>
				<?php if (is_home() && !easel_sidebars_disabled()) easel_get_sidebar('over-blog'); ?>
