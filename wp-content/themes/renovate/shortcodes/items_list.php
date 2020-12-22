<?php
//items list
function re_theme_items_list($atts, $content)
{
	extract(shortcode_atts(array(
		"class" => "",
		"top_margin" => "none"
	), $atts));
	
	$output = '<ul class="list' . ($class!='' ? ' ' . esc_attr($class) : '') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">' . wpb_js_remove_wpautop($content) . '</ul>';
	return $output;
}

//items list
function re_theme_item($atts, $content)
{
	extract(shortcode_atts(array(
		"icon" => "bullet",
		"class" => "",
		"url" => "",
		"url_target" => "",
		"text_color" => ""
	), $atts));
	
	$output = '<li class="' . ($icon!="" || $class!="" ? ($icon!="" ? 'template-' . esc_attr($icon) . ' ': '') . ($class!="" ? esc_attr($class) . ' ' : '') : '') . '"' . ($text_color!='' ? ' style="' . ($text_color!='' ? 'color:' . esc_attr($text_color) . ';' : '') . '"' : '') . '>' . '<' . ($url!="" ? 'a href="' . esc_attr($url) . '"' . ($url_target=='new_window' ? ' target="_blank"' : '') : 'span') . ($text_color!='' ? ' style="color: ' . esc_attr($text_color) . ';"' : '') . '>' . do_shortcode($content) . '</' . ($url!="" ? 'a' : 'span') . '>';
	$output .= '</li>';

	return $output;
}

//visual composer
vc_map( array(
	"name" => __("Items list", 'renovate'),
	"base" => "items_list",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-items-list",
	"category" => __('Renovate', 'renovate'),
	"params" => array(
		/*array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'renovate'),
			"param_name" => "type",
			"value" => array(__("Items list", 'renovate') => 'items', __("Info list", 'renovate') => 'info', __("Scrolling list", 'renovate') => 'scrolling', __("Simple list", 'renovate') => 'simple',)
		),*/
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Content", 'renovate'),
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "listitem",
			"class" => "",
			"param_name" => "additembutton",
			"value" => "Add list item"
		),
		array(
			"type" => "listitemwindow",
			"class" => "",
			"param_name" => "additemwindow",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'renovate'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'renovate') => "none", __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section")
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Extra class name", 'renovate'),
			"param_name" => "class",
			"value" => ""
		)
	)
));
?>