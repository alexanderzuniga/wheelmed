<?php
get_header();
?>
<div class="theme-page padding-bottom-70">
	<div class="vc_row wpb_row vc_row-fluid gray full-width page-header vertical-align-table">
		<div class="vc_row wpb_row vc_inner vc_row-fluid">
			<div class="page-header-left">
				<h1><?php the_title(); ?></h1>
			</div>
			<div class="page-header-right">
				<div class="bread-crumb-container">
					<label><?php _e("You Are Here:", 'renovate'); ?></label>
					<ul class="bread-crumb">
						<li>
							<a href="<?php echo esc_url(get_home_url()); ?>" title="<?php esc_attr_e('Home', 'renovate'); ?>">
								<?php _e('HOME', 'renovate'); ?>
							</a>
						</li>
						<li class="separator">
							&#47;
						</li>
						<li>
							<?php the_title(); ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="clearfix<?php echo (function_exists("has_blocks") && has_blocks() ? ' has-gutenberg-blocks' : '');?>">
		<?php
		if(have_posts()) : while (have_posts()) : the_post();
			if(!function_exists("vc_map") && !has_blocks())
			{
				echo '<div class="vc_row wpb_row vc_row-fluid page-margin-top padding-bottom-70 single-page">';
			}
			the_content();
			if(!function_exists("vc_map") && !has_blocks())
			{
				echo '</div>';
			}
		endwhile; endif;
		?>
	</div>
</div>
<?php
get_footer(); 
?>