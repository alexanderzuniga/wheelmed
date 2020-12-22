<?php
get_header();
global $post;
$post = get_post(get_option("woocommerce_shop_page_id"));
setup_postdata($post);
?>
<div class="theme-page padding-bottom-70">
	<div class="vc_row wpb_row vc_row-fluid gray full-width page-header vertical-align-table">
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
			<div class="page-header-left">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="page-header-right">
				<div class="bread-crumb-container">
					<label><?php _e("You Are Here:", 'renovate'); ?></label>
					<ul class="bread-crumb">
						<li>
							<a href="<?php echo esc_url(get_home_url()); ?>" title="<?php esc_attr_e('Home', 'renovate'); ?>">
								<?php _e('HOME', 'renovate'); ?>
							</a>
						</li>
						<li class="separator">
							&#47;
						</li>
						<li>
							<?php the_title(); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">
		<div class="vc_row wpb_row vc_row-fluid margin-top-70">
			<?php
			if(is_active_sidebar('sidebar-shop'))
			{
				$sidebar = get_page_by_title("Sidebar Shop", OBJECT, "renovate_sidebars");
			}
			?>
			<div class="vc_col-sm-<?php echo (is_active_sidebar('sidebar-shop') && isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true) ? '9' : '12'); ?> wpb_column vc_column_container">
				<div class="wpb_wrapper">
					<?php
					if(have_posts()):
						woocommerce_content();
					else:
						_e("No products found", 'renovate');
					endif;
					?>
				</div> 
			</div>
			<?php
			if(is_active_sidebar('sidebar-shop'))
			{
				if(isset($sidebar) && !(int)get_post_meta($sidebar->ID, "hidden", true))
				{
					?>
					<div class="vc_col-sm-3 wpb_column vc_column_container<?php echo ((int)get_post_meta($sidebar->ID, "hide_on_mobiles", true) ? ' hide-on-mobiles' : ''); ?>">
						<div class="wpb_wrapper">
							<div class="wpb_widgetised_column wpb_content_element clearfix">
								<div class="wpb_wrapper">
									<?php dynamic_sidebar('sidebar-shop'); ?>
								</div>
							</div>
						</div>
					</div>
					<?php
				}
			}
			?>
		</div>
	</div>
</div>
<?php
global $post;
$post = get_post(get_option("woocommerce_shop_page_id"));
setup_postdata($post);
get_footer(); 
?>