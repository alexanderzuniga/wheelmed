<?php
//blog
function re_theme_blog_2_columns($atts, $content)
{
	extract(shortcode_atts(array(
		"layout_type" => "row",
		"re_pagination" => 0,
		"items_per_page" => 4,
		"offset" => 0,
		"featured_image_size" => "default",
		"ids" => "",
		"category" => "",
		"author" => "",
		"order_by" => "title,menu_order",
		"order" => "DESC",
		"show_post_title" => 1,
		"show_post_excerpt" => 1,
		"excerpt_length" => 0,
		"read_more" => 1,
		"show_post_categories" => 1,
		"show_post_author" => 1,
		"show_post_date" => 1,
		"date_format" => "renovate",
		"show_post_views" => 1,
		"show_post_comments" => 1,
		"is_search_results" => 0,
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
	if((int)$is_search_results)
		$args['s'] = get_query_var('s');
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
	//$post_count = $blog_query->found_posts;
	$post_count = $blog_query->post_count;
	
	$output = '';
	if($blog_query->have_posts())
	{
		$output .= '<div class="vc_row wpb_row vc_row-fluid layout-' . esc_attr($layout_type) . ($top_margin!="none" ? ' ' . esc_attr($top_margin) : '') . ($el_class!="" ? ' ' . esc_attr($el_class) : '') . '">';
		$i = 0;
		re_get_theme_file("/shortcodes/class/Post.php");
		while ($blog_query->have_posts()) : $blog_query->the_post();
			$post = new Re_Post("blog", $featured_image_size, (int)$show_post_date, $date_format, (int)$show_post_views, (int)$show_post_comments, (int)$show_post_categories, (int)$show_post_excerpt, (int)$show_post_author, $i);
			if($layout_type=="row")
			{
				if($i==0 || $i%2==0)
				{
					if($i%2==0 && $i>0)
					{
						$output .= '</ul>';
					}
					$output .= '<ul class="blog two-columns clearfix">';
				}
				$output .= $post->getLiCssClass("vc_col-sm-6 wpb_column vc_column_container");
			}
			else
			{
				if($i==0 || $i==ceil($post_count/2))
				{
					if($i==ceil($post_count/2))
						$output .= '</ul></div>';
					$output .= '<div class="vc_col-sm-6 wpb_column vc_column_container"><ul class="blog clearfix">';
				}
				$output .= $post->getLiCssClass();
			}
			$output .= $post->getPostDetails();
			$output .= '<div class="post-content">';
			$output .= $post->getThumbnail("blog-post-thumb");
			$output .= $post->getPostContentDetails();
			if((int)$show_post_title)
			{
				$output .= '<h3 class="box-header align-left"><a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '">' . get_the_title() . '</a></h3>';
			}
			if((int)$show_post_excerpt)
			{
				$output .= apply_filters('the_excerpt', ((int)$excerpt_length && strpos(get_the_excerpt(), ' ', (int)$excerpt_length) ? substr(get_the_excerpt(), 0, strpos(get_the_excerpt(), ' ', (int)$excerpt_length)) : get_the_excerpt()));
			}
			if((int)$read_more)
			{
				$output .= '<div class="vc_row wpb_row vc_row-fluid padding-top-54 padding-bottom-17"><a title="' . esc_attr__('READ MORE', 'renovate') . '" href="' . esc_url(get_permalink()) . '" class="more">' . __('READ MORE', 'renovate') . '</a></div>';
			}
			$output .= '</div>';
			$output .= '</li>';
			$i++;
		endwhile;
		$output .= '</ul>';
		$output .= '</div>' . ($layout_type=="column" ? '</div>' : '');
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
function re_theme_blog_2_columns_vc_init()
{
	//get posts list
	global $renovate_posts_array;

	//get categories
	$post_categories = get_terms("category");
	$post_categories_array = array();
	$post_categories_array[__("All", 'renovate')] = "-";
	foreach($post_categories as $post_category)
		$post_categories_array[$post_category->name] =  $post_category->slug;
		
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
		"name" => __("Blog 2 Columns", 'renovate'),
		"base" => "blog_2_columns",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-layer-blog",
		"category" => __('Renovate', 'renovate'),
		"params" => array(
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Layout type", 'renovate'),
				"param_name" => "layout_type",
				"value" => array(__("Rows layout", 'renovate') => "row", __("Columns layout", 'renovate') => "column"),
				"description" => __("How posts should be displayed: row by row or column by column", 'renovate')
			),
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
				"heading" => __("Show post excerpt", 'renovate'),
				"param_name" => "show_post_excerpt",
				"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Excerpt length", 'renovate'),
				"param_name" => "excerpt_length",
				"value" => 0,
				"description" => __("The excerpt length. Set 0 to use default WordPress excerpt length.", 'renovate'),
				"dependency" => Array('element' => "show_post_excerpt", 'value' => "1")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Read more button", 'renovate'),
				"param_name" => "read_more",
				"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post categories", 'renovate'),
				"param_name" => "show_post_categories",
				"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post author", 'renovate'),
				"param_name" => "show_post_author",
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
				"heading" => __("Date format", 'renovate'),
				"param_name" => "date_format",
				"value" => array(__("Renovate", 'renovate') => 'renovate', __("From general settings", 'renovate') => 'general_settings'),
				"dependency" => Array('element' => "show_post_date", 'value' => "1")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show post views", 'renovate'),
				"param_name" => "show_post_views",
				"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Show comments number", 'renovate'),
				"param_name" => "show_post_comments",
				"value" => array(__("Yes", 'renovate') => 1, __("No", 'renovate') => 0)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Is search results component", 'renovate'),
				"param_name" => "is_search_results",
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
add_action("init", "re_theme_blog_2_columns_vc_init");
?>