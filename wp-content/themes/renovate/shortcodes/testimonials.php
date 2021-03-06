<?php
function renovate_testimonials_shortcode($atts)
{
	global $theme_options;
	extract(shortcode_atts(array(
		"type" => "big",
		"pagination" => 1,
		"testimonials_count" => 1,
		"autoplay" => 0,
		"pause_on_hover" => 1,
		"scroll" => 1,
		"effect" => "scroll",
		"easing" => "easeInOutQuint",
		"duration" => 750,
		"ontouch" => 0,
		"onmouse" => 0,
		"top_margin" => "none",
		"el_class" => ""
	), $atts));
	if($effect=="_fade")
		$effect = "fade";
	if(strpos($easing, 'ease')!==false)
	{
		$newEasing = 'ease';
		if(strpos($easing, 'inout')!==false)
			$newEasing .= 'InOut';
		else if(strpos($easing, 'in')!==false)
			$newEasing .= 'In';
		else if(strpos($easing, 'out')!==false)
			$newEasing .= 'Out';
		$newEasing .= ucfirst(substr($easing, strlen($newEasing), strlen($easing)-strlen($newEasing)));
	}
	else
		$newEasing = $easing;
	
	$output = '<div class="testimonials-container' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . (!empty($type) ? ' type-' . esc_attr($type) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '">';
	if(empty($type) || $type=="big")
		$output .= '<a href="#" class="slider-control left template-arrow-left-1"></a>';
	else if((int)$pagination)
		$output .= '<div class="re-carousel-pagination"></div>';
	$output .= '<ul class="testimonials-list autoplay-' . esc_attr($autoplay) . ' pause_on_hover-' . esc_attr($pause_on_hover) . ' scroll-' . esc_attr($scroll) . ' effect-' . esc_attr($effect) . ' easing-' . esc_attr($newEasing) . ' duration-' . esc_attr($duration) . ((int)$ontouch ? ' ontouch' : '') . ((int)$onmouse ? ' onmouse' : '') . '">';
	
	if(is_rtl())
	{
		for($i=$testimonials_count-1; $i>=0; $i--)
		{
			$output .= '<li' . (!empty($atts["testimonials_icon" . $i]) && $atts["testimonials_icon" . $i]!="" && $atts["testimonials_icon" . $i]!="none" && (empty($type) || (!empty($type) && $type=="big")) ? ' class="sl-small-' . esc_attr($atts["testimonials_icon" . $i]) . '"' : '') . '>
					' . (isset($atts["testimonials_icon" . $i]) && $atts["testimonials_icon" . $i]!="" && $atts["testimonials_icon" . $i]!="none" && (empty($type) || (!empty($type) && $type=="big")) ? '<div class="ornament"></div>' : '') . '
					' . (isset($atts["testimonials_title" . $i]) && $atts["testimonials_title" . $i]!="" ? '<p>' . str_replace('``', '"', $atts["testimonials_title" . $i]) . '</p>' : '') . '
					' . (!empty($type) && $type=="small" ? '<div class="ornament' . (!empty($atts["testimonials_icon" . $i]) && $atts["testimonials_icon" . $i]!="" && $atts["testimonials_icon" . $i]!="none" ? ' sl-small-' . esc_attr($atts["testimonials_icon" . $i]) : ' empty-circle') . '"></div>' : '') . '
					' . ((isset($atts["testimonials_author" . $i]) && $atts["testimonials_author" . $i]!="") || (isset($atts["testimonials_author_subtext" . $i]) && $atts["testimonials_author_subtext" . $i]!="") ? '<div class="author-details-box">' : '') . '
					' . (isset($atts["testimonials_author" . $i]) && $atts["testimonials_author" . $i]!="" ? '<div class="author">' . $atts["testimonials_author" . $i] . '</div>' : '') . '
					' . (isset($atts["testimonials_author_subtext" . $i]) && $atts["testimonials_author_subtext" . $i]!="" ? '<div class="author-details">' . $atts["testimonials_author_subtext" . $i] . '</div>' : '') . '
					' . ((isset($atts["testimonials_author" . $i]) && $atts["testimonials_author" . $i]!="") || (isset($atts["testimonials_author_subtext" . $i]) && $atts["testimonials_author_subtext" . $i]!="") ? '</div>' : '') . '
				</li>';
		}
	}
	else
	{
		for($i=0; $i<$testimonials_count; $i++)
		{
			$output .= '<li' . (!empty($atts["testimonials_icon" . $i]) && $atts["testimonials_icon" . $i]!="" && $atts["testimonials_icon" . $i]!="none" && (empty($type) || (!empty($type) && $type=="big")) ? ' class="sl-small-' . esc_attr($atts["testimonials_icon" . $i]) . '"' : '') . '>
					' . (isset($atts["testimonials_icon" . $i]) && $atts["testimonials_icon" . $i]!="" && $atts["testimonials_icon" . $i]!="none" && (empty($type) || (!empty($type) && $type=="big")) ? '<div class="ornament"></div>' : '') . '
					' . (isset($atts["testimonials_title" . $i]) && $atts["testimonials_title" . $i]!="" ? '<p>' . str_replace('``', '"', $atts["testimonials_title" . $i]) . '</p>' : '') . '
					' . (!empty($type) && $type=="small" ? '<div class="ornament' . (!empty($atts["testimonials_icon" . $i]) && $atts["testimonials_icon" . $i]!="" && $atts["testimonials_icon" . $i]!="none" ? ' sl-small-' . esc_attr($atts["testimonials_icon" . $i]) : ' empty-circle') . '"></div>' : '') . '
					' . ((isset($atts["testimonials_author" . $i]) && $atts["testimonials_author" . $i]!="") || (isset($atts["testimonials_author_subtext" . $i]) && $atts["testimonials_author_subtext" . $i]!="") ? '<div class="author-details-box">' : '') . '
					' . (isset($atts["testimonials_author" . $i]) && $atts["testimonials_author" . $i]!="" ? '<div class="author">' . $atts["testimonials_author" . $i] . '</div>' : '') . '
					' . (isset($atts["testimonials_author_subtext" . $i]) && $atts["testimonials_author_subtext" . $i]!="" ? '<div class="author-details">' . $atts["testimonials_author_subtext" . $i] . '</div>' : '') . '
					' . ((isset($atts["testimonials_author" . $i]) && $atts["testimonials_author" . $i]!="") || (isset($atts["testimonials_author_subtext" . $i]) && $atts["testimonials_author_subtext" . $i]!="") ? '</div>' : '') . '
				</li>';
		}
	}
	$output .= '</ul>';
	if(empty($type) || $type=="big")
		$output .= '<a href="#" class="slider-control right template-arrow-left-1"></a>';
	$output .= '</div>';
	return $output;
}

$count = array();
for($i=1; $i<=30; $i++)
	$count[$i] = $i;
	
$params = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Type", 'renovate'),
		"param_name" => "type",
		"value" => array(__("Big", 'renovate') => "big", __("Small", 'renovate') => "small")
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Display pagination", 'renovate'),
		"param_name" => "pagination",
		"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0),
		"dependency" => Array('element' => "type", 'value' => "small")
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Number of testimonials", 'renovate'),
		"param_name" => "testimonials_count",
		"value" => $count
	)
);
for($i=0; $i<30; $i++)
{
	$params[] = array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Icon", 'renovate') . " " . ($i+1),
		"param_name" => "testimonials_icon" . $i,
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
	);
	$params[] = array(
		"type" => "textfield",
		"heading" => __("Text", 'renovate') . " " . ($i+1),
		"param_name" => "testimonials_title" . $i,
		"value" => "Sample Sentence Text"
	);
	$params[] = array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Author", 'renovate') . " " . ($i+1),
		"param_name" => "testimonials_author" . $i,
		"value" => ""
	);
	$params[] = array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Author subtitle", 'renovate') . " " . ($i+1),
		"param_name" => "testimonials_author_subtext" . $i,
		"value" => ""
	);
}
$params = array_merge($params, array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Autoplay", 'renovate'),
		"param_name" => "autoplay",
		"value" => array(__("No", 'renovate') => 0, __("Yes", 'renovate') => 1)
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Pause on hover", 'renovate'),
		"param_name" => "pause_on_hover",
		"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0),
		"dependency" => Array('element' => "autoplay", 'value' => "1")
	),
	/*array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Scroll", 'renovate'),
		"param_name" => "scroll",
		"value" => 1,
		"description" => __("Number of items to scroll in one step", 'renovate')
	),*/
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Effect", 'renovate'),
		"param_name" => "effect",
		"value" => array(
			__("scroll", 'renovate') => "scroll", 
			__("none", 'renovate') => "none", 
			__("directscroll", 'renovate') => "directscroll",
			__("fade", 'renovate') => "_fade",
			__("crossfade", 'renovate') => "crossfade",
			__("cover", 'renovate') => "cover",
			__("uncover", 'renovate') => "uncover"
		)
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Sliding easing", 'renovate'),
		"param_name" => "easing",
		"value" => array(
			__("easeInOutQuint", 'renovate') => "easeInOutQuint",
			__("swing", 'renovate') => "swing", 
			__("linear", 'renovate') => "linear", 
			__("easeInQuad", 'renovate') => "easeInQuad",
			__("easeOutQuad", 'renovate') => "easeOutQuad",
			__("easeInOutQuad", 'renovate') => "easeInOutQuad",
			__("easeInCubic", 'renovate') => "easeInCubic",
			__("easeOutCubic", 'renovate') => "easeOutCubic",
			__("easeInOutCubic", 'renovate') => "easeInOutCubic",
			__("easeInQuart", 'renovate') => "easeInQuart",
			__("easeOutQuart", 'renovate') => "easeOutQuart",
			__("easeInOutQuart", 'renovate') => "easeInOutQuart",
			__("easeInSine", 'renovate') => "easeInSine",
			__("easeOutSine", 'renovate') => "easeOutSine",
			__("easeInOutSine", 'renovate') => "easeInOutSine",
			__("easeInExpo", 'renovate') => "easeInExpo",
			__("easeOutExpo", 'renovate') => "easeOutExpo",
			__("easeInOutExpo", 'renovate') => "easeInOutExpo",
			__("easeInQuint", 'renovate') => "easeInQuint",
			__("easeOutQuint", 'renovate') => "easeOutQuint",
			__("easeInCirc", 'renovate') => "easeInCirc",
			__("easeOutCirc", 'renovate') => "easeOutCirc",
			__("easeInOutCirc", 'renovate') => "easeInOutCirc",
			__("easeInElastic", 'renovate') => "easeInElastic",
			__("easeOutElastic", 'renovate') => "easeOutElastic",
			__("easeInOutElastic", 'renovate') => "easeInOutElastic",
			__("easeInBack", 'renovate') => "easeInBack",
			__("easeOutBack", 'renovate') => "easeOutBack",
			__("easeInOutBack", 'renovate') => "easeInOutBack",
			__("easeInBounce", 'renovate') => "easeInBounce",
			__("easeOutBounce", 'renovate') => "easeOutBounce",
			__("easeInOutBounce", 'renovate') => "easeInOutBounce"
		)
	),
	array(
		"type" => "textfield",
		"class" => "",
		"heading" => __("Sliding transition speed (ms)", 'renovate'),
		"param_name" => "duration",
		"value" => 750
	),
	/*array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Slide on touch", 'renovate'),
		"param_name" => "ontouch",
		"value" => array(__("No", 'renovate') => 0, __("Yes", 'renovate') => 1)
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Slide on mouse", 'renovate'),
		"param_name" => "onmouse",
		"value" => array(__("No", 'renovate') => 0, __("Yes", 'renovate') => 1)
	),*/
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Top margin", 'renovate'),
		"param_name" => "top_margin",
		"value" => array(__("None", 'renovate') => "none", __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section")
	),
	array(
		'type' => 'textfield',
		'heading' => __( 'Extra class name', 'renovate' ),
		'param_name' => 'el_class',
		'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'renovate' )
	)
));
vc_map( array(
	"name" => __("Testimonials", 'renovate'),
	"base" => "re_testimonials",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-testimonials",
	"category" => __('Renovate', 'renovate'),
	"params" => $params
));
?>