<?php
/*
Template Name: ChangeLog
*/
get_header();

if (have_posts()) {
	while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?>>
			<?php easel_display_post_thumbnail(); ?>
			<div class="post-head"><?php do_action('easel-post-head'); ?></div>
			<div class="post-content">
				<div class="post-info">
					<div class="post-text">
						<?php easel_display_post_title(); ?>
					</div>
				</div>
				<div class="clear"></div>				
				<div class="entry">
					<?php easel_display_the_content(); ?>
					<?php echo nl2br(esc_attr(file_get_contents('c:\inetpub\frumph.net\wp-content\themes\comicpress\changelog.txt'))); ?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<?php edit_post_link(__('Edit this page.','easel'), '', ''); ?>
			</div>
			<div class="post-foot"><?php do_action('easel-post-foot'); ?></div>
		</div>
	<?php endwhile;
	if ($post->comment_status == 'open') {
		comments_template('', true);
	}
}

get_footer();
?>