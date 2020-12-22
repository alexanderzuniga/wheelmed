<?php
//google map
function re_theme_map_shortcode($atts)
{
	extract(shortcode_atts(array(
		"id" => "map",
		"width" => "100%",
		"height" => "",
		"map_type" => "ROADMAP",
		"lat" => "51.112265",
		"lng" => "17.033787",
		"marker_lat" => "51.112265",
		"marker_lng" => "17.033787",
		"zoom" => "16",
		"streetviewcontrol" => "false",
		"maptypecontrol" => "false",
		"map_icon_url" => get_template_directory_uri() . "/images/map_pointer.png",
		"icon_width" => 38,
		"icon_height" => 48,
		"icon_anchor_x" => 18,
		"icon_anchor_y" => 48,
		"scrollwheel" => "false",
		"draggable" => "false",
		"top_margin" => "none"
	), $atts));
	wp_enqueue_script("google-maps-v3");
	$map_type = strtoupper($map_type);
	$width = (substr($width, -1)!="%" && substr($width, -2)!="px" ? $width . "px" : $width);
	$height = (substr($height, -1)!="%" && substr($height, -2)!="px" ? $height . "px" : $height);
	$output = "<div id='" . esc_attr($id) . "'" . ($width!="" || $height!="" ? " style='" . ($width!="" ? "width:" . esc_attr($width) . ";" : "") . ($height!="" ? "height:" . esc_attr($height) . ";" : "") . "'" : "") . ($top_margin!="none" ? " class='" . esc_attr($top_margin) . "'" : "") . "></div>";
	$script = "var map_$id = null;
	var coordinate_$id;
	try
    {
        coordinate_$id=new google.maps.LatLng($lat, $lng);
        var mapOptions= 
        {
            zoom:$zoom,
            center:coordinate_$id,
            mapTypeId:google.maps.MapTypeId.$map_type,
			streetViewControl:$streetviewcontrol,
			mapTypeControl:$maptypecontrol,
			scrollwheel: $scrollwheel,
			draggable: $draggable,
			styles: [ { 'featureType': 'water', 'elementType': 'geometry', 'stylers': [ { 'color': '#8ccaf1' } ] },{ 'featureType': 'poi', 'stylers': [ { 'visibility': 'off' } ] },{ 'featureType': 'transit', 'stylers': [ { 'visibility': 'off' } ] },{ 'featureType': 'water', 'elementType': 'labels', 'stylers': [ { 'color': '#ffffff' }, { 'visibility': 'simplified' } ] } ]
        };
        var map_$id = new google.maps.Map(document.getElementById('$id'),mapOptions);";
	if($marker_lat!="" && $marker_lng!="")
	{
	$script .= "
		var marker_$id = new google.maps.Marker({
			position: new google.maps.LatLng($marker_lat, $marker_lng),
			map: map_$id" . ($map_icon_url!="" ? ", icon: new google.maps.MarkerImage('$map_icon_url', new google.maps.Size($icon_width, $icon_height), null, new google.maps.Point($icon_anchor_x, $icon_anchor_y))" : "") . "
		});";
		/*var infowindow = new google.maps.InfoWindow();
		infowindow.setContent('<p style=\'color:#000;\'>your html content</p>');
		infowindow.open(map_$id,marker_$id);*/
	}
	$script .= "
    }
    catch(e) {};
	jQuery(document).ready(function($){
		$(window).resize(function(){
			if(map_$id!=null)
				map_$id.setCenter(coordinate_$id);
		});
	});";
	wp_add_inline_script("google-maps-v3", $script);
	return $output;
}

//visual composer
function re_theme_google_map_vc_init()
{
	global $theme_options;
	vc_map( array(
		"name" => __("Google map", 'renovate'),
		"base" => "re_map",
		"class" => "",
		"controls" => "full",
		"show_settings_on_create" => true,
		"icon" => "icon-wpb-map-pin",
		"category" => __('Renovate', 'renovate'),
		"params" => array(
			array(
				"type" => "readonly",
				"class" => "",
				"heading" => __("Google API Key", 'renovate'),
				"param_name" => "api_key",
				"value" => $theme_options["google_api_code"],
				"description" => sprintf(__("Please provide valid Google API Key under <a href='%s' title='Theme Options'>Theme Options</a>", 'renovate'), esc_url(admin_url("themes.php?page=ThemeOptions")))
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Id", 'renovate'),
				"param_name" => "id",
				"value" => "map",
				"description" => __("Please provide unique id for each map on the same page/post", 'renovate')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Width", 'renovate'),
				"param_name" => "width",
				"value" => "100%"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Height", 'renovate'),
				"param_name" => "height",
				"value" => ""
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type", 'renovate'),
				"param_name" => "map_type",
				"value" => array(__("Roadmap", 'renovate') => "ROADMAP", __("Satellite", 'renovate') => "SATELLITE", __("Hybrid", 'renovate') => "HYBRID", __("Terrain", 'renovate') => "TERRAIN")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Latitude", 'renovate'),
				"param_name" => "lat",
				"value" => "51.112265",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'renovate')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Longitude", 'renovate'),
				"param_name" => "lng",
				"value" => "17.033787",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'renovate')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point Latitude", 'renovate'),
				"param_name" => "marker_lat",
				"value" => "51.112265",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'renovate')
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/point Longitude", 'renovate'),
				"param_name" => "marker_lng",
				"value" => "17.033787",
				"description" => __("You can use this <a href='http://www.birdtheme.org/useful/v3tool.html' target='_blank'>http://www.birdtheme.org/useful/v3tool.html</a> tool to designate coordinates", 'renovate')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Map Zoom", "renovate"),
				"param_name" => "zoom",
				"value" => array(__("16 - Default", "renovate") => 16, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 17, 18, 19, 20)
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Street view control", 'renovate'),
				"param_name" => "streetviewcontrol",
				"value" => array(__("no", 'renovate') => "false", __("yes", 'renovate') => "true")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Map type control", 'renovate'),
				"param_name" => "maptypecontrol",
				"value" => array(__("no", 'renovate') => "false", __("yes", 'renovate') => "true")
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Marker/Point icon url", 'renovate'),
				"param_name" => "map_icon_url",
				"value" => get_template_directory_uri() . "/images/map_pointer.png"
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon width", 'renovate'),
				"param_name" => "icon_width",
				"value" => 38
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon height", 'renovate'),
				"param_name" => "icon_height",
				"value" => 48
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor x", 'renovate'),
				"param_name" => "icon_anchor_x",
				"value" => 18
			),
			array(
				"type" => "textfield",
				"class" => "",
				"heading" => __("Icon anchor y", 'renovate'),
				"param_name" => "icon_anchor_y",
				"value" => 48
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Mouse scroll wheel", 'renovate'),
				"param_name" => "scrollwheel",
				"value" => array(__("no", 'renovate') => "false", __("yes", 'renovate') => "true")
			),
			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __("Draggable", 'renovate'),
				"param_name" => "draggable",
				"value" => array(__("no", 'renovate') => "false", __("yes", 'renovate') => "true")
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
}
add_action("init", "re_theme_google_map_vc_init");
?>