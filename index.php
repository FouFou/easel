<?php get_header();

if (!easel_themeinfo('disable_blog_on_homepage')) {
	Protect();

	$args = array(
			'public' => true,
			'_builtin' => false
			);
	$output = 'names';
	$operator = 'and';
	
	$loop_post_type = get_query_var('post_type');
	$post_types = array('post');

	if (empty($loop_post_type)) {
		$custom_post_types = get_post_types( $args , $output , $operator );
		$post_types = array_merge( $custom_post_types, array( 'post' ) );
		// remove comic and casts from the loop
		$post_types = array_diff( $post_types, array ( 'comic', 'casts' ) );
		$blog_query = array(
				'posts_per_page' => (int)easel_themeinfo('home_post_count'),
				'paged' => get_query_var('paged'),
				'post_type' => $post_types
			);
	} else {
		$blog_query = array(
				'posts_per_page' => (int)easel_themeinfo('home_post_count'),
				'paged' => get_query_var('paged'),
				'post_type' => $loop_post_type
				);
	}

/*	if (is_paged()) $blog_query = $query_string;
	var_dump($blog_query); */
	$posts = &query_posts($blog_query);
	if (have_posts()) {
		while (have_posts()) : the_post();
			easel_display_post();
		endwhile;
		if (easel_themeinfo('enable_comments_on_homepage') && (easel_themeinfo('home_post_count') == '1')) {
			$withcomments = 1;
			comments_template('', true);
		} else 
			easel_pagination();
	}
	UnProtect();
}

get_footer(); ?>