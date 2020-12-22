<?php
function re_theme_admin_init()
{
	wp_register_script("theme-colorpicker", get_template_directory_uri() . "/admin/js/colorpicker.js", array("jquery"));
	wp_register_script("theme-admin", get_template_directory_uri() . "/admin/js/theme_admin.js", array("jquery", "theme-colorpicker"));
	wp_register_script("jquery-bqq", get_template_directory_uri() . "/admin/js/jquery.ba-bbq.min.js", array("jquery"));
	wp_register_style("theme-colorpicker", get_template_directory_uri() . "/admin/style/colorpicker.css");
	wp_register_style("theme-admin-style", get_template_directory_uri() . "/admin/style/style.css");
	wp_register_style("theme-admin-style-rtl", get_template_directory_uri() . "/admin/style/rtl.css");
}
add_action("admin_init", "re_theme_admin_init");

function re_theme_admin_print_scripts()
{
	wp_enqueue_script('jquery');
	wp_enqueue_script('jquery-bqq');
	wp_enqueue_script('jquery-ui-core');
	wp_enqueue_script('jquery-ui-tabs');
	wp_enqueue_script('theme-admin');
	wp_enqueue_script('media-upload');
	wp_enqueue_script('thickbox');
	wp_enqueue_style('thickbox');
	wp_enqueue_style("google-font-open-sans", "//fonts.googleapis.com/css?family=Open+Sans:400,600");
	wp_enqueue_style("google-font-raleway", "//fonts.googleapis.com/css?family=Raleway:400,500,600,700");
	wp_enqueue_style("re-social", get_template_directory_uri() ."/fonts/social/styles.css");
	wp_enqueue_style("re-streamline-small", get_template_directory_uri() ."/fonts/streamline-small/styles.css");
	
	$sidebars = array(
		"default" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		),
		"template-blog.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		),
		"single.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		),
		"single-ql_services.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		),
		"single-ql_team.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		),
		"single-re_projects.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		),
		"search.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		),
		"template-default-without-breadcrumbs.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		),
		"404.php" => array(
			array(
				"name" => "footer_top",
				"label" => __("footer top", 'renovate')
			),
			array(
				"name" => "footer_bottom",
				"label" => __("footer bottom", 'renovate')
			)
		)
	);
	//get theme sidebars
	$theme_sidebars = array();
	$theme_sidebars_array = get_posts(array(
		'post_type' => 'renovate_sidebars',
		'posts_per_page' => '-1',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'order' => 'ASC'
	));
	$theme_sidebars[0]["id"] = -1;
	$theme_sidebars[0]["title"] = __("None", 'renovate');
	for($i=1; $i<=count($theme_sidebars_array); $i++)
	{
		$theme_sidebars[$i]["id"] = $theme_sidebars_array[$i-1]->ID;
		$theme_sidebars[$i]["title"] = $theme_sidebars_array[$i-1]->post_title;
	}

	$data = array(
		'img_url' =>  get_template_directory_uri() . "/images/",
		'admin_img_url' =>  get_template_directory_uri() . "/admin/images/",
		'sidebar_label' => __('Sidebar', 'renovate'),
		'sidebars' => $sidebars,
		'theme_sidebars' => $theme_sidebars,
		'page_sidebars' => get_post_meta(get_the_ID(), "renovate_page_sidebars", true),
		'themename' => 'renovate',
		'import_confirmation_message' => __('Please confirm the dummy data import.', 'renovate'),
		'shop_import_confirmation_message' => __('Please confirm the shop dummy data import.', 'renovate'),
		'import_in_progress_message' => __("Please wait and don't reload the page when import is in progress!", 'renovate'),
		'import_error_message' => __('Error during import:', 'renovate')
	);
	//pass data to javascript
	$params = array(
		'l10n_print_after' => 'config = ' . json_encode($data) . ';'
	);
	wp_localize_script("theme-admin", "config", $params);
}

function re_theme_admin_print_scripts_colorpicker()
{	
	wp_enqueue_script('theme-admin');
	wp_enqueue_script('theme-colorpicker');
	wp_enqueue_style('theme-colorpicker');
}

function re_theme_admin_print_scripts_all()
{
	global $theme_options;
	wp_enqueue_style('theme-admin-style');
	if(((is_rtl() || $theme_options["direction"]=='rtl') && ((isset($_COOKIE["re_direction"]) && $_COOKIE["re_direction"]!="LTR") || !isset($_COOKIE["re_direction"]))) || (isset($_COOKIE["re_direction"]) && $_COOKIE["re_direction"]=="RTL"))
		wp_enqueue_style('theme-admin-style-rtl');
}

function re_theme_admin_menu_theme_options() 
{
	add_action("admin_print_scripts", "re_theme_admin_print_scripts_all");
	add_action("admin_print_scripts-post-new.php", "re_theme_admin_print_scripts");
	add_action("admin_print_scripts-post.php", "re_theme_admin_print_scripts");
	add_action("admin_print_scripts-appearance_page_ThemeOptions", "re_theme_admin_print_scripts");
	add_action("admin_print_scripts-appearance_page_ThemeOptions", "re_theme_admin_print_scripts_colorpicker");
}
add_action("admin_menu", "re_theme_admin_menu_theme_options");
	
//visual composer
//if(function_exists("vc_add_shortcode_param"))
//{
	//dropdownmulti
	function re_dropdownmultiple_settings_field($settings, $value)
	{
		$value = ($value==null ? array() : $value);
		if(!is_array($value))
			$value = explode(",", $value);
		$output = '<select name="'.esc_attr($settings['param_name']).'" class="wpb_vc_param_value wpb-input wpb-select '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'" multiple>';
				foreach ( $settings['value'] as $text_val => $val ) {
					if ( is_numeric($text_val) && is_string($val) || is_numeric($text_val) && is_numeric($val) ) {
						$text_val = $val;
					}
				   // $val = strtolower(str_replace(array(" "), array("_"), $val));
					$selected = '';
					if ( in_array($val,$value) ) $selected = ' selected="selected"';
					$output .= '<option class="'.esc_attr($val).'" value="'.esc_attr($val).'"'.esc_attr($selected).'>'.$text_val.'</option>';
				}
				$output .= '</select>';
		return $output;
	}
	//hidden
	function re_hidden_settings_field($settings, $value) 
	{
	   return '<input name="'.esc_attr($settings['param_name'])
				 .'" class="wpb_vc_param_value wpb-textinput '
				 .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="hidden" value="'
				 .esc_attr($value).'"/>';
	}
	//readonly
	function re_readonly_settings_field($settings, $value) 
	{
	   return '<input name="'.esc_attr($settings['param_name'])
				 .'" class="wpb_vc_param_value wpb-textinput '
				 .esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'_field" type="text" readonly="readonly" value="'
				 .esc_attr($value).'"/>';
	}
	//add item button
	function re_listitem_settings_field($settings, $value)
	{
		$value = explode(",", $value);
		$output = '<input type="button" value="' . esc_attr__('Add list item', 'renovate') . '" name="'.esc_attr($settings['param_name']).'" class="button '.esc_attr($settings['param_name']).' '.esc_attr($settings['type']).'" style="width: auto; padding: 0 10px 1px;"/>';
		return $output;
	}
	//add item window
	function re_listitemwindow_settings_field($settings, $value)
	{
		$value = explode(",", $value);
		$output = '<div class="listitemwindow vc_panel vc_shortcode-edit-form" name="'.esc_attr($settings['param_name']).'">
			<div class="vc_panel-heading">
				<a class="vc_close" href="#" title="' . esc_attr__("Close panel", 'renovate') . '"><i class="vc_icon"></i></a>
				<h3 class="vc_panel-title">' . __('Add New List Item', 'renovate') . '</h3>
			</div>
			<div class="modal-body wpb-edit-form" style="display: block;min-height: auto;">
				<div class="vc_row-fluid wpb_el_type_textfield">
					<div class="wpb_element_label">' . __("Text", 'renovate') . '</div>
					<div class="edit_form_line">
						<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_content">
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_textfield">
					<div class="wpb_element_label">' . __("Url", 'renovate') . '</div>
					<div class="edit_form_line">
						<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_url">
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_dropdown">
					<div class="wpb_element_label">' . __("Url target", 'renovate') . '</div>
					<div class="edit_form_line">
						<select class="wpb_vc_param_value wpb-input wpb-select item_url_target dropdown" name="item_url_target">
							<option selected="selected" value="new_window">' . __("new window", 'renovate') . '</option>
							<option value="same_window">' . __("same window", 'renovate') . '</option>
						</select>
					</div>
				</div>
				<div class="vc_row-fluid wpb_el_type_dropdown">
					<div class="wpb_element_label">' . __("Icon", 'renovate') . '</div>
					<div class="edit_form_line">
						<select class="wpb_vc_param_value wpb-input wpb-select item_type dropdown" name="item_icon">
							<option selected="selected" value="">' . __("-", 'renovate') . '</option>
							<option value="bullet">' . __("Bullet", 'renovate') . '</option>
						</select>
					</div>
				</div>
				<div class="wpb_el_type_colorpicker vc_wrapper-param-type-colorpicker vc_shortcode-param vc_column" data-vc-ui-element="panel-shortcode-param" data-vc-shortcode-param-name="item_content_color" data-param_type="colorpicker" data-param_settings="{&quot;type&quot;:&quot;colorpicker&quot;}">
					<div class="wpb_element_label">' . __("Custom text color", 'renovate') . '</div>
					<div class="edit_form_line">
						<div class="color-group">
							<div class="wp-picker-container vc_color-picker">
								<span class="wp-picker-input-wrap">
									<input name="item_content_color" class="wpb_vc_param_value wpb-textinput item_content_color colorpicker_field vc_color-control wp-color-picker" type="text">
									<input class="button button-small hidden wp-picker-clear" value="Clear" type="button">
								</span>
							</div>
						</div>
					</div>
				</div>
				<div class="edit_form_actions" style="padding-top: 20px;">
					<a id="add-item-shortcode" class="button-primary" href="#">' . __("Add Item", 'renovate') . '</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="cancel-item-options button" href="#">' . __("Cancel", 'renovate') . '</a>
				</div>
			</div>
		</div>';
		return $output;
	}
//}
/*
//attach_images_custom
add_shortcode_param('attach_images_custom' , attach_images_custom_settings_field);
function attach_images_custom_settings_field($settings, $value)
{
	$param_line = '';
	
	// TODO: More native way
	$param_value = wpb_removeNotExistingImgIDs($value);
	$param_line .= '<input type="hidden" class="wpb_vc_param_value gallery_widget_attached_images_ids '.$settings['param_name'].' '.$settings['type'].'" name="'.$settings['param_name'].'" value="'.$param_value.'"/>';
	//$param_line .= '<a class="button gallery_widget_add_images" href="#" title="'.__('Add images', "renovate").'">'.__('Add images', "renovate").'</a>';
	$param_line .= '<div class="gallery_widget_attached_images">';
	$param_line .= '<ul class="gallery_widget_attached_images_list">';
	$param_line .= ($param_value != '') ? fieldAttachedImages(explode(",", $param_value)) : '';
	$param_line .= '</ul>';
	$param_line .= '</div>';
	$param_line .= '<div class="gallery_widget_site_images">';
	// $param_line .= siteAttachedImages(explode(",", $param_value));
	$param_line .= '</div>';
	$param_line .= '<a class="gallery_widget_add_images" href="#" title="'.__('Add images', "renovate").'">'.__('Add images', "renovate").'</a>';//class: button
	//$param_line .= '<div class="wpb_clear"></div>';
	for($i=0; $i<count(explode(",", $param_value)); $i++)
	{
		$param_line .= '<div class="row-fluid wpb_el_type_textfield">
				<div class="wpb_element_label">' . __("Text", 'renovate') . '</div>
				<div class="edit_form_line">
					<input type="text" value="" class="wpb_vc_param_value wpb-textinput textfield" name="item_content' . $i . '">
				</div>
			</div>';
	}
	return $param_line;
}*/
?>