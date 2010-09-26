
<div id="easel-debug">
	<div class="easel-options">
		<table class="widefat" style="width: 100%">
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
