		<?php easel_display_layout('foot'); ?>
		<div id="footer">
			<?php do_action('easel-footer'); ?>
			<?php easel_get_sidebar('footer'); ?>
			<?php if (!easel_themeinfo('disable_footer_text')) easel_footer_text(); ?>
			<div class="clear"></div>
		</div>
	</div> <!-- // #page -->
</div> <!-- / #page-wrap -->
<div id="page-foot"><?php do_action('easel-page-foot'); ?></div>

<?php wp_footer(); ?>
</body>
</html>