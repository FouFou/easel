<script language="javascript" type="text/javascript">
	function showimage(sel,pic) {
	if (!document.images) return
	document.getElementById(pic).src = '<?php echo get_template_directory_uri(); ?>/images/options/'+sel.options[sel.selectedIndex].value+'.png'
	}
</script>
<div id="easel-layout">
	<form method="post" id="myForm-layout" enctype="multipart/form-data" action="?page=easel-options">
	<?php wp_nonce_field('update-options') ?>

		<div class="easel-options">

			<table class="widefat nolowermargin" cellspacing="0">
				<thead>
					<tr>
						<th colspan="4"><?php _e('Layout','easel'); ?></th>
					</tr>
				</thead>
				<?php if (!isset($easel_options['layout']) || empty($easel_options['layout'])) $easel_options['layout'] = 'b3c'; ?>
				<tr class="alternate">
					<th scope="row" style="width:250px"><label for="layout" style="text-align:left"><?php _e('Choose Your Website Layout','easel'); ?></label>
						<select name="layout" id="layout" onchange="showimage(this,'easellayout')">
							<option class="level-0" value="b3c" <?php if (($easel_options['layout'] == 'b3c') || ($easel_options['layout'] == 'standard')) { ?>selected="selected" <?php } ?>><?php _e('BLOG: 3 Column - Standard','easel'); ?></option>
							<option class="level-0" value="b3cl" <?php if ($easel_options['layout'] == 'b3cl') { ?>selected="selected" <?php } ?>><?php _e('BLOG: 3 Column - Sidebar\'s on left','easel'); ?></option>
							<option class="level-0" value="b3cr" <?php if ($easel_options['layout'] == 'b3cr') { ?>selected="selected" <?php } ?>><?php _e('BLOG: 3 Column - Sidebar\'s on right','easel'); ?></option>
							<option class="level-0" value="b2cl" <?php if ($easel_options['layout'] == 'b2cl') { ?>selected="selected" <?php } ?>><?php _e('BLOG: 2 Column - Sidebar on left','easel'); ?></option>
							<option class="level-0" value="b2cr" <?php if ($easel_options['layout'] == 'b2cr') { ?>selected="selected" <?php } ?>><?php _e('BLOG: 2 Column - Sidebar on right','easel'); ?></option>
						<?php if (function_exists('ceo_initialize_post_types')) { ?>
							<option class="level-0" value="c3c" <?php if ($easel_options['layout'] == 'c3c') { ?>selected="selected" <?php } ?>><?php _e('COMIC: 3 Column - Standard','easel'); ?></option>
						<?php } ?>
						</select>
						<br />
					</th>
					<td>
						<img id="easellayout" src="<?php echo get_template_directory_uri(); ?>/images/options/<?php echo $easel_options['layout']; ?>.png" alt="Layout" />
					</td>
					<td style="vertical-align:middle">
					</td>
				</tr>
			</table>
			<br />	
		</div>

		<div class="easel-options-save">
			<div class="easel-major-publishing-actions">
				<div class="easel-publishing-action">
					<input name="easel_save_layout" type="submit" class="button-primary" value="Save Settings" />
					<input type="hidden" name="action" value="easel_save_layout" />
				</div>
				<div class="clear"></div>
			</div>
		</div>

	</form>

</div>
