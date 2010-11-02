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
}

// Navigation

function easel_comics_get_first_comic() {
	return easel_comics_get_terminal_post_of_chapter(0, true);
}

function easel_comics_get_first_comic_permalink() {
	$terminal = easel_comics_get_first_comic();
	return !empty($terminal) ? get_permalink($terminal->ID) : false;
}

function easel_comics_get_last_comic() {
	return easel_comics_get_terminal_post_of_chapter(0, false);
}

function easel_comics_get_last_comic_permalink() {
	$terminal = easel_comics_get_last_comic();
	return !empty($terminal) ? get_permalink($terminal->ID) : false;
}

function easel_comics_get_previous_comic() {
	return easel_comics_get_adjacent_comic(false, true);
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
	return easel_comics_get_adjacent_comic(false, false);
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

/**
 * Retrieve adjacent post link.
 *
 * Can either be next or previous post link.
 */
function easel_comics_get_adjacent_comic($in_same_chapter = false, $previous = true, $excluded_chapters = '', $taxonomy = 'comic') {
	global $post, $wpdb;

	if ( empty( $post ) )
		return null;

	$current_post_date = $post->post_date;

	$join = '';
	$posts_in_ex_cats_sql = '';
	if ( $in_same_chapter || !empty($excluded_chapters) ) {
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id";

		if ( $in_same_chapter ) {
			$cat_array = wp_get_object_terms($post->ID, $taxonomy, array('fields' => 'ids'));
			$join .= " AND tt.taxonomy = '".$taxonomy."' AND tt.term_id IN (" . implode(',', $cat_array) . ")";
		}

		$posts_in_ex_cats_sql = "AND tt.taxonomy = '".$taxonomy."'";
		if ( !empty($excluded_chapters) ) {
			$excluded_chapters = array_map('intval', explode(' and ', $excluded_chapters));
			if ( !empty($cat_array) ) {
				$excluded_chapters = array_diff($excluded_chapters, $cat_array);
				$posts_in_ex_cats_sql = '';
			}

			if ( !empty($excluded_chapters) ) {
				$posts_in_ex_cats_sql = " AND tt.taxonomy = '".$taxonomy."' AND tt.term_id NOT IN (" . implode($excluded_chapters, ',') . ')';
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join  = apply_filters( "get_{$adjacent}_comic_join", $join, $in_same_chapter, $excluded_chapters );
	$where = apply_filters( "get_{$adjacent}_comic_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_chapter, $excluded_chapters );
	$sort  = apply_filters( "get_{$adjacent}_comic_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
	$query_key = 'adjacent_comic_' . md5($query);
	$result = wp_cache_get($query_key, 'counts');
	if ( false !== $result )
		return $result;

	$result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");
	if ( null === $result )
		$result = '';

	wp_cache_set($query_key, $result, 'counts');
	return $result;
}

if (!function_exists('easel_comics_display_comic_navigation')) {
	function easel_comics_display_comic_navigation() {
		global $post, $wp_query;
		$first_comic = easel_comics_get_first_comic_permalink();
		$first_text = __('&lsaquo;&lsaquo; First','comicpress');
		$last_comic = easel_comics_get_last_comic_permalink();
		$last_text = __('Last &rsaquo;&rsaquo;','comicpress'); 
		$next_comic = easel_comics_get_next_comic_permalink();
		$next_text = __('Next &rsaquo;','comicpress');
		$prev_comic = easel_comics_get_previous_comic_permalink();
		$prev_text = __('&lsaquo; Prev','comicpress');
		?>
		<div id="default-nav-wrapper">
			<div class="default-nav">
				<div class="default-nav-base default-nav-first"><?php if ( get_permalink() != $first_comic ) { ?><a href="<?php echo $first_comic ?>"><?php echo $first_text; ?></a><?php } else { echo $first_text; } ?></div>
				<div class="default-nav-base default-nav-previous"><?php if ($prev_comic) { ?><a href="<?php echo $prev_comic ?>"><?php echo $prev_text; ?></a><?php } else { echo $prev_text; } ?></div>
				<div class="default-nav-base default-nav-next"><?php if ($next_comic) { ?><a href="<?php echo $next_comic ?>"><?php echo $next_text; ?></a><?php } else { echo $next_text; } ?></div>
				<div class="default-nav-base default-nav-last"><?php if ( get_permalink() != $last_comic ) { ?><a href="<?php echo $last_comic ?>"><?php echo $last_text; ?></a><?php } else { echo $last_text; } ?></div>
				<div class="clear"></div>
			</div>
		</div>
		<?php
	}
}

// Injections

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
		if (is_home() && !is_paged())  {
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
	global $post; 
	if ($post->post_type == 'comic') {
		?>
		<div id="comic-wrap">
			<div id="comic-head"></div>
			<div id="comic">
				<?php echo easel_comics_display_comic(); ?>
			</div>
			<div id="comic-foot">
				<?php easel_comics_display_comic_navigation(); ?>
			</div>
			<div class="clear"></div>
		</div>
	<?php }
}

add_action('easel-narrowcolumn-area', 'easel_comics_display_comic_post_home');

function easel_comics_display_comic_post_home() { 
	global $wp_query;
	if (is_home()) { 
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

?>