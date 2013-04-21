<?php if (is_author()) { ?>
	<li><span class="author-archive-date" align="right"><?php the_time('M j, Y') ?></span><span class="author-archive-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></span></li>
<?php } else { ?>
<?php if (!easel_is_bbpress()) easel_display_blog_navigation(); ?>
<?php if (!is_home() && !is_archive() && !is_search()) { easel_display_post_thumbnail('large'); ?>
<div class="clear"></div>
<?php } ?>
<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-head"><?php do_action('easel-post-head'); ?></div>
	<div class="post-content">
		<?php if (is_home() || is_archive() || is_search()) easel_display_post_thumbnail('thumbnail'); ?>
		<?php if (!easel_is_bbpress()) easel_display_author_gravatar(); ?>
		<div class="post-info">
			<?php 
				easel_display_post_title();
				if (!easel_is_bbpress()) easel_display_post_calendar();
				if (is_sticky()) { ?><div class="sticky-image">Featured Post</div><?php }
				if (function_exists('easel_show_mood_in_post')) easel_show_mood_in_post(); 
			?>
			<div class="post-text">
				<?php 
				easel_display_post_author();
				easel_display_post_date();	easel_display_post_time(); easel_display_modified_date_time();
				easel_display_post_category();
				if (function_exists('the_ratings') && $post->post_type == 'post') { the_ratings(); }
				do_action('easel-post-info');
				wp_link_pages(array('before' => '<div class="linkpages"><span class="linkpages-pagetext">Pages:</span> ', 'after' => '</div>', 'next_or_number' => 'number'));
				?>
			</div>
			<div class="clear"></div>
		</div>
		<div class="clear"></div>
		<div class="entry">
			<?php easel_display_the_content(); ?>
			<div class="clear"></div>
		</div>
		<div class="post-extras">
			<?php 
				easel_display_post_tags();
				do_action('easel-post-extras');
				easel_display_comment_link(); 
			?>
			<div class="clear"></div>
		</div>
		<?php edit_post_link(__('Edit this post.','easel'), '', ''); ?>
		<div class="clear"></div>
	</div>
	<div class="post-foot"><?php do_action('easel-post-foot'); ?></div>
	<div class="clear"></div>
</div>
<?php 
comments_template('', true);
<?php } ?>