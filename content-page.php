<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
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
			<div class="clear"></div>
		</div>
		<footer>
			<?php wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number')); ?>
			<div class="clear"></div>
			<?php edit_post_link(__('Edit this page.','easel'), '', ''); ?>
		</footer>
	</div>
	<div class="post-foot"><?php do_action('easel-post-foot'); ?></div>
</article>
<?php comments_template('', true);