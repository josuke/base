<?php
$args = (array) get_query_var('base_component_args', []);
$label = isset($args['label']) ? (string) $args['label'] : __('Theme', 'base');
?>
<button
	class="theme-toggle"
	type="button"
	data-theme-toggle
	aria-pressed="false"
	aria-label="<?php echo esc_attr($label); ?>"
>
	<?php echo base_svg('sun', ['class' => 'theme-toggle__icon theme-toggle__icon--light', 'aria-hidden' => 'true']); ?>
	<?php echo base_svg('moon', ['class' => 'theme-toggle__icon theme-toggle__icon--dark', 'aria-hidden' => 'true']); ?>
</button>
