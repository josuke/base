<?php
declare(strict_types=1);

function base_svg_sprite(): void {
	$path = get_template_directory() . '/assets/icons/sprite.svg';
	if (!is_readable($path)) {
		return;
	}

	echo '<div style="display:none" aria-hidden="true">';
	echo file_get_contents($path);
	echo '</div>';
}

function base_svg(string $name, array $attrs = []): string {
	$name = trim($name);
	if ($name === '') {
		return '';
	}

	$defaults = [
		'class' => 'sprite-icons',
		'aria-hidden' => 'true',
		'focusable' => 'false',
	];
	$attrs = array_merge($defaults, $attrs);

	$classes = preg_split('/\s+/', (string) $attrs['class'], -1, PREG_SPLIT_NO_EMPTY) ?: [];
	if (!in_array('sprite-icons', $classes, true)) {
		array_unshift($classes, 'sprite-icons');
	}
	$attrs['class'] = trim(implode(' ', $classes));

	$attrString = '';
	foreach ($attrs as $key => $value) {
		if ($value === null || $value === '') {
			continue;
		}
		$attrString .= ' ' . esc_attr((string) $key) . '="' . esc_attr((string) $value) . '"';
	}

	return '<svg' . $attrString . '><use href="#icon-' . esc_attr($name) . '"></use></svg>';
}
