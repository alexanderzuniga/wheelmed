<?php
class re_contact_info_widget extends WP_Widget 
{
	/** constructor */
	function __construct()
	{
		$widget_options = array(
			'classname' => 're_contact_info_widget',
			'description' => 'Displays Contact Informations Box'
		);
        parent::__construct('renovate_contact_info', __('Contact Informations Box', 'renovate'), $widget_options);
    }
	
	/** @see WP_Widget::widget */
    function widget($args, $instance) 
	{
        extract($args);

		//these are our widget options
		$title = $instance['title'];
		$content = $instance['content'];
		$icon = $instance["icon"];

		echo $before_widget;
		echo '<div class="contact-details-box' . ($icon!="" && $icon!="none" ? ' sl-small-' . esc_attr($icon) : '') . '">';
		if($title) 
		{
			echo $before_title . apply_filters("widget_title", $title) . $after_title;
		}
		if($content!='')
			echo '<p>' . do_shortcode(apply_filters("widget_text", nl2br($content))) . '</p>';
		echo '</div>';
        echo $after_widget;
    }
	
	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) 
	{
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['content'] = $new_instance['content'];
		$instance['icon'] = $new_instance['icon'];
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) 
	{	
		$title = esc_attr(isset($instance['title']) ? $instance['title'] : '');
		$content = esc_attr(isset($instance['content']) ? $instance['content'] : '');
		$icon = (isset($instance["icon"]) ? $instance["icon"] : '');
		$icons = array(
			__("none", 'renovate') => "none",
			__("bricks", 'renovate') => "bricks",
			__("briefcase", 'renovate') => "briefcase",
			__("brush-1", 'renovate') => "brush-1",
			__("brush-2", 'renovate') => "brush-2",
			__("bubble", 'renovate') => "bubble",
			__("bubble check", 'renovate') => "bubble-check",
			__("bucket", 'renovate') => "bucket",
			__("building", 'renovate') => "building",
			__("calculator", 'renovate') => "calculator",
			__("camera", 'renovate') => "camera",
			__("cart-1", 'renovate') => "cart-1",
			__("cart-2", 'renovate') => "cart-2",
			__("chat", 'renovate') => "chat",
			__("clock", 'renovate') => "clock",
			__("cone", 'renovate') => "cone",
			__("construction", 'renovate') => "construction",
			__("conversation", 'renovate') => "conversation",
			__("lab", 'renovate') => "documents",
			__("door", 'renovate') => "door",
			__("driller", 'renovate') => "driller",
			__("eco", 'renovate') => "eco",
			__("faq", 'renovate') => "faq",
			__("fax", 'renovate') => "fax",
			__("fence", 'renovate') => "fence",
			__("forklift", 'renovate') => "forklift",
			__("garage", 'renovate') => "garage",
			__("gears", 'renovate') => "gears",
			__("globe", 'renovate') => "globe",
			__("hammer", 'renovate') => "hammer",
			__("helmet", 'renovate') => "helmet",
			__("house-1", 'renovate') => "house-1",
			__("house-2", 'renovate') => "house-2",
			__("key", 'renovate') => "key",
			__("documents", 'renovate') => "lab",
			__("lightbulb", 'renovate') => "lightbulb",
			__("list", 'renovate') => "list",
			__("location", 'renovate') => "location",
			__("lock", 'renovate') => "lock",
			__("mail", 'renovate') => "mail",
			__("measure", 'renovate') => "measure",
			__("megaphone", 'renovate') => "megaphone",
			__("payment", 'renovate') => "payment",
			__("pencil", 'renovate') => "pencil",
			__("percent", 'renovate') => "percent",
			__("person", 'renovate') => "person",
			__("phone", 'renovate') => "phone",
			__("photo", 'renovate') => "photo",
			__("picture", 'renovate') => "picture",
			__("plan", 'renovate') => "plan",
			__("poster", 'renovate') => "poster",
			__("quote", 'renovate') => "quote",
			__("roller", 'renovate') => "roller",
			__("ruler", 'renovate') => "ruler",
			__("scissors", 'renovate') => "scissors",
			__("screwdriver", 'renovate') => "screwdriver",
			__("shield", 'renovate') => "shield",
			__("shovel", 'renovate') => "shovel",
			__("speaker", 'renovate') => "speaker",
			__("stationery", 'renovate') => "stationery",
			__("team", 'renovate') => "team",
			__("tick", 'renovate') => "tick",
			__("trolley", 'renovate') => "trolley",
			__("trophy", 'renovate') => "trophy",
			__("trowel", 'renovate') => "trowel",
			__("truck", 'renovate') => "truck",
			__("video", 'renovate') => "video",
			__("wallet", 'renovate') => "wallet",
			__("watering-can", 'renovate') => "watering-can",
			__("wrench", 'renovate') => "wrench",
			__("wrenches", 'renovate') => "wrenches");
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php _e('Title', 'renovate'); ?></label>
			<input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('icon')); ?>"><?php _e('Icon', 'renovate'); ?></label>
			<select id="<?php echo esc_attr($this->get_field_id('icon')); ?>" name="<?php echo esc_attr($this->get_field_name('icon')); ?>">
				<?php foreach($icons as $ico)
				{
				?>
				<option value="<?php echo (isset($ico) ? esc_attr($ico) : ''); ?>"<?php echo (isset($icon) && $ico==$icon ? " selected='selected'" : "") ?>><?php echo $ico; ?></option>
				<?php
				}
				?>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('content')); ?>"><?php _e('Content', 'renovate'); ?></label>
			<textarea rows="10" class="widefat" id="<?php echo esc_attr($this->get_field_id('content')); ?>" name="<?php echo esc_attr($this->get_field_name('content')); ?>"><?php echo $content; ?></textarea>
		</p>
		<?php
	}
}
//register widget
function re_contact_info_widget_init()
{
	return register_widget("re_contact_info_widget");
}
add_action('widgets_init', 're_contact_info_widget_init');
?>