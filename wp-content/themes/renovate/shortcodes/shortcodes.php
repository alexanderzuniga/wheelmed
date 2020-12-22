<?php
global $renovate_posts_array;
$renovate_posts_array = array();
$count_posts = wp_count_posts();
if($count_posts->publish<100)
{
	$renovate_posts_list = get_posts(array(
		'posts_per_page' => -1,
		'nopaging' => true,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'post'
	));
	$renovate_posts_array[__("All", 'renovate')] = "-";
	foreach($renovate_posts_list as $post)
		$renovate_posts_array[$post->post_title . " (id:" . $post->ID . ")"] = $post->ID;
}

global $renovate_pages_array;
$renovate_pages_array = array();
$count_pages = wp_count_posts('page');
if($count_pages->publish<100)
{
	$pages_list = get_posts(array(
		'posts_per_page' => -1,
		'orderby' => 'title',
		'order' => 'ASC',
		'post_type' => 'page'
	));
	$renovate_pages_array = array();
	$renovate_pages_array[__("none", 'renovate')] = "-";
	foreach($pages_list as $single_page)
		$renovate_pages_array[$single_page->post_title . " (id:" . $single_page->ID . ")"] = $single_page->ID;
}

//blog 1 column
re_get_theme_file("/shortcodes/blog.php");
//blog 2 columns
re_get_theme_file("/shortcodes/blog_2_columns.php");
//blog 3 columns
re_get_theme_file("/shortcodes/blog_3_columns.php");
//blog small
re_get_theme_file("/shortcodes/blog_small.php");
//post carousel
re_get_theme_file("/shortcodes/post_carousel.php");
//post
re_get_theme_file("/shortcodes/single-post.php");
//comments
re_get_theme_file("/shortcodes/comments.php");
//items_list
re_get_theme_file("/shortcodes/items_list.php");
//map
re_get_theme_file("/shortcodes/map.php");
if(is_plugin_active('ql_services/ql_services.php'))
{
	//service single
	re_get_theme_file("/shortcodes/single-service.php");
}
if(is_plugin_active('ql_team/ql_team.php'))
{
	//team single
	re_get_theme_file("/shortcodes/single-team.php");
	re_get_theme_file("/shortcodes/team_member_box.php");
}
if(is_plugin_active('renovate-projects/renovate-projects.php'))
{
	//project single
	re_get_theme_file("/shortcodes/single-project.php");
}
//about box
re_get_theme_file("/shortcodes/call_to_action_box.php");
//featured item
re_get_theme_file("/shortcodes/featured_item.php");
//timeline item
re_get_theme_file("/shortcodes/timeline_item.php");
//announcement box
re_get_theme_file("/shortcodes/announcement_box.php");
//pricing table
if(is_plugin_active('css3_web_pricing_tables_grids/css3_web_pricing_tables_grids.php'))
	re_get_theme_file("/shortcodes/pricing_table.php");
//testimonials
re_get_theme_file("/shortcodes/testimonials.php");
//our clients carousel
re_get_theme_file("/shortcodes/our_clients_carousel.php");

//progress bar
$attributes = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Top margin", 'renovate'),
		"param_name" => "top_margin",
		"value" => array(__("None", 'renovate') => "none",  __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section"),
		"description" => __("Select top margin value for your row", "renovate")
	),
	array(
		'type' => 'dropdown',
		'heading' => __( 'Color', 'renovate' ),
		'param_name' => 'bgcolor',
		'value' => array(
				__( 'Default', 'renovate' ) => '',
				__( 'Classic Grey', 'renovate' ) => 'bar_grey',
				__( 'Classic Blue', 'renovate' ) => 'bar_blue',
				__( 'Classic Turquoise', 'renovate' ) => 'bar_turquoise',
				__( 'Classic Green', 'renovate' ) => 'bar_green',
				__( 'Classic Orange', 'renovate' ) => 'bar_orange',
				__( 'Classic Red', 'renovate' ) => 'bar_red',
				__( 'Classic Black', 'renovate' ) => 'bar_black',
			) + (function_exists("vc_get_shared") ? vc_get_shared( 'colors-dashed' ) : array()) + array(
				__( 'Custom Color', 'renovate' ) => 'custom',
			),
		'description' => __( 'Select bar background color.', 'renovate' ),
		'admin_label' => true,
		'param_holder_class' => 'vc_colored-dropdown',
	)
);
vc_add_params('vc_progress_bar', $attributes);
//row inner
$attributes = array(
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Type", 'renovate'),
		"param_name" => "type",
		"value" => array(__("Default", 'renovate') => "",  __("Full width", 'renovate') => "full-width",  __("Paralax background", 'renovate') => "full-width re-parallax", __("Cost calculator form", 'renovate') => "cost-calculator-container"),
		"description" => __("Select row type", "renovate")
	),
	array(
		"type" => "textfield",
		"heading" => __("Form action url", 'renovate'),
		"param_name" => "action",
		"dependency" => Array('element' => "type", 'value' => "cost-calculator-container")
	),
	array(
		"type" => "dropdown",
		"class" => "",
		"heading" => __("Top margin", 'renovate'),
		"param_name" => "top_margin",
		"value" => array(__("None", 'renovate') => "none",  __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section"),
		"description" => __("Select top margin value for your row", "renovate")
	)
);
vc_add_params('vc_row_inner', $attributes);
//row
vc_map( array(
	'name' => __( 'Row', 'renovate' ),
	'base' => 'vc_row',
	'is_container' => true,
	'icon' => 'icon-wpb-row',
	'show_settings_on_create' => false,
	'category' => __( 'Content', 'renovate' ),
	'class' => 'vc_main-sortable-element',
	'description' => __( 'Place content elements inside the row', 'renovate' ),
	'params' => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'renovate'),
			"param_name" => "type",
			"value" => array(__("Default", 'renovate') => "",  __("Full width", 'renovate') => "full-width",  __("Paralax background", 'renovate') => "full-width re-parallax", __("Cost calculator form", 'renovate') => "cost-calculator-container"),
			"description" => __("Select row type", "renovate")
		),
		array(
			"type" => "textfield",
			"heading" => __("Form action url", 'renovate'),
			"param_name" => "action",
			"dependency" => Array('element' => "type", 'value' => "cost-calculator-container")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'renovate'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'renovate') => "none",  __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section"),
			"description" => __("Select top margin value for your row", "renovate")
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Row stretch', 'renovate' ),
			'param_name' => 'full_width',
			'value' => array(
				__( 'Default', 'renovate' ) => '',
				__( 'Stretch row', 'renovate' ) => 'stretch_row',
				__( 'Stretch row and content', 'renovate' ) => 'stretch_row_content',
				__( 'Stretch row and content (no paddings)', 'renovate' ) => 'stretch_row_content_no_spaces',
			),
			'description' => __( 'Select stretching options for row and content (Note: stretched may not work properly if parent container has "overflow: hidden" CSS property).', 'renovate' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns gap', 'renovate' ),
			'param_name' => 'gap',
			'value' => array(
				'0px' => '0',
				'1px' => '1',
				'2px' => '2',
				'3px' => '3',
				'4px' => '4',
				'5px' => '5',
				'10px' => '10',
				'15px' => '15',
				'20px' => '20',
				'25px' => '25',
				'30px' => '30',
				'35px' => '35',
			),
			'std' => '0',
			'description' => __( 'Select gap between columns in row.', 'renovate' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Full height row?', 'renovate' ),
			'param_name' => 'full_height',
			'description' => __( 'If checked row will be set to full height.', 'renovate' ),
			'value' => array( __( 'Yes', 'renovate' ) => 'yes' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Columns position', 'renovate' ),
			'param_name' => 'columns_placement',
			'value' => array(
				__( 'Middle', 'renovate' ) => 'middle',
				__( 'Top', 'renovate' ) => 'top',
				__( 'Bottom', 'renovate' ) => 'bottom',
				__( 'Stretch', 'renovate' ) => 'stretch',
			),
			'description' => __( 'Select columns position within row.', 'renovate' ),
			'dependency' => array(
				'element' => 'full_height',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Equal height', 'renovate' ),
			'param_name' => 'equal_height',
			'description' => __( 'If checked columns will be set to equal height.', 'renovate' ),
			'value' => array( __( 'Yes', 'renovate' ) => 'yes' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Content position', 'renovate' ),
			'param_name' => 'content_placement',
			'value' => array(
				__( 'Default', 'renovate' ) => '',
				__( 'Top', 'renovate' ) => 'top',
				__( 'Middle', 'renovate' ) => 'middle',
				__( 'Bottom', 'renovate' ) => 'bottom',
			),
			'description' => __( 'Select content position within columns.', 'renovate' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use video background?', 'renovate' ),
			'param_name' => 'video_bg',
			'description' => __( 'If checked, video will be used as row background.', 'renovate' ),
			'value' => array( __( 'Yes', 'renovate' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'YouTube link', 'renovate' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => __( 'Add YouTube link.', 'renovate' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'renovate' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'renovate' ) => '',
				__( 'Simple', 'renovate' ) => 'content-moving',
				__( 'With fade', 'renovate' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row.', 'renovate' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'renovate' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'renovate' ) => '',
				__( 'Simple', 'renovate' ) => 'content-moving',
				__( 'With fade', 'renovate' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'renovate' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'renovate' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'renovate' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Parallax speed', 'renovate' ),
			'param_name' => 'parallax_speed_video',
			'value' => '1.5',
			'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'renovate' ),
			'dependency' => array(
				'element' => 'video_bg_parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Parallax speed', 'renovate' ),
			'param_name' => 'parallax_speed_bg',
			'value' => '1.5',
			'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'renovate' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		vc_map_add_css_animation( false ),
		array(
			'type' => 'el_id',
			'heading' => __( 'Row ID', 'renovate' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter row ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'renovate' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Disable row', 'renovate' ),
			'param_name' => 'disable_element',
			// Inner param name.
			'description' => __( 'If checked the row won\'t be visible on the public side of your website. You can switch it back any time.', 'renovate' ),
			'value' => array( __( 'Yes', 'renovate' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'renovate' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'renovate' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'renovate' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'renovate' ),
		)
	),
	'js_view' => 'VcRowView'
) );

//column
$vc_column_width_list = array(
	__('1 column - 1/12', 'renovate') => '1/12',
	__('2 columns - 1/6', 'renovate') => '1/6',
	__('3 columns - 1/4', 'renovate') => '1/4',
	__('4 columns - 1/3', 'renovate') => '1/3',
	__('5 columns - 5/12', 'renovate') => '5/12',
	__('6 columns - 1/2', 'renovate') => '1/2',
	__('7 columns - 7/12', 'renovate') => '7/12',
	__('8 columns - 2/3', 'renovate') => '2/3',
	__('9 columns - 3/4', 'renovate') => '3/4',
	__('10 columns - 5/6', 'renovate') => '5/6',
	__('11 columns - 11/12', 'renovate') => '11/12',
	__('12 columns - 1/1', 'renovate') => '1/1'
);
vc_map( array(
	'name' => __( 'Column', 'renovate' ),
	'base' => 'vc_column',
	'icon' => 'icon-wpb-row',
	'is_container' => true,
	//"as_parent" => array('except' => 'vc_row'),
	'content_element' => false,
	'description' => __( 'Place content elements inside the column', 'renovate' ),
	'params' => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Column type", 'renovate'),
			"param_name" => "type",
			"value" => array(__("Default", 'renovate') => "",  __("Smart (sticky)", 'renovate') => "re-smart-column"),
			"dependency" => Array('element' => "width", 'value' => array_map('strval', array_values((array_slice($vc_column_width_list, 0, -1)))))
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'renovate'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'renovate') => "none",  __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section"),
			"description" => __("Select top margin value for your column", "renovate")
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Use video background?', 'renovate' ),
			'param_name' => 'video_bg',
			'description' => __( 'If checked, video will be used as row background.', 'renovate' ),
			'value' => array( __( 'Yes', 'renovate' ) => 'yes' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'YouTube link', 'renovate' ),
			'param_name' => 'video_bg_url',
			'value' => 'https://www.youtube.com/watch?v=lMJXxhRFO1k',
			// default video url
			'description' => __( 'Add YouTube link.', 'renovate' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'renovate' ),
			'param_name' => 'video_bg_parallax',
			'value' => array(
				__( 'None', 'renovate' ) => '',
				__( 'Simple', 'renovate' ) => 'content-moving',
				__( 'With fade', 'renovate' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row.', 'renovate' ),
			'dependency' => array(
				'element' => 'video_bg',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Parallax', 'renovate' ),
			'param_name' => 'parallax',
			'value' => array(
				__( 'None', 'renovate' ) => '',
				__( 'Simple', 'renovate' ) => 'content-moving',
				__( 'With fade', 'renovate' ) => 'content-moving-fade',
			),
			'description' => __( 'Add parallax type background for row (Note: If no image is specified, parallax will use background image from Design Options).', 'renovate' ),
			'dependency' => array(
				'element' => 'video_bg',
				'is_empty' => true,
			),
		),
		array(
			'type' => 'attach_image',
			'heading' => __( 'Image', 'renovate' ),
			'param_name' => 'parallax_image',
			'value' => '',
			'description' => __( 'Select image from media library.', 'renovate' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Parallax speed', 'renovate' ),
			'param_name' => 'parallax_speed_video',
			'value' => '1.5',
			'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'renovate' ),
			'dependency' => array(
				'element' => 'video_bg_parallax',
				'not_empty' => true,
			),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Parallax speed', 'renovate' ),
			'param_name' => 'parallax_speed_bg',
			'value' => '1.5',
			'description' => __( 'Enter parallax speed ratio (Note: Default value is 1.5, min value is 1)', 'renovate' ),
			'dependency' => array(
				'element' => 'parallax',
				'not_empty' => true,
			),
		),
		vc_map_add_css_animation( false ),
		array(
			'type' => 'el_id',
			'heading' => __( 'Element ID', 'renovate' ),
			'param_name' => 'el_id',
			'description' => sprintf( __( 'Enter element ID (Note: make sure it is unique and valid according to <a href="%s" target="_blank">w3c specification</a>).', 'renovate' ), 'http://www.w3schools.com/tags/att_global_id.asp' ),
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'renovate' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'renovate' ),
		),
		array(
			'type' => 'css_editor',
			'heading' => __( 'CSS box', 'renovate' ),
			'param_name' => 'css',
			'group' => __( 'Design Options', 'renovate' ),
		),
		array(
			'type' => 'dropdown',
			'heading' => __( 'Width', 'renovate' ),
			'param_name' => 'width',
			'value' => $vc_column_width_list,
			'group' => __( 'Responsive Options', 'renovate' ),
			'description' => __( 'Select column width.', 'renovate' ),
			'std' => '1/1',
		),
		array(
			'type' => 'column_offset',
			'heading' => __( 'Responsiveness', 'renovate' ),
			'param_name' => 'offset',
			'group' => __( 'Responsive Options', 'renovate' ),
			'description' => __( 'Adjust column for different screen sizes. Control width, offset and visibility settings.', 'renovate' ),
		)
	),
	'js_view' => 'VcColumnView'
) );

//widgetised sidebar
vc_map( array(
	'name' => __( 'Widgetised Sidebar', 'renovate' ),
	'base' => 'vc_widget_sidebar',
	'class' => 'wpb_widget_sidebar_widget',
	'icon' => 'icon-wpb-layout_sidebar',
	'category' => __( 'Structure', 'renovate' ),
	'description' => __( 'WordPress widgetised sidebar', 'renovate' ),
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Widget title', 'renovate' ),
			'param_name' => 'title',
			'description' => __( 'Enter text used as widget title (Note: located above content element).', 'renovate' )
		),
		array(
			'type' => 'widgetised_sidebars',
			'heading' => __( 'Sidebar', 'renovate' ),
			'param_name' => 'sidebar_id',
			'description' => __( 'Select widget area to display.', 'renovate' )
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Extra class name', 'renovate' ),
			'param_name' => 'el_class',
			'description' => __( 'Style particular content element differently - add a class name and refer to it in custom CSS.', 'renovate' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Top margin", 'renovate'),
			"param_name" => "top_margin",
			"value" => array(__("None", 'renovate') => "none",  __("Page (small)", 'renovate') => "page-margin-top", __("Section (large)", 'renovate') => "page-margin-top-section"),
			"description" => __("Select top margin value for your sidebar", "renovate")
		)
	)
) );

$vc_is_wp_version_3_6_more = version_compare( preg_replace( '/^([\d\.]+)(\-.*$)/', '$1', get_bloginfo( 'version' ) ), '3.6' ) >= 0;
//tab
vc_map( array(
	'name' => __( 'Tab', 'renovate' ),
	'base' => 'vc_tab',
	"as_parent" => array('except' => 'vc_tabs, vc_accordion'),
	"allowed_container_element" => array('vc_row', 'vc_nested_tabs', 'vc_nested_accordion'),
	'is_container' => true,
	'content_element' => false,
	'params' => array(
		array(
			'type' => 'textfield',
			'heading' => __( 'Title', 'renovate' ),
			'param_name' => 'title',
			'description' => __( 'Tab title.', 'renovate' )
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon", 'renovate'),
			"param_name" => "icon",
			"value" => array(
				__("none", 'renovate') => "none",
				__("bricks", 'renovate') => "sl-small-bricks",
				__("briefcase", 'renovate') => "sl-small-briefcase",
				__("brush-1", 'renovate') => "sl-small-brush-1",
				__("brush-2", 'renovate') => "sl-small-brush-2",
				__("bubble", 'renovate') => "sl-small-bubble",
				__("bubble check", 'renovate') => "sl-small-bubble-check",
				__("bucket", 'renovate') => "sl-small-bucket",
				__("building", 'renovate') => "sl-small-building",
				__("calculator", 'renovate') => "sl-small-calculator",
				__("camera", 'renovate') => "sl-small-camera",
				__("cart-1", 'renovate') => "sl-small-cart-1",
				__("cart-2", 'renovate') => "sl-small-cart-2",
				__("chat", 'renovate') => "sl-small-chat",
				__("clock", 'renovate') => "sl-small-clock",
				__("cone", 'renovate') => "sl-small-cone",
				__("construction", 'renovate') => "sl-small-construction",
				__("conversation", 'renovate') => "sl-small-conversation",
				__("lab", 'renovate') => "sl-small-documents",
				__("door", 'renovate') => "sl-small-door",
				__("driller", 'renovate') => "sl-small-driller",
				__("eco", 'renovate') => "sl-small-eco",
				__("faq", 'renovate') => "sl-small-faq",
				__("fax", 'renovate') => "sl-small-fax",
				__("fence", 'renovate') => "sl-small-fence",
				__("forklift", 'renovate') => "sl-small-forklift",
				__("garage", 'renovate') => "sl-small-garage",
				__("gears", 'renovate') => "sl-small-gears",
				__("globe", 'renovate') => "sl-small-globe",
				__("hammer", 'renovate') => "sl-small-hammer",
				__("helmet", 'renovate') => "sl-small-helmet",
				__("house-1", 'renovate') => "sl-small-house-1",
				__("house-2", 'renovate') => "sl-small-house-2",
				__("key", 'renovate') => "sl-small-key",
				__("documents", 'renovate') => "sl-small-lab",
				__("lightbulb", 'renovate') => "sl-small-lightbulb",
				__("list", 'renovate') => "sl-small-list",
				__("location", 'renovate') => "sl-small-location",
				__("lock", 'renovate') => "sl-small-lock",
				__("mail", 'renovate') => "sl-small-mail",
				__("measure", 'renovate') => "sl-small-measure",
				__("megaphone", 'renovate') => "sl-small-megaphone",
				__("payment", 'renovate') => "sl-small-payment",
				__("pencil", 'renovate') => "sl-small-pencil",
				__("percent", 'renovate') => "sl-small-percent",
				__("person", 'renovate') => "sl-small-person",
				__("phone", 'renovate') => "sl-small-phone",
				__("photo", 'renovate') => "sl-small-photo",
				__("picture", 'renovate') => "sl-small-picture",
				__("plan", 'renovate') => "sl-small-plan",
				__("poster", 'renovate') => "sl-small-poster",
				__("quote", 'renovate') => "sl-small-quote",
				__("roller", 'renovate') => "sl-small-roller",
				__("ruler", 'renovate') => "sl-small-ruler",
				__("scissors", 'renovate') => "sl-small-scissors",
				__("screwdriver", 'renovate') => "sl-small-screwdriver",
				__("shield", 'renovate') => "sl-small-shield",
				__("shovel", 'renovate') => "sl-small-shovel",
				__("speaker", 'renovate') => "sl-small-speaker",
				__("stationery", 'renovate') => "sl-small-stationery",
				__("team", 'renovate') => "sl-small-team",
				__("tick", 'renovate') => "sl-small-tick",
				__("trolley", 'renovate') => "sl-small-trolley",
				__("trophy", 'renovate') => "sl-small-trophy",
				__("trowel", 'renovate') => "sl-small-trowel",
				__("truck", 'renovate') => "sl-small-truck",
				__("video", 'renovate') => "sl-small-video",
				__("wallet", 'renovate') => "sl-small-wallet",
				__("watering-can", 'renovate') => "sl-small-watering-can",
				__("wrench", 'renovate') => "sl-small-wrench",
				__("wrenches", 'renovate') => "sl-small-wrenches")
		),
		array(
			'type' => 'textfield',
			'heading' => __( 'Tab ID', 'renovate' ),
			'param_name' => "tab_id"
		)
	),
	'js_view' => $vc_is_wp_version_3_6_more ? 'VcTabView' : 'VcTabView35'
) );

//box_header
function re_theme_box_header($atts)
{
	extract(shortcode_atts(array(
		"title" => "Sample Header",
		"type" => "h1",
		"class" => "",
		"bottom_border" => 1,
		"top_margin" => "none"
	), $atts));
	
	return '<' . esc_attr($type) . ' class="box-header' . ($class!="" ? ' ' . esc_attr($class) : '') . (!(int)$bottom_border ? ' no-border' : '') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '">' . do_shortcode($title) . '</' . esc_attr($type) . '>';
}

//visual composer
vc_map( array(
	"name" => __("Box header", 'renovate'),
	"base" => "box_header",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-layer-box-header",
	"category" => __('Renovate', 'renovate'),
	"params" => array(
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'renovate'),
			"param_name" => "title",
			"value" => "Sample Header"
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'renovate'),
			"param_name" => "type",
			"value" => array(__("H1", 'renovate') => "h1", __("H2", 'renovate') => "h2", __("H3", 'renovate') => "h3", __("H4", 'renovate') => "h4", __("H5", 'renovate') => "h5", __("H6", 'renovate') => "h6")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Bottom border", 'renovate'),
			"param_name" => "bottom_border",
			"value" => array(__("yes", 'renovate') => 1,  __("no", 'renovate') => 0)
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra class name", 'renovate'),
			"param_name" => "class",
			"value" => ""
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

//read more
function re_theme_button($atts)
{
	extract(shortcode_atts(array(
		"type" => "read_more",
		"icon" => "none",
		"url" => "",
		"title" => __("READ MORE", 'renovate'),
		"label" => "",
		"target" => "",
		"extraclass" => "",
		"top_margin" => "none"
	), $atts));

	$output = (is_rtl() ?  (($label!="" ? '<h3>' : '') . '<a class="' . ($type=="read_more" ? 'more' : 're-action-button') . ($type=="action" && !empty($icon) && $icon!="none" ? ' template-' . esc_attr($icon) : '') . (!empty($extraclass) ? ' ' . esc_attr($extraclass) : '') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '" href="' . esc_url($url) . '"'  . (!empty($target) ? ' target="' . esc_attr($target) . '"' : '') . ' title="' . esc_attr($title) . '">' . $title . '</a>' . ($label!="" ? '<span class="button-label">' . $label . '</span></h3>' : '')) : (($label!="" ? '<h3><span class="button-label">' . $label . '</span>' : '') . '<a class="' . ($type=="read_more" ? 'more' : 're-action-button') . ($type=="action" && !empty($icon) && $icon!="none" ? ' template-' . esc_attr($icon) : '') . (!empty($extraclass) ? ' ' . esc_attr($extraclass) : '') . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . '" href="' . esc_url($url) . '"'  . (!empty($target) ? ' target="' . esc_attr($target) . '"' : '') . ' title="' . esc_attr($title) . '">' . $title . '</a>' . ($label!="" ? '</h3>' : '')));
	return $output;	
}

//visual composer
vc_map( array(
	"name" => __("Button", 'renovate'),
	"base" => "vc_btn",
	"class" => "",
	"controls" => "full",
	"show_settings_on_create" => true,
	"icon" => "icon-wpb-ui-button",
	"category" => __('Renovate', 'renovate'),
	"params" => array(
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Type", 'renovate'),
			"param_name" => "type",
			"value" => array(__("Read more button", 'renovate') => "read_more", __("Action button", 'renovate') => "action")
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Icon", 'renovate'),
			"param_name" => "icon",
			"value" => array(
				__("none", 'renovate') => "none",
				__("arrow-circle-down", 'renovate') => "arrow-circle-down",
				__("arrow-circle-right", 'renovate') => "arrow-circle-right",
				__("arrow-dropdown", 'renovate') => "arrow-dropdown",
				__("arrow-left-1", 'renovate') => "arrow-left-1",
				__("arrow-left-2", 'renovate') => "arrow-left-2",
				__("arrow-right-1", 'renovate') => "arrow-right-1",
				__("arrow-right-2", 'renovate') => "arrow-right-2",
				__("arrow-menu", 'renovate') => "arrow-menu",
				__("arrow-up", 'renovate') => "arrow-up",
				__("bubble", 'renovate') => "bubble",
				__("bullet", 'renovate') => "bullet",
				__("calendar", 'renovate') => "calendar",
				__("clock", 'renovate') => "clock",
				__("location", 'renovate') => "location",
				__("eye", 'renovate') => "eye",
				__("mail", 'renovate') => "mail",
				__("map-marker", 'renovate') => "map-marker",
				__("phone", 'renovate') => "phone",
				__("search", 'renovate') => "search",
				__("shopping-cart", 'renovate') => "shopping-cart"
			),
			"dependency" => Array('element' => "type", 'value' => "action")
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Title", 'renovate'),
			"param_name" => "title",
			"value" => __("READ MORE", 'renovate')
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Label", 'renovate'),
			"param_name" => "label",
			"value" => ""
		),
		array(
			"type" => "textfield",
			"holder" => "div",
			"class" => "",
			"heading" => __("Url", 'renovate'),
			"param_name" => "url",
			"value" => ""
		),
		array(
			"type" => "dropdown",
			"class" => "",
			"heading" => __("Button target", 'renovate'),
			"param_name" => "target",
			"value" => array(__("Same window", 'renovate') => "", __("New window", 'renovate') => "_blank")
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
			"holder" => "div",
			"class" => "",
			"heading" => __("Extra class name", 'renovate'),
			"param_name" => "extraclass",
			"value" => ""
		),
	)
));
?>