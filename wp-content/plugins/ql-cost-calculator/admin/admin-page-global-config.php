<div class="wrap cost-calculator-settings-section">
	<h2><?php _e("Global settings", "cost-calculator"); ?></h2>
</div>
<?php
if(!empty($message))
{
?>
<div class="<?php echo ($message!="" ? "updated" : "error"); ?> settings-error"> 
	<p>
		<?php echo $message; ?>
	</p>
</div>
<?php
}
//get google fonts
$fontsArray = cc_get_google_fonts();
?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>" method="post" class="cost-calculator-config-form">
	<div class="cost-calculator-form-table-container">
		<table class="form-table">
			<tbody>
				<tr valign="top">
					<th scope="row">
						<label for="calculator_skin">
							<?php _e("Predefined skin", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<select id="calculator_skin" name="calculator_skin">
							<option value="default"<?php echo ($cost_calculator_global_form_options["calculator_skin"]=="default" ? " selected='selected'" : ""); ?>><?php _e("Skin 1 (Clean)", 'cost-calculator'); ?></option>
							<option value="carservice"<?php echo ($cost_calculator_global_form_options["calculator_skin"]=="carservice" ? " selected='selected'" : ""); ?>><?php _e("Skin 2 (Car Service)", 'cost-calculator'); ?></option>
							<option value="renovate"<?php echo ($cost_calculator_global_form_options["calculator_skin"]=="renovate" ? " selected='selected'" : ""); ?>><?php _e("Skin 3 (Renovation)", 'cost-calculator'); ?></option>
							<option value="gymbase"<?php echo ($cost_calculator_global_form_options["calculator_skin"]=="gymbase" ? " selected='selected'" : ""); ?>><?php _e("Skin 3 (GymBase)", 'cost-calculator'); ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="main_color">
							<?php _e("Main color", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<div class="cost-calculator-colorpicker-container">
							<span class="cost-calculator-color-preview" style="background-color: #<?php echo ($cost_calculator_global_form_options["main_color"]!="" ? esc_attr($cost_calculator_global_form_options["main_color"]) : '56B665'); ?>;"></span>
							<input type="text" class="regular-text cost-calculator-color input-short" value="<?php echo esc_attr($cost_calculator_global_form_options["main_color"]); ?>" id="main_color" name="main_color" data-default-color="56B665">
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="text_color">
							<?php _e("Box background color", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<div class="cost-calculator-colorpicker-container">
							<span class="cost-calculator-color-preview" style="background-color: #<?php echo ($cost_calculator_global_form_options["box_color"]!="" ? esc_attr($cost_calculator_global_form_options["box_color"]) : 'transparent'); ?>;"></span>
							<input type="text" class="regular-text cost-calculator-color input-short" value="<?php echo esc_attr($cost_calculator_global_form_options["box_color"]); ?>" id="box_color" name="box_color" data-default-color="transparent">
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="text_color">
							<?php _e("Text color", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<div class="cost-calculator-colorpicker-container">
							<span class="cost-calculator-color-preview" style="background-color: #<?php echo ($cost_calculator_global_form_options["text_color"]!="" ? esc_attr($cost_calculator_global_form_options["text_color"]) : '303030'); ?>;"></span>
							<input type="text" class="regular-text cost-calculator-color input-short" value="<?php echo esc_attr($cost_calculator_global_form_options["text_color"]); ?>" id="text_color" name="text_color" data-default-color="303030">
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="border_color">
							<?php _e("Borders color", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<div class="cost-calculator-colorpicker-container">
							<span class="cost-calculator-color-preview" style="background-color: #<?php echo ($cost_calculator_global_form_options["border_color"]!="" ? esc_attr($cost_calculator_global_form_options["border_color"]) : 'EBEBEB'); ?>;"></span>
							<input type="text" class="regular-text cost-calculator-color input-short" value="<?php echo esc_attr($cost_calculator_global_form_options["border_color"]); ?>" id="border_color" name="border_color" data-default-color="EBEBEB">
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="label_color">
							<?php _e("Labels color", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<div class="cost-calculator-colorpicker-container">
							<span class="cost-calculator-color-preview" style="background-color: #<?php echo ($cost_calculator_global_form_options["label_color"]!="" ? esc_attr($cost_calculator_global_form_options["label_color"]) : '303030'); ?>;"></span>
							<input type="text" class="regular-text cost-calculator-color input-short" value="<?php echo esc_attr($cost_calculator_global_form_options["label_color"]); ?>" id="label_color" name="label_color" data-default-color="303030">
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="form_label_color">
							<?php _e("Form labels color", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<div class="cost-calculator-colorpicker-container">
							<span class="cost-calculator-color-preview" style="background-color: #<?php echo ($cost_calculator_global_form_options["form_label_color"]!="" ? esc_attr($cost_calculator_global_form_options["form_label_color"]) : '999999'); ?>;"></span>
							<input type="text" class="regular-text cost-calculator-color input-short" value="<?php echo esc_attr($cost_calculator_global_form_options["form_label_color"]); ?>" id="form_label_color" name="form_label_color" data-default-color="999999">
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="inactive_color">
							<?php _e("Inactive color", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<div class="cost-calculator-colorpicker-container">
							<span class="cost-calculator-color-preview" style="background-color: #<?php echo ($cost_calculator_global_form_options["inactive_color"]!="" ? esc_attr($cost_calculator_global_form_options["inactive_color"]) : 'EEEEEE'); ?>;"></span>
							<input type="text" class="regular-text cost-calculator-color input-short" value="<?php echo esc_attr($cost_calculator_global_form_options["inactive_color"]); ?>" id="inactive_color" name="inactive_color" data-default-color="EEEEEE">
						</div>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="primary_font_custom">
							<?php _e("Primary font name", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<input type="text" class="regular-text input-full-width" value="<?php echo esc_attr($cost_calculator_global_form_options["primary_font_custom"]); ?>" id="primary_font_custom" name="primary_font_custom">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="primary_font">
							<?php _e("Primary font google", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<span class="spinner"></span>
						<select id="primary_font" name="primary_font">
							<option<?php echo ($cost_calculator_global_form_options["primary_font"]=="" ? " selected='selected'" : ""); ?>  value=""><?php _e("Default (Raleway)", 'cost-calculator'); ?></option>
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
										<option<?php echo ($cost_calculator_global_form_options["primary_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]); ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
									<?php
									}
								}
								else
								{
								?>
								<option<?php echo ($cost_calculator_global_form_options["primary_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family); ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
								<?php
								}
							}
							?>
						</select>
					</td>
				</tr>
				<tr valign="top"<?php echo (empty($cost_calculator_global_form_options["primary_font"]) ? ' class="cost-calculator-hidden"' : ''); ?>>
					<th scope="row">
						<label for="primary_font_subset">
							<?php _e("Google font subset", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<select id="primary_font_subset" class="font-subset" name="primary_font_subset[]" multiple="multiple">
						<?php
						if(!empty($cost_calculator_global_form_options["primary_font"]))
						{
							$fontExplode = explode(":", $cost_calculator_global_form_options["primary_font"]);
							$font_subset = cc_get_google_font_subset($fontExplode[0]);
							foreach($font_subset as $subset)
								echo "<option value='" . esc_attr($subset) . "' " . (in_array($subset, $cost_calculator_global_form_options["primary_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
						}
						?>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="secondary_font_custom">
							<?php _e("Secondary font name", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<input type="text" class="regular-text input-full-width" value="<?php echo esc_attr($cost_calculator_global_form_options["secondary_font_custom"]); ?>" id="secondary_font_custom" name="secondary_font_custom">
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="secondary_font">
							<?php _e("Secondary font google", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<span class="spinner"></span>
						<select id="secondary_font" name="secondary_font">
							<option<?php echo ($cost_calculator_global_form_options["secondary_font"]=="" ? " selected='selected'" : ""); ?> value=""><?php _e("Default (Lato)", 'cost-calculator'); ?></option>
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
										<option<?php echo ($cost_calculator_global_form_options["secondary_font"]==$fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j] ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]); ?>"><?php echo $fontsArray->items[$i]->family . ":" . $fontsArray->items[$i]->variants[$j]; ?></option>
									<?php
									}
								}
								else
								{
								?>
								<option<?php echo ($cost_calculator_global_form_options["secondary_font"]==$fontsArray->items[$i]->family ? " selected='selected'" : ""); ?> value="<?php echo esc_attr($fontsArray->items[$i]->family); ?>"><?php echo $fontsArray->items[$i]->family; ?></option>
								<?php
								}
							}
							?>
						</select>
					</td>
				</tr>
				<tr valign="top"<?php echo (empty($cost_calculator_global_form_options["secondary_font"]) ? ' class="cost-calculator-hidden"' : ''); ?>>
					<th scope="row">
						<label for="secondary_font_subset">
							<?php _e("Google font subset", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<select id="secondary_font_subset" class="font-subset" name="secondary_font_subset[]" multiple="multiple">
						<?php
						if(!empty($cost_calculator_global_form_options["secondary_font"]))
						{
							$fontExplode = explode(":", $cost_calculator_global_form_options["secondary_font"]);
							$font_subset = cc_get_google_font_subset($fontExplode[0]);
							foreach($font_subset as $subset)
								echo "<option value='" . esc_attr($subset) . "' " . (in_array($subset, $cost_calculator_global_form_options["secondary_font_subset"]) ? "selected='selected'" : "") . ">" . $subset . "</option>";							
						}
						?>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="send_email">
							<?php _e("Send calculation email to admin", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<select id="send_email" name="send_email">
							<option value="1"<?php echo ((int)$cost_calculator_global_form_options["send_email"] ? " selected='selected'" : ""); ?>><?php _e("yes", 'cost-calculator'); ?></option>
							<option value="0"<?php echo (!(int)$cost_calculator_global_form_options["send_email"] ? " selected='selected'" : ""); ?>><?php _e("no", 'cost-calculator'); ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="send_email_client">
							<?php _e("Send calculation email to client", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<select id="send_email_client" name="send_email_client">
							<option value="1"<?php echo ((int)$cost_calculator_global_form_options["send_email_client"] ? " selected='selected'" : ""); ?>><?php _e("yes", 'cost-calculator'); ?></option>
							<option value="0"<?php echo (!(int)$cost_calculator_global_form_options["send_email_client"] ? " selected='selected'" : ""); ?>><?php _e("no", 'cost-calculator'); ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="save_calculation">
							<?php _e("Save calculation in database", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<select id="save_calculation" name="save_calculation">
							<option value="1"<?php echo ((int)$cost_calculator_global_form_options["save_calculation"] ? " selected='selected'" : ""); ?>><?php _e("yes", 'cost-calculator'); ?></option>
							<option value="0"<?php echo (!(int)$cost_calculator_global_form_options["save_calculation"] ? " selected='selected'" : ""); ?>><?php _e("no", 'cost-calculator'); ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="calculation_status">
							<?php _e("Default calculation status", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<select id="calculation_status" name="calculation_status">
							<option value="draft"<?php echo ($cost_calculator_global_form_options["calculation_status"]=="draft" ? " selected='selected'" : ""); ?>><?php _e("draft", 'cost-calculator'); ?></option>
							<option value="pending"<?php echo ($cost_calculator_global_form_options["calculation_status"]=="pending" ? " selected='selected'" : ""); ?>><?php _e("pending", 'cost-calculator'); ?></option>
							<option value="publish"<?php echo ($cost_calculator_global_form_options["calculation_status"]=="publish" ? " selected='selected'" : ""); ?>><?php _e("publish", 'cost-calculator'); ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top">
					<th scope="row">
						<label for="google_recaptcha">
							<?php _e("Use reCaptcha in calculation forms", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<select id="google_recaptcha" name="google_recaptcha">
							<option value="0"<?php echo (!(int)$cost_calculator_global_form_options["google_recaptcha"] ? " selected='selected'" : "") ?>><?php _e('no', 'cost-calculator'); ?></option>
							<option value="1"<?php echo ((int)$cost_calculator_global_form_options["google_recaptcha"] ? " selected='selected'" : "") ?>><?php _e('yes', 'cost-calculator'); ?></option>
						</select>
					</td>
				</tr>
				<tr valign="top" class="google-recaptcha-depends<?php echo (!(int)$cost_calculator_global_form_options["google_recaptcha"] ? ' cost-calculator-hidden' : ''); ?>">
					<th scope="row">
						<label for="recaptcha_site_key">
							<?php _e("Google reCaptcha Site key", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<input type="text" class="regular-text input-full-width" value="<?php echo esc_attr($cost_calculator_global_form_options["recaptcha_site_key"]); ?>" id="recaptcha_site_key" name="recaptcha_site_key">
					</td>
				</tr>
				<tr valign="top" class="google-recaptcha-depends<?php echo (!(int)$cost_calculator_global_form_options["google_recaptcha"] ? ' cost-calculator-hidden' : ''); ?>">
					<th scope="row">
						<label for="recaptcha_secret_key">
							<?php _e("Google reCaptcha Secret key", "cost-calculator"); ?>
						</label>
					</th>
					<td>
						<input type="text" class="regular-text input-full-width" value="<?php echo esc_attr($cost_calculator_global_form_options["recaptcha_secret_key"]); ?>" id="recaptcha_secret_key" name="recaptcha_secret_key">
					</td>
				</tr>
				<tr valign="top" class="no-border">
					<th colspan="2">
						<input type="submit" value="<?php esc_attr_e("Save Options", 'cost-calculator'); ?>" class="button-primary" name="submit">
						<input type="hidden" name="action" value="save">

					</th>
				</tr>
			</tbody>
		</table>
	</div>
</form>