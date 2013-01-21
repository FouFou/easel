<?php
/*
Template Name: Blog
*/
get_header();

$blog_query = array(
		'paged' => get_query_var('paged')
		);
$posts = &query_posts($blog_query);
if (have_posts()) {
	while (have_posts()) : the_post();
		get_template_part('content', get_post_format());
	endwhile;
	easel_pagination();
}

get_footer();
?>