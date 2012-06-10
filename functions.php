<?php

function easel_themeinfo($whichinfo = null) {
	global $easel_themeinfo;
	if (empty($easel_themeinfo) || $whichinfo == 'reset') {	
		$easel_themeinfo = array();
		$easel_options = easel_load_options();
		$easel_coreinfo = wp_upload_dir();
		$easel_addinfo = array(
			'upload_path' => get_option('upload_path'),
			'version' => '3.0.3',
			'themepath' => get_template_directory(),
			'themeurl' => get_template_directory_uri(), 
			'stylepath' => get_stylesheet_directory(), 
			'styleurl' => get_stylesheet_directory_uri(),
			'uploadpath' => $easel_coreinfo['basedir'],
			'uploadurl' => $easel_coreinfo['baseurl'],
			'home' => untrailingslashit(home_url()),  
			'siteurl' => untrailingslashit(site_url()),
			'excerpt_length' => '40'
		);
		$easel_themeinfo = array_merge($easel_coreinfo, $easel_addinfo);
		$easel_themeinfo = array_merge($easel_themeinfo, $easel_options);
		if (!isset($easel_themeinfo['layout']) || empty($easel_themeinfo['layout']) || ($easel_themeinfo['layout'] == 'standard')) $easel_themeinfo['layout'] = '3c';
	}
	if ($whichinfo && $whichinfo !== 'reset')
		if (isset($easel_themeinfo[$whichinfo])) 
			return $easel_themeinfo[$whichinfo];
		else
			return false;
	return $easel_themeinfo;
}

// Load the text domain for translation
load_theme_textdomain( 'easel', get_template_directory() . '/lang' );

// the_post_thumbnail('thumbnail/medium/full');
add_theme_support( 'post-thumbnails' );

// Required by the wordpress review theme, it sucks donkey balls but is required.
add_theme_support( 'automatic-feed-links' );

register_nav_menus(array(
			'Primary' => __( 'Primary', 'easel' )
			));

/* child-functions.php / child-widgets.php - in the child theme */
if (is_child_theme()) {
	get_template_part('child', 'functions');
	get_template_part('child', 'widgets');
}

if ( version_compare( $wp_version, "3.3.999", ">" ) ) {
	// This theme allows users to set a custom background
	// the global if has anything in it from the child theme, use it.
	$easel_background_array = array();
	if (function_exists('easel_child_theme_background_array'))
		$easel_background_array = easel_child_theme_background_array();
	// Set defaults if it doesn't exit from the global #131315 url('images/background-tile-131315.jpg') repeat;
	if (!isset($easel_background_array) || empty($easel_background_array)) $easel_background_array = array('default-color' => '#131315', 'default-image' => easel_themeinfo('themeurl').'/images/background-tile.jpg');
	add_theme_support( 'custom-background', $easel_background_array );
} else {
	add_custom_background();
}

/* this sets default video width */
if (!isset($content_width)) {
	$content_width = 540;
}

// load up the addons that it finds, loads before functions just in case we want to rewrite a function
if (is_dir(easel_themeinfo('themepath') . '/addons')) {
	if (easel_themeinfo('enable_addon_page_options')) 
		@require_once(easel_themeinfo('themepath') . '/addons/page-options.php');
	if (easel_themeinfo('enable_addon_membersonly'))
		@require_once(easel_themeinfo('themepath') . '/addons/membersonly.php');
	if (easel_themeinfo('enable_addon_playingnow'))
		@require_once(easel_themeinfo('themepath') . '/addons/playingnow.php');
	if (easel_themeinfo('enable_addon_showcase'))
		@require_once(easel_themeinfo('themepath') . '/addons/showcase.php');
	if (easel_themeinfo('enable_addon_commpress'))
		@require_once(easel_themeinfo('themepath') . '/addons/commpress.php');
/*	if (easel_themeinfo('enable_wprewrite_posttype_control'))
		@require_once(easel_themeinfo('themepath') . '/addons/wp-rewrite.php'); */
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

add_action('init', 'easel_init');

function easel_init() {
	global $is_IE;
	if (!is_admin()) {
		wp_enqueue_script('jquery');
		if (!easel_themeinfo('disable_jquery_menu_code')) {
			wp_enqueue_script('ddsmoothmenu_js', easel_themeinfo('themeurl') . '/js/ddsmoothmenu.js'); 
			wp_enqueue_script('menubar_js', easel_themeinfo('themeurl') . '/js/menubar.js');
		}
		if (!easel_themeinfo('disable_scroll_to_top')) {
			wp_enqueue_script('easel_scroll', easel_themeinfo('themeurl') . '/js/scroll.js', null, null, true);
		}
		if (is_active_widget('easel_google_translate_widget', false, 'easel_google_translate_widget', true)) {
			wp_enqueue_script('google-translate', 'http://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit', null, null, true);
			wp_enqueue_script('google-translate-settings', get_template_directory_uri() . '/js/googletranslate.js');
		}
		if (easel_themeinfo('enable_avatar_trick') && !$is_IE) {
			wp_enqueue_script('themetricks_historic1', easel_themeinfo('themeurl') . '/js/cvi_text_lib.js', null, null, true);
			wp_enqueue_script('themetricks_historic2', easel_themeinfo('themeurl') . '/js/instant.js', null, null, true);
		}
		if (easel_themeinfo('facebook_like_blog_post'))
			wp_enqueue_script('easel-facebook', 'http://connect.facebook.net/en_US/all.js#xfbml=1'); // force to the header instead of footer
			
		add_filter('pre_get_posts', 'easel_archive_query');

	// Set the 'order' of the archive and search
		function easel_archive_query($query) {
			if ((is_archive() || is_search()) && !isset($query->query_vars['feed'])) {
				$archive_display_order = easel_themeinfo('archive_display_order');
				if (empty($archive_display_order)) $archive_display_order = 'DESC';
				$order = '&order='.$archive_display_order;
				$query->set('order', $archive_display_order);
				return $query;
			}
		}
		
		function easel_excerpt_length($length) {
			return easel_themeinfo('excerpt_length');
		}
		add_filter('excerpt_length', 'easel_excerpt_length');
		
		function easel_enqueue_comment_reply() {
			if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
		}
		add_action( 'wp_enqueue_scripts', 'easel_enqueue_comment_reply' );
	}
}

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
						'after_widget'  => "</div>\r\n<div class=\"clear\"></div>\r\n<div class=\"widget-foot\"></div>\r\n</div>\r\n",
						'before_title'  => "<h2 class=\"widgettitle\">",
						'after_title'   => "</h2>\r\n"
						));
		}
	}
}
add_action('widgets_init', 'easel_register_sidebars');

function easel_get_sidebar($location = '') {
	if (empty($location)) { get_sidebar(); return; }
	if (file_exists(get_stylesheet_directory().'/sidebar-'.$location.'.php')) {
		get_sidebar($location);
	} elseif (is_active_sidebar('sidebar-'.$location)) { ?>
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
			'enable_addon_membersonly' => false,
			'non_members_message' => __('There is members only content here.','easel'),
			'enable_addon_showcase' => false,
			'enable_addon_playingnow' => false,
			'enable_addon_showcase_slider' => false,
			'enable_addon_commpress' => false,
			'enable_addon_page_options' => false,
			'custom_image_header_width' => '980',
			'custom_image_header_height' => '100',
			'copyright_name' => '',
			'copyright_url' => '',
			'facebook_like_blog_post' => false,
			'facebook_meta' => false,
			'display_archive_as_links' => false,
			'archive_display_order' => 'DESC',
			'layout' => '3c',
			'enable_wprewrite_posttype_control' => false,
			'force_active_connection_close' => false,
			'enable_addon_easel_slider' => true,
			'menubar_social_icons' => false,
			'menubar_social_twitter' => '',
			'menubar_social_facebook' => '',
			'enable_breadcrumbs' => false
		) as $field => $value) {
			$easel_options[$field] = $value;
		}
		update_option('easel-options', $easel_options);
	}
	return $easel_options;
}

if (!function_exists('easel_add_post_ratings')) {
	function easel_add_post_ratings() {
		global $post;
		if (function_exists('the_ratings') && $post->post_type == 'post') { the_ratings(); } 
	}
}
add_action('easel-post-info','easel_add_post_ratings');


function easel_debug_page_foot_code() { ?>
	<p><?php echo get_num_queries() ?> queries. <?php if (function_exists('memory_get_usage')) { $unit=array('b','kb','mb','gb','tb','pb'); echo @round(memory_get_usage(true)/pow(1024,($i=floor(log(memory_get_usage(true),1024)))),2).' '.$unit[$i]; ?> Memory usage. <?php } timer_stop(1) ?> seconds.</p>
<?php }
if (easel_themeinfo('enable_debug_footer_code')) {
	add_action('easel-page-foot', 'easel_debug_page_foot_code');
}

function easel_auto_excerpt_more( $more ) {
	return __(' [&hellip;]','easel') . ' <a class="more-link" href="'. get_permalink() . '">' . __('&darr; Read the rest of this entry...','easel') . '</a>';
}

add_filter( 'excerpt_more', 'easel_auto_excerpt_more' );

if (easel_themeinfo('force_active_connection_close')) 
	add_action('shutdown_action_hook','easel_close_up_shop');

function easel_close_up_shop() {
	@mysql_close();
}

if (!function_exists('easel_is_layout')) {
	function easel_is_layout($choices) {
		$choices = explode(",", $choices);
		if (in_array(easel_themeinfo('layout'), $choices)) return true;
		return false;
	}
}

function easel_is_bbpress() {
	if (function_exists('bbp_is_single_forum') &&
			(bbp_is_forum()
				|| bbp_is_forum_archive()
				|| bbp_is_topic_archive()
				|| bbp_is_single_forum() 
				|| bbp_is_single_topic()
				|| bbp_is_topic()
				|| bbp_is_topic_edit()
				|| bbp_is_topic_merge()
				|| bbp_is_topic_split()
				|| bbp_is_single_reply()
				|| bbp_is_reply_edit()
				|| bbp_is_reply_edit()
				|| bbp_is_single_view()
				|| bbp_is_single_user_edit()
				|| bbp_is_single_user()
				|| bbp_is_user_home()
				|| bbp_is_subscriptions()
				|| bbp_is_favorites()
				|| bbp_is_topics_created()))
		return true;
	return false;
}

if (!function_exists('easel_sidebars_disabled')) {
	function easel_sidebars_disabled() {
		global $post;
		if (is_page() && !empty($post)) {
			$sidebars_disabled = get_post_meta($post->ID, 'disable-sidebars', true);
			if ($sidebars_disabled) return true;
		}
//		if (easel_is_bbpress()) return true;
		return false;
	}
}

add_action('pre_get_posts','easel_add_post_types_to_queries');

function easel_add_post_types_to_queries($query) {
	$args = array(
			'public' => true,
			'_builtin' => false
			);
	$output = 'names';
	$operator = 'and';
	$post_types = get_post_types( $args , $output , $operator );
	$post_types = array_merge(array('post'), $post_types);
	if ($query->is_author) {
		$query->set('post_type', $post_types);
	}
	return $query;
}

if (easel_themeinfo('menubar_social_icons')) 
	add_action('easel-menubar-menunav', 'easel_display_social_icons');

function easel_display_social_icons() {
	$twitter = easel_themeinfo('menubar_social_twitter');
	$facebook = easel_themeinfo('menubar_social_facebook');
	if (!empty($twitter)) echo '<a href="http://www.twitter.com/'.$twitter.'" title="'.__('Follow on Twitter','easel').'" class="menunav-social menunav-twitter">'.__('Twitter','easel').'</a>'."\r\n";
	if (!empty($facebook)) echo '<a href="http://www.facebook.com/'.$facebook.'" title="'.__('Friend on Facebook','easel').'" class="menunav-social menunav-facebook">Facebook</a>'."\r\n";
	echo '<a href="'.get_bloginfo('rss2_url').'" title="RSS Feed" class="menunav-social menunav-rss2">RSS</a>'."\r\n";
}

/**
 * This is function ceo_clean_filename
 *
 * @param string $filename the BASE filename
 * @return string returns the rawurlencoded filename with the %2F put back to /
 *
 */
function easel_clean_filename($filename) {
	return str_replace("%2F", "/", rawurlencode($filename));
}
