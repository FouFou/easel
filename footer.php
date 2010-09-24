		<?php get_template_part('layout', 'foot'); ?>
		<div id="footer">
			<?php do_action('easel-footer'); ?>
			<?php easel_get_sidebar('footer-area'); ?>
			<?php if (!easel_themeinfo('disable_footer_text')) easel_footer_text(); ?>
		</div>
	</div> <!-- // #page -->
</div> <!-- / #page-wrap -->
<div id="page-foot"><?php do_action('easel-page-foot'); ?></div>

<?php wp_footer(); ?>
</body>
</html>