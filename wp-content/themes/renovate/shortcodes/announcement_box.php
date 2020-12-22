<?php
function re_theme_announcement_box_shortcode($atts)
{
	extract(shortcode_atts(array(
		"header" => "",
		"header_expose" => "",
		"button_label" => "",
		"button_url" => "",
		"icon" => "bricks",
		/*"button_color" => "",
		"button_custom_color" => "",
		"button_hover_color" => "",
		"button_hover_custom_color" => "",
		"button_text_color" => "#FFFFFF",
		"button_hover_text_color" => "#ED1C24",*/
		"top_margin" => "none"
	), $atts));
	
	/*$button_color = ($button_custom_color!="" ? $button_custom_color : $button_color);
	$button_hover_color = ($button_hover_custom_color!="" ? $button_hover_custom_color : $button_hover_color);*/
	
	$output = '<div class="announcement clearfix' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">
					<div class="vc_row wpb_row vc_row-fluid">
						<div class="vc_col-sm-9 wpb_column vc_column_container">
							<div class="vertical-align">
								<div class="vertical-align-cell sl-small-' . esc_attr($icon) . '">
									' . ($header!="" ? '<h3>' . $header . '</h3>' : '')	. ($header_expose!="" ? '<p class="description">' . $header_expose . '</p>' : '') . '
								</div>
							</div>
						</div>';
	if($button_label!="")
		$output .= '<div class="vc_col-sm-3 wpb_column vc_column_container">
						<div class="vertical-align">
							<div class="vertical-align-cell">
								<a title="' . esc_attr($button_label) . '" href="' . esc_url($button_url) . '" class="more">' . $button_label . '</a>
							</div>
						</div>
					</div>';
	$output .= '</div>
			</div>';
	//<a' . ($button_color!="" || $button_text_color!="" ? ' style="' . ($button_color!="" ? 'background-color:' . $button_color . ';border-color:' . $button_color . ';' : '') . ($button_text_color!="" ? 'color:' . $button_text_color . ';': '') . '"' : '') . ($button_hover_color!="" || $button_hover_text_color!="" ? ' onMouseOver="' . ($button_hover_color!="" ? 'this.style.backgroundColor=\''.$button_hover_color.'\';this.style.borderColor=\''.$button_hover_color.'\';' : '' ) . ($button_hover_text_color!="" ? 'this.style.color=\''.$button_hover_text_color.'\';' : '' ) . '" onMouseOut="' . ($button_hover_color!="" ? 'this.style.backgroundColor=\''.$button_color.'\';this.style.borderColor=\''.$button_color.'\';' : '' ) . ($button_hover_text_color!="" ? 'this.style.color=\''.$button_text_color.'\';' : '') . '"' : '') . ' title="' . esc_attr($button_label) . '" href="' . esc_attr($button_url) . '" class="more active' . ' ' . $button_size . ($animation!='' ? ' animated_element animation-' . $animation . ((int)$animation_duration>0 && (int)$animation_duration!=600 ? ' duration-' . (int)$animation_duration : '') . ((int)$animation_delay>0 ? ' delay-' . (int)$animation_delay : '') : '') . '">' . $button_label . '</a>
	return $output;
}

//visual composer
$re_colors_arr = array(__("Red", "renovate") => "#ed1c24", __("Dark red", "renovate") => "#c03427", __("Light red", "renovate") => "#f37548", __("Dark blue", "renovate") => "#3156a3", __("Blue", "renovate") => "#0384ce", __("Light blue", "renovate") => "#42b3e5", __("Black", "renovate") => "#000000", __("Gray", "renovate") => "#AAAAAA", __("Dark gray", "renovate") => "#444444", __("Light gray", "renovate") => "#CCCCCC", __("Green", "renovate") => "#43a140", __("Dark green", "renovate") => "#008238", __("Light green", "renovate") => "#7cba3d", __("Orange", "renovate") => "#f17800", __("Dark orange", "renovate") => "#cb451b", __("Light orange", "renovate") => "#ffa800", __("Turquoise", "renovate") => "#0097b5", __("Dark turquoise", "renovate") => "#006688", __("Turquoise", "renovate") => "#00b6cc", __("Light turquoise", "renovate") => "#00b6cc", __("Violet", "renovate") => "#6969b3", __("Dark violet", "renovate") => "#3e4c94", __("Light violet", "renovate") => "#9187c4", __("White", "renovate") => "#FFFFFF", __("Yellow", "renovate") => "#fec110");
vc_map( array(
	"name" => __("Announcement box", 'renovate'),
	"base" => "announcement_box",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-announcement-box",
	"category" => __('Renovate', 'renovate'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Header", 'renovate'),
			"param_name" => "header",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Header expose", 'renovate'),
			"param_name" => "header_expose",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button label", 'renovate'),
			"param_name" => "button_label",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __("Button url", 'renovate'),
			"param_name" => "button_url",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon", 'renovate'),
			"param_name" => "icon",
			"value" => array(
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
		/*array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button color", 'renovate'),
			"param_name" => "button_color",
			"value" => array(__("Dark blue", 'renovate') => "blue", __("Blue", 'renovate') => "dark_blue", __("Light", 'renovate') => "light")
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom button color", 'renovate'),
			"param_name" => "custom_button_color",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button size", 'renovate'),
			"param_name" => "button_size",
			"value" => array(__("Big", 'renovate') => "big", __("Medium", 'renovate') => "medium", __("Small", 'renovate') => "")
		),*/
        /*array(
            "type" => "dropdown",
            "heading" => __("Button color", "renovate"),
            "param_name" => "button_color",
            "value" => $re_colors_arr
        ),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom button color", 'renovate'),
			"param_name" => "button_custom_color",
			"value" => ""
		),
		array(
            "type" => "dropdown",
            "heading" => __("Button hover Color", "renovate"),
            "param_name" => "button_hover_color",
            "value" => $re_colors_arr
        ),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("or pick custom button hover color", 'renovate'),
			"param_name" => "button_hover_custom_color",
			"value" => ""
		),
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button text color", 'renovate'),
			"param_name" => "button_text_color",
			"value" => "#FFFFFF"
		),*/
		array(
			"type" => "colorpicker",
			"holder" => "div",
			"class" => "",
			"heading" => __("Button Hover text color", 'renovate'),
			"param_name" => "button_hover_text_color",
			"value" => "#ED1C24"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'renovate'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'renovate') => "none", __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section")
		)
	)
));
?>
