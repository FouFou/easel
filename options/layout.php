<script language="javascript" type="text/javascript">
	function lshowimage(sel,pic) {
	if (!document.images) return
	document.getElementById(pic).src = '<?php echo get_template_directory_uri(); ?>/images/options/'+sel.options[sel.selectedIndex].value+'.png'
	}
</script>
<script language="javascript" type="text/javascript">
	function sshowimage(sel,pic) {
	if (!document.images) return
	document.getElementById(pic).src = '<?php echo get_template_directory_uri(); ?>/images/schemes/'+sel.options[sel.selectedIndex].value+'.jpg'
	}
</script>
<div id="easel-layout">
	<form method="post" id="myForm-layout" enctype="multipart/form-data" action="?page=easel-options">
	<?php wp_nonce_field('update-options') ?>

		<div class="easel-options">

			<table class="widefat" cellspacing="0">
				<thead>
					<tr>
						<th colspan="4"><?php _e('Layout','easel'); ?></th>
					</tr>
				</thead>
				<?php if (!isset($easel_options['layout']) || empty($easel_options['layout'])) $easel_options['layout'] = 'b3c'; ?>
				<tr class="alternate">
					<th scope="row" style="width:250px"><label for="layout" style="text-align:left"><?php _e('Choose Your Website Layout','easel'); ?></label>
						<select name="layout" id="layout" onchange="lshowimage(this,'easellayout')">
							<option class="level-0" value="b3c" <?php if (($easel_options['layout'] == 'b3c') || ($easel_options['layout'] == 'standard')) { ?>selected="selected" <?php } ?>><?php _e('3 Column - Standard','easel'); ?></option>
							<option class="level-0" value="b3cl" <?php if ($easel_options['layout'] == 'b3cl') { ?>selected="selected" <?php } ?>><?php _e('3 Column - Sidebar\'s on left','easel'); ?></option>
							<option class="level-0" value="b3cr" <?php if ($easel_options['layout'] == 'b3cr') { ?>selected="selected" <?php } ?>><?php _e('3 Column - Sidebar\'s on right','easel'); ?></option>
							<option class="level-0" value="b2cl" <?php if ($easel_options['layout'] == 'b2cl') { ?>selected="selected" <?php } ?>><?php _e('2 Column - Sidebar on left','easel'); ?></option>
							<option class="level-0" value="b2cr" <?php if ($easel_options['layout'] == 'b2cr') { ?>selected="selected" <?php } ?>><?php _e('2 Column - Sidebar on right','easel'); ?></option>
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

			<table class="widefat nolowermargin" cellspacing="0">
				<thead>
					<tr>
						<th colspan="4"><?php _e('Scheme','easel'); ?></th>
					</tr>
				</thead>
				<tr class="alternate">
					<th scope="row"><label for="disable_default_design"><?php _e('Disable Design Schemes','easel'); ?><?php if (is_child_theme()) { ?><br /><?php _e('(Schemes are disabled due to child theme active)','easel'); } ?></label></th>
					<td>
						<input id="disable_default_design" name="disable_default_design" type="checkbox" value="1" <?php checked(true, $easel_options['disable_default_design']); ?> />
					</td>
					<td>
						<?php _e('Checking this option will make it so the various schemes are not loaded.  Schemes are automatically disabled if a child-theme exists.  This is a completely blank slate with no design.','easel'); ?>
					</td>
				</tr>
				<?php if (!is_child_theme() && !$easel_options['disable_default_design']) { ?>
				<?php if (!isset($easel_options['scheme']) || empty($easel_options['scheme'])) $easel_options['scheme'] = 'default'; ?>
				<tr>
					<th scope="row" style="width:250px"><label for="layout" style="text-align:left"><?php _e('Choose the default scheme.','easel'); ?></label>
						<select name="scheme" id="scheme" onchange="sshowimage(this,'easelscheme')">
							<option class="level-0" value="default" <?php if (!!isset($easel_options['scheme']) || empty($easel_options['scheme']) || ($easel_options['scheme'] == 'default')) { ?>selected="selected" <?php } ?>><?php _e('Default','easel'); ?></option>
							<option class="level-0" value="ocean" <?php if ($easel_options['scheme'] == 'ocean') { ?>selected="selected" <?php } ?>><?php _e('Ocean','easel'); ?></option>
							<option class="level-0" value="desert" <?php if ($easel_options['scheme'] == 'desert') { ?>selected="selected" <?php } ?>><?php _e('Desert','easel'); ?></option>
							<option class="level-0" value="greymatter" <?php if ($easel_options['scheme'] == 'greymatter') { ?>selected="selected" <?php } ?>><?php _e('Grey Matter','easel'); ?></option>
						</select>
						<br />
					</th>
					<td>
						<img id="easelscheme" src="<?php echo get_template_directory_uri(); ?>/images/schemes/<?php echo $easel_options['scheme']; ?>.jpg" alt="Scheme" />
					</td>
					<td style="vertical-align:middle">
					</td>
				</tr>
				<?php } ?>
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
