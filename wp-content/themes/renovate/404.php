<?php
/*
Template Name: 404 page
*/
header("HTTP/1.1 404 Not Found");
header("Status: 404 Not Found");
get_header();
/*get page with 404 page template set*/
$not_found_template_page_array = get_pages(array(
	'post_type' => 'page',
	'post_status' => 'publish',
	'number' => 1,
	'meta_key' => '_wp_page_template',
	'meta_value' => '404.php'
));
if(count($not_found_template_page_array))
{
	$not_found_template_page = $not_found_template_page_array[0];
}
?>
<div class="theme-page padding-bottom-66">
	<div class="vc_row wpb_row vc_row-fluid gray full-width page-header vertical-align-table">
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
			<div class="page-header-left">
				<h1><?php echo (isset($not_found_template_page) ? $not_found_template_page->post_title : __("404 Page Not Found", 'renovate')); ?></h1>
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
							<?php echo (isset($not_found_template_page) ? $not_found_template_page->post_title : __("404 Page Not Found", 'renovate')); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix">
		<?php
		if(function_exists("vc_map"))
		{
			if(count($not_found_template_page_array) && isset($not_found_template_page))
			{
				echo wpb_js_remove_wpautop(apply_filters('the_content', $not_found_template_page->post_content));
				global $post;
				$post = $not_found_template_page;
				setup_postdata($post);
			}
			else
			{
				echo wpb_js_remove_wpautop(apply_filters('the_content', '[vc_row top_margin="none" el_class="margin-top-70"][vc_column type="" top_margin="none" width="1/1"][featured_item icon="construction" type="big" title="' . esc_attr__("404: PAGE NOT FOUND", 'renovate') . '" counter="0" top_margin="none"]' . __("We're sorry but we can't seem to find the page you requested.<br>This might be because you have typed the web address incorrectly.", 'renovate') . '[/featured_item][/vc_column][/vc_row][vc_row top_margin="none" el_class="padding-top-54 padding-bottom-17 align-center"][vc_column type="" top_margin="none" width="1/1"][vc_btn type="read_more" icon="none" title="' . esc_attr__("GO TO HOME", 'renovate') . '" url="' . esc_url(get_home_url()) . '" top_margin="none"][/vc_column][/vc_row]'));		
			}
		}
		else
		{
		?>
			<div class="vc_row wpb_row vc_row-fluid margin-top-70">
				<div class="wpb_column vc_column_container vc_col-sm-12">
					<div class="wpb_wrapper">
						<div class="feature-item sl-large-construction feature-item-big">
							<div class="ornament"></div>
							<h4 class="box-header page-margin-top"><?php _e("404: PAGE NOT FOUND", 'renovate');?></h4>
							<p><?php _e("We’re sorry but we can’t seem to find the page you requested.<br>This might be because you have typed the web address incorrectly.", 'renovate');?></p>
						</div>
					</div>
				</div>
			</div>
			<div class="vc_row wpb_row vc_row-fluid padding-top-54 padding-bottom-17 align-center">
				<div class="wpb_column vc_column_container vc_col-sm-12">
					<div class="wpb_wrapper">
						<a class="more" href="<?php echo esc_url(get_home_url());?>" title="<?php esc_attr_e('GO TO HOME', 'renovate');?>"><?php _e("GO TO HOME", 'renovate');?></a>
					</div>
				</div>
			</div>
		<?php
		}
		?>
	</div>
</div>
<?php
get_footer(); 
?>
