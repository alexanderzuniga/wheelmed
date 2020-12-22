<?php
//post
function re_theme_featured_item($atts, $content)
{
	extract(shortcode_atts(array(
		"icon" => "none",
		"type" => "default",
		"title" => "",
		"counter" => "0",
		"url" => "",
		"title_link" => 1,
		"icon_link" => 1,
		"top_margin" => "none"
	), $atts));
	
	$output = "";
	$output .= '<div class="feature-item' . ($icon!="none" ? ' sl-' . ($type=="big" ? 'large' : 'small') . '-' . esc_attr($icon) : ' no-icon') . ($type=="big" ? ' feature-item-big' : '') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">';
	if(!empty($url) && (int)$icon_link && $icon!="none")
		$output .= '<a href="' . esc_url($url) . '" class="featured-item-icon-url">&nbsp;</a>';
	if($type=="big" && $icon!="none")
		$output .= '<div class="ornament"></div>';
	if((int)$counter>0)
		$output .= '<span class="number animated-element" data-value="' . (int)esc_attr($counter) . '"></span>';
	if($title!="")
		$output .= '<h4' . ($type=="big" ? ' class="box-header page-margin-top"' : '') . '>' . (!empty($url) && (int)$title_link ? '<a href="' . esc_url($url) . '">' : '') . $title . (!empty($url) && (int)$title_link ? '</a>' : '') . '</h4>';
	if($content!="")
		$output .= '<p>' . $content . '</p>';
	$output .= '</div>';
	return $output;
}

//visual composer
function re_theme_featured_item_vc_init()
{
	$params = array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon", 'renovate'),
			"param_name" => "icon",
			"value" => array(
				__("none", 'renovate') => "none",
				__("bricks", 'renovate') => "bricks",
				__("briefcase", 'renovate') => "briefcase",
				__("brush-1", 'renovate') => "brush-1",
				__("brush-2", 'renovate') => "brush-2",
				__("bubble", 'renovate') => "bubble",
				__("bubble check", 'renovate') => "bubble-check",
				__("bucket", 'renovate') => "bucket",
				__("building", 'renovate') => "building",
				__("calculator", 'renovate') => "calculator",
				__("camera", 'renovate') => "camera",
				__("cart-1", 'renovate') => "cart-1",
				__("cart-2", 'renovate') => "cart-2",
				__("chat", 'renovate') => "chat",
				__("clock", 'renovate') => "clock",
				__("cone", 'renovate') => "cone",
				__("construction", 'renovate') => "construction",
				__("conversation", 'renovate') => "conversation",
				__("lab", 'renovate') => "documents",
				__("door", 'renovate') => "door",
				__("driller", 'renovate') => "driller",
				__("eco", 'renovate') => "eco",
				__("faq", 'renovate') => "faq",
				__("fax", 'renovate') => "fax",
				__("fence", 'renovate') => "fence",
				__("forklift", 'renovate') => "forklift",
				__("garage", 'renovate') => "garage",
				__("gears", 'renovate') => "gears",
				__("globe", 'renovate') => "globe",
				__("hammer", 'renovate') => "hammer",
				__("helmet", 'renovate') => "helmet",
				__("house-1", 'renovate') => "house-1",
				__("house-2", 'renovate') => "house-2",
				__("key", 'renovate') => "key",
				__("documents", 'renovate') => "lab",
				__("lightbulb", 'renovate') => "lightbulb",
				__("list", 'renovate') => "list",
				__("location", 'renovate') => "location",
				__("lock", 'renovate') => "lock",
				__("mail", 'renovate') => "mail",
				__("measure", 'renovate') => "measure",
				__("megaphone", 'renovate') => "megaphone",
				__("payment", 'renovate') => "payment",
				__("pencil", 'renovate') => "pencil",
				__("percent", 'renovate') => "percent",
				__("person", 'renovate') => "person",
				__("phone", 'renovate') => "phone",
				__("photo", 'renovate') => "photo",
				__("picture", 'renovate') => "picture",
				__("plan", 'renovate') => "plan",
				__("poster", 'renovate') => "poster",
				__("quote", 'renovate') => "quote",
				__("roller", 'renovate') => "roller",
				__("ruler", 'renovate') => "ruler",
				__("scissors", 'renovate') => "scissors",
				__("screwdriver", 'renovate') => "screwdriver",
				__("shield", 'renovate') => "shield",
				__("shovel", 'renovate') => "shovel",
				__("speaker", 'renovate') => "speaker",
				__("stationery", 'renovate') => "stationery",
				__("team", 'renovate') => "team",
				__("tick", 'renovate') => "tick",
				__("trolley", 'renovate') => "trolley",
				__("trophy", 'renovate') => "trophy",
				__("trowel", 'renovate') => "trowel",
				__("truck", 'renovate') => "truck",
				__("video", 'renovate') => "video",
				__("wallet", 'renovate') => "wallet",
				__("watering-can", 'renovate') => "watering-can",
				__("wrench", 'renovate') => "wrench",
				__("wrenches", 'renovate') => "wrenches")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'renovate'),
			"param_name" => "type",
			"value" => array(__("Default", 'renovate') => "default",  __("Big", 'renovate') => "big")
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Title", 'renovate'),
			"param_name" => "title",
			"value" => ""
		),
		array(
			"type" => "textarea_html",
			"holder" => "div",
			"class" => "",
			"heading" => __("Text", 'renovate'),
			"param_name" => "content",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Counter value", 'renovate'),
			"param_name" => "counter",
			"value" => "0"
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Url", 'renovate'),
			"param_name" => "url",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Title link", 'renovate'),
			"param_name" => "title_link",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon link", 'renovate'),
			"param_name" => "icon_link",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'renovate'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'renovate') => "none", __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section")
		)
	);
	
	vc_map( array(
		"name" => __("Featured Item", 'renovate'),
		"base" => "featured_item",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-featured-item",
		"category" => __('Renovate', 'renovate'),
		"params" => $params
	));
}
add_action("init", "re_theme_featured_item_vc_init");
?>
