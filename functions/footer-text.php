<?php

if (!function_exists('easel_footer_text')) {
	function easel_footer_text() {
		$output = "<p class=\"footer-text\">\r\n";
		$output .= easel_copyright_info();
		$output .= "<span class=\"footer-pipe\">-</span> ";
		$output .= __('Powered by','easel') . " <a href=\"http://wordpress.org/\">WordPress</a> " . __('with','easel'). " <a href=\"http://comiceasel.com/\">Easel</a>\r\n";
		$output .= easel_hosted_on();
		$output .= "<span class=\"footer-subscribe\">";
			$output .= "<span class=\"footer-pipe\">-</span> ";
			$output .= "Subscribe: <a href=\"" . get_bloginfo('rss2_url') ."\">RSS</a>\r\n";
		$output .= "</span>\r\n";
		if (!easel_themeinfo('disable_scroll_to_top')) { 
			$output .= "<span class=\"footer-uptotop\">";
				$output .= "<span class=\"footer-pipe\">-</span> ";
				$output .= "<a href=\"#outside\" onclick=\"scrollup(); return false;\">".__('Back to Top &uarr;','easel')."</a>";
			$output .="</span>\r\n";
		}
		$output .= "</p>\r\n";
		echo apply_filters('easel_footer_text', $output);
	}
}


if (!function_exists('easel_hosted_on')) {
	function easel_hosted_on() {
		$current_site = get_current_site();
		if (!isset($current_site->site_name)) {
			$site_name = ucfirst( $current_site->domain );
		} else {
			$site_name = $current_site->site_name;
		}
		if(is_multisite()) {
			$output = "<span class=\"footer-pipe\">-</span> ";
			$output .= __('Hosted on','easel') . ' <a href="http://'. $current_site->domain. $current_site->path. '">'. $site_name. '</a> ';
			return apply_filters('easel_hosted_on', $output);
		}
	}
}

if (!function_exists('easel_copyright_info')) {
	function easel_copyright_info() {
		$copyright = __('&copy;', 'easel'). easel_copyright_dates() . ' ' . apply_filters('easel_copyright_info_name', '<a href="'.home_url().'">' . get_bloginfo('name') . '</a>') . ' ';
		return apply_filters('easel_copyright_info', $copyright);
	}
}

if (!function_exists('easel_copyright_dates')) {
	function easel_copyright_dates() {
		global $wpdb;
		$copyright_dates = $wpdb->get_results("
					SELECT
					YEAR(min(post_date_gmt)) AS firstdate,
					YEAR(max(post_date_gmt)) AS lastdate
					FROM
					$wpdb->posts
					WHERE
					post_status = 'publish'
					");
		$output = '';
		if ($copyright_dates) {
			$copyright = $copyright_dates[0]->firstdate;
			if($copyright_dates[0]->firstdate != $copyright_dates[0]->lastdate) {
				$copyright .= '-' . $copyright_dates[0]->lastdate;
			}
			$output =  $copyright;
		}
		return apply_filters('easel_copyright_dates', $output);
	}
}

// Example of how to do copyright information 

// add_filter('easel_copyright_info_name', 'easel_add_copyright_info_name');
/*
function easel_add_copyright_info_name() {
	$output =  'Philip M. Hofer ';
	return $output;
}
*/

?>