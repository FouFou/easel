<?php 
get_header();
$archive_display_order = easel_themeinfo('archive_display_order');
?>
	<h2 class="page-title"><?php _e('Search for &lsquo;','easel'); the_search_query(); _e('&rsquo;','easel'); ?></h2>

<?php
if (have_posts()) :
	$posts = &query_posts($query_string.'&order='.$archive_display_order);

	while (have_posts()) : the_post();
			easel_display_post();
	endwhile;
	easel_pagination();

	else : ?>
		<div class="post post-search type-page">
			<div class="post-head"></div>
			<div class="post-content">
				<h3><?php _e('No entries found.','easel'); ?></h3>
				<p><?php _e('Try another search?','easel'); ?></p>
				<p><?php get_search_form(); ?></p>
			</div>
			<div class="post-foot"></div>
		</div>
<?php
	endif;
	
get_footer();
?>