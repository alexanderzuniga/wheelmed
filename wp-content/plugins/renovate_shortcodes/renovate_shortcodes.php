<?php
/*
Plugin Name: Renovate Theme Shortcodes
Plugin URI: https://1.envato.market/quanticalabs-portfolio
Description: Renovate Theme Shortcodes plugin
Author: QuanticaLabs
Author URI: https://1.envato.market/quanticalabs-portfolio
Version: 1.0
*/

function renovate_shortcodes_vc_init()
{
	if(function_exists("vc_map"))
	{
		add_shortcode("re_contact_form", "re_theme_contact_form_shortcode");
		add_shortcode("announcement_box", "re_theme_announcement_box_shortcode");
		add_shortcode("blog", "re_theme_blog");
		add_shortcode("blog_2_columns", "re_theme_blog_2_columns");
		add_shortcode("blog_3_columns", "re_theme_blog_3_columns");
		add_shortcode("blog_small", "re_theme_blog_small");
		add_shortcode("call_to_action_box", "re_theme_call_to_action_box");
		add_shortcode("comments", "re_theme_comments");
		add_shortcode("featured_item", "re_theme_featured_item");
		add_shortcode("items_list", "re_theme_items_list");
		add_shortcode("item", "re_theme_item");
		add_shortcode("re_map", "re_theme_map_shortcode");
		add_shortcode("our_clients_carousel", "re_theme_our_clients_carousel");
		add_shortcode("re_post_carousel", "re_theme_post_carousel_shortcode");
		add_shortcode("box_header", "re_theme_box_header");
		add_shortcode("vc_btn", "re_theme_button");
		add_shortcode("single_post", "re_theme_single_post");
		add_shortcode("single_project", "re_theme_single_project");
		add_shortcode("single_service", "re_theme_single_service");
		add_shortcode("single_team", "re_theme_single_team");
		add_shortcode("team_member_box", "re_theme_team_member_box");
		add_shortcode("re_testimonials", "renovate_testimonials_shortcode");
		add_shortcode("timeline_item", "re_theme_timeline_item");
		if(function_exists("vc_add_shortcode_param"))
		{
			vc_add_shortcode_param('dropdownmulti' , 're_dropdownmultiple_settings_field');
			vc_add_shortcode_param('hidden', 're_hidden_settings_field');
			vc_add_shortcode_param('readonly', 're_readonly_settings_field');
			vc_add_shortcode_param('listitem' , 're_listitem_settings_field');
			vc_add_shortcode_param('listitemwindow' , 're_listitemwindow_settings_field');
		}
	}
}
add_action("init", "renovate_shortcodes_vc_init");
?>