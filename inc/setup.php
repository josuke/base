<?php
declare(strict_types=1);

add_action('after_setup_theme', static function (): void {
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);

	register_nav_menus([
		'primary' => 'Primary Menu',
	]);
});

add_action('wp_enqueue_scripts', static function (): void {
	$theme = wp_get_theme();
	$ver = $theme->get('Version');

	wp_enqueue_style('base-main', get_stylesheet_directory_uri() . '/assets/css/main.css', [], $ver);
	wp_enqueue_script('base-main', get_stylesheet_directory_uri() . '/assets/js/main.js', [], $ver, true);
});
