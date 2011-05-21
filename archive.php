<?php
get_header();

// set to empty
$count = $theCatID = '';
if (is_category()) {
	$theCatID = get_term_by( 'slug', $wp_query->query_vars['category_name'], 'category' );
	if (!empty($theCatID))
		$theCatID = $theCatID->term_id;
	if (isset($wp_query->query_vars['cat'])) $theCatID = (int)$wp_query->query_vars['cat'];	
}

$count = 'No';

if (have_posts()) :
	$count = $wp_query->found_posts;
//	$count = $wp_query->post_count;
	$post = $posts[0]; // Hack. Set $post so that the_date() works
	$post_title_type = $title_string = '';
	if ($post->post_type !== 'post') $post_title_type = $post->post_type.'-'; // extra space at the end for visual
	if (is_category()) { /* Category */
		$title_string = __('Archive for &#8216;','easel').$post_title_type.single_cat_title('',false).__('&#8217;', 'easel');
	} elseif(is_tag()) { /* Tag */
		$title_string = __('Posts Tagged &#8216;','easel').$post_title_type.single_tag_title('',false).__('&#8217;', 'easel');
	} elseif (is_day()) {
		$title_string = __('Archive for &#8216;','easel').$post_title_type.get_the_time('F jS, Y').__('&#8217;', 'easel');
	} elseif (is_month()) {
		$title_string = __('Archive for &#8216;','easel').$post_title_type.get_the_time('F, Y').__('&#8217;', 'easel');
	} elseif (is_year()) {
		$title_string = __('Archive for &#8216;','easel').$post_title_type.get_the_time('Y').__('&#8217;', 'easel');
	} elseif (is_author()) {
		$title_string = __('Author Archive &#8216;','easel').$post_title_type.get_the_time('Y').__('&#8217;', 'easel');
	} elseif (isset($_GET['paged']) && !empty($_GET['paged'])) {
		$title_string = __('Archives','easel');
	} elseif (taxonomy_exists($wp_query->query_vars['taxonomy'])) {
		if (term_exists($wp_query->query_vars['term'])) {
			$title_string = __('Archive for &#8216;','easel').$wp_query->query_vars['term'].__('&#8217;', 'easel');
		} else {
			$title_string = __('Archive for &#8216;','easel').$wp_query->query_vars['taxonomy'].__('&#8217;', 'easel');
		}
	} elseif ($post->post_type !== 'post') {
		$title_string = __('Archive for &#8216;','easel').$post->post_type.__('&#8217;', 'easel');
	} else {
		$title_string = __('Archive is unable to be found.','easel');
	}
?>
	<h2 class="page-title"><?php echo $title_string; ?></h2>
	<div class="archiveresults"><?php printf(_n("%d result.", "%d results.", $count,'easel'),$count); ?></div>
	<div class="clear"></div>
	<?php 
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
	}
	?>
	<div class="clear"></div>
	<?php easel_pagination(); ?>
	
<?php endif; ?>

<?php get_footer(); ?>