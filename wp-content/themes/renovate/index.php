<?php get_header(); ?>
<div class="theme-page padding-bottom-70">
	<div class="vc_row wpb_row vc_row-fluid gray full-width page-header vertical-align-table">
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
			<div class="page-header-left">
				<h1><?php echo __("Latest Posts", 'renovate');?></h1>
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
							<?php echo __("Latest Posts", 'renovate');?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">
	<?php
	if(function_exists("vc_map"))
		echo do_shortcode(apply_filters('the_content', '[vc_row top_margin="none" el_class="margin-top-70"][vc_column type="" top_margin="none" width="3/4"][blog re_pagination="1" items_per_page="6" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="date" order="DESC" show_post_title="1" show_post_excerpt="1" read_more="1" show_post_categories="1" show_post_author="1" show_post_date="1" show_post_views="1" show_post_comments="1" is_search_results="0" top_margin="none" date_format="renovate"][/vc_column][vc_column type="re-smart-column" top_margin="none" width="1/4"][call_to_action_box title="COST CALCULATOR" icon="wallet" button_label="REQUEST A QUOTE" button_url="#" top_margin="none"]Use our form to estimate the initial cost of renovation or installation.[/call_to_action_box][box_header title="Latest Posts" type="h6" bottom_border="1" top_margin="page-margin-top"][blog_small re_pagination="0" items_per_page="3" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="date" order="DESC" show_post_title="1" show_post_date="1" top_margin="none" el_class="margin-top-30" show_post_views="0"][box_header title="Most Viewed" type="h6" bottom_border="1" top_margin="page-margin-top"][blog_small re_pagination="0" items_per_page="3" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="views" order="DESC" show_post_title="1" show_post_date="0" top_margin="none" el_class="margin-top-30" show_post_views="1"][box_header title="Text Widget" type="h6" bottom_border="1" top_margin="page-margin-top"][vc_wp_text el_class="margin-top-24"]Here is a text widget settings ipsum lore tora dolor sit amet velum. Maecenas est velum, gravida <a href="#">Vehicula Dolor</a>[/vc_wp_text][vc_wp_categories options="" el_class="page-margin-top clearfix" title="Categories"][vc_wp_archives options="count" title="Archives" el_class="page-margin-top full-width clearfix"][vc_wp_tagcloud taxonomy="post_tag" title="Tags" el_class="page-margin-top clearfix"][/vc_column][/vc_row]'));	
	else
	{
		re_get_theme_file("/shortcodes/blog.php");
		echo '<div class="vc_row wpb_row vc_row-fluid margin-top-70">' . re_theme_blog(array(
			"re_pagination" => 1,
			"items_per_page" => esc_attr(get_option('posts_per_page')),
			"offset" => 0,
			"featured_image_size" => "default",
			"ids" => "-",
			"category" => "-",
			"author" => "-",
			"order_by" => "date", 
			"order" => "DESC",
			"show_post_title" => "1",
			"show_post_excerpt" => "1",
			"read_more" => "1",
			"show_post_categories" => "1",
			"show_post_author" => "1", 
			"show_post_date" => "1",
			"show_post_views" => "1",
			"show_post_comments" => "1", 
			"is_search_results" => "0",
			"top_margin" => "none",
			"date_format" => "renovate"
		)) . '</div>';
	}
	paginate_links();
	?>
	</div>
</div>
<?php get_footer(); ?>