<?php 
get_header();
$archive_display_order = easel_themeinfo('archive_display_order');
if (empty($archive_display_order)) $archive_display_order = 'DESC';

$order = '&order='.$archive_display_order;

if (easel_themeinfo('display_archive_as_links')) {
	$post_count = '&showposts=-1&posts_per_page=-1';
}

Protect();
$tmp_search = new WP_Query($query_string.'&showposts=-1&posts_per_page=-1');
if (isset($tmp_search->post_count)) {
	$count = $tmp_search->post_count;
} else {
	$count = "No";
}
UnProtect();

$args = $query_string . $post_count . $order;
$posts = &query_posts($args);

?>
	<h2 class="page-title"><?php _e('Search for &lsquo;','easel'); the_search_query(); _e('&rsquo;','easel'); ?></h2>
	<div class="searchresults"><?php printf(_n("%d result.", "%d results.", $count,'easel'),$count); ?></div>
	<div class="clear"></div>
<?php
if (have_posts()) :
	if (easel_themeinfo('display_archive_as_links')) { ?>
	<div <?php post_class(); ?>>
		<div class="post-head"></div>
		<div class="entry">
		<table class="archive-table">
			<?php while (have_posts()) : the_post(); ?>
			<tr><td class="archive-date"><?php the_time('M d, Y') ?></td><td class="archive-title"><a href="<?php echo get_permalink($post->ID) ?>" rel="bookmark" title="<?php _e('Permanent Link:','easel'); ?> <?php the_title() ?>"><?php the_title() ?></a></td></tr>
			<?php endwhile; ?>
		</table>
		</div>
		<div class="post-foot"></div>
	</div>
	<?php } else {
		while (have_posts()) : the_post();
			easel_display_post();
		endwhile;
	} ?>
	<div class="clear"></div>
	<?php easel_pagination();
	else : ?>
		<div class="post post-search type-page">
			<div class="post-head"></div>
			<div class="post-content">
				<div class="entry">
					<h3><?php _e('No results found.','easel'); ?></h3>
					<p><?php _e('Try another search?','easel'); ?></p>
					<p><?php get_search_form(); ?></p>
				</div>
			</div>
			<div class="post-foot"></div>
		</div>
<?php
	endif;
	
get_footer();
?>