<?php
$args = (array) get_query_var('base_component_args', []);
$label = isset($args['label']) ? (string) $args['label'] : __('Loading', 'base');
?>
<div class="loader-overlay" data-loader aria-hidden="true" role="presentation">
	<div class="loader-overlay__inner" role="status" aria-live="polite">
		<span class="loader-overlay__percent" data-loader-percent>0%</span>
	</div>
</div>
