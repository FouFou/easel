<?php

// the_post_thumbnail('thumbnail/medium/full');
add_theme_support( 'post-thumbnails' );

// Required by the wordpress review theme, it sucks donkey balls but is required.
add_theme_support( 'automatic-feed-links' );

add_theme_support( 'custom-header' );

// This theme allows users to set a custom background
add_custom_background();
add_theme_support( 'custom-background' );

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
	foreach (glob(easel_themeinfo('themepath') . "/addons/*.php") as $addonfile) {
		@require_once($addonfile);
	}
}

// These autoload
foreach (glob(easel_themeinfo('themepath') . "/functions/*.php") as $funcfile) {
	@require_once($funcfile);
}


// Load all the widgets.
foreach (glob(easel_themeinfo('themepath')  . '/widgets/*.php') as $widgefile) {
	@require_once($widgefile);
}

// Load all the widgets from the child theme *if* a child theme exists
if (is_child_theme()) {
	if (is_dir(easel_themeinfo('stylepath') . '/widgets')) {
		$results = glob(easel_themeinfo('stylepath') . '/widgets/*.php');
		if (!empty($results)) {
			foreach ($results as $widgefile) {
				@require_once($widgefile);
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
			'enable_addon_playingnow' => false
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
			'version' => '1.1.3',
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

// Credit: http://bajada.net/2010/06/08/custom-post-types-in-the-loop-adding-a-filter-on-pre_get_posts
// This filter adds all of the custom post types except comic to the blog loop.
add_filter( 'pre_get_posts' , 'easel_include_custom_post_types' );

function easel_include_custom_post_types( $query ) {
	global $wp_query;
	
	/* Don't break admin or preview pages. This is also a good place to exclude feed with !is_feed() if desired. */
	if ( !is_preview() && !is_admin() && !is_singular() ) {
		$args = array(
				'public' => true,
				'_builtin' => false
				);
		$output = 'names';
		$operator = 'and';
		
		$post_types = get_post_types( $args , $output , $operator );
		$post_types = array_merge( $post_types , array( 'post') );
		if (is_search() || is_archive()) $post_types = array_merge( $post_types, array( 'page' ) );
		
		// Set all the custom post types to be able to be seen by the feed.
		
		if ($query->is_feed) {
			$query->set( 'post_type' , $post_types );
		} else {
			$my_post_type = get_query_var( 'post_type' );
			if (is_home()) $post_types = array_diff( $post_types, array ( 'comic' ) );
			if ( empty( $my_post_type ) )
				$query->set( 'post_type' , $post_types );
		}
	}
	return $query;
}

?>