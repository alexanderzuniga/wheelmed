<?php
/*
Plugin Name: Renovate Projects
Plugin URI: https://1.envato.market/quanticalabs-portfolio
Description: Renovate Theme Projects Plugin
Author: QuanticaLabs
Author URI: https://1.envato.market/quanticalabs-portfolio
Version: 1.4
Text Domain: renovate_projects
*/

//translation
function renovate_projects_load_textdomain()
{
	load_plugin_textdomain("renovate_projects", false, dirname(plugin_basename(__FILE__)) . '/languages');
}
add_action('plugins_loaded', 'renovate_projects_load_textdomain');
//custom post type - projects
if(is_admin())
{
	function re_projects_admin_menu()
	{
		$permalinks_page = add_submenu_page('edit.php?post_type=re_projects', __('Permalink', 'renovate_projects'), __('Permalink', 'renovate_projects'), 'manage_options', 're_projects_permalink', 're_projects_permalink');
		add_action("admin_enqueue_scripts", "re_projects_admin_enqueue_scripts");
	}
	add_action("admin_menu", "re_projects_admin_menu");
	
	function re_projects_permalink()
	{
		$message = "";
		if(isset($_POST["action"]) && $_POST["action"]=="save_projects_permalink")
			$message = __("Options saved!", "renovate_projects");
		$re_projects_permalink = array(
			"slug" => 'projects',
			"label_singular" => __("Project", 'renovate_projects'),
			"label_plural" => __("Projects", 'renovate_projects')
		);
		$re_projects_permalink = array_merge($re_projects_permalink, (array)get_option("re_projects_permalink"));
		
		require_once("admin/admin-page-permalink.php");
	}
	function re_projects_admin_enqueue_scripts($hook)
	{
		if($hook=="re_projects_page_re_projects_permalink")
		{
			wp_enqueue_style("re_projects-admin-style", plugins_url('admin/style.css', __FILE__));
		}
	}
}
function re_projects_init()
{
	$re_projects_permalink = array(
		"slug" => 'projects',
		"label_singular" => __("Project", 'renovate_projects'),
		"label_plural" => __("Projects", 'renovate_projects')
	);
	if(isset($_POST["action"]) && $_POST["action"]=="save_projects_permalink")
	{
		$re_projects_permalink = array_merge($re_projects_permalink, (array)get_option("re_projects_permalink"));
		$slug_old = $re_projects_permalink["slug"];
		$re_projects_permalink = array(
			"slug" => (!empty($_POST["slug"]) ? sanitize_title($_POST["slug"]) : "projects"),
			"label_singular" => (!empty($_POST["label_singular"]) ? $_POST["label_singular"] : __("Project", "renovate_projects")),
			"label_plural" => (!empty($_POST["label_plural"]) ? $_POST["label_plural"] : __("Projects", "renovate_projects"))
		);
		update_option("re_projects_permalink", $re_projects_permalink);
		if($slug_old!=$_POST["slug"])
		{
			delete_option('rewrite_rules');
		}
	}
	$re_projects_permalink = array_merge($re_projects_permalink, (array)get_option("re_projects_permalink"));
	$labels = array(
		'name' => $re_projects_permalink['label_plural'],
		'singular_name' => $re_projects_permalink['label_singular'],
		'add_new' => _x('Add New', $re_projects_permalink["slug"], 'renovate_projects'),
		'add_new_item' => sprintf(__('Add New %s' , 'renovate_projects') , $re_projects_permalink['label_singular']),
		'edit_item' => sprintf(__('Edit %s', 'renovate_projects'), $re_projects_permalink['label_singular']),
		'new_item' => sprintf(__('New %s', 'renovate_projects'), $re_projects_permalink['label_singular']),
		'all_items' => sprintf(__('All %s', 'renovate_projects'), $re_projects_permalink['label_plural']),
		'view_item' => sprintf(__('View %s', 'renovate_projects'), $re_projects_permalink['label_singular']),
		'search_items' => sprintf(__('Search %s', 'renovate_projects'), $re_projects_permalink['label_plural']),
		'not_found' =>  sprintf(__('No %s found', 'renovate_projects'), strtolower($re_projects_permalink['label_plural'])),
		'not_found_in_trash' => sprintf(__('No %s found in Trash', 'renovate_projects'), strtolower($re_projects_permalink['label_plural'])), 
		'parent_item_colon' => '',
		'menu_name' => $re_projects_permalink['label_plural']
	);
	
	$args = array(  
		"labels" => $labels, 
		"public" => true,  
		"show_ui" => true,  
		"capability_type" => "post",
		"menu_position" => 20,
		"hierarchical" => false,  
		"rewrite" => array("slug" => $re_projects_permalink["slug"]),
		"supports" => array("title", "editor", "excerpt", "thumbnail", "page-attributes") 
	);
	register_post_type("re_projects", $args);
	register_taxonomy("re_projects_category", array("re_projects"), array("label" => "Categories", "singular_label" => "Category", "rewrite" => true));
}  
add_action("init", "re_projects_init"); 

//custom sidebars items list
function renovate_projects_edit_columns($columns)
{
	$columns = array(  
		"cb" => "<input type=\"checkbox\" />",  
		"title" => _x('Project name', 'post type singular name', 'renovate_projects'),
		"re_projects_category" => __('Categories', 'renovate_projects'),
		"order" =>  _x('Order', 'post type singular name', 'renovate_projects'),
		"date" => __('Date', 'renovate_projects')
	);    

	return $columns;  
}  
add_filter("manage_edit-re_projects_columns", "renovate_projects_edit_columns");

function manage_renovate_projects_posts_custom_column($column)
{
	global $post;
	switch($column)
	{
		case "re_projects_category":
			$re_projects_category_list = (array)get_the_terms($post->ID, "re_projects_category");
			foreach($re_projects_category_list as $re_projects_category)
			{
				if(empty($re_projects_category->slug))
					continue;
				echo '<a href="' . esc_url(admin_url("edit.php?post_type=re_projects&re_projects_category=" . $re_projects_category->slug)) . '">' . $re_projects_category->name . '</a>' . (end($re_projects_category_list)!=$re_projects_category ? ", " : "");;
			}
			break;
		case "order":
			echo get_post($post->ID)->menu_order;
			break;
	}
}
add_action("manage_re_projects_posts_custom_column", "manage_renovate_projects_posts_custom_column");

// Register the column as sortable
function renovate_projects_sortable_columns($columns) 
{
    $columns = array(
		"title" => "title",
		"order" => "order",
		"date" => "date"
	);

    return $columns;
}
add_filter("manage_edit-re_projects_sortable_columns", "renovate_projects_sortable_columns");

function re_projects_shortcode($atts)
{
	extract(shortcode_atts(array(
		"items_per_page" => "-1",
		"category" => "",
		"ids" => "",
		"order_by" => "title,menu_order",
		"order" => "ASC",
		"type" => "list",
		"all_label" => __("All Projects", 'renovate_projects'),
		"headers" => 1,
		"read_more" => 1,
		"read_more_label" => __("VIEW PROJECT", 'renovate_projects'),
		"top_margin" => "page-margin-top" 
	), $atts));
	
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
	query_posts(array(
		'post__in' => $ids,
		'post_type' => 're_projects',
		'posts_per_page' => $items_per_page,
		'post_status' => 'publish',
		're_projects_category' => implode(",", $category),
		'orderby' => implode(" ", explode(",", $order_by)),
		'order' => $order
	));
	
	
	$output = "";
	if(have_posts())
	{
		if($type=="isotope")
		{
			$categories_count = count($category);
			$output .= '<div class="clearfix gray small"><ul class="ui-tabs-nav isotope-filters margin-top-70">';
			if($all_label!="")
				$output .= '<li>
						<a class="selected" href="#filter-*" title="' . ($all_label!='' ? esc_attr($all_label) : '') . '">' . ($all_label!='' ? $all_label : '') . '</a>
					</li>';
			for($i=0; $i<$categories_count; $i++)
			{
				$term = get_term_by('slug', $category[$i], "re_projects_category");
				$output .= '<li>
						<a href="#filter-' . trim($category[$i]) . '" title="' . esc_attr($term->name) . '">' . $term->name . '</a>
					</li>';
			}
			$output .= '</ul>';
		}
		$output .= '<ul class="projects-list clearfix' . ($type=="isotope" ? ' isotope' : '') . ($top_margin!="none" ? ' ' . $top_margin : '') . '">';
		while(have_posts()): the_post();
			if($type=="isotope")
			{
				$categories = array_filter((array)get_the_terms(get_the_ID(), "re_projects_category"));
				$categories_count = count($categories);
				$categories_string = "";
				$i = 0;
				foreach($categories as $category)
				{
					$categories_string .= urldecode($category->slug) . ($i+1<$categories_count ? ' ' : '');
					$i++;
				}
			}
			$output .= '<li' . ($type=="isotope" ? ' class="' . $categories_string . '"' : '') . '>
			<a href="' . get_permalink() . '" title="' . esc_attr(get_the_title()) . '">
				' . get_the_post_thumbnail(get_the_ID(), ($type=="isotope" ? "small" : "big") . "-thumb" , array("alt" => get_the_title(), "title" => "")) . '
			</a>';
			if((int)$headers || (int)$read_more)
			{
				$output .= '<div class="view align-center">
					<div class="vertical-align-table">
						<div class="vertical-align-cell">';
				if((int)$headers)
					$output .= '<p class="description">' . get_the_title() . '</p>';
				if((int)$read_more)
					$output .= '<a class="more simple" href="' . get_permalink() . '" title="' . esc_attr($read_more_label) . '">' . $read_more_label . '</a>';
				$output .= '</div>
					</div>
				</div>';
			}
		endwhile;
		$output .= '</ul>';
		if($type=="isotope")
			$output .= '</div>';
	}
	//Reset Query
	wp_reset_query();
	return $output;
}
add_shortcode("re_projects", "re_projects_shortcode");

//visual composer
function re_projects_vc_init()
{
	if(is_plugin_active("js_composer/js_composer.php") && function_exists('vc_map'))
	{
		//get projects list
		$projects_list = get_posts(array(
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
			'post_type' => 're_projects'
		));
		$projects_array = array();
		$projects_array[__("All", 'renovate_projects')] = "-";
		foreach($projects_list as $project)
			$projects_array[$project->post_title . " (id:" . $project->ID . ")"] = $project->ID;
			
		//get projects categories list
		$projects_categories = get_terms("re_projects_category");
		$projects_categories_array = array();
		$projects_categories_array[__("All", 'renovate_projects')] = "-";
		foreach($projects_categories as $projects_category)
			$projects_categories_array[$projects_category->name] =  $projects_category->slug;

		vc_map( array(
			"name" => __("Projects list", 'renovate_projects'),
			"base" => "re_projects",
			"class" => "",
			"controls" => "full",
			"show_settings_on_create" => true,
			"icon" => "icon-wpb-layer-custom-post-type-list",
			"category" => __('Renovate', 'renovate_projects'),
			"params" => array(
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Items per page/Post count", 'renovate_projects'),
					"param_name" => "items_per_page",
					"value" => -1,
					"description" => __("Set -1 to display all.", 'renovate_projects')
				),
				array(
					"type" => "dropdownmulti",
					"class" => "",
					"heading" => __("Display selected", 'renovate_projects'),
					"param_name" => "ids",
					"value" => $projects_array
				),
				array(
					"type" => "dropdownmulti",
					"class" => "",
					"heading" => __("Display from Category", 'renovate_projects'),
					"param_name" => "category",
					"value" => $projects_categories_array
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Order by", 'renovate_projects'),
					"param_name" => "order_by",
					"value" => array(__("Title, menu order", 'renovate_projects') => "title,menu_order", __("Menu order", 'renovate_projects') => "menu_order", __("Date", 'renovate_projects') => "date", __("Random", 'renovate_projects') => "rand")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Order", 'renovate_projects'),
					"param_name" => "order",
					"value" => array(__("ascending", 'renovate_projects') => "ASC", __("descending", 'renovate_projects') => "DESC")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Type", 'renovate_projects'),
					"param_name" => "type",
					"value" => array(__("list", 'renovate_projects') => "list", __("isotope", 'renovate_projects') => "isotope")
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("All filter label", 'renovate_projects'),
					"param_name" => "all_label",
					"value" => __("All Projects", 'renovate_projects'),
					"dependency" => Array('element' => "type", 'value' => "isotope")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Headers", 'renovate_projects'),
					"param_name" => "headers",
					"value" => array(__("Yes", 'renovate_projects') => 1, __("No", 'renovate_projects') => 0)
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Read more button", 'renovate_projects'),
					"param_name" => "read_more",
					"value" => array(__("Yes", 'renovate_projects') => 1, __("No", 'renovate_projects') => 0)
				),
				array(
					"type" => "textfield",
					"class" => "",
					"heading" => __("Read more button label", 'renovate_projects'),
					"param_name" => "read_more_label",
					"value" => __("VIEW PROJECT", 'renovate_projects'),
					"dependency" => Array('element' => "read_more", 'value' => "1")
				),
				array(
					"type" => "dropdown",
					"class" => "",
					"heading" => __("Top margin", 'renovate_projects'),
					"param_name" => "top_margin",
					"value" => array(__("None", 'renovate_projects') => "none", __("Page (small)", 'renovate_projects') => "page-margin-top", __("Section (large)", 'renovate_projects') => "page-margin-top-section")
				)
			)
		));
	}
}
add_action("init", "re_projects_vc_init"); 
?>