<?php
declare(strict_types=1);

/**
 * Render a component from template-parts/{slug}/index.php with optional args.
 */
function base_component(string $slug, array $args = []): void {
	$slug = trim($slug);
	if ($slug === '') {
		return;
	}

	$childDir = get_stylesheet_directory() . '/template-parts/' . $slug;
	$childUri = get_stylesheet_directory_uri() . '/template-parts/' . $slug;
	$parentDir = get_template_directory() . '/template-parts/' . $slug;
	$parentUri = get_template_directory_uri() . '/template-parts/' . $slug;

	$dir = $childDir;
	$uri = $childUri;
	$php = $dir . '/index.php';

	if (!is_readable($php)) {
		$dir = $parentDir;
		$uri = $parentUri;
		$php = $dir . '/index.php';
	}

	if (!is_readable($php)) {
		return;
	}

	$assetsEnabled = apply_filters('base_component_assets_enabled', true, $slug);
	if ($assetsEnabled) {
		$css = $dir . '/style.css';
		if (is_readable($css) && filesize($css) > 0) {
			$handle = 'base-part-' . $slug;
			$ver = (string) filemtime($css);
			wp_enqueue_style($handle, $uri . '/style.css', [], $ver);
		}

		$js = $dir . '/script.js';
		if (is_readable($js) && filesize($js) > 0) {
			$handle = 'base-part-' . $slug;
			$ver = (string) filemtime($js);
			wp_enqueue_script($handle, $uri . '/script.js', [], $ver, true);
		}
	}

	set_query_var('base_component_args', $args);
	include $php;
	set_query_var('base_component_args', null);
}
