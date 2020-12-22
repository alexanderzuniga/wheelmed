<?php
//blog
function re_theme_blog_small($atts, $content)
{
	extract(shortcode_atts(array(
		"re_pagination" => 0,
		"items_per_page" => 4,
		"offset" => 0,
		"featured_image_size" => "default",
		"ids" => "",
		"category" => "",
		"post_format" => "",
		"author" => "",
		"order_by" => "title menu_order",
		"order" => "DESC",
		"show_post_title" => 1,
		"show_post_date" => 1,
		"show_post_views" => 0,
		"top_margin" => "none",
		"el_class" => ""
	), $atts));
	
	$featured_image_size = str_replace("re_", "", $featured_image_size);
	
	$ids = explode(",", $ids);
	if($ids[0]=="-" || $ids[0]=="")
	{
		unset($ids[0]);
		$ids = array_values($ids);
	}	
	$category = explode(",", $category);
	if($category[0]=="-" || $category[0]=="")
	{
		unset($category[0]);
		$category = array_values($category);
	}
	$author = explode(",", $author);
	if($author[0]=="-" || $author[0]=="")
	{
		unset($author[0]);
		$author = array_values($author);
	}
	
	global $paged;
	$paged = (get_query_var((is_front_page() && !is_home() ? 'page' : 'paged')) && (int)$re_pagination ? get_query_var((is_front_page() && !is_home() ? 'page' : 'paged')) : 1);
	if(in_array("current", (array)$author))
	{
		$author = (get_query_var('author_name')) ? get_user_by('slug', get_query_var('author_name')) : get_userdata(get_query_var('author'));
		$author = array($author->ID);
	}
	$args = array( 
		'post__in' => $ids,
		'post_type' => 'post',
		'post_status' => 'publish',
		'paged' => $paged,
		'posts_per_page' => $items_per_page,
		'offset' => (!(int)$re_pagination ? (int)$offset : ""),
		'cat' => (get_query_var('cat')!="" ? get_query_var('cat') : ''),
		'category_name' => (get_query_var('cat')=="" ? implode(",", $category) : ''),
		'tag' => get_query_var('tag'),
		'author__in' => $author,
		'orderby' => ($order_by=="views" ? 'meta_value_num' : implode(" ", explode(",", $order_by))), 
		'order' => $order
	);
	if($order_by=="views")
		$args['meta_key'] = 'post_views_count';
	if(!is_single())
	{
		$args['monthnum'] = get_query_var('monthnum');
		$args['day'] = get_query_var('day');
		$args['year'] = get_query_var('year');
		$args['w'] = get_query_var('week');
	}
	if(get_query_var('cat')!="")
	{
		$tmpCategory = get_category(get_query_var('cat'));
		$category = array($tmpCategory->slug);
	}
	$blog_query = new WP_Query($args);
	$post_count = $blog_query->found_posts;
	
	$output = '';
	if($blog_query->have_posts())
	{
		$output .= '<div class="vc_row wpb_row vc_row-fluid">';
		$output .= '<ul class="blog clearfix small' . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '">';
		$i = 0;
		re_get_theme_file("/shortcodes/class/Post.php");
		while ($blog_query->have_posts()) : $blog_query->the_post();
			$post = new Re_Post("small", $featured_image_size, (int)$show_post_date, "general_settings", (int)$show_post_views, 0, 0, 0, 0, $i);
			$output .= $post->getLiCssClass();
			$output .= $post->getThumbnail("tiny-thumb");
			$output .= '<div class="post-content">';
			if((int)$show_post_title)
			{
				$output .= '<a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '">' . get_the_title() . '</a>';
			}
			$output .= $post->getPostDetails();
			$output .= '</div></li>';
			$i++;
		endwhile;
		$output .= '</ul></div>';
	}
	else if(is_search())
	{
		$output .= '<div class="vc_row wpb_row vc_row-fluid">' . sprintf(__('No results found for %s', 'renovate'), esc_attr(get_query_var('s'))) . '</div>';
	}
	
	if($re_pagination)
	{
		re_get_theme_file("/pagination.php");
		$output .= kriesi_pagination(false, '', 2, false, false, '', 'page-margin-top', $blog_query);
	}
	//Reset Postdata
	wp_reset_postdata();
	return $output;
}

//visual composer
function re_theme_blog_small_vc_init()
{
	//get posts list
	global $renovate_posts_array;

	//get categories
	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All", 'renovate')] = "-";
	foreach($post_categories as $post_category)
		$post_categories_array[$post_category->name] =  $post_category->slug;
		
	//get post formats
	$post_formats_array = array();
	$post_formats_array[__("All", 'renovate')] = "-";
	if(current_theme_supports('post-formats')) 
	{
		$post_formats = get_theme_support('post-formats');
		
		if(is_array($post_formats[0]))
		{
			foreach($post_formats[0] as $post_format)
				$post_formats_array[$post_format] =  "post-format-" . $post_format;
		}
	}
		
	//get authors list
	$authors_list = get_users(array(
		'who' => 'authors'
	));
	$authors_array = array();
	$authors_array[__("All", 'renovate')] = "-";
	$authors_array[__("Current author (applies on author single page)", 'renovate')] = "current";
	foreach($authors_list as $author)
		$authors_array[$author->display_name . " (id:" . $author->ID . ")"] = $author->ID;
	
	//image sizes
	$image_sizes_array = array();
	$image_sizes_array[__("Default", 'renovate')] = "default";
	global $_wp_additional_image_sizes;
	foreach(get_intermediate_image_sizes() as $s) 
	{
		if(isset($_wp_additional_image_sizes[$s])) 
		{
			$width = intval($_wp_additional_image_sizes[$s]['width']);
			$height = intval($_wp_additional_image_sizes[$s]['height']);
		} 
		else
		{
			$width = get_option($s.'_size_w');
			$height = get_option($s.'_size_h');
		}
		$image_sizes_array[$s . " (" . $width . "x" . $height . ")"] = "re_" . $s;
	}
	vc_map( array(
		"name" => __("Blog Small", 'renovate'),
		"base" => "blog_small",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-blog",
		"category" => __('Renovate', 'renovate'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Pagination", 'renovate'),
				"param_name" => "re_pagination",
				"value" => array(__("No", 'renovate') => 0, __("Yes", 'renovate') => 1)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Items per page/Post count", 'renovate'),
				"param_name" => "items_per_page",
				"value" => 4,
				"description" => __("Items per page if pagination is set to 'yes' or post count otherwise. Set -1 to display all.", 'renovate')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Offset", 'renovate'),
				"param_name" => "offset",
				"value" => 0,
				"description" => __("Number of post to displace or pass over.", 'renovate'),
				"dependency" => Array('element' => "re_pagination", 'value' => "0")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Featured image size", 'renovate'),
				"param_name" => "featured_image_size",
				"value" => $image_sizes_array
			),
			array(
				"type" => (count($renovate_posts_array) ? "dropdownmulti" : "textfield"),
				"class" => "",
				"heading" => __("Display selected", 'renovate'),
				"param_name" => "ids",
				"value" => (count($renovate_posts_array) ? $renovate_posts_array : ''),
				"description" => (count($renovate_posts_array) ? '' : __("Please provide post ids separated with commas, to display only selected posts", 'renovate'))
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display from Category", 'renovate'),
				"param_name" => "category",
				"value" => $post_categories_array
			),
			array(
				"type" => "dropdownmulti",
				"class" => "",
				"heading" => __("Display by author", 'renovate'),
				"param_name" => "author",
				"value" => $authors_array
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order by", 'renovate'),
				"param_name" => "order_by",
				"value" => array(__("Title, menu order", 'renovate') => "title,menu_order", __("Menu order", 'renovate') => "menu_order", __("Date", 'renovate') => "date", __("Post views", 'renovate') => "views", __("Comment count", 'renovate') => "comment_count", __("Random", 'renovate') => "rand")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Order", 'renovate'),
				"param_name" => "order",
				"value" => array( __("descending", 'renovate') => "DESC", __("ascending", 'renovate') => "ASC")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post title", 'renovate'),
				"param_name" => "show_post_title",
				"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post date", 'renovate'),
				"param_name" => "show_post_date",
				"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post views", 'renovate'),
				"param_name" => "show_post_views",
				"value" => array(__("No", 'renovate') => 0, __("Yes", 'renovate') => 1)
			),
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
		)
	));
}
add_action("init", "re_theme_blog_small_vc_init");
?>
