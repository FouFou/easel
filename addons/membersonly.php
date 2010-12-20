<?php
/**
 * Members Only
 * by Philip M. Hofer (Frumph)
 * http://frumph.net/
 * 
 * Displays content that only registered users that are marked members can see.
 * 
 * example:  [members]Only members can read this.[/members]
 * 
 * 
 */

add_shortcode( 'members', 'shortcode_for_easel_members_only' );
add_shortcode( 'member', 'shortcode_for_easel_members_only' );
add_action('show_user_profile', 'easel_profile_members_only');
add_action('edit_user_profile', 'easel_profile_members_only');
add_action('profile_update', 'easel_profile_members_only_save');

function shortcode_for_easel_members_only( $atts, $content = null ) {
	global $post;
	$this_ID = get_current_user_id();
	$returninfo = '<div class="non-members-post"><p>'.__('There is Members Only content here.<br />To view this content you need to be a member of this site.','easel').'</p></div>';
	if ( !empty($this_ID) && !empty($content) ) {
		$is_member = get_user_meta($this_ID, 'easel-is-member', true);
		if ($is_member || current_user_can('manage_options')) {
			$content = str_replace('<p>', '', $content);
			$content = str_replace('</p>', '', $content);
			$returninfo = "<div class=\"members-post\">$content</div>\r\n";
		}
	}
	return $returninfo;
}

function easel_profile_members_only() { 
	global $profileuser, $errormsg;
	$easel_is_member = get_user_meta($profileuser->ID,'easel-is-member', true);
	if (empty($easel_is_member)) $easel_is_member = 0;
	?>
	<h3><?php _e('Member of','easel'); ?> <?php bloginfo('name'); ?></h3>
	<table class="form-table">
	<tr>
	<th><label for="Memberflag"><?php _e('Member?','easel'); ?></label></th>
	<td> 
	<?php 
	if (current_user_can('manage_users')) { ?>
		<input id="easel-is-member" name="easel-is-member" type="checkbox" value="1" <?php checked(true, get_user_meta($profileuser->ID,'easel-is-member', true)); ?> />		
	<?php } else {
		if ($easel_is_member) { 
			echo 'Is Member';
		} else {
			echo 'Not a Member';
		}
	}
	?>
	</td>
	</tr>
	</table>
<?php }


function easel_profile_members_only_save($this_id) { 
	if (isset($_POST['easel-is-member']) && !empty($_POST['easel-is-member'])) {
		$is_member = (int)$_POST['easel-is-member'];
		$easel_is_member = (bool)( $is_member == 1 ? 1 : 0 );
		update_user_meta($this_id, 'easel-is-member', $easel_is_member);
	}
}

function easel_is_member() {
	$this_ID = get_current_user_id();
	if (!empty($this_ID)) {
		$is_member = get_user_meta($this_ID,'easel-is-member', true);
		if (empty($is_member)) $is_member = get_user_meta($this_ID, 'easel-is-member', true);
		if ($is_member || current_user_can('manage_options')) {
			return true;
		}
	}
	return false;
}

add_filter('body_class','easel_members_only_body_class');

function easel_members_only_body_class($classes = array()) {
	$this_ID = get_current_user_id();
	if (!empty($this_ID)) {
		$is_member = get_user_meta($this_ID, 'easel-is-member', true);
		if ($is_member) {
			$classes[] = 'member';
		} else {
			$classes[] = 'non-member';
		}
	} else 
		$classes[] = 'non-member';
	return $classes;
}

?>