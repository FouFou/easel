<?php

function commpress_init() {
	
	$labels = array(
		'name' => _x('Casts', 'post type general name'),
		'singular_name' => _x('Cast', 'post type singular name'),
		'add_new' => _x('Add New', 'casts'),
		'add_new_item' => __('Add New Cast'),
		'edit_item' => __('Edit Cast'),
		'edit' => _x('Edit', 'casts'),
		'new_item' => __('New Cast'),
		'view_item' => __('View Cast'),
		'search_items' => __('Search Casts'),
		'not_found' =>  __('No casts found'),
		'not_found_in_trash' => __('No casts found in Trash'), 
		'view' =>  __('View Cast'),
		'parent_item_colon' => ''
	);	
	
	register_post_type(
		'casts', 
		array(
			'labels' => $labels,
			'public' => true,
			'public_queryable' => true,
			'show_ui' => true,
			'query_var' => true,
			'_edit_link' => 'post.php?post=%d',
			'capability_type' => 'post',
			'rewrite' => true,
			'hierarchical' => false,
			'menu_position' => null,
			'supports' => array( 'title', 'editor', 'excerpt', 'author', 'trackbacks', 'comments', 'thumbnail' )
		)
	);
	
	$labels = array(
		'name' => _x( 'Tags', 'taxonomy general name' ),
		'singular_name' => _x( 'Tag', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Tags' ),
		'popular_items' => __( 'Popular Tags' ),
		'all_items' => __( 'All Tags' ),
		'parent_item' => __( 'Parent Tag' ),
		'parent_item_colon' => __( 'Parent Tag:' ),
		'edit_item' => __( 'Edit Tag' ), 
		'update_item' => __( 'Update Tag' ),
		'add_new_item' => __( 'Add New Tag' ),
		'new_item_name' => __( 'New Tag Name' ),
	); 	

	register_taxonomy('cast-tag',array('casts'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'cast-tag' ),
	));

	$labels = array(
		'name' => _x( 'Guests', 'taxonomy general name' ),
		'singular_name' => _x( 'Guest', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Guests' ),
		'popular_items' => __( 'Popular Guests' ),
		'all_items' => __( 'All Guests' ),
		'parent_item' => __( 'Parent Guest' ),
		'parent_item_colon' => __( 'Parent Guest:' ),
		'edit_item' => __( 'Edit Guest' ), 
		'update_item' => __( 'Update Guest' ),
		'add_new_item' => __( 'Add New Guest' ),
		'new_item_name' => __( 'New Guest Name' ),
	); 	

	register_taxonomy('cast-guest',array('casts'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'cast-guest' ),
	));
	
	$labels = array(
		'name' => _x( 'Audience', 'taxonomy general name' ),
		'singular_name' => _x( 'Audience', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Audience' ),
		'popular_items' => __( 'Popular Audience' ),
		'all_items' => __( 'All Audience' ),
		'parent_item' => __( 'Parent Audience' ),
		'parent_item_colon' => __( 'Parent Audience:' ),
		'edit_item' => __( 'Edit Audience' ), 
		'update_item' => __( 'Update Audience' ),
		'add_new_item' => __( 'Add New Audience' ),
		'new_item_name' => __( 'New Audience Name' ),
	); 	

	register_taxonomy('cast-audience',array('casts'), array(
		'hierarchical' => false,
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'cast-audience' ),
	));
	
	$labels = array(
		'name' => _x( 'Hosts', 'taxonomy general name' ),
		'singular_name' => _x( 'Host', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Hosts' ),
		'popular_items' => __( 'Popular Host' ),
		'all_items' => __( 'All Hosts' ),
		'parent_item' => __( 'Parent Host' ),
		'parent_item_colon' => __( 'Parent Host:' ),
		'edit_item' => __( 'Edit Host' ), 
		'update_item' => __( 'Update Host' ),
		'add_new_item' => __( 'Add New Host' ),
		'new_item_name' => __( 'New Host Name' ),
	); 	

	register_taxonomy('cast-host',array('casts'), array(
		'hierarchical' => false,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'host' ),
	));

	$labels = array(
		'name' => _x( 'Show', 'taxonomy general name' ),
		'singular_name' => _x( 'Show', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Shows' ),
		'popular_items' => __( 'Popular Shows' ),
		'all_items' => __( 'All Shows' ),
		'parent_item' => __( 'Parent Show' ),
		'parent_item_colon' => __( 'Parent Show:' ),
		'edit_item' => __( 'Edit Show' ), 
		'update_item' => __( 'Update Show' ),
		'add_new_item' => __( 'Add New Show' ),
		'new_item_name' => __( 'New Show Name' ),
	); 	

	register_taxonomy('cast-show',array('casts'), array(
		'hierarchical' => true,
		'labels' => $labels,
		'public' => true,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'cast-show' ),
	));

	register_taxonomy_for_object_type('cast-host', 'casts');
	register_taxonomy_for_object_type('cast-guest', 'casts');
	register_taxonomy_for_object_type('cast-tag', 'casts');
	register_taxonomy_for_object_type('cast-audience', 'casts');
	register_taxonomy_for_object_type('cast-show', 'casts');

}

add_action('init', 'commpress_init');

if (!function_exists('commpress_display_hosts')) {
	function commpress_display_hosts() {
		global $post;
		$before = '<li>';
		$sep = '</li><li>'; 
		$after = '</li>';
		$output = get_the_term_list( $post->ID, 'cast-host', $before, $sep, $after );
		return $output;
	}
}

if (!function_exists('commpress_display_guests')) {
	function commpress_display_guests() {
		global $post;
		$before = '<li>';
		$sep = '</li><li>';
		$after = '</li>';
		$output = get_the_term_list( $post->ID, 'cast-guest', $before, $sep, $after );
		return $output;
	}
}

if (!function_exists('commpress_display_cast_tags')) {
	function commpress_display_cast_tags() {
		global $post;
		$before = __('&#9492; Tags: ','commpress');
		$sep = "\',"; 
		$after = '<br />';
		$output = get_the_term_list( $post->ID, 'cast-tag', $before, $sep, $after );
		return $output;
	}
}

if (!function_exists('commpress_display_post_tags')) {
	function commpress_display_post_tags() {
		global $post;
		$post_tags = "<div class=\"post-tags\">".get_the_tag_list(__('&#9492; Tags: ','commpress'), ', ', '<br />')."</div>\r\n";
		echo apply_filters('commpress_display_post_tags',$post_tags);
	}
}

if (!function_exists('commpress_display_audience')) {
	function commpress_display_audience() {
		global $post;
		$before = '<li>';
		$sep = '</li><li>'; 
		$after = '</li>';
		$output = get_the_term_list( $post->ID, 'cast-audience', $before, $sep, $after );
		return $output;
	}
}

// Injections

add_action('easel-post-foot', 'commpress_display_edit_link');
	
function commpress_display_edit_link() {
	global $post;
	if ($post->post_type == 'casts') {
		edit_post_link(__('<br />Edit Cast','comiceasel'), '', ''); 
	}
}

add_filter('easel_display_post_category', 'commpress_display_cast_show');

// TODO: Make this actually output a chapter set that the comic is in, instead of the post-type
function commpress_display_cast_show($post_show) {
	global $post;
	if ($post->post_type == 'casts') {
		$before = '<div class="casts-show"> ';
		$sep = ', '; 
		$after = '</div>';
		$post_show = get_the_term_list( $post->ID, 'cast-show', $before, $sep, $after );
	}
	return apply_filters('commpress_display_cast_show', $post_show);
}

add_action('easel-narrowcolumn-area', 'commpress_display_cast');

function commpress_display_cast() {
	global $wp_query, $post;
	if (!is_paged() && is_home()) { 
		Protect();
		$cast_args = array(
				'posts_per_page' => 1,
				'post_type' => 'casts'
				);
		$wp_query->in_the_loop = true; $castFrontpage = new WP_Query(); $castFrontpage->query($cast_args);
		while ($castFrontpage->have_posts()) : $castFrontpage->the_post();
			easel_display_post();
		endwhile;
		UnProtect();
	}
}


?>