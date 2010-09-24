<form method="get" id="searchform" action="<?php home_url(); ?>/">
	<div>
		<input type="text" value="<?php _e('Search...','easel'); ?>" name="s" id="s-search" onfocus="this.value=(this.value=='<?php _e('Search...','easel'); ?>') ? '' : this.value;" onblur="this.value=(this.value=='') ? '<?php _e('Search...','easel'); ?>' : this.value;" />
		<input id="search-btn" value="Search" type="image" src="<?php echo easel_themeinfo('themeurl'); ?>/images/search-small.png" class="search" />
	</div>
	<div class="clear"></div>
</form>
