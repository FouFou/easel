<?php
/**
 * Syndication - adding thumbnail to feed.
 * Author: Philip M. Hofer (Frumph)
 * 
 */

//Insert the comic image into the RSS feed
if (!function_exists('easel_thumbnail_feed')) {
	function easel_thumbnail_feed() { 
		global $post, $wp_query;
		$post_thumbnail = '';
		$post_thumbnail_image = get_the_post_thumbnail($post->ID, 'thumbnail');
		if (!empty($post_thumbnail_image)) {
			$link = get_post_meta( $post->ID, 'link', true );
			if (empty($link)) $link = get_permalink();
			$post_thumbnail = "<p><a href=\"".$link."\" rel=\"bookmark\" title=\"Link to ".get_the_title()."\">".$post_thumbnail_image."</a></p>";
		}
		return apply_filters('easel_thumbnail_feed', $post_thumbnail);
	}
}

// removed the easel_in_comic_category so that if it has a post-image it will add it to the rss feed (else rss comic thumb)
if (!function_exists('easel_insert_thumbnail_feed')) {
	function easel_insert_thumbnail_feed($content) {
		global $post, $wp_query;
		if (is_feed()) {
			$content .= easel_thumbnail_feed();
		}
		return $content;
	}
}

// Using the_content and the_excerpt instead of the_content_rss cause it doesn't work properly otherwise
if (easel_themeinfo('enable_post_thumbnail_rss')) {
	add_filter('the_content','easel_insert_thumbnail_feed');
	add_filter('the_excerpt_rss','easel_insert_thumbnail_feed');
}

// This will add *all* custom post types to the RSS feed naturally
// This doesn't work the query is still hitting the /comic/feed/
// add_filter( 'pre_get_posts' , 'easel_include_custom_post_types_in_rss' );

function easel_include_custom_post_types_in_rss( $query ) {
	if ($query->is_feed && !isset($query->post_type) && empty($query->post_type)) {
		$args = array(
				'public' => true,
				'_builtin' => false
				);
		$output = 'names';
		$operator = 'and';
		$post_types = get_post_types( $args , $output , $operator );
		// remove 'pages' from the RSS
		$post_types = array_merge( $post_types, array('post') ) ;
		$query->set( 'post_type' , $post_types );
	}
	return $query;
}

?>