<div id="content-wrapper-head"><?php do_action('easel-content-wrapper-head'); ?></div>
<div id="content-wrapper">
	
	<?php do_action('easel-content-area'); ?>
	<?php do_action('comic-area'); ?>
	
	<div id="subcontent-wrapper-head"><?php do_action('easel-subcontent-wrapper-head'); ?></div>
	<div id="subcontent-wrapper">
		<?php do_action('easel-subcontent-wrapper'); ?>
		<div id="column-head"></div>
		<?php if (easel_is_signup() || easel_sidebars_disabled()) { ?>
			<div id="column" class="widecolumn">
		<?php } else { ?>
<?php
if (!easel_is_signup() && !easel_sidebars_disabled()) {
		if (easel_themeinfo('layout') != 'b3cr') get_sidebar('left');
		if (easel_themeinfo('layout') == 'b3cl') get_sidebar('right');
}
?>
			<div id="column" class="narrowcolumn">
		<?php } ?>
		<?php do_action('easel-narrowcolumn-area'); ?>
		<?php easel_get_sidebar('over-blog'); ?>