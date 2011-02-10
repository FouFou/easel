<?php
/**
 * ComicPress Light - addon for Easel
 * by Philip M. Hofer (Frumph)
 * http://frumph.net/
 * 
 * Displays a basic comic with Easel with minor navigation, simple to use.
 *
 * 
 */

add_action('init', 'easel_comics_init');

function easel_comics_init() {
	wp_enqueue_style('comics-default-style', easel_themeinfo('themeurl').'/addons/comics.css');
	
	$labels = array(
			'name' => __('Comics', 'easel'),
			'singular_name' => __('Comic', 'easel'),
			'add_new' => __('Add Comic', 'easel'),
			'add_new_item' => __('Add Comic'),
			'edit_item' => _x('Edit Comic','comic'),
			'edit' => _x('Edit', 'comic'),
			'new_item' => __('New Comic'),
			'view_item' => __('View Comic'),
			'search_items' => __('Search Comics'),
			'not_found' =>  __('No comics found'),
			'not_found_in_trash' => __('No comics found in Trash'), 
			'view' =>  __('View Comic'),
			'parent_item_colon' => ''
			);
	
	register_post_type(
			'comic', 
			array(
				'labels' => $labels,
				'public' => true,
				'public_queryable' => true,
				'show_ui' => true,
				'query_var' => true,
				'capability_type' => 'post',
				'taxonomies' => array( 'post_tag' ),
				'rewrite' => true,
				'hierarchical' => false,
				'menu_position' => 5,
				'supports' => array( 'title', 'editor', 'excerpt', 'author', 'comments', 'thumbnail', 'custom-fields' ),
				'description' => 'Post type for Comics'
				));	
				
		$labels = array(
			'name' => _x( 'Chapters', 'taxonomy general name' ),
			'singular_name' => _x( 'Chapter', 'taxonomy singular name' ),
			'search_items' =>  __( 'Search Chapters' ),
			'popular_items' => __( 'Popular Chapters' ),
			'all_items' => __( 'All Chapters' ),
			'parent_item' => __( 'Parent Chapter' ),
			'parent_item_colon' => __( 'Parent Chapter:' ),
			'edit_item' => __( 'Edit Chapters' ), 
			'update_item' => __( 'Update Chapters' ),
			'add_new_item' => __( 'Add New Chapter' ),
			'new_item_name' => __( 'New Chapter Name' ),
			); 	

	register_taxonomy('chapters', 'comic', array(
				'hierarchical' => true,
				'public' => true,
				'labels' => $labels,
				'show_ui' => true,
				'query_var' => true,
				'show_tagcloud' => false,
				'rewrite' => array( 'slug' => 'chapter' ),
				));
				
	register_taxonomy_for_object_type('chapters', 'comic');
}

// Navigation

function easel_comics_get_first_comic() {
	global $post;
	$current_chapter = reset(get_the_terms( $post->ID, 'chapters'));
	if (empty($current_chapter) || is_null($current_chapter)) { 
		$current_chapter_id = 0;
	} else {
		$current_chapter_id = $current_chapter->term_id;
	}
	return easel_comics_get_terminal_post_of_chapter($current_chapter_id, true);
}

function easel_comics_get_first_comic_permalink() {
	$terminal = easel_comics_get_first_comic();
	return !empty($terminal) ? get_permalink($terminal->ID) : false;
}

function easel_comics_get_last_comic() {
	global $post;
	$current_chapter = reset(get_the_terms( $post->ID, 'chapters'));
	if (empty($current_chapter) || is_null($current_chapter)) { 
		$current_chapter_id = 0;
	} else {
		$current_chapter_id = $current_chapter->term_id;
	}	
	return easel_comics_get_terminal_post_of_chapter($current_chapter_id, false);
}

function easel_comics_get_last_comic_permalink() {
	$terminal = easel_comics_get_last_comic();
	return !empty($terminal) ? get_permalink($terminal->ID) : false;
}

function easel_comics_get_previous_comic() {
	return easel_get_adjacent_post_type(true, 'comic', true);
}

function easel_comics_get_previous_comic_permalink() {
	$prev_comic = easel_comics_get_previous_comic();
	if (is_object($prev_comic)) {
		if (isset($prev_comic->ID)) {
			return get_permalink($prev_comic->ID);
		}
	}
	return false;
}

function easel_comics_get_next_comic() {
	return easel_get_adjacent_post_type(false, 'comic', true);
}

function easel_comics_get_next_comic_permalink() {
	$next_comic = easel_comics_get_next_comic();
	if (is_object($next_comic)) {
		if (isset($next_comic->ID)) {
			return get_permalink($next_comic->ID);
		}
	}
	return false;
}

// 0 means get the first of them all, no matter chapter, otherwise 0 = this chapter.
function easel_comics_get_terminal_post_of_chapter($chapterID = 0, $first = true) {
	
	$sortOrder = $first ? "asc" : "desc";	
	
	if (!empty($chapterID)) {
		$chapter = &get_term_by('id', $chapterID, 'chapters');
		$chapter_slug = $chapter->slug;
		$args = array(
				'chapters' => $chapter_slug,
				'order' => $sortOrder,
				'posts_per_page' => 1,
				'post_type' => 'comic'
				);
	} else {
		$args = array(
				'order' => $sortOrder,
				'posts_per_page' => 1,
				'post_type' => 'comic'
				);
	}
	
	$terminalComicQuery = new WP_Query($args);
	
	$terminalPost = false;
	if ($terminalComicQuery->have_posts()) {
		$terminalPost = reset($terminalComicQuery->posts);
	}
	return $terminalPost;
}


if (!function_exists('easel_comics_display_comic_navigation')) {
	function easel_comics_display_comic_navigation() {
		global $post, $wp_query;
		$first_comic = easel_comics_get_first_comic_permalink();
		$first_text = __('&lsaquo;&lsaquo; First','easel');
		$last_comic = easel_comics_get_last_comic_permalink();
		$last_text = __('Last &rsaquo;&rsaquo;','easel'); 
		$next_comic = easel_comics_get_next_comic_permalink();
		$next_text = __('Next &rsaquo;','easel');
		$prev_comic = easel_comics_get_previous_comic_permalink();
		$prev_text = __('&lsaquo; Prev','easel');
		?>
		<div id="default-nav-wrapper">
			<div class="default-nav">
				<div class="default-nav-base default-nav-first"><?php if ( get_permalink() != $first_comic ) { ?><a href="<?php echo $first_comic ?>"><?php echo $first_text; ?></a><?php } else { echo $first_text; } ?></div>
				<div class="default-nav-base default-nav-previous"><?php if ($prev_comic) { ?><a href="<?php echo $prev_comic ?>"><?php echo $prev_text; ?></a><?php } else { echo $prev_text; } ?></div>
				<div class="default-nav-base default-nav-last"><?php if ( get_permalink() != $last_comic ) { ?><a href="<?php echo $last_comic ?>"><?php echo $last_text; ?></a><?php } else { echo $last_text; } ?></div>
				<div class="default-nav-base default-nav-next"><?php if ($next_comic) { ?><a href="<?php echo $next_comic ?>"><?php echo $next_text; ?></a><?php } else { echo $next_text; } ?></div>
				<div class="clear"></div>
			</div>
		</div>
		<?php
	}
}

// Injections

add_filter('easel_display_post_category', 'easel_comics_display_comic_chapters');

// TODO: Make this actually output a chapter set that the comic is in, instead of the post-type
function easel_comics_display_comic_chapters($post_category) {
	global $post;
	if ($post->post_type == 'comic') {
		$before = '<div class="comic-chapter">Chapter: ';
		$sep = ', '; 
		$after = '</div>';
		$post_category = get_the_term_list( $post->ID, 'chapters', $before, $sep, $after );
	}
	return apply_filters('easel_comics_display_comic_chapters', $post_category);
}

// Injected with a poison.
add_action('easel-post-foot', 'easel_comics_display_edit_link');
	
function easel_comics_display_edit_link() {
	global $post;
	if ($post->post_type == 'comic') {
		edit_post_link(__('<br />Edit Comic.','comiceasel'), '', ''); 
	}
}

add_action('easel-content-area', 'easel_comics_display_comic_area');

function easel_comics_display_comic_area() {
	global $wp_query, $post;
	if (is_single()) {
		easel_comics_display_comic_wrapper();
	} else {
		if (is_home() && !is_paged() && easel_themeinfo('display_comic_on_home'))  {
			Protect();
			$comic_args = array(
				'posts_per_page' => 1,
				'post_type' => 'comic'
			);
			$wp_query->in_the_loop = true; $comicFrontpage = new WP_Query(); $comicFrontpage->query($comic_args);
			while ($comicFrontpage->have_posts()) : $comicFrontpage->the_post();
				easel_comics_display_comic_wrapper();
			endwhile;
			UnProtect();
		}
	}
}

// This is used inside easel_comics_display_comic_area()
function easel_comics_display_comic_wrapper() {
	global $post, $wp_query; 
	if ($post->post_type == 'comic') {
		?>
		<div id="comic-wrap" class="comic-id-<?php echo $post->ID; ?>">
			<div id="comic-head"></div>
			<div id="comic">
				<?php echo easel_comics_display_comic(); ?>
			</div>
			<div id="comic-foot">
				<?php if (!is_search() && !is_archive()) easel_comics_display_comic_navigation(); ?>
			</div>
			<div class="clear"></div>
		</div>
	<?php }
}

add_action('easel-narrowcolumn-area', 'easel_comics_display_comic_post_home');

function easel_comics_display_comic_post_home() { 
	global $wp_query;
	if (is_home() && easel_themeinfo('display_comic_post_on_home')) { 
		if (!is_paged())  { 
			Protect();
			$posts = &query_posts('post_type=comic&showposts=1');
			while (have_posts()) : the_post();
				easel_display_post();
			endwhile;
			if (easel_themeinfo('enable_comments_on_homepage')) {
				$withcomments = 1;
				comments_template('', true);
			}
			UnProtect();
		?>
		<div id="blogheader"></div>	
	<?php }
	}
}

// Display Comic (featured image)

// make sure the comic post type does *not* display in the featured image area, this overwrites the regular easel function
function easel_display_post_thumbnail() {
global $post;
	if ($post->post_type !== 'comic') {
		if ( has_post_thumbnail() ) {
			$link = get_post_meta( $post->ID, 'link', true );
			if (empty($link)) $link = get_permalink();
			$post_thumbnail = "<div class=\"post-image\"><center><a href=\"".$link."\" rel=\"bookmark\" title=\"Link to ".get_the_title()."\">".get_the_post_thumbnail($post->ID,'full')."</a></center></div>\r\n";
			echo apply_filters('easel_display_post_thumbnail', $post_thumbnail);
		}
	}
}

function easel_comics_display_comic($size = 'full') {
global $post;
	$post_image_id = get_post_thumbnail_id($post->ID);
	if ($post_image_id) {
		$thumbnail = wp_get_attachment_image_src( $post_image_id, $size, false);
		$thumbnail = reset($thumbnail);
		$hovertext = easel_comics_the_hovertext();
		$output = '<img src="'.$thumbnail.'" alt="'.$hovertext.'" title="'.$hovertext.'" />';
		return apply_filters('easel_comics_display_comic', $output);
	} else
		return "No Comic (featured image) Found.  Set One.";
}

function easel_comics_the_hovertext($override_post = null) {
	global $post;
	$post_to_use = !is_null($override_post) ? $override_post : $post;
	$hovertext = get_post_meta( $post_to_use->ID, "hovertext", true );
	return (empty($hovertext)) ? get_the_title($post_to_use->ID) : $hovertext;
}

// Injections into syndication

// Syndication Injection

add_filter('easel_thumbnail_feed', 'easel_comics_inject_comic_into_feed');

function easel_comics_inject_comic_into_feed($post_thumbnail) {
	global $post;
	if (empty($post_thumbnail) && ($post->post_type == 'comic'))
		$post_thumbnail = '<p>'.easel_comics_display_comic('medium'). '</p>';
	return $post_thumbnail;
}

add_action('easel-display-the-content-archive-before', 'easel_comics_inject_thumbnail_into_archive_posts');

function easel_comics_inject_thumbnail_into_archive_posts() {
	global $post;
	if ($post->post_type == 'comic') {
		echo '<p>'.str_replace('alt=', 'class="aligncenter" alt=', easel_comics_display_comic('thumbnail')).'</p>';
	}
}

// Widgets

class easel_latest_comics_widget extends WP_Widget {
	
	function easel_latest_comics_widget($skip_widget_init = false) {
		if (!$skip_widget_init) {
			$widget_ops = array('classname' => __CLASS__, 'description' => __('Display a list of the latest comics','easel') );
			$this->WP_Widget(__CLASS__, __('Latest Comics','easel'), $widget_ops);
		}
	}
	
	function widget($args, $instance) {
		global $post;
		extract($args, EXTR_SKIP); 
		Protect();
		echo $before_widget;
		$title = empty($instance['title']) ? __('Latest Comics','easel') : apply_filters('widget_title', $instance['title']); 
		if ( !empty( $title ) ) { echo $before_title . $title . $after_title; }; 
		$latestmusic = get_posts('numberposts=5&post_type=comic'); ?>
		<ul>
		<?php foreach($latestmusic as $post) : ?>
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
register_widget('easel_latest_comics_widget');

?>