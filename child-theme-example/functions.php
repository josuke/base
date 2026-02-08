<?php
// Child theme setup and assets.
add_action('after_setup_theme', function () {
	add_editor_style(['assets/css/editor-style.css']);
});

add_action('wp_enqueue_scripts', function () {
	$theme = wp_get_theme();
	$ver = $theme->get('Version');

	$dir = get_stylesheet_directory();
	$uri = get_stylesheet_directory_uri();

	$css = $dir . '/assets/css/main.css';
	$js = $dir . '/assets/js/main.js';

	wp_enqueue_style('child-base', $uri . '/style.css', [], $ver);

	if (is_readable($css)) {
		$cssVer = (string) filemtime($css);
		wp_enqueue_style('child-main', $uri . '/assets/css/main.css', ['base-main'], $cssVer);
	}

	if (is_readable($js)) {
		$jsVer = (string) filemtime($js);
		wp_enqueue_script('child-main', $uri . '/assets/js/main.js', ['base-main'], $jsVer, true);
	}
});