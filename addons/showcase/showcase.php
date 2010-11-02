<?php

function comic_list_init() {
	
	$labels = array(
		'name' => _x('Comic List', 'post type general name'),
		'singular_name' => _x('Comic', 'post type singular name'),
		'add_new' => _x('Add New', 'showcase'),
		'add_new_item' => __('Add New Comic'),
		'edit_item' => __('Edit Comic'),
		'edit' => _x('Edit', 'showcase'),
		'new_item' => __('New Comic'),
		'view_item' => __('View Comic'),
		'search_items' => __('Search Comics'),
		'not_found' =>  __('No comics found'),
		'not_found_in_trash' => __('No comics found in Trash'), 
		'view' =>  __('View Comic'),
		'parent_item_colon' => ''
	);
	
	register_post_type(
		'showcase', 
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
			'menu_position' => 5,
			'supports' => array( 'title', 'editor', 'excerpt', 'custom-fields', 'author', 'trackbacks', 'comments', 'thumbnail' )
	));
			
	  $labels = array(
		'name' => _x( 'Genres', 'taxonomy general name' ),
		'singular_name' => _x( 'Genre', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Genres' ),
		'popular_items' => __( 'Popular Genres' ),
		'all_items' => __( 'All Genres' ),
		'parent_item' => __( 'Parent Genre' ),
		'parent_item_colon' => __( 'Parent Genre:' ),
		'edit_item' => __( 'Edit Genre' ), 
		'update_item' => __( 'Update Genre' ),
		'add_new_item' => __( 'Add New Genre' ),
		'new_item_name' => __( 'New Genre Name' ),
	  ); 	

	  register_taxonomy('genre',array('showcase'), array(
		'hierarchical' => false,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'genre' ),
	  ));
	
	  $labels = array(
		'name' => _x( 'Styles', 'taxonomy general name' ),
		'singular_name' => _x( 'Style', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Styles' ),
		'popular_items' => __( 'Popular Styles' ),
		'all_items' => __( 'All Styles' ),
		'parent_item' => __( 'Parent Style' ),
		'parent_item_colon' => __( 'Parent Style:' ),
		'edit_item' => __( 'Edit Style' ), 
		'update_item' => __( 'Update Style' ),
		'add_new_item' => __( 'Add New Style' ),
		'new_item_name' => __( 'New Style Name' ),
	  ); 	

	  register_taxonomy('style',array('showcase'), array(
		'hierarchical' => false,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'style' ),
	  ));
	
	  $labels = array(
		'name' => _x( 'Authors', 'taxonomy general name' ),
		'singular_name' => _x( 'Author', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Authors' ),
		'popular_items' => __( 'Popular Authors' ),
		'all_items' => __( 'All Authors' ),
		'parent_item' => __( 'Parent Author' ),
		'parent_item_colon' => __( 'Parent Author:' ),
		'edit_item' => __( 'Edit Author' ), 
		'update_item' => __( 'Update Author' ),
		'add_new_item' => __( 'Add New Author' ),
		'new_item_name' => __( 'New Author Name' ),
	  ); 	

	  register_taxonomy('authors',array('showcase'), array(
		'hierarchical' => false,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'authors' ),
	  ));

	  $labels = array(
		'name' => _x( 'Languages', 'taxonomy general name' ),
		'singular_name' => _x( 'Language', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Languages' ),
		'popular_items' => __( 'Popular Languages' ),
		'all_items' => __( 'All Languages' ),
		'parent_item' => __( 'Parent Language' ),
		'parent_item_colon' => __( 'Parent Language:' ),
		'edit_item' => __( 'Edit Language' ), 
		'update_item' => __( 'Update Language' ),
		'add_new_item' => __( 'Add New Language' ),
		'new_item_name' => __( 'New Language' ),
	  ); 	

	  register_taxonomy('language',array('showcase'), array(
		'hierarchical' => false,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'language' ),
	  ));
	
	  $labels = array(
		'name' => _x( 'Designers', 'taxonomy general name' ),
		'singular_name' => _x( 'Designer', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Designers' ),
		'popular_items' => __( 'Popular Designers' ),
		'all_items' => __( 'All Designers' ),
		'parent_item' => __( 'Parent Designer' ),
		'parent_item_colon' => __( 'Parent Designer:' ),
		'edit_item' => __( 'Edit Designer' ), 
		'update_item' => __( 'Update Designer' ),
		'add_new_item' => __( 'Add New Designer' ),
		'new_item_name' => __( 'New Designer Name' ),
	  ); 	

	  register_taxonomy('designer',array('showcase'), array(
		'hierarchical' => false,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'designer' ),
	  ));

	  $labels = array(
		'name' => _x( 'CMS Used', 'taxonomy general name' ),
		'singular_name' => _x( 'CMS', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search CMS\'s' ),
		'popular_items' => __( 'Popular CMS\'s' ),
		'all_items' => __( 'All CMS\'s' ),
		'parent_item' => __( 'Parent CMS' ),
		'parent_item_colon' => __( 'Parent CMS:' ),
		'edit_item' => __( 'Edit CMS' ), 
		'update_item' => __( 'Update CMS' ),
		'add_new_item' => __( 'Add New CMS' ),
		'new_item_name' => __( 'New CMS Name' ),
	  ); 	

	  register_taxonomy('cms',array('showcase'), array(
		'hierarchical' => false,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'cms' ),
	  ));
	
	  $labels = array(
		'name' => _x( 'Twitter Names', 'taxonomy general name' ),
		'singular_name' => _x( 'Twitter User', 'taxonomy singular name' ),
		'search_items' =>  __( 'Search Twitter Users' ),
		'popular_items' => __( 'Popular Twitter Users' ),
		'all_items' => __( 'All Twitter Users' ),
		'parent_item' => __( 'Parent Twitter' ),
		'parent_item_colon' => __( 'Parent Twitter:' ),
		'edit_item' => __( 'Edit Twitter Name' ), 
		'update_item' => __( 'Update Twitter Name' ),
		'add_new_item' => __( 'Add New Twitter Name' ),
		'new_item_name' => __( 'New Twitter Name' ),
	  ); 	

	  register_taxonomy('twitter',array('showcase'), array(
		'hierarchical' => false,
		'public' => true,
		'labels' => $labels,
		'show_ui' => true,
		'query_var' => true,
		'show_tagcloud' => true,
		'rewrite' => array( 'slug' => 'twitter' ),
	  ));

	register_taxonomy_for_object_type('genre', 'showcase');
	register_taxonomy_for_object_type('style', 'showcase');
	register_taxonomy_for_object_type('authors', 'showcase');
	register_taxonomy_for_object_type('language', 'showcase');
	register_taxonomy_for_object_type('designer', 'showcase');
	register_taxonomy_for_object_type('cms', 'showcase');
	register_taxonomy_for_object_type('twitter', 'showcase');
}

add_action('init', 'comic_list_init');

add_action('easel-post-info', 'showcase_display_post_text');

function showcase_display_post_text() {
	global $post;
	if ($post->post_type == 'showcase') {
		echo showcase_display_authors();
		echo showcase_display_showcase_link();
	}
}

add_action('easel-post-extras', 'showcase_display_post_extras');

function showcase_display_post_extras() {
	global $post;
	if ($post->post_type == 'showcase' && !is_archive() && !is_search()) {
		echo showcase_display_styles();
		echo showcase_display_genres();
		echo showcase_display_language();
		echo showcase_display_designer();
		echo showcase_display_cms();
		echo showcase_display_twitter();
	}
}

add_action('easel-post-foot', 'showcase_display_edit_link');

function showcase_display_edit_link() {
	global $post;
	if ($post->post_type == 'showcase') {
		edit_post_link(__('<br />Edit this showcase.','easel'), '', ''); 
	}
}

function showcase_display_authors() {
	global $post;
	$before = '<div class="authors">By ';
	$sep = ', '; 
	$after = '</div>';
	$output = get_the_term_list( $post->ID, 'authors', $before, $sep, $after );
	return $output;
}

function showcase_display_styles() {
	global $post;
	$before = '<div class="styles">Style: ';
	$sep = ', '; 
	$after = '</div>';
	$output = get_the_term_list( $post->ID, 'style', $before, $sep, $after );
	return $output;
}

function showcase_display_genres() {
	global $post;
	$before = '<div class="genre">Genre: ';
	$sep = ', '; 
	$after = '</div>';
	$output = get_the_term_list( $post->ID, 'genre', $before, $sep, $after );
	return $output;
}

function showcase_display_designer() {
	global $post;
	$before = '<div class="designer">Site Designed By: ';
	$sep = ', '; 
	$after = '</div>';
	$output = get_the_term_list( $post->ID, 'designer', $before, $sep, $after );
	return $output;
}

function showcase_display_cms() {
	global $post;
	$before = '<div class="cms">Site Powered By: ';
	$sep = ', '; 
	$after = '</div>';
	$output = get_the_term_list( $post->ID, 'cms', $before, $sep, $after );
	return $output;
}

function showcase_display_twitter() {
	global $post;
	$before = '<div class="twitter">Twitter: ';
	$sep = ', '; 
	$after = '</div>';
	$output = get_the_twitter_list( $post->ID, 'twitter', $before, $sep, $after );
	return $output;
}

function get_the_twitter_list( $id = 0, $taxonomy, $before = '', $sep = '', $after = '' ) {
	$terms = get_the_terms( $id, $taxonomy );

	if ( is_wp_error( $terms ) )
		return $terms;

	if ( empty( $terms ) )
		return false;

	foreach ( $terms as $term ) {
		$term_links[] = '<a href="http://www.twitter.com/'.$term->name.'">' . $term->name . '</a>';
	}

	return $before . join( $sep, $term_links ) . $after;
}

function showcase_display_language() {
	global $post;
	$before = '<div class="language">Language: ';
	$sep = ', '; 
	$after = '</div>';
	$output = get_the_term_list( $post->ID, 'language', $before, $sep, $after );
	return $output;
}

function showcase_display_showcase_link() {
	global $post;
	$showcase_link = get_post_meta( $post->ID, 'link', true );
	if (!empty($showcase_link)) {
		$output = '<div class="url">';
		$output .= 'URL: <a href="'.$showcase_link.'" target="_blank">'.$showcase_link.'</a>';
		$output .= '</div>';
		return $output;
	}
	return '';
}

function showcase_display_showcase_rsslink() {
	global $post;
	$showcase_rsslink = get_post_meta( $post->ID, 'rsslink', true );
	if (!empty($showcase_rsslink)) { ?>
	<div class="rsslink">
		<h4>Latest RSS Feed</h4>
		<?php wp_widget_rss_output($showcase_rsslink, array('items' => 1, 'show_summary' => true)); ?>
	</div>
	<?php
	}
}

function showcase_lastpostmodified()
{
    $lastpostmodified = wp_cache_get( "lastpostmodified:custom:server", 'timeinfo' );
    if ( $lastpostmodified ) return $lastpostmodified;
    global $wpdb;
    $add_seconds_server = date('Z');
    $lastpostmodified = $wpdb->get_var("SELECT  DATE_ADD(post_modified_gmt, INTERVAL '$add_seconds_server' SECOND) FROM $wpdb->posts WHERE post_status = 'publish' ORDER  BY post_modified_gmt DESC LIMIT 1");
    wp_cache_set( "lastpostmodified:custom:server", $lastpostmodified, 'timeinfo', 3600 );
    return $lastpostmodified;
}

add_filter('get_lastpostmodified', 'showcase_lastpostmodified');


/*
Widget Name: Latest Showcase Widget
Description: Display a list of links of the latest comics.
Author: Philip M. Hofer (Frumph)
Version: 1.03
*/
class showcase_latest_showcase_widget extends WP_Widget {
	
	function showcase_latest_showcase_widget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Display a list of the latest showcase comics','easel') );
			$this->WP_Widget(__CLASS__, __('Latest Showcase','easel'), $widget_ops);
		}
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		Protect();
		echo $before_widget;
		$title = empty($instance['title']) ? __('Latest Showcase','easel') : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 
		$latestcomics = get_posts('numberposts=5&post_type=showcase'); ?>
		<ul>
		<?php foreach($latestcomics as $post) : ?>
			<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
			<?php endforeach; ?>
		</ul>
		<?php
		UnProtect();
		echo $after_widget;
	}
	
	function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		return $instance;
	}
	
	function form($instance) {
		$instance = wp_parse_args( (array) $instance, array( 'title' => '' ) );
		$title = strip_tags($instance['title']);
		?>
		<p><label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:','easel'); ?> <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></label></p>
		<?php
	}
}
register_widget('showcase_latest_showcase_widget');

add_filter('easel_display_post_calendar', 'showcase_filter_display_post_calendar');

function showcase_filter_display_post_calendar($post_calendar) {
	global $post;
	if ($post->post_type == 'showcase') $post_calendar = '';
	return $post_calendar;
}

add_filter('easel_display_post_category', 'showcase_filter_display_post_category');


function showcase_filter_display_post_category($post_category) {
	global $post;
	if ($post->post_type == 'showcase') $post_category = '';
	return $post_category;
}

?>