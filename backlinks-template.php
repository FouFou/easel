<?php
/*
Template Name: Backlinks

.page-template-backlinks-template-php .entry ul {
	list-style: none;
	margin: 0;
	padding: 0;
}

.page-template-backlinks-template-php .entry ul li {
	margin: 5px 0;
}

*/
get_header();

$home = home_url();
// $link = 'http://blogsearch.google.com/blogsearch?scoring=d&partner=wordpress&q=link:' . trailingslashit( home_url() );
$num_items = 1000;
$url =  'http://blogsearch.google.com/blogsearch_feeds?scoring=d&ie=utf-8&num=' . $num_items . '&output=rss&partner=wordpress&q=link:' . trailingslashit( home_url() );
$show_date = true;
$output = '';

$rss = fetch_feed( $url );

if ( is_wp_error($rss) && is_admin() ) {
	$output = '<p>';
	$output .= __('<strong>RSS Error</strong>: ', 'easel'). $rss->get_error_message();
	$output .= '</p>';
}

if ( !$rss->get_item_quantity() ) {
	$output .= '<p>' . __('There were no backlinks found.') . "</p>\r\n";
} else {
	
	$output .= "<ul>\r\n";

	if ( !isset($items) )
		$items = 1000;
	
	foreach ( $rss->get_items(0, $items) as $item ) {
		$publisher = '';
		$site_link = '';
		$link = '';
		$content = '';
		$date = '';
		$link = esc_url( strip_tags( $item->get_link() ) );
		
		$author = $item->get_author();
		if ( $author ) {
			$site_link = esc_url( strip_tags( $author->get_link() ) );
			if ( !$publisher = esc_html( strip_tags( $author->get_name() ) ) )
				$publisher = __( 'Somebody' );
		} else {
			$publisher = __( 'Somebody' );
		}
		if ( $site_link )
			$publisher = "<a href='$site_link'>$publisher</a>";
		else
			$publisher = "<strong>$publisher</strong>";
		$content = $item->get_content();
		$content = wp_html_excerpt($content, 200) . ' ...';
		
		if ( $link )
			/* translators: incoming links feed, %1$s is other person, %3$s is content */
			$text = __( '%1$s linked here <a href="%2$s">saying</a>, "%3$s"' );
		else
			/* translators: incoming links feed, %1$s is other person, %3$s is content */
			$text = __( '%1$s linked here saying, <br />"%3$s"' );
		
		if ( !empty($show_date) ) {
			if ( !empty($show_author) || !empty($show_summary) )
				/* translators: incoming links feed, %4$s is the date */
				$text .= ' ' . __( 'on %4$s' );
			$date = esc_html( strip_tags( $item->get_date() ) );
			$date = strtotime( $date );
			$date = gmdate( get_option( 'date_format' ), $date );
		}
		$output .= "\t<li>" . sprintf( $text, $publisher, $link, $content, $date ) . "</li>\n";
	}
	$output .= "</ul>\r\n";
}

$rss->__destruct();
unset($rss);

if (have_posts()) {
	while (have_posts()) : the_post(); ?>
		<div <?php post_class(); ?>>
			<?php easel_display_post_thumbnail(); ?>
			<div class="post-head"><?php do_action('easel-post-head'); ?></div>
			<div class="post-content">
				<div class="post-info">
					<div class="post-text">
						<?php easel_display_post_title(); ?>
					</div>
				</div>
				<div class="clear"></div>				
				<div class="entry">
					<?php easel_display_the_content(); ?>
					<?php if (!empty($output)) echo $output; ?>
					<div class="clear"></div>
				</div>
				<div class="clear"></div>
				<?php edit_post_link(__('Edit this page.','easel'), '', ''); ?>
			</div>
			<div class="post-foot"><?php do_action('easel-post-foot'); ?></div>
		</div>
	<?php endwhile;
	if ($post->comment_status == 'open') {
		comments_template('', true);
	}
}

get_footer();
?>