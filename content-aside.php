<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-head"><?php do_action('easel-post-head'); ?></div>
	<div class="post-content">
		<div class="entry">
			<?php easel_display_the_content(); ?>
			<div class="clear"></div>
			<?php edit_post_link(__('Edit this post.','easel'), '', ''); ?>
		</div>
	</div>
	<div class="post-foot"><?php do_action('easel-post-foot'); ?></div>
	<div class="clear"></div>
</div>
<?php 
comments_template('', true);