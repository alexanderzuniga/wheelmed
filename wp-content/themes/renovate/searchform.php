<div class="search-container clearfix">
	<a class="template-search" href="#" title="<?php esc_attr_e('Search', 'renovate');?>"></a>
	<form class="search-form" action="<?php echo esc_url(get_home_url()); ?>">
		<input name="s" class="search-input hint" type="text" value="<?php esc_attr_e('Search...', 'renovate'); ?>" placeholder="<?php esc_attr_e('Search...', 'renovate'); ?>">
		<fieldset class="search-submit-container">
			<span class="template-search"></span>
			<input type="submit" class="search-submit" value="">
		</fieldset>
	</form>
</div>