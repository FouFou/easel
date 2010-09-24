<?php

if (!function_exists('easel_footer_text')) {
	function easel_footer_text() {
		$copyinfo = '';
		$copyinfo = apply_filters('easle_footer_text_copyinfo', $copyinfo);
		$output = "<p class=\"footer-text\">\r\n";
		$output .= $copyinfo;
		$output .= __('Powered by','easel') . " <a href=\"http://wordpress.org/\">WordPress</a> " . __('with','easel'). " <a href=\"http://comiceasel.com/\">Easel</a>\r\n";
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

// Example of how to do copyright information 
/*

add_filter('easle_footer_text_copyinfo', 'easel_add_copyright_info');

function easel_add_copyright_info() {
	$output =  '&copy; 2010 Philip M. Hofer - ';
	return $output;
}
*/
?>