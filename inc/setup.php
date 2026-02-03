<?php
declare(strict_types=1);

add_action('after_setup_theme', static function (): void {
	load_theme_textdomain('base', get_template_directory() . '/languages');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
	add_theme_support('responsive-embeds');
	add_theme_support('align-wide');

	register_nav_menus([
		'primary' => __('Primary Menu', 'base'),
	]);
});

add_action('wp_enqueue_scripts', static function (): void {
	$enabled = apply_filters('base_enable_assets', true);
	if (!$enabled) {
		return;
	}

	$theme = wp_get_theme();
	$ver = $theme->get('Version');

	wp_enqueue_style('base-main', get_template_directory_uri() . '/assets/css/main.css', [], $ver);
	wp_enqueue_script('base-main', get_template_directory_uri() . '/assets/js/main.js', [], $ver, true);
});
