			<?php global $theme_options;
			$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_footer_top", true));
			if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name))
			{
			?>
			<div class="vc_row wpb_row vc_row-fluid yellow footer-row full-width padding-top-bottom-30<?php echo ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
				<div class="vc_row wpb_row vc_inner vc_row-fluid">
					<?php
						dynamic_sidebar($sidebar->post_name);
					?>
				</div>
			</div>
			<?php
			}
			$sidebar = get_post(get_post_meta(get_the_ID(), "page_sidebar_footer_bottom", true));
			if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) && is_active_sidebar($sidebar->post_name))
			{
			?>
			<div class="vc_row wpb_row vc_row-fluid gray footer-row full-width page-padding-top padding-bottom-50<?php echo ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
				<div class="vc_row wpb_row vc_inner vc_row-fluid row-4-4">
					<?php
						dynamic_sidebar($sidebar->post_name);
					?>
				</div>
			</div>
			<?php
			}
			if($theme_options["footer_text"]!=""): ?>
			<div class="vc_row wpb_row vc_row-fluid align-center padding-top-bottom-30">
				<span class="copyright">
				<?php echo do_shortcode($theme_options["footer_text"]); ?>
				</span>
			</div>
			<?php endif; ?>
		</div>
		<div class="background-overlay"></div>
		<?php if((int)$theme_options["scroll_top"]): ?>
		<a href="#top" class="scroll-top animated-element template-arrow-up" title="<?php esc_attr_e("Scroll to top", 'renovate'); ?>"></a>
		<?php
		endif;
		if((int)$theme_options["style_selector"])
			re_get_theme_file("/style_selector/style_selector.php");
		wp_footer();
		?>
	</body>
</html>