<div id="content-wrapper-head"><?php do_action('easel-content-wrapper-head'); ?></div>
<div id="content-wrapper">
	<?php do_action('easel-content-area'); ?>
	<div id="subcontent-wrapper-head"><?php do_action('easel-subcontent-wrapper-head'); ?></div>
	<div id="subcontent-wrapper">
		<?php do_action('easel-subcontent-wrapper'); ?>
<?php 
if (!easel_is_signup() && !is_page('chat') && !is_page('forum')) { 
	get_sidebar('left');
	get_sidebar('right'); 
}
?>
		<div id="column-head"></div>
		<?php if (easel_is_signup() || is_page('chat') || is_page('forum')) { ?>
			<div id="column" class="widecolumn">
		<?php } else { ?>
			<div id="column" class="narrowcolumn">
		<?php } ?>
		<?php do_action('easel-narrowcolumn-area'); ?>
		<?php easel_get_sidebar('over-blog'); ?>