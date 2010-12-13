<div id="easel-debug">

	<div class="easel-options">
	
		<form method="post" id="myForm-debug" enctype="multipart/form-data" action="?page=easel-options">
		<?php wp_nonce_field('update-options') ?>
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

		<div class="easel-options-save">
			<div class="easel-major-publishing-actions">
				<div class="easel-publishing-action">
					<input name="easel_save_debug" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="easel_save_debug" />
				</div>
				<div class="clear"></div>
			</div>
		</div>
		
		</form>
		
		<table class="widefat" style="width: 100%">
		<tr>
			<td colspan="5">
				Technical Support is available on the forums at <a href="http://comicpress.net/forum" target="_blank">ComicPress/Frumph.NET forums</a>
			</td>
		<tr>
			<td>
			<strong>Site URL</strong>:(siteurl) <?php echo easel_themeinfo('siteurl'); ?><br />
			<strong>Blog URL</strong>:(home) <?php echo easel_themeinfo('home'); ?><br />
			<br />
			<strong>Theme Path</strong>:(themepath) <?php echo easel_themeinfo('themepath'); ?><br />
			<strong>Theme URL</strong>:(themeurl) <?php echo easel_themeinfo('themeurl'); ?><br />
			<?php if (is_child_theme()) { ?>
				<strong>Child Theme Path</strong>:(childpath) <?php echo easel_themeinfo('stylepath'); ?><br />
				<strong>Child Theme URL</strong>:(childurl) <?php echo easel_themeinfo('styleurl'); ?><br />
			<?php } else { ?>
				<strong>Child Theme</strong>: None<br />
			<?php } ?>
			<strong>Upload Path</strong>:(path) <?php echo easel_themeinfo('path'); ?><br />
			<strong>Upload Path Sub Dir</strong>:(subdir) <?php echo easel_themeinfo('subdir'); ?><br />
			<strong>Upload Path Base Dir</strong>:(uploadpath) <?php echo easel_themeinfo('uploadpath'); ?><br />
			<strong>Upload Base URL</strong>:(uploadurl) <?php echo easel_themeinfo('uploadurl'); ?><br />
			<br />
			<?php var_dump(easel_themeinfo()); ?>
			</td>
		</tr>
		</table>
	</div>
</div>
