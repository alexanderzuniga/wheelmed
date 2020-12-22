<?php
global $themename;
//admin menu
function re_theme_admin_menu() 
{
	add_theme_page(__('Theme Options', 'renovate') ,__('Theme Options', 'renovate'), 'edit_theme_options', 'ThemeOptions', "renovate_options");
}
add_action("admin_menu", "re_theme_admin_menu");

function re_theme_stripslashes_deep($value)
{
	$value = is_array($value) ?
				array_map('stripslashes_deep', $value) :
				stripslashes($value);

	return $value;
}

function renovate_save_options()
{
	global $themename;

	$theme_options = array(
		"favicon_url" => $_POST["favicon_url"],
		"logo_url" => $_POST["logo_url"],
		"logo_text" => $_POST["logo_text"],
		"footer_text" => $_POST["footer_text"],
		"sticky_menu" => (int)$_POST["sticky_menu"],
		"responsive" => (int)$_POST["responsive"],
		"scroll_top" => (int)$_POST["scroll_top"],
		"layout" => $_POST["layout"],
		"layout_style" => $_POST["layout_style"],
		"layout_image_overlay" => (isset($_POST["layout_image_overlay"]) && $_POST["layout_image_overlay"]!="" ? $_POST["layout_image_overlay"] : "0"),
		"style_selector" => $_POST["style_selector"],
		"direction" => $_POST["direction"],
		"collapsible_mobile_submenus" => $_POST["collapsible_mobile_submenus"],
		"google_api_code" => $_POST["google_api_code"],
		"google_recaptcha" => $_POST["google_recaptcha"],
		"google_recaptcha_comments" => $_POST["google_recaptcha_comments"],
		"recaptcha_site_key" => $_POST["recaptcha_site_key"],
		"recaptcha_secret_key" => $_POST["recaptcha_secret_key"],
		"ga_tracking_code" => $_POST["ga_tracking_code"],
		"cf_admin_name" => $_POST["cf_admin_name"],
		"cf_admin_email" => $_POST["cf_admin_email"],
		"cf_smtp_host" => $_POST["cf_smtp_host"],
		"cf_smtp_username" => $_POST["cf_smtp_username"],
		"cf_smtp_password" => $_POST["cf_smtp_password"],
		"cf_smtp_port" => $_POST["cf_smtp_port"],
		"cf_smtp_secure" => $_POST["cf_smtp_secure"],
		"cf_email_subject" => $_POST["cf_email_subject"],
		"cf_template" => $_POST["cf_template"],
		"cf_name_message" => $_POST["cf_name_message"],
		"cf_email_message" => $_POST["cf_email_message"],
		"cf_phone_message" => $_POST["cf_phone_message"],
		"cf_message_message" => $_POST["cf_message_message"],
		"cf_recaptcha_message" => $_POST["cf_recaptcha_message"],
		"cf_terms_message" => $_POST["cf_terms_message"],
		"cf_thankyou_message" => $_POST["cf_thankyou_message"],
		"cf_error_message" => $_POST["cf_error_message"],
		"cf_name_message_comments" => $_POST["cf_name_message_comments"],
		"cf_email_message_comments" => $_POST["cf_email_message_comments"],
		"cf_comment_message_comments" => $_POST["cf_comment_message_comments"],
		"cf_recaptcha_message_comments" => $_POST["cf_recaptcha_message_comments"],
		"cf_terms_message_comments" => $_POST["cf_terms_message_comments"],
		"cf_thankyou_message_comments" => $_POST["cf_thankyou_message_comments"],
		"cf_error_message_comments" => $_POST["cf_error_message_comments"],
		/*"color_scheme" => $_POST["color_scheme"],*/
		/*"font_size_selector" => $_POST["font_size_selector"],*/
		"site_background_color" => $_POST["site_background_color"],
		"main_color" => $_POST["main_color"],
		/*"header_style" => $_POST["header_style"],*/
		"header_top_sidebar" => $_POST["header_top_sidebar"],
		/*"header_top_right_sidebar" => $_POST["header_top_right_sidebar"],*/
		"primary_font" => $_POST["primary_font"],
		"primary_font_subset" => (isset($_POST["primary_font_subset"]) ? $_POST["primary_font_subset"] : ""),
		"primary_font_custom" => $_POST["primary_font_custom"]/*,
		"secondary_font" => $_POST["secondary_font"],
		"secondary_font_custom" => $_POST["secondary_font_custom"],
		"text_font" => $_POST["text_font"],
		"text_font_custom" => $_POST["text_font_custom"]*/
	);
	update_option($themename . "_options", $theme_options);
	echo json_encode($_POST);
	exit();
}
add_action('wp_ajax_' . $themename . '_save', $themename . '_save_options');

function renovate_options() 
{
	global $themename;

	$theme_options = array(
		"favicon_url" => '',
		"logo_url" => '',
		"logo_text" => '',
		"footer_text" => '',
		"sticky_menu" => '',
		"responsive" => '',
		"scroll_top" => '',
		"layout" => '',
		"layout_style" => '',
		"layout_image_overlay" => '',
		"style_selector" => '',
		"direction" => '',
		"collapsible_mobile_submenus" => '',
		"google_api_code" => '',
		"google_recaptcha" => '',
		"google_recaptcha_comments" => '',
		"recaptcha_site_key" =>'',
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
		"primary_font_subset" => '',
		"primary_font_custom" => ''
	);
	$theme_options = re_theme_stripslashes_deep(array_merge($theme_options, get_option($themename . "_options")));
	if(isset($_POST["action"]) && $_POST["action"]==$themename . "_save")
	{
	?>
	<div class="updated"> 
		<p>
			<strong>
				<?php _e('Options saved', 'renovate'); ?>
			</strong>
		</p>
	</div>
	<?php
	}
	//get google fonts
	$fontsArray = re_get_google_fonts();
	?>
	<form class="theme_options" action="<?php echo esc_url($_SERVER['REQUEST_URI']); ?>" method="post" id="theme-options-panel">
		<div class="header">
			<div class="header_left">
				<h3>
					<a href="<?php echo esc_url(__('https://1.envato.market/quanticalabs-portfolio-themeforest', 'renovate')); ?>" title="<?php esc_attr_e("QuanticaLabs", 'renovate'); ?>">
						<?php _e("QuanticaLabs", 'renovate'); ?>
					</a>
				</h3>
				<h5><?php _e("Theme Options", 'renovate'); ?></h5>
			</div>
			<div class="header_right">
				<div class="description">
					<h3>
						<a href="<?php echo esc_url(__('https://1.envato.market/renovate-construction-renovation-wordpress-theme', 'renovate')); ?>" title="<?php esc_attr_e("Renovate - Construction Renovation Theme", 'renovate'); ?>" rel="nofollow">
							<?php _e("Renovate - Construction Renovation Theme", 'renovate'); ?>
						</a>
					</h3>
					<h5><?php _e("Version 6.2", 'renovate'); ?></h5>
					<a class="description_link" target="_blank" href="<?php echo esc_url(get_template_directory_uri() . '/documentation/index.html'); ?>"><?php _e("Documentation", 'renovate'); ?></a>
					<a class="description_link" target="_blank" href="<?php echo esc_url(__('http://support.quanticalabs.com', 'renovate')); ?>"><?php _e("Support Forum", 'renovate'); ?></a>
					<a class="description_link" target="_blank" href="<?php echo esc_url(__('https://1.envato.market/renovate-construction-renovation-wordpress-theme', 'renovate')); ?>" rel="nofollow"><?php _e("Theme site", 'renovate'); ?></a>
				</div>
				<a class="logo" href="<?php echo esc_url(__('https://1.envato.market/quanticalabs-portfolio-themeforest', 'renovate')); ?>" title="<?php esc_attr_e("QuanticaLabs", 'renovate'); ?>">
					&nbsp;
				</a>
			</div>
		</div>
		<div class="content clearfix">
			<ul class="menu">
				<li>
					<a href='#tab-main' class="selected">
						<span class="dashicons dashicons-hammer"></span>
						<?php _e('Main', 'renovate'); ?>
					</a>
				</li>
				<li>
					<a href="#tab-email-config">
						<span class="dashicons dashicons-email-alt"></span>
						<?php _e('Email Config', 'renovate'); ?>
					</a>
				</li>
				<li>
					<a href="#tab-colors">
						<span class="dashicons dashicons-art"></span>
						<?php _e('Colors', 'renovate'); ?>
					</a>
				</li>
				<li>
					<a href="#tab-header">
						<span class="dashicons dashicons-welcome-widgets-menus"></span>
						<?php _e('Header', 'renovate'); ?>
					</a>
				</li>
				<li>
					<a href="#tab-fonts">
						<span class="dashicons dashicons-editor-textcolor"></span>
						<?php _e('Fonts', 'renovate'); ?>
					</a>
				</li>
			</ul>
			<div id="tab-main" class="settings" style="display: block;">
				<h3><?php _e('Main', 'renovate'); ?></h3>
				<ul class="form_field_list">
					<?php
					if(is_plugin_active('ql_importer/ql_importer.php'))
					{
					?>
					<li>
						<label for="import_dummy"><?php _e('DUMMY CONTENT IMPORT', 'renovate'); ?></label>
						<input type="button" class="button" name="renovate_import_dummy" id="import_dummy" value="<?php esc_attr_e('Import dummy content', 'renovate'); ?>" />
						<img id="dummy_content_preloader" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/ajax-loader.gif'); ?>" />
						<img id="dummy_content_tick" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/tick.png'); ?>" />
						<div id="dummy_templates_sidebars">
							<label class="small_label" for="import_templates_sidebars"><input type="checkbox" name="renovate_import_templates_sidebars" id="import_templates_sidebars" value="1"><?php _e('Import only template pages and sidebars', 'renovate'); ?></label>
						</div>
						<div id="dummy_content_info"></div>
					</li>
					<?php
					if(is_plugin_active('woocommerce/woocommerce.php')):
					?>
					<li>
						<label for="import_shop_dummy"><?php _e('DUMMY SHOP CONTENT IMPORT', 'renovate'); ?></label>
						<input type="button" class="button" name="renovate_import_shop_dummy" id="import_shop_dummy" value="<?php esc_attr_e('Import shop dummy content', 'renovate'); ?>" />
						<img id="dummy_shop_content_preloader" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/ajax-loader.gif'); ?>" />
						<img id="dummy_shop_content_tick" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/tick.png'); ?>" />
						<div id="dummy_shop_content_info"></div>
					</li>
					<?php
					endif;
					}
					else
					{
					?>
					<li>
						<label for="import_dummy"><?php _e('DUMMY CONTENT IMPORT', 'renovate'); ?></label>
						<label class="small_label"><?php printf(__('Please <a href="%s" title="Install Plugins">install and activate</a> Theme Dummy Content Importer plugin to enable dummy content import option.', 'renovate'), menu_page_url('install-required-plugins', false)); ?></label>
					</li>
					<?php
					}
					?>
					<li>
						<label for="favicon_url"><?php _e('FAVICON URL', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["favicon_url"]); ?>" id="favicon_url" name="favicon_url">
							<input type="button" class="button" name="<?php echo esc_attr($themename);?>_upload_button" id="favicon_url_upload_button" value="<?php esc_attr_e('Insert favicon', 'renovate'); ?>" />
						</div>
					</li>
					<li>
						<label for="logo_url"><?php _e('LOGO URL', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_url"]); ?>" id="logo_url" name="logo_url">
							<input type="button" class="button" name="<?php echo esc_attr($themename);?>_upload_button" id="logo_url_upload_button" value="<?php esc_attr_e('Insert logo', 'renovate'); ?>" />
						</div>
					</li>
					<li>
						<label for="logo_text"><?php _e('LOGO TEXT', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["logo_text"]); ?>" id="logo_text" name="logo_text">
						</div>
					</li>
					<li>
						<label for="footer_text"><?php _e('FOOTER TEXT', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["footer_text"]); ?>" id="footer_text" name="footer_text">
						</div>
					</li>
					<li>
						<label for="sticky_menu"><?php _e('STICKY MENU', 'renovate'); ?></label>
						<div>
							<select id="sticky_menu" name="sticky_menu">
								<option value="0"<?php echo ((int)$theme_options["sticky_menu"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'renovate'); ?></option>
								<option value="1"<?php echo ((int)$theme_options["sticky_menu"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'renovate'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="responsive"><?php _e('RESPONSIVE', 'renovate'); ?></label>
						<div>
							<select id="responsive" name="responsive">
								<option value="1"<?php echo ((int)$theme_options["responsive"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'renovate'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["responsive"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'renovate'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="scroll_top"><?php _e('SCROLL TO TOP ICON', 'renovate'); ?></label>
						<div>
							<select id="scroll_top" name="scroll_top">
								<option value="1"<?php echo ((int)$theme_options["scroll_top"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'renovate'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["scroll_top"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'renovate'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="layout"><?php _e('LAYOUT', 'renovate'); ?></label>
						<div>
							<select id="layout" name="layout">
								<option value="fullwidth"<?php echo ($theme_options["layout"]=="fullwidth" ? " selected='selected'" : "") ?>><?php _e('full width', 'renovate'); ?></option>
								<option value="boxed"<?php echo ($theme_options["layout"]=="boxed" ? " selected='selected'" : "") ?>><?php _e('boxed', 'renovate'); ?></option>
							</select>
						</div>
					</li>
					<li class="boxed_bg_image clearfix"<?php echo ($theme_options["layout"]!="boxed" ? ' style="display: none;"' : ''); ?>>
						<label for="layout"><?php _e('BOXED LAYOUT BACKGROUND', 'renovate');?></label>
						<div>
							<label class="small_label"><?php _e("Boxed Layout Background Color", 'renovate'); ?></label>
							<div<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='color_preview' ? ' class="selected"' : ''); ?>>
								<a href="#" class="color_preview" style="background-color: #<?php echo ($theme_options["site_background_color"]!="" ? esc_attr($theme_options["site_background_color"]) : 'E5E5E5'); ?>;"><span class="tick"></span></a>
								<input type="text" class="regular-text color short" value="<?php echo esc_attr($theme_options["site_background_color"]); ?>" id="site_background_color" name="site_background_color" data-default-color="E5E5E5">
							</div>
							<br>
							<label class="small_label"><?php _e("Boxed Layout Pattern", 'renovate'); ?></label>
							<ul class="layout_chooser clearfix">
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-1' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-1">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-2' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-2">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-3' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-3">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-4' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-4">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-5' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-5">
										<span class="tick"></span>
									</a>
								</li>
								<li class="first<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-6' ? ' selected' : ''); ?>">
									<a href="#" class="pattern-6">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-7' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-7">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-8' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-8">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-9' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-9">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='pattern-10' ? ' class="selected"' : ''); ?>>
									<a href="#" class="pattern-10">
										<span class="tick"></span>
									</a>
								</li>
							</ul>
							<label class="small_label"><?php _e("Boxed Layout Image", 'renovate'); ?></label>
							<ul class="layout_chooser clearfix">
								<li<?php echo (!isset($theme_options['layout_style']) || (isset($theme_options['layout_style']) && $theme_options['layout_style']=='image-1') ? ' class="selected"' : ''); ?>>
									<a href="#" class="image-1">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='image-2' ? ' class="selected"' : ''); ?>>
									<a href="#" class="image-2">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='image-3' ? ' class="selected"' : ''); ?>>
									<a href="#" class="image-3">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='image-4' ? ' class="selected"' : ''); ?>>
									<a href="#" class="image-4">
										<span class="tick"></span>
									</a>
								</li>
								<li<?php echo (isset($theme_options['layout_style']) && $theme_options['layout_style']=='image-5' ? ' class="selected"' : ''); ?>>
									<a href="#" class="image-5">
										<span class="tick"></span>
									</a>
								</li>
								<li class="first">
									<input type="checkbox"<?php echo ((isset($theme_options['layout_image_overlay']) && $theme_options['layout_image_overlay']=='overlay') || !isset($theme_options['layout_image_overlay']) ? ' checked="checked"' : ''); ?> id="overlay" name="layout_image_overlay" value="overlay"><label class="overlay_label small_label" for="overlay"><?php _e("overlay", 'renovate'); ?></label>
								</li>
							</ul>
							<input type="hidden" name="layout_style" id="layout_style_input" value="<?php echo esc_attr($theme_options['layout_style']); ?>">
						</div>
					</li>
					<li>
						<label for="style_selector"><?php _e('SHOW STYLE SELECTOR', 'renovate'); ?></label>
						<div>
							<select id="style_selector" name="style_selector">
								<option value="0"<?php echo (!(int)$theme_options["style_selector"] ? " selected='selected'" : "") ?>><?php _e('no', 'renovate'); ?></option>
								<option value="1"<?php echo ((int)$theme_options["style_selector"] ? " selected='selected'" : "") ?>><?php _e('yes', 'renovate'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="direction"><?php _e('Direction', 'renovate'); ?></label>
						<div>
							<select id="direction" name="direction">
								<option value="default" <?php echo ($theme_options["direction"]=="default" ? " selected='selected'" : "") ?>><?php _e('Default', 'renovate'); ?></option>
								<option value="ltr" <?php echo ($theme_options["direction"]=="ltr" ? " selected='selected'" : "") ?>><?php _e('LTR', 'renovate'); ?></option>
								<option value="rtl" <?php echo ($theme_options["direction"]=="rtl" ? " selected='selected'" : "") ?>><?php _e('RTL', 'renovate'); ?></option>	
							</select>
						</div>
					</li>
					<li>
						<label for="collapsible_mobile_submenus"><?php _e('Collapsible mobile submenus', 'renovate'); ?></label>
						<div>
							<select id="collapsible_mobile_submenus" name="collapsible_mobile_submenus">
								<option value="1"<?php echo (!isset($theme_options["collapsible_mobile_submenus"]) || (int)$theme_options["collapsible_mobile_submenus"]==1 ? " selected='selected'" : "") ?>><?php _e('yes', 'renovate'); ?></option>
								<option value="0"<?php echo ((int)$theme_options["collapsible_mobile_submenus"]==0 ? " selected='selected'" : "") ?>><?php _e('no', 'renovate'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="google_recaptcha"><?php _e('Use reCaptcha in contact forms', 'renovate'); ?></label>
						<div>
							<select id="google_recaptcha" name="google_recaptcha">
								<option value="0"<?php echo (!(int)$theme_options["google_recaptcha"] ? " selected='selected'" : "") ?>><?php _e('no', 'renovate'); ?></option>
								<option value="1"<?php echo ((int)$theme_options["google_recaptcha"] ? " selected='selected'" : "") ?>><?php _e('yes', 'renovate'); ?></option>
							</select>
						</div>
					</li>
					<li>
						<label for="google_recaptcha_comments"><?php _e('Use reCaptcha in comment forms', 'renovate'); ?></label>
						<div>
							<select id="google_recaptcha_comments" name="google_recaptcha_comments">
								<option value="0"<?php echo (!(int)$theme_options["google_recaptcha_comments"] ? " selected='selected'" : "") ?>><?php _e('no', 'renovate'); ?></option>
								<option value="1"<?php echo ((int)$theme_options["google_recaptcha_comments"] ? " selected='selected'" : "") ?>><?php _e('yes', 'renovate'); ?></option>
							</select>
						</div>
					</li>
					<li class="google-recaptcha-depends<?php echo (!(int)$theme_options["google_recaptcha"] ? ' hidden' : ''); ?>">
						<label for="recaptcha_site_key"><?php _e('Google reCaptcha Site key', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["recaptcha_site_key"]); ?>" id="recaptcha_site_key" name="recaptcha_site_key">
							<label class="small_label"><?php printf(__('You can generate reCaptcha keys <a href="%s" target="_blank" title="Get reCaptcha keys">here</a>', 'renovate'), "https://www.google.com/recaptcha/admin"); ?></label>
						</div>
					</li>
					<li class="google-recaptcha-depends"<?php echo (!(int)$theme_options["google_recaptcha"] ? ' hidden' : ''); ?>>
						<label for="recaptcha_secret_key"><?php _e('Google reCaptcha Secret key', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["recaptcha_secret_key"]); ?>" id="recaptcha_secret_key" name="recaptcha_secret_key">
							<label class="small_label"><?php printf(__('You can generate reCaptcha keys <a href="%s" target="_blank" title="Get reCaptcha keys">here</a>', 'renovate'), "https://www.google.com/recaptcha/admin"); ?></label>
						</div>
					</li>
					<li>
						<label for="google_api_code"><?php _e('Google Maps API Key', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["google_api_code"]); ?>" id="google_api_code" name="google_api_code">
							<label class="small_label"><?php printf(__('You can generate API Key <a href="%s" target="_blank" title="Generate API Key">here</a>', 'renovate'), "https://developers.google.com/maps/documentation/javascript/get-api-key"); ?></label>
						</div>
					</li>
					<li>
						<label for="ga_tracking_code"><?php _e('Google Analytics tracking code', 'renovate'); ?></label>
						<div>
							<textarea id="ga_tracking_code" name="ga_tracking_code"><?php echo (isset($theme_options["ga_tracking_code"]) ? esc_attr($theme_options["ga_tracking_code"]) : ""); ?></textarea>							
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-email-config" class="settings">
				<h3><?php _e('Contact Form', 'renovate'); ?></h3>
				<h4><?php _e('ADMIN EMAIL CONFIG', 'renovate'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_admin_name"><?php _e('NAME', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_name"]); ?>" id="cf_admin_name" name="cf_admin_name">
						</div>
					</li>
					<li>
						<label for="cf_admin_email"><?php _e('EMAIL', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_admin_email"]); ?>" id="cf_admin_email" name="cf_admin_email">
						</div>
					</li>
				</ul>
				<h4><?php _e('ADMIN SMTP CONFIG (OPTIONAL)', 'renovate'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_smtp_host"><?php _e('HOST', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_host"]); ?>" id="cf_smtp_host" name="cf_smtp_host">
						</div>
					</li>
					<li>
						<label for="cf_smtp_username"><?php _e('USERNAME', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_username"]); ?>" id="cf_smtp_username" name="cf_smtp_username">
						</div>
					</li>
					<li>
						<label for="cf_smtp_password"><?php _e('PASSWORD', 'renovate'); ?></label>
						<div>
							<input type="password" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_password"]); ?>" id="cf_smtp_password" name="cf_smtp_password">
						</div>
					</li>
					<li>
						<label for="cf_smtp_port"><?php _e('PORT', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_smtp_port"]); ?>" id="cf_smtp_port" name="cf_smtp_port">
						</div>
					</li>
					<li>
						<label for="cf_smtp_secure"><?php _e('SMTP SECURE', 'renovate'); ?></label>
						<div>
							<select id="cf_smtp_secure" name="cf_smtp_secure">
								<option value=""<?php echo ($theme_options["cf_smtp_secure"]=="" ? " selected='selected'" : "") ?>>-</option>
								<option value="ssl"<?php echo ($theme_options["cf_smtp_secure"]=="ssl" ? " selected='selected'" : "") ?>><?php _e('ssl', 'renovate'); ?></option>
								<option value="tls"<?php echo ($theme_options["cf_smtp_secure"]=="tls" ? " selected='selected'" : "") ?>><?php _e('tls', 'renovate'); ?></option>
							</select>
						</div>
					</li>
				</ul>
				<h4><?php _e('EMAIL CONFIG', 'renovate'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_email_subject"><?php _e('EMAIL SUBJECT', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_subject"]); ?>" id="cf_email_subject" name="cf_email_subject">
						</div>
					</li>
					<li>
						<label for="cf_template"><?php _e('TEMPLATE', 'renovate'); ?></label>
						<div>
							<?php _e("Available shortcodes:", 'renovate'); ?><br><strong>[name]</strong>, <strong>[email]</strong>, <strong>[phone]</strong>, <strong>[message]</strong>, <strong>[form_data]</strong><br><br>
							<?php wp_editor($theme_options["cf_template"], "cf_template");?>
						</div>
					</li>
				</ul>
				<h4><?php _e('CONTACT FORM MESSAGES', 'renovate'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_name_message"><?php _e('Name field required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_name_message"]); ?>" id="cf_name_message" name="cf_name_message">
						</div>
					</li>
					<li>
						<label for="cf_email_message"><?php _e('Email field required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_message"]); ?>" id="cf_email_message" name="cf_email_message">
						</div>
					</li>
					<li>
						<label for="cf_phone_message"><?php _e('Phone field required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_phone_message"]); ?>" id="cf_phone_message" name="cf_phone_message">
						</div>
					</li>
					<li>
						<label for="cf_message_message"><?php _e('Message field required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_message_message"]); ?>" id="cf_message_message" name="cf_message_message">
						</div>
					</li>
					<li>
						<label for="cf_recaptcha_message"><?php _e('reCaptcha required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_recaptcha_message"]); ?>" id="cf_recaptcha_message" name="cf_recaptcha_message">
						</div>
					</li>
					<li>
						<label for="cf_terms_message"><?php _e('Terms and conditions checkbox required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_terms_message"]); ?>" id="cf_terms_message" name="cf_terms_message">
						</div>
					</li>
					<li>
						<label for="cf_thankyou_message"><?php _e('Form thank you message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_thankyou_message"]); ?>" id="cf_thankyou_message" name="cf_thankyou_message">
						</div>
					</li>
					<li>
						<label for="cf_error_message"><?php _e('Form error message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_error_message"]); ?>" id="cf_error_message" name="cf_error_message">
						</div>
					</li>
				</ul>
				<h4><?php _e('COMMENTS FORM MESSAGES', 'renovate'); ?></h4>
				<ul class="form_field_list">
					<li>
						<label for="cf_name_message_comments"><?php _e('Name field required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_name_message_comments"]); ?>" id="cf_name_message_comments" name="cf_name_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_email_message_comments"><?php _e('Email field required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_email_message_comments"]); ?>" id="cf_email_message_comments" name="cf_email_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_comment_message_comments"><?php _e('Comment field required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_comment_message_comments"]); ?>" id="cf_comment_message_comments" name="cf_comment_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_recaptcha_message_comments"><?php _e('reCaptcha required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_recaptcha_message_comments"]); ?>" id="cf_recaptcha_message_comments" name="cf_recaptcha_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_terms_message_comments"><?php _e('Terms and conditions checkbox required message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_terms_message_comments"]); ?>" id="cf_terms_message_comments" name="cf_terms_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_thankyou_message_comments"><?php _e('Form thank you message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_thankyou_message_comments"]); ?>" id="cf_thankyou_message_comments" name="cf_thankyou_message_comments">
						</div>
					</li>
					<li>
						<label for="cf_error_message_comments"><?php _e('Form error message', 'renovate'); ?></label>
						<div>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["cf_error_message_comments"]); ?>" id="cf_error_message_comments" name="cf_error_message_comments">
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-colors" class="settings">
				<h3><?php _e('Colors', 'renovate'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="main_color"><?php _e('Main color', 'renovate'); ?></label>
						<div>
							<span class="color_preview" style="background-color: #<?php echo ($theme_options["main_color"]!="" ? esc_attr($theme_options["main_color"]) : 'F4BC16'); ?>;"></span>
							<input type="text" class="regular-text color short margin_top_0" value="<?php echo esc_attr($theme_options["main_color"]); ?>" id="main_color" name="main_color" data-default-color="F4BC16">
						</div>
						<div>
							<br>
							<label class="small_label"><?php _e("Choose from predefined colors", 'renovate'); ?></label>
							<ul class="layout_chooser for_main_color clearfix">
								<li>
									<a href="#" class="color_preview" style="background-color: #5FC7AE;" data-color="5FC7AE">&nbsp;</a>
								</li>
								<li>
									<a href="#" class="color_preview" style="background-color: #F68220;" data-color="F68220">&nbsp;</a>
								</li>
								<li>
									<a href="#" class="color_preview" style="background-color: #82B541;" data-color="82B541">&nbsp;</a>
								</li>
								<li>
									<a href="#" class="color_preview" style="background-color: #66A1C3;" data-color="66A1C3">&nbsp;</a>
								</li>
							</ul>
						</div>
					</li>
				</ul>
			</div>
			<div id="tab-header" class="settings">
				<h3><?php _e('Header', 'renovate'); ?></h3>
				<ul class="form_field_list">
					<?php
					/*<li class="header_style_container"<?php echo ($theme_options["color_scheme"]=="high_contrast" ? ' style="display: none;"' : ''); ?>>
						<label for="header_style"><?php _e('Header style', 'renovate'); ?></label>
						<div>
							<select id="header_style" name="header_style">
								<?php
								for($i=0; $i<15; $i++)
								{
								?>
								<option<?php echo ($theme_options["header_style"]=="style_" . ($i+1) ? " selected='selected'" : ""); ?>  value="style_<?php echo ($i+1);?>"><?php _e("Style " . ($i+1), 'renovate'); ?></option>
								<?php
								}
								?>
								<option<?php echo ($theme_options["header_style"]=="style_high_contrast" ? " selected='selected'" : ""); ?>  value="style_high_contrast"><?php _e("Style high contrast", 'renovate'); ?></option>
							</select>
						</div>
					</li>*/
					?>
					<li>
						<label for="header_top_sidebar"><?php _e('Header top sidebar', 'renovate'); ?></label>
						<div>
						<?php
						//get theme sidebars
						$theme_sidebars = array();
						$theme_sidebars_array = get_posts(array(
							'post_type' => 'renovate_sidebars',
							'posts_per_page' => '-1',
							'nopaging' => true,
							'post_status' => 'publish',
							'orderby' => 'menu_order',
							'order' => 'ASC'
						));
						for($i=0; $i<count($theme_sidebars_array); $i++)
						{
							$theme_sidebars[$i]["id"] = $theme_sidebars_array[$i]->ID;
							$theme_sidebars[$i]["title"] = $theme_sidebars_array[$i]->post_title;
						}
						?>
						<select id="header_top_sidebar" name="header_top_sidebar">
							<option value=""<?php echo ($theme_options["header_top_sidebar"]=="" ? " selected='selected'" : ""); ?>><?php _e("none", 'renovate'); ?></option>
							<?php
							foreach($theme_sidebars as $theme_sidebar)
							{
								?>
								<option value="<?php echo esc_attr($theme_sidebar["id"]); ?>"<?php echo ($theme_options["header_top_sidebar"]==$theme_sidebar["id"] ? " selected='selected'" : ""); ?>><?php echo $theme_sidebar["title"]; ?></option>
								<?php
							}
							?>
						</select>
						</div>
					</li>
					<?php
					/*
					<li id="header_top_right_sidebar_container">
						<label for="header_top_right_sidebar"><?php _e('Header top right sidebar', 'renovate'); ?></label>
						<div>
						<select id="header_top_right_sidebar" name="header_top_right_sidebar">
							<option value=""<?php echo ($theme_options["header_top_right_sidebar"]=="" ? " selected='selected'" : ""); ?>><?php _e("none", 'renovate'); ?></option>
							<?php
							foreach($theme_sidebars as $theme_sidebar)
							{
								?>
								<option value="<?php echo esc_attr($theme_sidebar["id"]); ?>"<?php echo ($theme_options["header_top_right_sidebar"]==$theme_sidebar["id"] ? " selected='selected'" : ""); ?>><?php echo $theme_sidebar["title"]; ?></option>
								<?php
							}
							?>
						</select>
						</div>
					</li>*/
					?>
				</ul>
			</div>
			<div id="tab-fonts" class="settings">
				<h3><?php _e('Fonts', 'renovate'); ?></h3>
				<ul class="form_field_list">
					<li>
						<label for="primary_font"><?php _e('Primary font', 'renovate'); ?></label>
						<div>
							<label class="small_label"><?php _e('Enter font name', 'renovate'); ?></label>
							<input type="text" class="regular-text" value="<?php echo esc_attr($theme_options["primary_font_custom"]); ?>" id="primary_font_custom" name="primary_font_custom">
							<label class="small_label margin_top_10"><?php _e('or choose Google font', 'renovate'); ?></label>
							<select id="primary_font" name="primary_font">
								<option<?php echo ($theme_options["primary_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (Raleway)", 'renovate'); ?></option>
								<?php
								$fontsCount = count($fontsArray->items);
								for($i=0; $i<$fontsCount; $i++)
								{
								?>
									
									<?php
									$variantsCount = count($fontsArray->items[$i]->variants);
									if($variantsCount>1)
									{
										for($j=0; $j<$variantsCount; $j++)
										{
										?>
											<option<?php echo ($theme_options["primary_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]); ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
										<?php
										}
									}
									else
									{
									?>
									<option<?php echo ($theme_options["primary_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family); ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
									<?php
									}
								}
								?>
							</select>
							<img class="theme_font_subset_preloader" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/ajax-loader.gif');?>" />
							<label class="small_label font_subset margin_top_10" style="<?php echo (!empty($theme_options["primary_font"]) ? "display: block;" : ""); ?>"><?php _e('Google font subset:', 'renovate'); ?></label>
							<select id="primary_font_subset" class="font_subset" name="primary_font_subset[]" multiple="multiple" style="<?php echo (!empty($theme_options["primary_font"]) ? "display: block;" : ""); ?>">
							<?php
							if(!empty($theme_options["primary_font"]))
							{
								$fontExplode = explode(":", $theme_options["primary_font"]);
								$font_subset = re_get_google_font_subset($fontExplode[0]);
								foreach($font_subset as $subset)
									echo "<option value='" . esc_attr($subset) . "' " . (in_array($subset, $theme_options["primary_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
							}
							?>
							</select>
						</div>
					</li>
				</ul>
			</div>
		</div>
		<div class="footer">
			<div class="footer_left">
				<ul class="social-list">
					<li><a target="_blank" href="<?php echo esc_url(__('http://www.facebook.com/QuanticaLabs/', 'renovate')); ?>" class="social-facebook" title="<?php esc_html_e('Facebook', 'renovate'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://twitter.com/quanticalabs', 'renovate')); ?>" class="social-twitter" title="<?php esc_html_e('Twitter', 'renovate'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://www.pinterest.com/quanticalabs/', 'renovate')); ?>" class="social-pinterest" title="<?php esc_html_e('Pinterest', 'renovate'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://1.envato.market/quanticalabs', 'renovate')); ?>" class="social-envato" title="<?php esc_html_e('Envato', 'renovate'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://www.behance.net/quanticalabs', 'renovate')); ?>" class="social-behance" title="<?php esc_html_e('Behance', 'renovate'); ?>"></a></li>
					<li><a target="_blank" href="<?php echo esc_url(__('https://dribbble.com/QuanticaLabs', 'renovate')); ?>" class="social-dribbble" title="<?php esc_html_e('Dribbble', 'renovate'); ?>"></a></li>
				</ul>
			</div>
			<div class="footer_right">
				<input type="hidden" name="action" value="<?php echo esc_attr($themename); ?>_save" />
				<input type="submit" name="submit" value="Save Options" />
				<img id="theme_options_preloader" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/ajax-loader.gif');?>" />
				<img id="theme_options_tick" src="<?php echo esc_url(get_template_directory_uri() . '/admin/images/tick.png');?>" />
			</div>
		</div>
	</form>
<?php
}
?>