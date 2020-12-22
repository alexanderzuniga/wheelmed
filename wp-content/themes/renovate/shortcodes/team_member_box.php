<?php
//author
function re_theme_team_member_box($atts, $content)
{
	extract(shortcode_atts(array(
		"featured_image" => '',
		"headers" => 1,
		"headers_links" => 1,
		"headers_border" => 1,
		"show_subtitle" => 1,
		"show_excerpt" => 1,
		"show_social_icons" => 1,
		"show_featured_image" => 1,
		"featured_image_links" => 1,
		"top_margin" => "none"
	), $atts));
	
	global $post;
	setup_postdata($post);
	
	$output = "";
	$output .= '<div class="team-box' . (!empty($top_margin) && $top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">';
	$external_url = get_post_meta(get_the_ID(), "external_url", true);
	$external_url_target = get_post_meta(get_the_ID(), "external_url_target", true);
	if((int)$show_featured_image)
	{
		if((int)$featured_image_links)
			$output .= '<a' . ($external_url!="" && $external_url_target=="new_window" ? ' target="_blank"' : '') . ' href="' . ($external_url!="" ? esc_url($external_url) : esc_url(get_permalink())) . '" title="' . esc_attr(get_the_title()) . '">';
		if(!empty($featured_image))
		{
			$featured_image_id = preg_replace('/[^\d]/', '', $featured_image);
			$output .= wp_get_attachment_image($featured_image_id, "big-thumb");
		}
		else
			$output .= get_the_post_thumbnail(get_the_ID(), "big-thumb" , array("alt" => get_the_title(), "title" => ""));
		if((int)$featured_image_links)
			$output .= '</a>';
	}
	$arrayEmpty = true;
	if((int)$show_social_icons)
	{
		$icon_type = get_post_meta(get_the_ID(), "social_icon_type", true);	
		for($j=0; $j<count($icon_type); $j++)
		{
			if($icon_type[$j]!="")
				$arrayEmpty = false;
		}
	}
	if((int)$show_subtitle)
		$subtitle = get_post_meta(get_the_ID(), "subtitle", true);
	if((int)$headers || ((int)$show_subtitle && !empty($subtitle)) || ((int)$show_excerpt && has_excerpt()))
		$output .= '<div class="team-content' . (!(int)$headers && (!(int)$show_subtitle || empty($subtitle)) ? ' padding-top-0' : '') . '">';
	if((int)$headers || ((int)$show_subtitle && !empty($subtitle)))
		$output .= '<h4' . ((int)$headers_border ? ' class="box-header"' : '') . '>' . ((int)$headers ? ((int)$headers_links ? '<a' . ($external_url!="" && $external_url_target=="new_window" ? ' target="_blank"' : '') . ' href="' . ($external_url!="" ? esc_url($external_url) : esc_url(get_permalink())) . '" title="' . esc_attr(get_the_title()) . '">' : '') . get_the_title() .  ((int)$headers_links ? '</a>' : '') : '') . ((int)$show_subtitle && !empty($subtitle) ? '<span>' . $subtitle . '</span>' : '') . '</h4>';
	if((int)$show_excerpt && has_excerpt())
		$output .= apply_filters('the_excerpt', get_the_excerpt());
	if((int)$headers || ((int)$show_subtitle && !empty($subtitle)) || ((int)$show_excerpt && has_excerpt()))
		$output .= '</div>';
	if(!$arrayEmpty)
	{
		$icon_url = get_post_meta(get_the_ID(), "social_icon_url", true);
		$icon_target = get_post_meta(get_the_ID(), "social_icon_target", true);
		$output .= '<ul class="social-icons' . (!(int)$show_featured_image ? ' social-static clearfix' : '') . '">';
		for($j=0; $j<count($icon_type); $j++)
		{
			if($icon_type[$j]!="")
				$output .= '<li><a class="social-' . esc_attr($icon_type[$j]) . '" href="' . esc_url($icon_url[$j]) . '"' . (isset($icon_target[$j]) && $icon_target[$j]=='new_window' ? ' target="_blank"' : '') . ' title="">&nbsp;</a></li>';
		}
		$output .= '</ul>';
	}
	$output .= '</div>';
		
	return $output;
}

//visual composer
function re_theme_team_member_box_vc_init()
{
	$params = array(
		array(
			"type" => "attach_image",
			"class" => "",
			"heading" => __("Alternative featured image", 'renovate'),
			"param_name" => "featured_image",
			"value" => ''
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Header", 'renovate'),
			"param_name" => "headers",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Header link", 'renovate'),
			"param_name" => "headers_links",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Header border", 'renovate'),
			"param_name" => "headers_border",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show subtitle", 'renovate'),
			"param_name" => "show_subtitle",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show excerpt", 'renovate'),
			"param_name" => "show_excerpt",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show social icons", 'renovate'),
			"param_name" => "show_social_icons",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Show featured image", 'renovate'),
			"param_name" => "show_featured_image",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Featured image link", 'renovate'),
			"param_name" => "featured_image_links",
			"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0),
			"dependency" => Array('element' => "show_featured_image", 'value' => '1')
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
		"name" => __("Team Member Box", 'renovate'),
		"base" => "team_member_box",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-custom-post-type",
		"category" => __('Renovate', 'renovate'),
		"params" => $params
	));
}
add_action("init", "re_theme_team_member_box_vc_init");
?>
