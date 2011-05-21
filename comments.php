<?php
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
  die (__('Please do not load this page directly. Thanks!','easel'));

if ( post_password_required() ) { ?>
	<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.','easel'); ?></p>
	<?php
	return;
}
?>

<div id="comment-wrapper-head"></div>
<div id="comment-wrapper">

<?php if ( have_comments() ) : ?>

	<?php if ( !empty($comments_by_type['comment']) ) : ?>
		
		<h3 id="comments"><?php comments_number(__('Discussion &not;','easel'), __('Discussion &not;','easel'), __('Discussion (%) &not;','easel') );?></h3>
		<div class="commentsrsslink"><?php post_comments_feed_link('Comments RSS'); ?></div>
		<ol class="commentlist">
			<?php if (function_exists('easel_comments_callback')) { 
				wp_list_comments(array(
							'type' => 'comment',
							'reply_text' => __('Reply to %s&not;','easel'), 
							'callback' => 'easel_comments_callback',
							'end-callback' => 'easel_comments_end_callback',
							'avatar_size'=>64
							)
						); 
			} else {
				wp_list_comments(array('type' => 'comment', 'avatar_size'=>64));
			}?>	
		</ol>
		
		<?php if (easel_themeinfo('enable_numbered_pagination')) { ?>
		<?php 
			$pagelinks = paginate_comments_links(array('echo' => 0)); 
			if (!empty($pagelinks)) {
				$pagelinks = str_replace('<a', '<li><a', $pagelinks);
				$pagelinks = str_replace('</a>', '</a></li>', $pagelinks); 
				$pagelinks = str_replace('<span', '<li', $pagelinks); 
				$pagelinks = str_replace('</span>', '</li>', $pagelinks); ?>
			<div id="wp-paginav">
				<div id="paginav">				
					<?php echo '<ul><li class="paginav-extend">'.__('Comment Pages','easel').'</li>'. $pagelinks . '</ul>'; ?>
					</div>
				<div class="clear"></div>
			</div>					
			<?php } ?>

		<?php } else { ?>
			<div class="commentnav">
				<div class="commentnav-right"><?php next_comments_link(__('Next Comments &uarr;','easel')) ?></div>
				<div class="commentnav-left"><?php previous_comments_link(__('&darr; Previous Comments','easel')) ?></div>
				<div class="clear"></div>
			</div>
		<?php } ?>
		
	<?php endif; ?>
	
	<?php if ( isset($comments_by_type['pings']) && (isset($wp_query->query_vars['cpage']) && $wp_query->query_vars['cpage'] < 2)) : ?>
		<div id="pingtrackback-wrap">
			<h3 id="pingtrackback"><?php _e('Pings &amp; Trackbacks &not;','easel'); ?></h3>
			<ol class="commentlist">
			<li>
				<ul>
					<?php if (function_exists('easel_comments_callback')) { 
						wp_list_comments(array(
									'type' => 'pings',
									'callback' => 'easel_comments_callback',
									'end-callback' => 'easel_comments_end_callback',
									'avatar_size'=>32
									)
								); 
					} else {
						wp_list_comments(array('type' => 'pings', 'avatar_size'=>64));
					}?>	
				</ul>
			</li>
			</ol>
		</div>

	<?php endif; ?>

	
<?php else : // this is displayed if there are no comments so far ?>
	<?php if ('open' == $post->comment_status) : ?>
  <!-- If comments are open, but there are no comments. -->

	<?php else : // comments are closed ?>
	<!-- If comments are closed. -->
	<?php if (!is_page()) { ?>
		<p class="nocomments"><?php _e('Comments are closed.','easel'); ?></p>
	<?php } ?>
	<?php endif; ?>
<?php endif; ?>

<?php if ('open' == $post->comment_status) : 

	if (function_exists('in_members_category')) {
		if (in_members_category() && !easel_is_member()) {
			return;
		}
	}
	// comment_form(); not used based on our own required look and functionality.
?>
<div class="comment-wrapper-respond">
	<?php
	
	$fields =  array(
			'author' => '<p class="comment-form-author">' .
			'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" />'. ' <label for="author"><small>' . __( 'NAME &mdash;','easel' ) . ' <a href="http://gravatar.com">'. __('Get a Gravatar','easel') . '</a></small></label></p>',
			'email'  => '<p class="comment-form-email">' .
			'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" /> <label for="email">' . __( 'EMAIL', 'easel' ) . '</label></p>',
			'url'    => '<p class="comment-form-url">' .
			'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /> <label for="url">' . __( 'Website URL', 'easel' ) . '</label></p>',
			);

	if (easel_themeinfo('disable_comment_note')) {
		$args = array(
				'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" class="comment-textarea"></textarea></p>',
				'comment_notes_before' => '',
				'comment_notes_after'  => '',
				'title_reply'          => __( 'Comment &not;<br />', 'easel' ),
				'title_reply_to'       => __( 'Reply to %s &not;<br />','easel' ), 
				'cancel_reply_link'    => __( '<small>Cancel reply</small>', 'easel' ),
				'label_submit'         => __( 'Post Comment', 'easel' )
				);
	} else {
		$args = array(
				'fields'               => apply_filters( 'comment_form_default_fields', $fields ),
				'comment_notes_before' => '',
				'comment_field'        => '<p class="comment-form-comment"><textarea id="comment" name="comment" class="comment-textarea"></textarea></p>',
				'comment_notes_after'  => '<p class="comment-note">' . __('NOTE - You can use these ','easel') . sprintf(('<abbr title="HyperText Markup Language">HTML</abbr> tags and attributes:<br />%s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
				'title_reply'          => __( 'Comment &not;<br />', 'easel'),
				'title_reply_to'       => __('Reply to %s &not;<br />','easel'), 
				'cancel_reply_link'    => __( '<small>Cancel reply</small>', 'easel' ),
				'label_submit'         => __( 'Post Comment', 'easel' )
				);
	}
	comment_form($args); 
	?>
</div>

<?php endif; ?>
</div>

<div id="comment-wrapper-foot"></div>