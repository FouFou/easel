<div id="content-wrapper-head"><?php do_action('easel-content-wrapper-head'); ?></div>
<div id="content-wrapper">
	
	<?php do_action('easel-content-area'); ?>
	<?php do_action('comic-area'); ?>
	
	<div id="subcontent-wrapper-head"><?php do_action('easel-subcontent-wrapper-head'); ?></div>
	<div id="subcontent-wrapper">
		<?php do_action('easel-subcontent-area-top'); ?>
<?php
if (!easel_is_signup() && !easel_sidebars_disabled()) {
		if (easel_is_layout('2cl,2clw,3c,3cl')) easel_get_sidebar('left');
		if (easel_is_layout('3cl')) easel_get_sidebar('right');
}
?>
		<div id="content-head"></div>
		<div id="content" class="narrowcolumn">
		<?php do_action('comic-blog-area'); ?>
		<?php do_action('easel-narrowcolumn-area'); ?>
		<?php if (is_home() && !easel_sidebars_disabled()) easel_get_sidebar('over-blog'); ?>
