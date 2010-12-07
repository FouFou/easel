<?php
get_header(); 

if (is_category()) {
	$theCatId = get_term_by( 'slug', $wp_query->query_vars['category_name'], 'category' );
	$theCatId = $theCatId->term_id;
}

if (have_posts()) :
?>
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
	<?php /* Category Archive */ if (is_category()) { ?>
		<h2 class="page-title"><?php _e('Archive for &#8216;','easel'); ?><?php single_cat_title() ?>&#8217;</h2>
	<?php /* Tag Archive */ } elseif( is_tag() ) { ?>
		<h2 class="page-title"><?php _e('Posts Tagged &#8216;','easel'); ?><?php single_tag_title() ?>&#8217;</h2>
	<?php /* Daily Archive */ } elseif (is_day()) { ?>
		<h2 class="page-title"><?php _e('Archive for','easel'); ?> <?php the_time('F jS, Y') ?></h2>
	<?php /* Monthly Archive */ } elseif (is_month()) { ?>
		<h2 class="page-title"><?php _e('Archive for','easel'); ?> <?php the_time('F, Y') ?></h2>
	<?php /* Yearly Archive */ } elseif (is_year()) { ?>
		<h2 class="page-title"><?php _e('Archive for','easel'); ?> <?php the_time('Y') ?></h2>
	<?php /* Author Archive */ } elseif (is_author()) { ?>
		<h2 class="page-title"><?php _e('Author Archive','easel'); ?></h2>
	<?php /* Paged Archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
		<h2 class="page-title"><?php _e('Archives','easel'); ?></h2>
	<?php /* taxonomy */ } elseif (taxonomy_exists($wp_query->query_vars['taxonomy'])) {
		if (term_exists($wp_query->query_vars['term'])) { ?>
			<h2 class="page-title"><?php _e('Archive for','easel'); ?> - <?php echo $wp_query->query_vars['term']; ?></h2>
		<?php } else { ?>
			<h2 class="page-title"><?php _e('Archive for','easel'); ?> - <?php echo $wp_query->query_vars['taxonomy']; ?></h2>
		<?php } ?>
	<?php /* Post Type */ } elseif ($post->post_type !== 'post') { ?>
		<h2 class="page-title"><?php echo $post->post_type; ?></h2>
	<?php } ?>
	<div class="clear"></div>
	<?php 
	while (have_posts()) : the_post();
		easel_display_post();
	endwhile;
	?>
	<div class="clear"></div>
	<?php easel_pagination(); ?>
	
<?php endif; ?>


<?php get_footer(); ?>