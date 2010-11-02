<div id="easel-general">
	<form method="post" id="myForm-general" enctype="multipart/form-data" action="?page=easel-options">
	<?php wp_nonce_field('update-options') ?>

		<div class="easel-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('General','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_default_design"><?php _e('Disable Default Design','easel'); ?></label></th>
					<td>
						<input id="disable_default_design" name="disable_default_design" type="checkbox" value="1" <?php checked(true, $easel_options['disable_default_design']); ?> />
					</td>
					<td>
						<?php _e('Checking this option will make it so the style-default.css isn\'t loaded.  This style is what is used if there isn\'t a child theme found.  A default site design for Easel.','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="home_post_count"><?php _e('How many blog posts would you like to display on the home page?','easel'); ?></label></th>
					<td>
						<input type="text" size="2" name="home_post_count" id="home_post_count" value="<?php echo $easel_options['home_post_count']; ?>" />
					</td>
					<td>
						<?php _e('How many blog posts you would like displayed on the index page at one time.','easel'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="disable_blog_on_homepage"><?php _e('Disable Blog on Home Page','easel'); ?></label></th>
					<td>
						<input id="disable_blog_on_homepage" name="disable_blog_on_homepage" type="checkbox" value="1" <?php checked(true, $easel_options['disable_blog_on_homepage']); ?> />
					</td>
					<td>
						<?php _e('Enabling this option, will DISABLE the blog from appearing on the home page.  This will let you design specific scenerios that allow you to create seperate sections and pages for blog posts.','easel'); ?>
					</td>
				</tr>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Menubar','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_default_menubar"><?php _e('Disable default Menubar','easel'); ?></label></th>
					<td>
						<input id="disable_default_menubar" name="disable_default_menubar" type="checkbox" value="1" <?php checked(true, $easel_options['disable_default_menubar']); ?> />
					</td>
					<td>
						<?php _e('Allows you to customize the location of the Menubar via Widgets or, just not have it.','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_search_in_menubar"><?php _e('Enable Search Form','easel'); ?></label></th>
					<td>
						<input id="enable_search_in_menubar" name="enable_search_in_menubar" type="checkbox" value="1" <?php checked(true, $easel_options['enable_search_in_menubar']); ?> />
					</td>
					<td>
						<?php _e('Searchforms can be fun when you have something to search for.','easel'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_rss_in_menubar"><?php _e('Enable RSS Link','easel'); ?></label></th>
					<td>
						<input id="enable_rss_in_menubar" name="enable_rss_in_menubar" type="checkbox" value="1" <?php checked(true, $easel_options['enable_rss_in_menubar']); ?> />
					</td>
					<td>
					<?php _e('Adds an RSS link icon to your menubar on the right side.','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_jquery_menu_code"><?php _e('Disable the menubar jQuery?','easel'); ?></label></th>
					<td>
						<input id="disable_jquery_menu_code" name="disable_jquery_menu_code" type="checkbox" value="1" <?php checked(true, $easel_options['disable_jquery_menu_code']); ?> />
					</td>
					<td>
						<?php _e('Disable the loading of the menubar jQuery.  If you do not want the ddsmoother menu code to load. (will not do drop downs without it)','easel'); ?>
					</td>
				</tr>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Pages','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_page_titles"><?php _e('Disable the titles on pages','easel'); ?></label></th>
					<td>
						<input id="disable_page_titles" name="disable_page_titles" type="checkbox" value="1" <?php checked(true, $easel_options['disable_page_titles']); ?> />
					</td>
					<td>
						<?php _e('Page titles will be turned off.  If you disable the titles no pages you can still add a post-image in the page editor.','easel'); ?>
					</td>
				</tr>			
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Posts','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_post_titles"><?php _e('Disable the titles on posts','easel'); ?></label></th>
					<td>
						<input id="disable_post_titles" name="disable_post_titles" type="checkbox" value="1" <?php checked(true, $easel_options['disable_post_titles']); ?> />
					</td>
					<td>
						<?php _e('Post titles will be turned off.  If you disable the titles on posts can still add a post-image in the post editor.','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_post_calendar"><?php _e('Add graphic calendar to blog posts','easel'); ?></label></th>
					<td>
						<input id="enable_post_calendar" name="enable_post_calendar" type="checkbox" value="1" <?php checked(true, $easel_options['enable_post_calendar']); ?> />
					</td>
					<td>
						<?php _e('Enabling this option will display a calendar image on your blog posts. The graphic calendar is an image that has the date of the blog post overlayed on top of it.','easel'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_post_author_gravatar"><?php _e('Enable Author Gravatar','easel'); ?></label></th>
					<td>
						<input id="enable_post_author_gravatar" name="enable_post_author_gravatar" type="checkbox" value="1" <?php checked(true, $easel_options['enable_post_author_gravatar']); ?> />
					</td>
					<td>
						<?php _e('Enabling this option will show a gravatar of the post author based on the author email address.  Gravatars are associated by your email address and you can create them at','easel'); ?> <a href="http://gravatar.com/">http://gravatar.com</a>.
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_avatar_trick"><?php _e('Enable Avatar Mod','easel'); ?></label></th>
					<td>
						<input id="enable_avatar_trick" name="enable_avatar_trick" type="checkbox" value="1" <?php checked(true, $easel_options['enable_avatar_trick']); ?> />
					</td>
					<td>
						<?php _e('With this enabled, the avatar\'s that are displayed will be jquery modified to look like poloroids randomly tilted.','easel'); ?>
					</td>
				</tr>
				<?php
					$current_avatar_directory = $easel_options['avatar_directory'];
					if (empty($current_avatar_directory)) $current_avatar_directory = 'default';
					$avatar_directories = array();
					$dirs_to_search = array_unique(array(easel_themeinfo('themepath'), easel_themeinfo('stylepath')));
					foreach ($dirs_to_search as $avdir) { 
						if (is_dir($avdir . '/images/avatars')) {
							$thisdir = null;
							$thisdir = array();
							$thisdir = glob($avdir. '/images/avatars/*');
							$avatar_directories = array_merge($avatar_directories, $thisdir); 		
						}
					}
				?>
				<tr>
					<th scope="row" colspan="2">
						<label for="avatar_directory"><?php _e('Avatar Directory','easel'); ?></label>
						<select name="avatar_directory" id="avatar_directory">
							<option class="level-0" value="none" <?php if ($current_avatar_directory == "none") { ?>selected="selected"<?php } ?>>none</option>
							<?php
								foreach ($avatar_directories as $avatar_dirs) {
									if (is_dir($avatar_dirs)) {
										$avatar_dir_name = basename($avatar_dirs); ?>
										<option class="level-0" value="<?php echo $avatar_dir_name; ?>" <?php if ($current_avatar_directory == $avatar_dir_name) { ?>selected="selected"<?php } ?>><?php echo $avatar_dir_name; ?></option>
								<?php }
								}
							?>
						</select>
					</th>
					<td>
						<?php _e('Choose a directory to get the avatars for default gravatars if someone does not have one.  You will have to make these images yourself, or download them from avatar providers. Then make a new directory on your site server to upload them to and select that directory here. <strong>Setting this to \'none\' will disable it from using any special avatar sets.</strong>','easel'); ?><br />
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="disable_tags_in_posts"><?php _e('Disable display of <strong>tags</strong> in posts','easel'); ?></label></th>
					<td>
						<input id="disable_tags_in_posts" name="disable_tags_in_posts" type="checkbox" value="1" <?php checked(true, $easel_options['disable_tags_in_posts']); ?> />
					</td>
					<td>
						<?php _e('Checkmarking this will make it so that tags will not appear in posts.','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_categories_in_posts"><?php _e('Disable display of <strong>categories</strong> in posts','easel'); ?></label></th>
					<td>
						<input id="disable_categories_in_posts" name="disable_categories_in_posts" type="checkbox" value="1" <?php checked(true, $easel_options['disable_categories_in_posts']); ?> />
					</td>
					<td>
						<?php _e('Checkmarking this will make it so that categories will not appear in posts.','easel'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="disable_author_info_in_posts"><?php _e('Disable display of <strong>by Author</strong> in post information.','easel'); ?></label></th>
					<td>
						<input id="disable_author_info_in_posts" name="disable_author_info_in_posts" type="checkbox" value="1" <?php checked(true, $easel_options['disable_author_info_in_posts']); ?> />
					</td>
					<td>
						<?php _e('Checkmarking this will make it so that the by Author information will not appear in posts.','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_date_info_in_posts"><?php _e('Disable display of <strong>on post-Date</strong> in posts','easel'); ?></label></th>
					<td>
						<input id="disable_date_info_in_posts" name="disable_date_info_in_posts" type="checkbox" value="1" <?php checked(true, $easel_options['disable_date_info_in_posts']); ?> />
					</td>
					<td>
						<?php _e('Checkmarking this will make it so that on post-Date will not appear in posts.','easel'); ?>
					</td>
				</tr>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Comments','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_comment_note"><?php _e('Disable the comment notes','easel'); ?></label></th>
					<td>
						<input id="disable_comment_note" name="disable_comment_note" type="checkbox" value="1" <?php checked(true, $easel_options['disable_comment_note']); ?> />
					</td>
					<td>
						<?php _e('Disabling this will remove the note text that displays with more options for adding to comments (html).','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_comment_javascript"><?php _e('Disable Comment Javascript','easel'); ?></label></th>
					<td>
						<input id="disable_comment_javascript" name="disable_comment_javascript" type="checkbox" value="1" <?php checked(true, $easel_options['disable_comment_javascript']); ?> />
					</td>
					<td>
						<?php _e('Checkmark this if you want the comment form to not use javascript to appear directly under who is being replied to. (increases pageviews/hits)','easel'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_comments_on_homepage"><?php _e('Enable Comments on Home Page','easel'); ?></label></th>
					<td>
						<input id="enable_comments_on_homepage" name="enable_comments_on_homepage" type="checkbox" value="1" <?php checked(true, $easel_options['enable_comments_on_homepage']); ?> />
					</td>
					<td>
						<?php _e('Checkmarking this option will make it so that the post(s) on the home page will also display the comments under them, This will ONLY work if you have it set to only display 1 post on the home page.  The post count and this must be set to work.','easel'); ?>
					</td>
				</tr>
			</table>

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Navigation','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="enable_numbered_pagination"><?php _e('Enable numbered pagination','easel'); ?></label></th>
					<td>
						<input id="enable_numbered_pagination" name="enable_numbered_pagination" type="checkbox" value="1" <?php checked(true, $easel_options['enable_numbered_pagination']); ?> />
					</td>
					<td>
						<?php _e('Previous Entries and Next Entries buttons are replaced by a bar of numbered pages. Numbered pagination appears on the Home page, the author(s) page, the blog template, and comments/single when there are more then the set number of comments per page. Uses the same styling as the Menubar.','easel'); ?>
					</td>
				</tr>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Footer','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_footer_text"><?php _e('Disable the default text in the footer','easel'); ?></label></th>
					<td>
						<input id="disable_footer_text" name="disable_footer_text" type="checkbox" value="1" <?php checked(true, $easel_options['disable_footer_text']); ?> />
					</td>
					<td>
						<?php _e('Default text in the footer will not display. Enable this if you do not want any text in the footer. If you wish to add you own custom content, you may do so via Appearance -> Widgets-> Footer.', 'easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="disable_scroll_to_top"><?php _e('Disable the scroll to top link in the footer?','easel'); ?></label></th>
					<td>
						<input id="disable_scroll_to_top" name="disable_scroll_to_top" type="checkbox" value="1" <?php checked(true, $easel_options['disable_scroll_to_top']); ?> />
					</td>
					<td>
						<?php _e('When this link is clicked on long pages it will scroll back to the top.','easel'); ?>
					</td>
				</tr>
			</table>
			
			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('RSS','easel'); ?></th>
					</tr>
				</thead>			
				<tr class="alternate">
					<th scope="row"><label for="enable_post_thumbnail_rss"><?php _e('Enable the post thumbnails in the RSS feed?','easel'); ?></label></th>
					<td>
						<input id="enable_post_thumbnail_rss" name="enable_post_thumbnail_rss" type="checkbox" value="1" <?php checked(true, $easel_options['enable_post_thumbnail_rss']); ?> />		
					</td>
					<td>
						<?php _e('If enabled will show the post thumbnail of the post in the RSS feed.','easel'); ?>
					</td>
				</tr>
			</table>

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Debug','easel'); ?></th>
					</tr>
				</thead>			
				<tr class="alternate">
					<th scope="row"><label for="enable_debug_footer_code"><?php _e('Enable the debug page load/memory usage at the bottom of each page?','easel'); ?></label></th>
					<td>
						<input id="enable_debug_footer_code" name="enable_debug_footer_code" type="checkbox" value="1" <?php checked(true, $easel_options['enable_debug_footer_code']); ?> />		
					</td>
					<td>
						<?php _e('If enabled will show information on how many queries, memory is used as well as how fast the page loads.','easel'); ?>
					</td>
				</tr>
			</table>

		</div>

		<div class="easel-options-save">
			<div class="easel-major-publishing-actions">
				<div class="easel-publishing-action">
					<input name="easel_save_general" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="easel_save_general" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
