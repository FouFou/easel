<div id="easel-addons">
	<form method="post" id="myForm-general" enctype="multipart/form-data" action="?page=easel-options">
	<?php wp_nonce_field('update-options') ?>

		<div class="easel-options">

			<table class="widefat">
				<thead>
					<tr>
						<th colspan="3"><?php _e('Addons','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="enable_addon_membersonly"><?php _e('Members Only','easel'); ?></label></th>
					<td>
						<input id="enable_addon_membersonly" name="enable_addon_membersonly" type="checkbox" value="1" <?php checked(true, $easel_options['enable_addon_membersonly']); ?> />
					</td>
					<td>
						<?php _e('Enabled the members only shortcode [members]content[/members] - you can configure who is a member in the user editor.  Those with access will be able to see the content.','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_addon_playingnow"><?php _e('Playing Now','easel'); ?></label></th>
					<td>
						<input id="enable_addon_playingnow" name="enable_addon_playingnow" type="checkbox" value="1" <?php checked(true, $easel_options['enable_addon_playingnow']); ?> />
					</td>
					<td>
						<?php _e('The "Music" post type, this post type allows you to seperate music selections and post about music/bands seperate from regular posts; includes a [latest music] widget that lists off the latest posts in the music post type.','easel'); ?>
					</td>
				</tr>
				<tr class="alternate">
					<th scope="row"><label for="enable_addon_showcase"><?php _e('Comic Showcase','easel'); ?></label></th>
					<td>
						<input id="enable_addon_showcase" name="enable_addon_showcase" type="checkbox" value="1" <?php checked(true, $easel_options['enable_addon_showcase']); ?> />
					</td>
					<td>
						<?php _e('The "Showcase" post type, this post type is specifically for creating posts that are relevant to comics, and showcasing which comics you read and who makes them and what type of comic they are.  Includes a [latest showcase] widget that lists off the latest posts in the showcase post type.','easel'); ?>
					</td>
				</tr>
				<tr>
					<th scope="row"><label for="enable_addon_comics"><?php _e('ComicPress Light','easel'); ?></label></th>
					<td>
						<input id="enable_addon_comics" name="enable_addon_comics" type="checkbox" value="1" <?php checked(true, $easel_options['enable_addon_comics']); ?> />
					</td>
					<td>
						<?php _e('This is the Comics post type, how it works is when you add a comic, you put the comic in the "featured image" section of the comic post type.  Whatever image is in the featured image section will be used as the comic.  There is standard navigation first next previous and last and a latest comics widget that goes with this.  This is a very basic rudimentary comic system.','easel'); ?>
					</td>
				</tr>
				<tr style="background: #fcffc7">
					<td scope="row" colspan="3">
						Remember with custom post types, you will need to go to settings -> permalinks and click "save" to enable them to work properly and reinitilize the permalink structure.
					</td>
				</tr>
			</table>

		</div>

		<div class="easel-options-save">
			<div class="easel-major-publishing-actions">
				<div class="easel-publishing-action">
					<input name="easel_save_general" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="easel_save_addons" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>

