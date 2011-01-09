<?php

// the_post_thumbnail('thumbnail/medium/full');
add_theme_support( 'post-thumbnails' );

// Required by the wordpress review theme, it sucks donkey balls but is required.
add_theme_support( 'automatic-feed-links' );

add_theme_support( 'custom-header' );

// This theme allows users to set a custom background
add_custom_background();

/* this sets default video width */
if (!isset($content_width)) $content_width = 538;

register_nav_menus(array(
	'Primary' => __( 'Primary', 'easel' )
));

/* child-functions.php / child-widgets.php - in the child theme */
if (is_child_theme()) {
	get_template_part('child', 'functions');
	get_template_part('child', 'widgets');
}

// load up the addons that it finds, loads before functions just in case we want to rewrite a function
if (is_dir(easel_themeinfo('themepath') . '/addons')) {
	if (easel_themeinfo('enable_addon_comics')) 
		@require_once(easel_themeinfo('themepath') . '/addons/comics.php');
	if (easel_themeinfo('enable_addon_membersonly'))
		@require_once(easel_themeinfo('themepath') . '/addons/membersonly.php');
	if (easel_themeinfo('enable_addon_playingnow'))
		@require_once(easel_themeinfo('themepath') . '/addons/playingnow.php');
	if (easel_themeinfo('enable_addon_showcase'))
		@require_once(easel_themeinfo('themepath') . '/addons/showcase.php');
	if (easel_themeinfo('enable_addon_commpress'))
		@require_once(easel_themeinfo('themepath') . '/addons/commpress.php');
}

// These autoload
foreach (glob(easel_themeinfo('themepath') . "/functions/*.php") as $funcfile) {
	@require($funcfile);
}

// Load all the widgets.
foreach (glob(easel_themeinfo('themepath')  . '/widgets/*.php') as $widgefile) {
	@require($widgefile);
}

// Load all the widgets from the child theme *if* a child theme exists
if (is_child_theme()) {
	if (is_dir(easel_themeinfo('stylepath') . '/widgets')) {
		$results = glob(easel_themeinfo('stylepath') . '/widgets/*.php');
		if (!empty($results)) {
			foreach ($results as $widgefile) {
				@require($widgefile);
			}
		}
	}
}

// Dashboard Menu Easel Options
if (is_admin()) {
	@require_once(easel_themeinfo('themepath') . '/options.php');
}

function __easel_init() {
	global $is_IE;
	
	easel_register_sidebars();
	
	if (!is_admin()) {
		wp_enqueue_script('jquery');
		if (!easel_themeinfo('disable_jquery_menu_code')) {
			wp_enqueue_script('ddsmoothmenu_js', easel_themeinfo('themeurl') . '/js/ddsmoothmenu.js'); 
			wp_enqueue_script('menubar_js', easel_themeinfo('themeurl') . '/js/menubar.js');
		}
		if (!easel_themeinfo('disable_scroll_to_top')) {
			wp_enqueue_script('easel_scroll', easel_themeinfo('themeurl') . '/js/scroll.js', array(), false, true);
		}
		if (easel_themeinfo('enable_avatar_trick') && !$is_IE) {
			wp_enqueue_script('themetricks_historic1', easel_themeinfo('themeurl') . '/js/cvi_text_lib.js', array(), false, true);
			wp_enqueue_script('themetricks_historic2', easel_themeinfo('themeurl') . '/js/instant.js', array(), false, true);
		}
		if (easel_themeinfo('facebook_like_blog_post'))
			wp_enqueue_script('facebook', 'http://connect.facebook.net/en_US/all.js#xfbml=1', array(), false, true);
	}
}

add_action('init', '__easel_init');

if (!function_exists('easel_register_sidebars')) {
	function easel_register_sidebars() {
		foreach (array(
					__('Left Sidebar', 'easel'),
					__('Right Sidebar', 'easel'),
					__('Above Header', 'easel'),
					__('Header', 'easel'),
					__('Menubar', 'easel'),
					__('Over Blog', 'easel'),
					__('Under Blog', 'easel'),
					__('Footer', 'easel')
					) as $sidebartitle) {
			register_sidebar(array(
						'name'=> $sidebartitle,
						'id' => 'sidebar-'.sanitize_title($sidebartitle),
						'before_widget' => "<div id=\"".'%1$s'."\" class=\"widget ".'%2$s'."\">\r\n<div class=\"widget-head\"></div>\r\n<div class=\"widget-content\">\r\n",
						'after_widget'  => "</div>\r\n<div class=\"widget-foot\"></div>\r\n</div>\r\n",
						'before_title'  => "<h2 class=\"widgettitle\">",
						'after_title'   => "</h2>\r\n"
						));
		}
	}
}

function easel_get_sidebar($location = '') {
	if (empty($location)) { get_sidebar(); return; }
	if (is_active_sidebar('sidebar-'.$location)) { ?>
		<div id="sidebar-<?php echo $location; ?>" class="sidebar">
			<?php dynamic_sidebar('sidebar-'.$location); ?>
		</div>
	<?php }
}

function easel_is_signup() {
	global $wp_query;
	if (strpos( $_SERVER['SCRIPT_NAME'], 'wp-signup.php' ) || strpos( $_SERVER['SCRIPT_NAME'], 'wp-activate.php' )) return true;
	return false;
}

function easel_load_options() {

	$easel_options = get_option('easel-options');
	if (empty($easel_options)) {
		
		foreach (array(
			// This section is added
			'disable_jquery_menu_code' => false,
			'disable_scroll_to_top' => false,
			'enable_avatar_trick' => true,
			'disable_default_design' => false,
			'disable_comment_note' => false,
			'enable_numbered_pagination' => true,
			'disable_comment_javascript' => false,
			'enable_post_thumbnail_rss' => true,
			'disable_page_titles' => false,
			'disable_post_titles' => false,			
			'enable_post_calendar' => true,
			'enable_post_author_gravatar' => false,
			'disable_categories_in_posts' => false,
			'disable_tags_in_posts' => false,
			'disable_author_info_in_posts' => false,
			'disable_date_info_in_posts' => false,
			'home_post_count' => '5',
			'disable_footer_text' => false,
			'disable_default_menubar' => false,
			'enable_search_in_menubar' => false,
			'enable_rss_in_menubar' => true,
			'avatar_directory' => 'none',
			'enable_debug_footer_code' => false,
			'disable_blog_on_homepage' => false,
			'enable_comments_on_homepage' => false,
			'enable_addon_comics' => false,
			'enable_addon_membersonly' => false,
			'enable_addon_showcase' => false,
			'enable_addon_playingnow' => false,
			'enable_addon_showcase_slider' => false,
			'enable_addon_commpress' => false,
			'custom_image_header_width' => '980',
			'custom_image_header_height' => '100',
			'copyright_name' => '',
			'copyright_url' => '',
			'facebook_like_blog_post' => false,
			'facebook_meta' => false,
			'display_archive_as_links' => false,
			'archive_display_order' => 'DESC'
		) as $field => $value) {
			$easel_options[$field] = $value;
		}
		add_option('easel-options', $easel_options, '', false);
	}
	return $easel_options;
}

function easel_themeinfo($whichinfo = null) {
	global $easel_themeinfo;
	if (empty($easel_themeinfo) || $whichinfo == 'reset') {	
		$easel_themeinfo = array();
		$easel_options = easel_load_options();
		$easel_coreinfo = wp_upload_dir();
		$easel_addinfo = array(
			'upload_path' => get_option('upload_path'),
			'version' => '1.1.7',
			'themepath' => get_template_directory(),
			'themeurl' => get_template_directory_uri(), 
			'stylepath' => get_stylesheet_directory(), 
			'styleurl' => get_stylesheet_directory_uri(),
			'uploadpath' => $easel_coreinfo['basedir'],
			'uploadurl' => $easel_coreinfo['baseurl'],
			'home' => untrailingslashit(home_url()),  
			'siteurl' => untrailingslashit(site_url()) 
		);
		$easel_themeinfo = array_merge($easel_coreinfo, $easel_addinfo);		
		$easel_themeinfo = array_merge($easel_themeinfo, $easel_options);
	}
	if ($whichinfo && $whichinfo !== 'reset')
		if (isset($easel_themeinfo[$whichinfo])) 
			return $easel_themeinfo[$whichinfo];
		else
			return false;
	return $easel_themeinfo;
}

// Examples of how to inject something into the post-info area of the theme.

add_action('easel-post-info','easel_add_post_ratings');

if (!function_exists('easel_add_post_ratings')) {
	function easel_add_post_ratings() {
		global $post;
		if (function_exists('the_ratings') && $post->post_type !== 'post') { the_ratings(); } 
	}
}

// Example of checking with option first.

if (easel_themeinfo('enable_debug_footer_code')) {
	add_action('easel-page-foot', 'easel_debug_page_foot_code');
}

function easel_debug_page_foot_code() { ?>
	<p><?php echo get_num_queries() ?> queries. <?php if (function_exists('memory_get_usage')) { $unit=array('b','kb','mb','gb','tb','pb'); echo @round(memory_get_usage(true)/pow(1024,($i=floor(log(memory_get_usage(true),1024)))),2).' '.$unit[$i]; ?> Memory usage. <?php } timer_stop(1) ?> seconds.</p>
<?php }


/**
 * Retrieve adjacent post link.
 *
 * Can either be next or previous post link.
 */
function easel_get_adjacent_post_type($in_same_chapter = false, $previous = true, $excluded_chapters = '', $taxonomy = 'post') {
	global $post, $wpdb;
	
	if ( empty( $post ) ) return null;

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

	$join  = apply_filters( "get_{$adjacent}_{$taxonomy}_join", $join, $in_same_chapter, $excluded_chapters );
	$where = apply_filters( "get_{$adjacent}_{$taxonomy}_where", $wpdb->prepare("WHERE p.post_date $op %s AND p.post_type = %s AND p.post_status = 'publish' $posts_in_ex_cats_sql", $current_post_date, $post->post_type), $in_same_chapter, $excluded_chapters );
	$sort  = apply_filters( "get_{$adjacent}_{$taxonomy}_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.* FROM $wpdb->posts AS p $join $where $sort";
	$query_key = "adjacent_{$taxonomy}_" . md5($query);
	$result = wp_cache_get($query_key, 'counts');
	if ( false !== $result )
		return $result;

	$result = $wpdb->get_row("SELECT p.* FROM $wpdb->posts AS p $join $where $sort");
	if ( null === $result )
		$result = '';

	wp_cache_set($query_key, $result, 'counts');
	return $result;
}

function easel_is_post_type($post_type) {
	if ( is_array($post_type) )	{	// multiple post types 
		if ( count($post_type) > 1 )	// not a custom post type archive
			return false;
		$post_type = $post_type[0];		
	}
	if ( !is_string($post_type) )
		return;
	if ($post_type == 'post') return;
	$post_type = get_post_type_object( $post_type );
	if ( !is_null( $post_type ) && ($post_type->public == true) ) 
		return $post_type;		
	return false;
}

function easel_is_custom_post_type_archive( $post_type = '' ) {
	global $wp_query;
	
	if ( !isset($wp_query->is_custom_post_type_archive) || !$wp_query->is_custom_post_type_archive ) 
		return false;
	
	if ( empty($post_type) || $post_type == get_query_var('post_type') )
		return true;
		
	return false;
}

/*  
// This is actually NO GOOD
add_action( 'template_redirect', 'easel_template_redirect' );

function easel_template_redirect() {	
	if ( easel_is_custom_post_type_archive() ) :
		$post_type = easel_is_post_type( get_query_var('post_type') );
	
		$template = array( "type-".$post_type->name.".php" );
		if ( isset( $post_type->rewrite['slug'] ) ) $template[] = "type-".$post_type->rewrite['slug'].".php";
		array_push( $template, 'type.php', 'index.php' );
	
		locate_template( $template, true );
		
		die();
		
	endif;
}
*/

add_action( 'generate_rewrite_rules', 'easel_rewrite_rules' );

function easel_rewrite_rules( $wp_rewrite ) {
	$args = array(
			'public' => true,
			'_builtin' => false
			);
	$output = 'names';
	$operator = 'and';
	
	$post_types = get_post_types( $args , $output , $operator );
	$feed = get_default_feed();

	foreach ( $post_types as $ptype ) :
		$this_type = get_post_type_object( $ptype );
		$type_slug = $this_type->rewrite['slug'];
		if (!empty($type_slug)) {
			$new_rules = array( 
					$type_slug.'/([0-9]+)/([0-9]{1,2})/([0-9]{1,2})/?$' => 'index.php?post_type='.$ptype.'&year=' . $wp_rewrite->preg_index(1) . '&monthnum=' . $wp_rewrite->preg_index(2) . '&day=' . $wp_rewrite->preg_index(3),
					$type_slug.'/([0-9]+)/([0-9]{1,2})/?$' => 'index.php?post_type='.$ptype.'&year=' . $wp_rewrite->preg_index(1) . '&monthnum=' . $wp_rewrite->preg_index(2),
					$type_slug.'/([0-9]+/?$)' => 'index.php?post_type='.$ptype.'&year=' . $wp_rewrite->preg_index(1),
					$type_slug.'/page/?([0-9]{1,})/?$' => 'index.php?post_type='.$ptype.'&paged='.$wp_rewrite->preg_index(1),
					$type_slug.'/feed/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type='.$ptype.'&feed='.$wp_rewrite->preg_index(1),
					$type_slug.'/(feed|rdf|rss|rss2|atom)/?$' => 'index.php?post_type='.$ptype.'&feed='.$wp_rewrite->preg_index(1),
					$type_slug.'/?$' => 'index.php?post_type='.$ptype,
					);
			
			$wp_rewrite->rules = array_merge($new_rules, $wp_rewrite->rules);
		}
		endforeach;
}

add_action( 'parse_query', 'easel_parse_query', 100 );

function easel_parse_query( $wp_query ) {
	if ( !isset($wp_query->query_vars['post_type']) )
		return;
	
	$post_type = $wp_query->query_vars['post_type'];
	if (!empty($post_type)) {
		if ( get_query_var('name') || !easel_is_post_type($post_type) || is_robots() || is_feed() || is_trackback() )
			return;
		
		$wp_query->is_home = false;	// correct is_home variable
		$wp_query->is_archive = true;
		$wp_query->is_custom_post_type_archive = true; // define new query variable
	}
} 

function easel_continue_reading_link() {
	return ' <a class="more-link" href="'. get_permalink() . '">' . __('&darr; Read the rest of this entry...','comicpress') . '</a>';
}

function easel_auto_excerpt_more( $more ) {
	return __(' [&hellip;]','easel') . easel_continue_reading_link();
}

add_filter( 'excerpt_more', 'easel_auto_excerpt_more' );


?>