<?php
$themename = "renovate";
/*function your_prefix_vcSetAsTheme() 
{
	vc_set_as_theme();
}
add_action('init', 'your_prefix_vcSetAsTheme');*/
if(function_exists('set_revslider_as_theme'))
{
	function renovate_set_revolution_as_theme() 
	{
		set_revslider_as_theme();
	}
	add_action('init', 'renovate_set_revolution_as_theme');
}

//plugins activator
require_once("plugins_activator.php");

//for is_plugin_active
include_once( ABSPATH . 'wp-admin/includes/plugin.php');

//vc_remove_element("vc_row_inner");
if(function_exists("vc_remove_element"))
{
	vc_remove_element("vc_gmaps");
	vc_remove_element("vc_tour");
	vc_remove_element("vc_separator");
	vc_remove_element("vc_text_separator");
}

//theme options
re_get_theme_file("/theme-options.php");

//menu walker
re_get_theme_file("/mobile_menu_walker.php");

//custom meta box
re_get_theme_file("/meta-box.php");

if(function_exists("vc_map"))
{
	//contact_form
	re_get_theme_file("/contact_form.php");
	//shortcodes
	re_get_theme_file("/shortcodes/shortcodes.php");
}

//comments
re_get_theme_file("/comments-functions.php");

//widgets
re_get_theme_file("/widgets/widget-contact-info.php");
re_get_theme_file("/widgets/widget-contact-details.php");
re_get_theme_file("/widgets/widget-contact-details-list.php");
re_get_theme_file("/widgets/widget-list.php");
re_get_theme_file("/widgets/widget-recent.php");
re_get_theme_file("/widgets/widget-social-icons.php");
re_get_theme_file("/widgets/widget-cart-icon.php");

function re_theme_after_setup_theme()
{
	global $themename;
	//set default theme options
	if(!get_option($themename . "_installed") || !get_option("wpb_js_content_types"))
	{		
		$theme_options = array(
			"favicon_url" => get_template_directory_uri() . "/images/favicon.ico",
			"logo_url" => "",
			"logo_text" => "RENOVATE",
			"footer_text" => sprintf(__('© Copyright 2020 <a target="_blank" title="%s" href="%s" rel="nofollow">Renovate Theme</a> by <a target="_blank" title="%s" href="%s">QuanticaLabs</a>', 'renovate'), esc_html__('Renovate Theme', 'renovate'), esc_url(__('https://1.envato.market/renovate-construction-renovation-wordpress-theme', 'renovate')), esc_html__('QuanticaLabs', 'renovate'), esc_url(__('http://quanticalabs.com', 'renovate'))),
			"sticky_menu" => 0,
			"responsive" => 1,
			"scroll_top" => 1,
			"layout" => 'fullwidth',
			"layout_style" => '',
			"layout_image_overlay" => '',
			"style_selector" => 0,
			"direction" => "default",
			"collapsible_mobile_submenus" => 1,
			"google_api_code" => "",
			"google_recaptcha" => "",
			"google_recaptcha_comments" => "",
			"recaptcha_site_key" => "",
			"recaptcha_secret_key" => "",
			"ga_tracking_code" => "",
			"cf_admin_name" => get_option("admin_email"),
			"cf_admin_email" => get_option("admin_email"),
			"cf_smtp_host" => "",
			"cf_smtp_username" => "",
			"cf_smtp_password" => "",
			"cf_smtp_port" => "",
			"cf_smtp_secure" => "",
			"cf_email_subject" => "Renovate WP: Contact from WWW",
			"cf_template" => "<html>
	<head>
	</head>
	<body>
		<div><b>Name</b>: [name]</div>
		<div><b>E-mail</b>: [email]</div>
		<div><b>Phone</b>: [phone]</div>
		<div><b>Message</b>: [message]</div>
		[form_data]
	</body>
</html>",
			"cf_name_message" => __("Please enter your name.", 'renovate'),
			"cf_email_message" => __("Please enter valid e-mail.", 'renovate'),
			"cf_phone_message" => __("Please enter your phone number.", 'renovate'),
			"cf_message_message" => __("Please enter your message.", 'renovate'),
			"cf_recaptcha_message" => __("Please verify captcha.", 'renovate'),
			"cf_terms_message" => __("Checkbox is required.", 'renovate'),
			"cf_thankyou_message" => __("Thank you for contacting us", 'renovate'),
			"cf_error_message" => __("Sorry, we can't send this message", 'renovate'),
			"cf_name_message_comments" => __("Please enter your name.", 'renovate'),
			"cf_email_message_comments" => __("Please enter valid e-mail.", 'renovate'),
			"cf_comment_message_comments" => __("Please enter your message.", 'renovate'),
			"cf_recaptcha_message_comments" => __("Please verify captcha.", 'renovate'),
			"cf_terms_message_comments" => __("Checkbox is required.", 'renovate'),
			"cf_thankyou_message_comments" => __("Your comment has been added.", 'renovate'),
			"cf_error_message_comments" => __("Error while adding comment.", 'renovate'),
			"site_background_color" => '',
			"main_color" => '',
			"header_top_sidebar" => '',
			"primary_font" => '',
			"primary_font_custom" => ''
		);
		add_option($themename . "_options", $theme_options);
		
		add_option("wpb_js_content_types", array(
			"page",
			"re_projects",
			"re_services",
			"ql_services",
			"ql_team")
		);
		
		global $wp_rewrite;
		$wp_rewrite->flush_rules();
		add_option($themename . "_installed", 1);
	}
	//set default cost calculator options
	if(is_plugin_active("ql-cost-calculator/ql-cost-calculator.php"))
	{
		if(!get_option($themename . "cost_calculator_installed"))
		{
			$cost_calculator_global_form_options = array(
				"calculator_skin" => "renovate",
				"main_color" => "F4BC16",
				"box_color" => "F5F5F5",
				"text_color" => "444444",
				"border_color" => "E2E6E7",
				"label_color" => "25282A",
				"form_label_color" => "",
				"inactive_color" => "E2E6E7",
				"primary_font_custom" => "",
				"primary_font" => "",
				"primary_font_subset" => "",
				"secondary_font_custom" => "",
				"secondary_font" => "Raleway:300",
				"secondary_font_subset" => array("latin", "latin-ext"),
				"send_email" => 1,
				"save_calculation" => 1,
				"calculation_status" => "draft",
				"google_recaptcha" => 0,
				"recaptcha_site_key" => "",
				"recaptcha_secret_key" => ""
			);
			update_option("cost_calculator_global_form_options", $cost_calculator_global_form_options);
			add_option($themename . "cost_calculator_installed", 1);
		}
	}
	
	//Make theme available for translation
	//Translations can be filed in the /languages/ directory
	load_theme_textdomain('renovate', get_template_directory() . '/languages');
	
	//woocommerce
	add_theme_support("woocommerce", array(
		'gallery_thumbnail_image_width' => 150)
	);
	add_theme_support("wc-product-gallery-zoom");
	add_theme_support("wc-product-gallery-lightbox");
	add_theme_support("wc-product-gallery-slider");
	
	//register thumbnails
	add_theme_support("post-thumbnails");
	add_image_size("blog-post-thumb", 750, 500, true);
	add_image_size("project-thumb", 570, 380, true);
	add_image_size("large-thumb", 480, 480, true);
	add_image_size("big-thumb", 480, 320, true);
	add_image_size("medium-thumb", 390, 260, true);
	add_image_size("small-thumb", 270, 180, true);
	add_image_size("tiny-thumb", 90, 90, true);
	
	//enable custom background
	add_theme_support("custom-background"); //3.4
	//add_custom_background(); //deprecated
	
	//enable feed links
	add_theme_support("automatic-feed-links");
	
	//title tag
	add_theme_support("title-tag");
	
	//gutenberg
	add_theme_support("wp-block-styles");
	add_theme_support("align-wide");
	add_theme_support("editor-color-palette", array(
		array(
			'name' => __("renovate yellow", 'renovate'),
			'slug' => 'renovate-yellow',
			'color' => '#F4BC16',
		),
		array(
			'name' => __("renovate turquoise", 'renovate' ),
			'slug' => 'renovate-turquoise',
			'color' => '#5FC7AE',
		),
		array(
			'name' => __("renovate orange", 'renovate' ),
			'slug' => 'renovate-orange',
			'color' => '#F68220',
		),
		array(
			'name' => __("renovate green", 'renovate' ),
			'slug' => 'renovate-green',
			'color' => '#82B541',
		),
		array(
			'name' => __("renovate light blue", 'renovate' ),
			'slug' => 'renovate-light-blue',
			'color' => '#66A1C3',
		)
	));
	
	//register menus
	if(function_exists("register_nav_menu"))
	{
		register_nav_menu("main-menu", "Main Menu");
	}
	
	//custom theme filters
	add_filter('upload_mimes', 're_custom_upload_files');
	//using shortcodes in sidebar
	add_filter("widget_text", "do_shortcode");
	add_filter("image_size_names_choose", "re_theme_image_sizes");
	add_filter('wp_list_categories','re_category_count_span');
	add_filter('get_archives_link', 're_archive_count_span');
	add_filter('excerpt_more', 're_theme_excerpt_more', 99);
	add_filter('post_class', 're_check_image');
	add_filter('user_contactmethods', 're_contactmethods', 10, 1);
	add_filter('wp_title', 're_wp_title_filter', 10, 2);
	add_filter('site_transient_update_plugins', 'renovate_filter_update_vc_plugin', 10, 2);
	
	//custom theme woocommerce filters
	add_filter('woocommerce_pagination_args' , 're_woo_custom_override_pagination_args');
	add_filter('woocommerce_product_single_add_to_cart_text', 're_woo_custom_cart_button_text');
	add_filter('woocommerce_product_add_to_cart_text', 're_woo_custom_cart_button_text');
	add_filter('loop_shop_columns', 're_woo_custom_loop_columns');
	add_filter('woocommerce_product_description_heading', 're_woo_custom_product_description_heading');
	add_filter('woocommerce_checkout_fields' , 're_woo_custom_override_checkout_fields');
	add_filter('woocommerce_show_page_title', 're_woo_custom_show_page_title');
	add_filter('loop_shop_per_page', 're_loop_shop_per_page', 20);
	add_filter('woocommerce_review_gravatar_size', 're_woo_custom_review_gravatar_size');
	add_filter('theme_page_templates', 're_woocommerce_page_templates' , 11, 3);
		
	//custom theme actions
	if(!function_exists('_wp_render_title_tag')) 
		add_action('wp_head', 're_theme_slug_render_title');
	add_action("add_meta_boxes", "re_theme_add_ql_services_custom_box");
	add_action("save_post", "re_theme_save_ql_services_postdata");
	
	//custom theme woocommerce actions
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
	remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
	//remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 5);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 10);
	add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
	//add_action('woocommerce_after_shop_loop', 'woocommerce_result_count', 20);
	
	//phpMailer
	add_action('phpmailer_init', 're_phpmailer_init');
	
	//content width
	if(!isset($content_width)) 
		$content_width = 1050;
	
	//register sidebars
	if(function_exists("register_sidebar"))
	{
		//register custom sidebars
		$sidebars_list = get_posts(array( 
			'post_type' => $themename . '_sidebars',
			'posts_per_page' => '-1',
			'post_status' => 'publish',
			'orderby' => 'menu_order',
			'order' => 'ASC'
		));
		foreach($sidebars_list as $sidebar)
		{
			$before_widget = get_post_meta($sidebar->ID, "before_widget", true);
			$after_widget = get_post_meta($sidebar->ID, "after_widget", true);
			$before_title = get_post_meta($sidebar->ID, "before_title", true);
			$after_title = get_post_meta($sidebar->ID, "after_title", true);
			register_sidebar(array(
				"id" => $sidebar->post_name,
				"name" => $sidebar->post_title,
				'before_widget' => ($before_widget!='' && $before_widget!='empty' ? $before_widget : ''),
				'after_widget' => ($after_widget!='' && $after_widget!='empty' ? $after_widget : ''),
				'before_title' => ($before_title!='' && $before_title!='empty' ? $before_title : ''),
				'after_title' => ($after_title!='' && $after_title!='empty' ? $after_title : '')
			));
		}
	}
}
add_action("after_setup_theme", "re_theme_after_setup_theme");
function re_theme_switch_theme($theme_template)
{
	global $themename;
	delete_option($themename . "_installed");
}
add_action("switch_theme", "re_theme_switch_theme");

/* --- phpMailer config --- */
function re_phpmailer_init(PHPMailer $mail) 
{
	global $theme_options;
	$mail->CharSet='UTF-8';
	
	$smtp = $theme_options["cf_smtp_host"];
	if(!empty($smtp))
	{
		$mail->IsSMTP();
		$mail->SMTPAuth = true; 
		//$mail->SMTPDebug = 2;
		$mail->Host = $theme_options["cf_smtp_host"];
		$mail->Username = $theme_options["cf_smtp_username"];
		$mail->Password = $theme_options["cf_smtp_password"];
		if((int)$theme_options["cf_smtp_port"]>0)
			$mail->Port = (int)$theme_options["cf_smtp_port"];
		$mail->SMTPSecure = $theme_options["cf_smtp_secure"];
	}
}
 
function re_custom_template_for_vc() 
{
    $data = array();
    $data['name'] = __('Single Post Template', 'renovate');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
        [vc_row top_margin="none" el_class="margin-top-70"][vc_column type="" top_margin="none" width="3/4"][single_post featured_image_size="default" show_post_title="1" show_post_featured_image="1" show_post_excerpt="0" show_post_categories="1" show_post_date="1" show_post_author="1" show_post_views="1" show_post_comments="1" show_post_author_box="1" show_post_tags_footer="1" show_post_categories_footer="1" show_share_box="1" icons_count="1" icon_type0="behance" icon_type1="behance" icon_type2="behance" icon_type3="behance" icon_type4="behance" icon_type5="behance" icon_type6="behance" icon_type7="behance" icon_type8="behance" icon_type9="behance" icon_type10="behance" icon_type11="behance" icon_type12="behance" icon_type13="behance" icon_type14="behance" icon_type15="behance" icon_type16="behance" icon_type17="behance" icon_type18="behance" icon_type19="behance" icon_type20="behance" icon_type21="behance" icon_type22="behance" icon_type23="behance" icon_type24="behance" date_format="renovate" show_leave_reply_button="1"][comments show_comments_form="1" show_comments_list="1" top_margin="page-margin-top"][/vc_column][vc_column type="re-smart-column" top_margin="none" width="1/4"][call_to_action_box title="COST CALCULATOR" icon="wallet" button_label="REQUEST A QUOTE" button_url="#" button_target="" top_margin="none"]Use our form to estimate the initial cost of renovation or installation.[/call_to_action_box][box_header title="Latest Posts" type="h6" bottom_border="1" class="" top_margin="page-margin-top"][blog_small re_pagination="0" items_per_page="3" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="date" order="DESC" show_post_title="1" show_post_date="1" top_margin="none" el_class="margin-top-30" show_post_views="0"][box_header title="Most Viewed" type="h6" bottom_border="1" class="" top_margin="page-margin-top"][blog_small re_pagination="0" items_per_page="3" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="views" order="DESC" show_post_title="1" show_post_date="0" top_margin="none" el_class="margin-top-30" show_post_views="1"][box_header title="Text Widget" type="h6" bottom_border="1" class="" top_margin="page-margin-top"][vc_wp_text el_class="margin-top-24"]Here is a text widget settings ipsum lore tora dolor sit amet velum. Maecenas est velum, gravida <a href="#">Vehicula Dolor</a>[/vc_wp_text][vc_wp_categories options="" el_class="page-margin-top clearfix" title="Categories"][vc_wp_archives options="count" title="Archives" el_class="page-margin-top full-width clearfix"][vc_wp_tagcloud taxonomy="post_tag" title="Tags" el_class="page-margin-top clearfix"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Blog Template', 'renovate');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
        [vc_row top_margin="none" el_class="margin-top-70"][vc_column type="" top_margin="none" width="3/4"][blog re_pagination="1" items_per_page="6" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="date" order="DESC" show_post_title="1" show_post_excerpt="1" read_more="1" show_post_categories="1" show_post_author="1" show_post_date="1" show_post_views="1" show_post_comments="1" is_search_results="0" top_margin="none" date_format="renovate"][/vc_column][vc_column type="re-smart-column" top_margin="none" width="1/4"][call_to_action_box title="COST CALCULATOR" icon="wallet" button_label="REQUEST A QUOTE" button_url="#" top_margin="none"]Use our form to estimate the initial cost of renovation or installation.[/call_to_action_box][box_header title="Latest Posts" type="h6" bottom_border="1" top_margin="page-margin-top"][blog_small re_pagination="0" items_per_page="3" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="date" order="DESC" show_post_title="1" show_post_date="1" top_margin="none" el_class="margin-top-30" show_post_views="0"][box_header title="Most Viewed" type="h6" bottom_border="1" top_margin="page-margin-top"][blog_small re_pagination="0" items_per_page="3" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="views" order="DESC" show_post_title="1" show_post_date="0" top_margin="none" el_class="margin-top-30" show_post_views="1"][box_header title="Text Widget" type="h6" bottom_border="1" top_margin="page-margin-top"][vc_wp_text el_class="margin-top-24"]Here is a text widget settings ipsum lore tora dolor sit amet velum. Maecenas est velum, gravida <a href="#">Vehicula Dolor</a>[/vc_wp_text][vc_wp_categories options="" el_class="page-margin-top clearfix" title="Categories"][vc_wp_archives options="count" title="Archives" el_class="page-margin-top full-width clearfix"][vc_wp_tagcloud taxonomy="post_tag" title="Tags" el_class="page-margin-top clearfix"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Search Page Template', 'renovate');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
        [vc_row type="" top_margin="none" el_class="margin-top-70"][vc_column type="" top_margin="none" width="3/4"][blog re_pagination="1" items_per_page="6" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="date" order="DESC" show_post_title="1" show_post_excerpt="1" read_more="1" show_post_categories="1" show_post_author="1" show_post_date="1" date_format="renovate" show_post_views="1" show_post_comments="1" is_search_results="1" top_margin="none"][/vc_column][vc_column type="re-smart-column" top_margin="none" width="1/4"][call_to_action_box title="COST CALCULATOR" icon="wallet" button_label="REQUEST A QUOTE" button_url="#" button_target="" top_margin="none"]Use our form to estimate the initial cost of renovation or installation.[/call_to_action_box][box_header title="Latest Posts" type="h6" bottom_border="1" class="" top_margin="page-margin-top"][blog_small re_pagination="0" items_per_page="3" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="date" order="DESC" show_post_title="1" show_post_date="1" top_margin="none" el_class="margin-top-30" show_post_views="0"][box_header title="Most Viewed" type="h6" bottom_border="1" class="" top_margin="page-margin-top"][blog_small re_pagination="0" items_per_page="3" offset="0" featured_image_size="default" ids="-" category="-" author="-" order_by="views" order="DESC" show_post_title="1" show_post_date="0" top_margin="none" el_class="margin-top-30" show_post_views="1"][box_header title="Text Widget" type="h6" bottom_border="1" class="" top_margin="page-margin-top"][vc_wp_text el_class="margin-top-24"]Here is a text widget settings ipsum lore tora dolor sit amet velum. Maecenas est velum, gravida <a href="#">Vehicula Dolor</a>[/vc_wp_text][vc_wp_categories options="" el_class="page-margin-top clearfix" title="Categories"][vc_wp_archives options="count" title="Archives" el_class="page-margin-top full-width clearfix"][vc_wp_tagcloud taxonomy="post_tag" title="Tags" el_class="page-margin-top clearfix"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Single Project Template', 'renovate');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
        [vc_row top_margin="none" el_class="margin-top-70"][vc_column type="" top_margin="none" width="1/1"][single_project top_margin="none"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Single Service Template', 'renovate');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
        [vc_row top_margin="none" el_class="margin-top-70"][vc_column type="" top_margin="none" width="1/4"][vc_wp_custommenu nav_menu="22" el_class="vertical-menu"][call_to_action_box title="COST CALCULATOR" text="" icon="wallet" button_label="REQUEST A QUOTE" button_url="#" top_margin="page-margin-top"]Use our form to estimate the initial cost of renovation or installation.[/call_to_action_box][box_header title="Download Brochures" type="h6" bottom_border="1" top_margin="page-margin-top"][vc_btn type="action" icon="arrow-circle-down" title="Download Brochure" url="#" top_margin="none" extraclass="margin-top-30"][vc_btn type="action" icon="arrow-circle-down" url="#" top_margin="none" extraclass="margin-top-10" title="Download Summary"][/vc_column][vc_column type="" top_margin="none" width="3/4"][single_service show_social_icons="1" show_twitter="1" show_facebook="1" show_linkedin="1" show_skype="1" show_googleplus="1" show_instagram="1" top_margin="none"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Single Team Member Template', 'renovate');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
        [vc_row type="full-width" top_margin="page-margin-top-section"][vc_column][single_team][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
	
	$data = array();
    $data['name'] = __('Team Member Page Layout', 'renovate');
    $data['weight'] = 0;
    $data['image_path'] = preg_replace( '/\s/', '%20', get_template_directory_uri() . '/admin/images/visual_composer/layout.png');
    $data['custom_class'] = 'custom_template_for_vc_custom_template';
    $data['content'] = <<<CONTENT
        [vc_row][vc_column width="1/3"][team_member_box featured_image="" headers="1" headers_links="1" headers_border="0" show_subtitle="1" show_excerpt="0" show_social_icons="1" show_featured_image="1" featured_image_links="0"][/vc_column][vc_column width="1/3"][box_header title="RESUME" type="h3" bottom_border="1"][vc_raw_html el_class="align-left margin-top-40"]JTNDdGFibGUlM0UlMEElMDklM0N0Ym9keSUzRSUwQSUwOSUwOSUzQ3RyJTNFJTBBJTA5JTA5JTA5JTNDdGQlM0VOYW1lJTNBJTIwUGhpbGlwJTIwQnJvd2VyJTNDJTJGdGQlM0UlMEElMDklMDklM0MlMkZ0ciUzRSUwQSUwOSUwOSUzQ3RyJTNFJTBBJTA5JTA5JTA5JTNDdGQlM0VEYXRlJTIwb2YlMjBiaXJ0aCUzQSUyMDE5JTIwTm92ZW1iZXIlMjAxOTkwJTNDJTJGdGQlM0UlMEElMDklMDklM0MlMkZ0ciUzRSUwQSUwOSUwOSUzQ3RyJTNFJTBBJTA5JTA5JTA5JTNDdGQlM0VBZGRyZXNzJTNBJTIwMjcyJTIwTGluZGVuJTIwQXZlbnVlJTJDJTIwV2ludGVyJTIwUGFyayUzQyUyRnRkJTNFJTBBJTA5JTA5JTNDJTJGdHIlM0UlMEElMDklMDklM0N0ciUzRSUwQSUwOSUwOSUwOSUzQ3RkJTNFRW1haWwlM0ElMjAlM0NhJTIwaHJlZiUzRCUyN21haWx0byUzQXBoaWxpcC5icm93ZXIlNDBtYWlsLmNvbSUyNyUzRXBoaWxpcC5icm93ZXIlNDBtYWlsLmNvbSUzQyUyRmElM0UlM0MlMkZ0ZCUzRSUwQSUwOSUwOSUzQyUyRnRyJTNFJTBBJTA5JTA5JTNDdHIlM0UlMEElMDklMDklMDklM0N0ZCUzRVBob25lJTNBJTIwJTJCMTQ5JTIwNzUlMjAyMyUyMDIyMiUyMDM1JTNDJTJGdGQlM0UlMEElMDklMDklM0MlMkZ0ciUzRSUwQSUwOSUzQyUyRnRib2R5JTNFJTBBJTNDJTJGdGFibGUlM0U=[/vc_raw_html][/vc_column][vc_column width="1/3"][box_header title="PROFILE" type="h3" bottom_border="1"][vc_column_text el_class="margin-top-34"]Founded by Kevin Smith back in 2000, Renovate has established itself as one of the greatest and prestigous providers of construction focused interior renovation services and building.

We provide a professional renovation and installation services with a real focus on customer satisfaction. Our installations are carried out by fully trained staff to the highest professional standards. We can help you bring new life to existing rooms and develop unused spaces, from initial design and project specification to archieving a high end finish.[/vc_column_text][/vc_column][/vc_row][vc_row type="full-width" top_margin="page-margin-top-section" el_class="top-border"][vc_column][vc_row_inner top_margin="page-margin-top-section"][vc_column_inner width="1/3"][featured_item icon="key" title="TURNKEY"]We combine quality workmanship, superior knowledge and low prices.[/featured_item][/vc_column_inner][vc_column_inner width="1/3"][featured_item icon="person" title="RESOURCES"]We have the experience, personel and resources to make.[/featured_item][/vc_column_inner][vc_column_inner width="1/3"][featured_item icon="trolley" title="SUPPLY"]Work with us involves a carefully planned series of steps.[/featured_item][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row type="full-width" top_margin="page-margin-top-section" css=".vc_custom_1456404788489{background-color: #f5f5f5 !important;}" el_class="page-padding-top-section padding-bottom-50"][vc_column][vc_row_inner][vc_column_inner][box_header title="MY SKILLS" type="h3" bottom_border="1"][/vc_column_inner][/vc_row_inner][vc_row_inner el_class="margin-top-40"][vc_column_inner width="1/2"][vc_progress_bar values="%5B%7B%22label%22%3A%22Interior%20Renovation%22%2C%22value%22%3A%2295%22%7D%2C%7B%22label%22%3A%22Paver%20Walkways%22%2C%22value%22%3A%2272%22%7D%2C%7B%22label%22%3A%22Tiling%20and%20Painting%22%2C%22value%22%3A%2260%22%7D%5D" units="%"][/vc_column_inner][vc_column_inner width="1/2"][vc_progress_bar values="%5B%7B%22label%22%3A%22Solar%20Systems%22%2C%22value%22%3A%2275%22%7D%2C%7B%22label%22%3A%22Household%20Repairs%22%2C%22value%22%3A%2262%22%7D%2C%7B%22label%22%3A%22Design%20and%20Build%22%2C%22value%22%3A%2282%22%7D%5D" units="%"][/vc_column_inner][/vc_row_inner][/vc_column][/vc_row][vc_row el_class="page-padding-top-section"][vc_column width="2/3"][box_header title="MY EXPERIENCE" type="h3" bottom_border="1"][timeline_item label="2014-2015" title="HITACHI CONSTRUCT" subtitle="DIGGER OPERATOR" el_class="margin-top-40"]Paetos dignissim at cursus elefeind norma arcu. Pellentesque accumsan est in tempus etos ullamcorper, sem quam suscipit lacus maecenas tortor.[/timeline_item][timeline_item label="2012-2014" title="BRICK LTD" subtitle="FOREMAN"]Paetos dignissim at cursus elefeind norma arcu. Pellentesque accumsan est in tempus etos ullamcorper, sem quam suscipit lacus maecenas tortor.[/timeline_item][timeline_item label="2011-2012" title="HOME RENEW" subtitle="SENIOR FOREMAN"]Paetos dignissim at cursus elefeind norma arcu. Pellentesque accumsan est in tempus etos ullamcorper, sem quam suscipit lacus maecenas tortor.[/timeline_item][/vc_column][vc_column width="1/3"][box_header title="TESTIMONIALS" type="h3" bottom_border="1"][re_testimonials type="small" pagination="1" testimonials_count="2" testimonials_icon0="bucket" testimonials_title0="``We would like to thank Renovate Company for an outstanding effort on this recently completed project located in the Moscow. The project involved a very aggressive schedule and it was completed on time. We would certainly like to use their professional services.``" testimonials_author0="MITCHEL SMITH" testimonials_author_subtext0="INTERIOR RENOVATION" testimonials_icon1="camera" testimonials_title1="``We would like to thank Renovate Company for an outstanding effort on this recently completed project located in the Moscow. The project involved a very aggressive schedule and it was completed on time. We would certainly like to use their professional services.``" testimonials_author1="MITCHEL SMITH" testimonials_author_subtext1="INTERIOR RENOVATION" autoplay="0" scroll="1" duration="500" top_margin="page-margin-top" el_class="margin-top-40"][/vc_column][/vc_row]
CONTENT;
    vc_add_default_templates($data);
}
if(is_plugin_active("js_composer/js_composer.php") && function_exists("vc_set_default_editor_post_types"))
	add_action("vc_load_default_templates_action", "re_custom_template_for_vc");

/* --- Theme Custom Filters & Actions Functions --- */
//add new mimes for upload dummy content files (code can be removed after dummy content import)
function re_custom_upload_files($mimes) 
{
    $mimes = array_merge($mimes, array('xml' => 'application/xml'), array('json' => 'application/json'), array('zip' => 'application/zip'), array('gz' => 'application/x-gzip'), array('ico' => 'image/x-icon'));
    return $mimes;
}
function re_theme_image_sizes($sizes)
{
	$addsizes = array(
		"blog-post-thumb" => __("Blog post thumbnail", 'renovate'),
		"project-thumb" => __("Project thumbnail", 'renovate'),
		"large-thumb" => __("Large thumbnail", 'renovate'),
		"big-thumb" => __("Big thumbnail", 'renovate'),
		"medium-thumb" => __("Medium thumbnail", 'renovate'),
		"small-thumb" => __("Small thumbnail", 'renovate'),
		"tiny-thumb" => __("Tiny thumbnail", 'renovate'),
	);
	$newsizes = array_merge($sizes, $addsizes);
	return $newsizes;
}
function re_category_count_span($links) 
{
	$links = str_replace('</a> (', '<span>', $links);
	$links = str_replace(')', '</span></a>', $links);
	return $links;
}
function re_archive_count_span($links) 
{
	$links = str_replace('</a>&nbsp;(', '<span>', $links);
	$links = str_replace(')', '</span></a>', $links);
	return $links;
}
//excerpt
function re_theme_excerpt_more($more) 
{
	return '';
}
//sticky
function re_check_image($class) 
{
	if(is_sticky())
		$class[] = 'sticky';
	return $class;
}
//user info
function re_contactmethods($contactmethods) 
{
	$contactmethods['twitter'] = 'Twitter';
	$contactmethods['facebook'] = 'Facebook';
	$contactmethods['linkedin'] = 'Linkedin';
	$contactmethods['skype'] = 'Skype';
	$contactmethods['googleplus'] = 'Google Plus';
	$contactmethods['instagram'] = 'Instagram';
	return $contactmethods;
}
if(!function_exists('_wp_render_title_tag'))
{
    function re_theme_slug_render_title() 
	{
		echo ''. wp_title('-', true, 'right') . '';
    }
}
function re_wp_title_filter($title, $sep)
{
	//$title = get_bloginfo('name') . " | " . (is_home() || is_front_page() ? get_bloginfo('description') : $title);
	return $title;
}
function renovate_filter_update_vc_plugin($date) 
{
    if(!empty($date->checked["js_composer/js_composer.php"]))
        unset($date->checked["js_composer/js_composer.php"]);
    if(!empty($date->response["js_composer/js_composer.php"]))
        unset($date->response["js_composer/js_composer.php"]);
    return $date;
}

//Adds a box to the main column on the Services edit screens
function re_theme_add_ql_services_custom_box() 
{
	add_meta_box( 
        "ql_services_config",
        __("Options", 'renovate'),
        "re_theme_inner_ql_services_custom_box_main",
        "ql_services",
		"side",
		"core"
    );
}

function re_theme_inner_ql_services_custom_box_main($post)
{
	global $themename;
	//Use nonce for verification
	wp_nonce_field(plugin_basename( __FILE__ ), $themename . "_ql_services_noncename");
	
	//The actual fields for data entry
	$icon = get_post_meta($post->ID, "icon", true);
	$custom_url = get_post_meta($post->ID, "ql_services_custom_url", true);
	echo '
	<table>
		<tr>
			<td>
				<label for="icon">' . __('Icon', 'renovate') . ':</label>
			</td>
			<td>
				<select style="width: 120px;" id="ql_services_icon" name="ql_services_icon">
					<option value="-"' . (empty($icon) || $icon=="-" ? ' selected="selected"' : '') . '>' . __('none', 'renovate') . '</option>
					<option class="sl-small-bricks" value="sl-small-bricks"' . ($icon=="sl-small-bricks" || $icon=="bricks" ? ' selected="selected"' : '') . '>' . __('bricks', 'renovate') . '</option>
					<option class="sl-small-briefcase" value="sl-small-briefcase"' . ($icon=="sl-small-briefcase" || $icon=="briefcase" ? ' selected="selected"' : '') . '>' . __('briefcase', 'renovate') . '</option>
					<option class="sl-small-brush-1" value="sl-small-brush-1"' . ($icon=="sl-small-brush-1" || $icon=="brush-1" ? ' selected="selected"' : '') . '>' . __('brush-1', 'renovate') . '</option>
					<option class="sl-small-brush-2" value="sl-small-brush-2"' . ($icon=="sl-small-brush-2" || $icon=="brush-2" ? ' selected="selected"' : '') . '>' . __('brush-2', 'renovate') . '</option>
					<option class="sl-small-bubble" value="sl-small-bubble"' . ($icon=="sl-small-bubble" || $icon=="bubble" ? ' selected="selected"' : '') . '>' . __('bubble', 'renovate') . '</option>
					<option class="sl-small-bubble-check" value="sl-small-bubble-check"' . ($icon=="sl-small-bubble-check" || $icon=="bubble-check" ? ' selected="selected"' : '') . '>' . __('bubble-check', 'renovate') . '</option>
					<option class="sl-small-bucket" value="sl-small-bucket"' . ($icon=="sl-small-bucket" || $icon=="bucket" ? ' selected="selected"' : '') . '>' . __('bucket', 'renovate') . '</option>
					<option class="sl-small-building" value="sl-small-building"' . ($icon=="sl-small-building" || $icon=="building" ? ' selected="selected"' : '') . '>' . __('building', 'renovate') . '</option>
					<option class="sl-small-calculator" value="sl-small-calculator"' . ($icon=="sl-small-calculator" || $icon=="calculator" ? ' selected="selected"' : '') . '>' . __('calculator', 'renovate') . '</option>
					<option class="sl-small-camera" value="sl-small-camera"' . ($icon=="sl-small-camera" || $icon=="camera" ? ' selected="selected"' : '') . '>' . __('camera', 'renovate') . '</option>
					<option class="sl-small-cart-1" value="sl-small-cart-1"' . ($icon=="sl-small-cart-1" || $icon=="cart-1" ? ' selected="selected"' : '') . '>' . __('cart-1', 'renovate') . '</option>
					<option class="sl-small-cart-2" value="sl-small-cart-2"' . ($icon=="sl-small-cart-2" || $icon=="cart-2" ? ' selected="selected"' : '') . '>' . __('cart-2', 'renovate') . '</option>
					<option class="sl-small-chat" value="sl-small-chat"' . ($icon=="sl-small-chat" || $icon=="chat" ? ' selected="selected"' : '') . '>' . __('chat', 'renovate') . '</option>
					<option class="sl-small-clock" value="sl-small-clock"' . ($icon=="sl-small-clock" || $icon=="clock" ? ' selected="selected"' : '') . '>' . __('clock', 'renovate') . '</option>
					<option class="sl-small-cone" value="sl-small-cone"' . ($icon=="sl-small-cone" || $icon=="cone" ? ' selected="selected"' : '') . '>' . __('cone', 'renovate') . '</option>
					<option class="sl-small-construction" value="sl-small-construction"' . ($icon=="sl-small-construction" || $icon=="construction" ? ' selected="selected"' : '') . '>' . __('construction', 'renovate') . '</option>
					<option class="sl-small-conversation" value="sl-small-conversation"' . ($icon=="sl-small-conversation" || $icon=="conversation" ? ' selected="selected"' : '') . '>' . __('conversation', 'renovate') . '</option>
					<option class="sl-small-lab" value="sl-small-lab"' . ($icon=="sl-small-lab" || $icon=="lab" ? ' selected="selected"' : '') . '>' . __('lab', 'renovate') . '</option>
					<option class="sl-small-door" value="sl-small-door"' . ($icon=="sl-small-door" || $icon=="door" ? ' selected="selected"' : '') . '>' . __('door', 'renovate') . '</option>
					<option class="sl-small-driller" value="sl-small-driller"' . ($icon=="sl-small-driller" || $icon=="driller" ? ' selected="selected"' : '') . '>' . __('driller', 'renovate') . '</option>
					<option class="sl-small-eco" value="sl-small-eco"' . ($icon=="sl-small-eco" || $icon=="eco" ? ' selected="selected"' : '') . '>' . __('eco', 'renovate') . '</option>
					<option class="sl-small-faq" value="sl-small-faq"' . ($icon=="sl-small-faq" || $icon=="faq" ? ' selected="selected"' : '') . '>' . __('faq', 'renovate') . '</option>
					<option class="sl-small-fax" value="sl-small-fax"' . ($icon=="sl-small-fax" || $icon=="fax" ? ' selected="selected"' : '') . '>' . __('fax', 'renovate') . '</option>
					<option class="sl-small-fence" value="sl-small-fence"' . ($icon=="sl-small-fence" || $icon=="fence" ? ' selected="selected"' : '') . '>' . __('fence', 'renovate') . '</option>
					<option class="sl-small-forklift" value="sl-small-forklift"' . ($icon=="sl-small-forklift" || $icon=="forklift" ? ' selected="selected"' : '') . '>' . __('forklift', 'renovate') . '</option>
					<option class="sl-small-garage" value="sl-small-garage"' . ($icon=="sl-small-garage" || $icon=="garage" ? ' selected="selected"' : '') . '>' . __('garage', 'renovate') . '</option>
					<option class="sl-small-gears" value="sl-small-gears"' . ($icon=="sl-small-gears" || $icon=="gears" ? ' selected="selected"' : '') . '>' . __('gears', 'renovate') . '</option>
					<option class="sl-small-globe" value="sl-small-globe"' . ($icon=="sl-small-globe" || $icon=="globe" ? ' selected="selected"' : '') . '>' . __('globe', 'renovate') . '</option>
					<option class="sl-small-hammer" value="sl-small-hammer"' . ($icon=="sl-small-hammer" || $icon=="hammer" ? ' selected="selected"' : '') . '>' . __('hammer', 'renovate') . '</option>
					<option class="sl-small-helmet" value="sl-small-helmet"' . ($icon=="sl-small-helmet" || $icon=="helmet" ? ' selected="selected"' : '') . '>' . __('helmet', 'renovate') . '</option>
					<option class="sl-small-house-1" value="sl-small-house-1"' . ($icon=="sl-small-house-1" || $icon=="house-1" ? ' selected="selected"' : '') . '>' . __('house-1', 'renovate') . '</option>
					<option class="sl-small-house-2" value="sl-small-house-2"' . ($icon=="sl-small-house-2" || $icon=="house-2" ? ' selected="selected"' : '') . '>' . __('house-2', 'renovate') . '</option>
					<option class="sl-small-key" value="sl-small-key"' . ($icon=="sl-small-key" || $icon=="key" ? ' selected="selected"' : '') . '>' . __('key', 'renovate') . '</option>
					<option class="sl-small-documents" value="sl-small-documents"' . ($icon=="sl-small-documents" || $icon=="documents" ? ' selected="selected"' : '') . '>' . __('documents', 'renovate') . '</option>
					<option class="sl-small-lightbulb" value="sl-small-lightbulb"' . ($icon=="sl-small-lightbulb" || $icon=="lightbulb" ? ' selected="selected"' : '') . '>' . __('lightbulb', 'renovate') . '</option>
					<option class="sl-small-list" value="sl-small-list"' . ($icon=="sl-small-list" || $icon=="list" ? ' selected="selected"' : '') . '>' . __('list', 'renovate') . '</option>
					<option class="sl-small-location" value="sl-small-location"' . ($icon=="sl-small-location" || $icon=="location" ? ' selected="selected"' : '') . '>' . __('location', 'renovate') . '</option>
					<option class="sl-small-lock" value="sl-small-lock"' . ($icon=="sl-small-lock" || $icon=="lock" ? ' selected="selected"' : '') . '>' . __('lock', 'renovate') . '</option>
					<option class="sl-small-mail" value="sl-small-mail"' . ($icon=="sl-small-mail" || $icon=="mail" ? ' selected="selected"' : '') . '>' . __('mail', 'renovate') . '</option>
					<option class="sl-small-measure" value="sl-small-measure"' . ($icon=="sl-small-measure" || $icon=="measure" ? ' selected="selected"' : '') . '>' . __('measure', 'renovate') . '</option>
					<option class="sl-small-megaphone" value="sl-small-megaphone"' . ($icon=="sl-small-megaphone" || $icon=="megaphone" ? ' selected="selected"' : '') . '>' . __('megaphone', 'renovate') . '</option>
					<option class="sl-small-payment" value="sl-small-payment"' . ($icon=="sl-small-payment" || $icon=="payment" ? ' selected="selected"' : '') . '>' . __('payment', 'renovate') . '</option>
					<option class="sl-small-pencil" value="sl-small-pencil"' . ($icon=="sl-small-pencil" || $icon=="pencil" ? ' selected="selected"' : '') . '>' . __('pencil', 'renovate') . '</option>
					<option class="sl-small-percent" value="sl-small-percent"' . ($icon=="sl-small-percent" || $icon=="percent" ? ' selected="selected"' : '') . '>' . __('percent', 'renovate') . '</option>
					<option class="sl-small-person" value="sl-small-person"' . ($icon=="sl-small-person" || $icon=="person" ? ' selected="selected"' : '') . '>' . __('person', 'renovate') . '</option>
					<option class="sl-small-phone" value="sl-small-phone"' . ($icon=="sl-small-phone" || $icon=="phone" ? ' selected="selected"' : '') . '>' . __('phone', 'renovate') . '</option>
					<option class="sl-small-photo" value="sl-small-photo"' . ($icon=="sl-small-photo" || $icon=="photo" ? ' selected="selected"' : '') . '>' . __('photo', 'renovate') . '</option>
					<option class="sl-small-picture" value="sl-small-picture"' . ($icon=="sl-small-picture" || $icon=="picture" ? ' selected="selected"' : '') . '>' . __('picture', 'renovate') . '</option>
					<option class="sl-small-plan" value="sl-small-plan"' . ($icon=="sl-small-plan" || $icon=="plan" ? ' selected="selected"' : '') . '>' . __('plan', 'renovate') . '</option>
					<option class="sl-small-poster" value="sl-small-poster"' . ($icon=="sl-small-poster" || $icon=="poster" ? ' selected="selected"' : '') . '>' . __('poster', 'renovate') . '</option>
					<option class="sl-small-quote" value="sl-small-quote"' . ($icon=="sl-small-quote" || $icon=="quote" ? ' selected="selected"' : '') . '>' . __('quote', 'renovate') . '</option>
					<option class="sl-small-roller" value="sl-small-roller"' . ($icon=="sl-small-roller" || $icon=="roller" ? ' selected="selected"' : '') . '>' . __('roller', 'renovate') . '</option>
					<option class="sl-small-ruler" value="sl-small-ruler"' . ($icon=="sl-small-ruler" || $icon=="ruler" ? ' selected="selected"' : '') . '>' . __('ruler', 'renovate') . '</option>
					<option class="sl-small-scissors" value="sl-small-scissors"' . ($icon=="sl-small-scissors" || $icon=="scissors" ? ' selected="selected"' : '') . '>' . __('scissors', 'renovate') . '</option>
					<option class="sl-small-screwdriver" value="sl-small-screwdriver"' . ($icon=="sl-small-screwdriver" || $icon=="screwdriver" ? ' selected="selected"' : '') . '>' . __('screwdriver', 'renovate') . '</option>
					<option class="sl-small-shield" value="sl-small-shield"' . ($icon=="sl-small-shield" || $icon=="shield" ? ' selected="selected"' : '') . '>' . __('shield', 'renovate') . '</option>
					<option class="sl-small-shovel" value="sl-small-shovel"' . ($icon=="sl-small-shovel" || $icon=="shovel" ? ' selected="selected"' : '') . '>' . __('shovel', 'renovate') . '</option>
					<option class="sl-small-speaker" value="sl-small-speaker"' . ($icon=="sl-small-speaker" || $icon=="speaker" ? ' selected="selected"' : '') . '>' . __('speaker', 'renovate') . '</option>
					<option class="sl-small-stationery" value="sl-small-stationery"' . ($icon=="sl-small-stationery" || $icon=="stationery" ? ' selected="selected"' : '') . '>' . __('stationery', 'renovate') . '</option>
					<option class="sl-small-team" value="sl-small-team"' . ($icon=="sl-small-team" || $icon=="team" ? ' selected="selected"' : '') . '>' . __('team', 'renovate') . '</option>
					<option class="sl-small-tick" value="sl-small-tick"' . ($icon=="sl-small-tick" || $icon=="tick" ? ' selected="selected"' : '') . '>' . __('tick', 'renovate') . '</option>
					<option class="sl-small-trolley" value="sl-small-trolley"' . ($icon=="sl-small-trolley" || $icon=="trolley" ? ' selected="selected"' : '') . '>' . __('trolley', 'renovate') . '</option>
					<option class="sl-small-trophy" value="sl-small-trophy"' . ($icon=="sl-small-trophy" || $icon=="trophy" ? ' selected="selected"' : '') . '>' . __('trophy', 'renovate') . '</option>
					<option class="sl-small-trowel" value="sl-small-trowel"' . ($icon=="sl-small-trowel" || $icon=="trowel" ? ' selected="selected"' : '') . '>' . __('trowel', 'renovate') . '</option>
					<option class="sl-small-truck" value="sl-small-truck"' . ($icon=="sl-small-truck" || $icon=="truck" ? ' selected="selected"' : '') . '>' . __('truck', 'renovate') . '</option>
					<option class="sl-small-video" value="sl-small-video"' . ($icon=="sl-small-video" || $icon=="video" ? ' selected="selected"' : '') . '>' . __('video', 'renovate') . '</option>
					<option class="sl-small-wallet" value="sl-small-wallet"' . ($icon=="sl-small-wallet" || $icon=="wallet" ? ' selected="selected"' : '') . '>' . __('wallet', 'renovate') . '</option>
					<option class="sl-small-watering-can" value="sl-small-watering-can"' . ($icon=="sl-small-watering-can" || $icon=="watering-can" ? ' selected="selected"' : '') . '>' . __('watering-can', 'renovate') . '</option>
					<option class="sl-small-wrench" value="sl-small-wrench"' . ($icon=="sl-small-wrench" || $icon=="wrench" ? ' selected="selected"' : '') . '>' . __('wrench', 'renovate') . '</option>
					<option class="sl-small-wrenches" value="sl-small-wrenches"' . ($icon=="sl-small-wrenches" || $icon=="wrenches" ? ' selected="selected"' : '') . '>' . __('wrenches', 'renovate') . '</option>
				</select>
			</td>
		</tr>
		<tr>
			<td>
				<label>' . __('Custom url:', 'renovate') . '</label>
			</td>
			<td>
				<input class="regular-text" type="text" id="ql_services_custom_url" name="ql_services_custom_url" value="' . (!empty($custom_url) ? esc_attr($custom_url) : '') . '">
			</td>
		</tr>
	</table>';
}

//When the post is saved, saves our custom data
function re_theme_save_ql_services_postdata($post_id) 
{
	global $themename;
	//verify if this is an auto save routine. 
	//if it is our form has not been submitted, so we dont want to do anything
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) 
		return;

	//verify this came from the our screen and with proper authorization,
	//because save_post can be triggered at other times
	if (!isset($_POST[$themename . '_ql_services_noncename']) || !wp_verify_nonce($_POST[$themename . '_ql_services_noncename'], plugin_basename( __FILE__ )))
		return;


	//Check permissions
	if(!current_user_can('edit_post', $post_id))
		return;

	//OK, we're authenticated: we need to find and save the data
	update_post_meta($post_id, "icon", $_POST["ql_services_icon"]);
	update_post_meta($post_id, "ql_services_custom_url", $_POST["ql_services_custom_url"]);
}

/* --- Theme WooCommerce Custom Filters Functions --- */
function re_woo_custom_override_pagination_args($args) 
{
	$args['prev_text'] = __('&lsaquo;', 'renovate');
	$args['next_text'] = __('&rsaquo;', 'renovate');
	return $args;
}
function re_woo_custom_cart_button_text() 
{
	return __('ADD TO CART', 'renovate');
}
if(!function_exists('loop_columns')) 
{
	function re_woo_custom_loop_columns() 
	{
		return 3; // 3 products per row
	}
}
function re_woo_custom_product_description_heading() 
{
    return '';
}
function re_woo_custom_show_page_title()
{
	return false;
}
function re_loop_shop_per_page($cols)
{
	return 6;
}
function re_woo_custom_override_checkout_fields($fields) 
{
	$fields['billing']['billing_first_name']['placeholder'] = __("First Name", 'renovate');
	$fields['billing']['billing_last_name']['placeholder'] = __("Last Name", 'renovate');
	$fields['billing']['billing_company']['placeholder'] = __("Company Name", 'renovate');
	$fields['billing']['billing_email']['placeholder'] = __("Email Address", 'renovate');
	$fields['billing']['billing_phone']['placeholder'] = __("Phone", 'renovate');
	return $fields;
}
function re_woo_custom_review_gravatar_size()
{
	return 100;
}

function re_woocommerce_page_templates($page_templates, $class, $post)
{
	if(is_plugin_active('woocommerce/woocommerce.php'))
	{
		$shop_page_id = wc_get_page_id('shop');
		if($post && absint($shop_page_id) === absint($post->ID))
		{
			$page_templates["path-to-template/full-width.php"] = "Template Name";
		}
	}
 	return $page_templates;
}

//admin functions
re_get_theme_file("/admin/functions.php");

//theme options
global $theme_options;
$theme_options = array(
	"favicon_url" => '',
	"logo_url" => '',
	"logo_text" => '',
	"footer_text" => '',
	"sticky_menu" => '',
	"responsive" => '',
	"scroll_top" => '',
	"style_selector" => '',
	"direction" => '',
	"collapsible_mobile_submenus" => '',
	"google_api_code" => '',
	"google_recaptcha" => '',
	"google_recaptcha_comments" => '',
	"recaptcha_site_key" => '',
	"recaptcha_secret_key" => '',
	"ga_tracking_code" => '',
	"cf_admin_name" => '',
	"cf_admin_email" => '',
	"cf_smtp_host" => '',
	"cf_smtp_username" => '',
	"cf_smtp_password" => '',
	"cf_smtp_port" => '',
	"cf_smtp_secure" => '',
	"cf_email_subject" => '',
	"cf_template" => '',
	"cf_name_message" => '',
	"cf_email_message" => '',
	"cf_phone_message" => '',
	"cf_message_message" => '',
	"cf_recaptcha_message" => '',
	"cf_terms_message" => '',
	"cf_thankyou_message" => '',
	"cf_error_message" => '',
	"cf_name_message_comments" => '',
	"cf_email_message_comments" => '',
	"cf_comment_message_comments" => '',
	"cf_recaptcha_message_comments" => '',
	"cf_terms_message_comments" => '',
	"cf_thankyou_message_comments" => '',
	"cf_error_message_comments" => '',
	"site_background_color" => '',
	"main_color" => '',
	"header_top_sidebar" => '',
	"primary_font" => '',
	"primary_font_custom" => ''
);
$theme_options = re_theme_stripslashes_deep(array_merge($theme_options, (array)get_option($themename . "_options")));

function re_theme_enqueue_scripts()
{
	global $themename;
	global $theme_options;
	//style
	if($theme_options["primary_font"]!="" && $theme_options["primary_font_custom"]=="")
		wp_enqueue_style("google-font-primary", "//fonts.googleapis.com/css?family=" . urlencode($theme_options["primary_font"]) . (!empty($theme_options["primary_font_subset"]) ? "&subset=" . implode(",", $theme_options["primary_font_subset"]) : ""));
	else if($theme_options["primary_font_custom"]=="")
		wp_enqueue_style("google-font-raleway", "//fonts.googleapis.com/css?family=Raleway:100,300,400,500,600,700,900");
	wp_enqueue_style("reset", get_template_directory_uri() . "/style/reset.css");
	wp_enqueue_style("superfish", get_template_directory_uri() ."/style/superfish.css");
	wp_enqueue_style("prettyPhoto", get_template_directory_uri() ."/style/prettyPhoto.css");
	wp_enqueue_style("jquery-qtip", get_template_directory_uri() ."/style/jquery.qtip.css");
	wp_enqueue_style("odometer", get_template_directory_uri() ."/style/odometer-theme-default.css");
	wp_enqueue_style("animations", get_template_directory_uri() ."/style/animations.css");
	wp_enqueue_style("main-style", get_stylesheet_uri());
	if((int)$theme_options["responsive"])
		wp_enqueue_style("responsive", get_template_directory_uri() ."/style/responsive.css");
	else
		wp_enqueue_style("no-responsive", get_template_directory_uri() ."/style/no_responsive.css");

	if(is_plugin_active('woocommerce/woocommerce.php'))
	{
		wp_enqueue_style("woocommerce-custom", get_template_directory_uri() ."/woocommerce/style.css");
		if((int)$theme_options["responsive"])
			wp_enqueue_style("woocommerce-responsive", get_template_directory_uri() ."/woocommerce/responsive.css");
		else
			wp_dequeue_style("woocommerce-smallscreen");
		if(is_rtl())
			wp_enqueue_style("woocommerce-rtl", get_template_directory_uri() ."/woocommerce/rtl.css");
	}
	wp_enqueue_style("re-streamline-small", get_template_directory_uri() ."/fonts/streamline-small/styles.css");
	wp_enqueue_style("re-streamline-large", get_template_directory_uri() ."/fonts/streamline-large/styles.css");
	wp_enqueue_style("re-template", get_template_directory_uri() ."/fonts/template/styles.css");
	wp_enqueue_style("re-social", get_template_directory_uri() ."/fonts/social/styles.css");
	wp_enqueue_style("custom", get_template_directory_uri() ."/custom.css");
	//js
	wp_enqueue_script("jquery", false, array(), false, true);
	wp_enqueue_script("jquery-ui-core", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-accordion", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-tabs", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-selectmenu", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-slider", false, array("jquery"), false, true);
	wp_enqueue_script("jquery-ui-touch-punch", get_template_directory_uri() ."/js/jquery.ui.touch-punch.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-isotope", get_template_directory_uri() ."/js/jquery.isotope.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-ba-bqq", get_template_directory_uri() ."/js/jquery.ba-bbq.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-easing", get_template_directory_uri() ."/js/jquery.easing.1.3.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-carouFredSel", get_template_directory_uri() ."/js/jquery.carouFredSel-6.2.1-packed.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-touchSwipe", get_template_directory_uri() ."/js/jquery.touchSwipe.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-transit", get_template_directory_uri() ."/js/jquery.transit.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-hint", get_template_directory_uri() ."/js/jquery.hint.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-qtip", get_template_directory_uri() ."/js/jquery.qtip.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-block-ui", get_template_directory_uri() ."/js/jquery.blockUI.min.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-prettyPhoto", get_template_directory_uri() ."/js/jquery.prettyPhoto.js", array("jquery"), false, true);
	wp_enqueue_script("jquery-odometer", get_template_directory_uri() ."/js/odometer.min.js", array("jquery", "theme-main" ), false, true);
	wp_register_script("google-maps-v3", "//maps.google.com/maps/api/js" . ($theme_options["google_api_code"]!="" ? "?key=" . esc_attr($theme_options["google_api_code"]) : ""), array(), false, true);
	wp_register_script("google-recaptcha-v2", "//google.com/recaptcha/api.js", array(), false, true);
	if(function_exists("is_customize_preview") && !is_customize_preview())
		wp_enqueue_script("theme-main", get_template_directory_uri() ."/js/main.js", array("jquery", "jquery-ui-core", "jquery-ui-accordion", "jquery-ui-tabs"), false, true);
	
	//ajaxurl
	$data["ajaxurl"] = admin_url("admin-ajax.php");
	//themename
	$data["themename"] = $themename;
	//home url
	$data["home_url"] = esc_url(get_home_url());
	//is_rtl
	$data["is_rtl"] = ((is_rtl() || $theme_options["direction"]=='rtl') && ((isset($_COOKIE["re_direction"]) && $_COOKIE["re_direction"]!="LTR") || !isset($_COOKIE["re_direction"]))) || (isset($_COOKIE["re_direction"]) && $_COOKIE["re_direction"]=="RTL") ? 1 : 0;
	
	//pass data to javascript
	$params = array(
		'l10n_print_after' => 'config = ' . json_encode($data) . ';'
	);
	wp_localize_script("theme-main", "config", $params);
}
add_action("wp_enqueue_scripts", "re_theme_enqueue_scripts", 12);

//function to display number of posts
function re_getPostViews($postID)
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
	{
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '0');
    }
    return (int)$count;
}

//function to count views
function re_setPostViews($postID) 
{
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if($count=='')
	{
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, 1);
    }
	else
	{
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function re_get_time_iso8601() 
{
	$offset = get_option('gmt_offset');
	$timezone = ($offset < 0 ? '-' : '+') . (abs($offset)<10 ? '0'.abs($offset) : abs($offset)) . '00' ;
	return get_the_time('Y-m-d\TH:i:s') . $timezone;					
}

function re_theme_direction() 
{
	global $wp_locale, $theme_options;
	if(isset($theme_options['direction']) || (isset($_COOKIE["re_direction"]) && ($_COOKIE["re_direction"]=="LTR" || $_COOKIE["re_direction"]=="RTL")))
	{
		if($theme_options['direction']=='default' && empty($_COOKIE["re_direction"]))
			return;
		$wp_locale->text_direction = ($theme_options['direction']=='rtl' && ((isset($_COOKIE["re_direction"]) && $_COOKIE["re_direction"]!="LTR") || !isset($_COOKIE["re_direction"])) || (isset($_COOKIE["re_direction"]) && $_COOKIE["re_direction"]=="RTL") ? 'rtl' : 'ltr');
	}
}
add_action("after_setup_theme", "re_theme_direction");

//renovate get_font_subsets
function re_ajax_get_font_subsets()
{
	if($_POST["font"]!="")
	{
		$subsets = '';
		$fontExplode = explode(":", $_POST["font"]);
		$subsets_array = re_get_google_font_subset($fontExplode[0]);
		
		foreach($subsets_array as $subset)
			$subsets .= '<option value="' . esc_attr($subset) . '">' . $subset . '</option>';
		
		echo "re_start" . $subsets . "re_end";
	}
	exit();
}
add_action('wp_ajax_renovate_get_font_subsets', 're_ajax_get_font_subsets');

/**
 * Returns array of Google Fonts
 * @return array of Google Fonts
 */
function re_get_google_fonts()
{
	//get google fonts
	$fontsArray = get_option("renovate_google_fonts");
	//update if option doesn't exist or it was modified more than 2 weeks ago
	if($fontsArray===FALSE || count((array)$fontsArray)==0 || (time()-$fontsArray->last_update>2*7*24*60*60)) 
	{
		$google_api_url = 'http://quanticalabs.com/.tools/GoogleFont/font.txt';
		$fontsJson = wp_remote_retrieve_body(wp_remote_get($google_api_url, array('sslverify' => false)));
		$fontsArray = json_decode($fontsJson);
		$fontsArray->last_update = time();		
		update_option("renovate_google_fonts", $fontsArray);
	}
	return $fontsArray;
}

/**
 * Returns array of subsets for provided Google Font
 * @param type $font - Google font
 * @return array of subsets for provided Google Font
 */
function re_get_google_font_subset($font)
{
	$subsets = array();
	//get google fonts
	$fontsArray = re_get_google_fonts();		
	$fontsCount = count($fontsArray->items);
	for($i=0; $i<$fontsCount; $i++)
	{
		if($fontsArray->items[$i]->family==$font)
		{
			for($j=0, $max=count($fontsArray->items[$i]->subsets); $j<$max; $j++)
			{
				$subsets[] = $fontsArray->items[$i]->subsets[$j];
			}
			break;
		}
	}
	return $subsets;
}

/**
 * Includes a theme file, supports child themes.
 * 
 * @param string $file - file path relative to theme root directory.
 */
function re_get_theme_file($file)
{
	if(file_exists($file_path = get_stylesheet_directory() . $file))
        require_once($file_path);
    else
        require_once(get_template_directory() . $file);
}

?>