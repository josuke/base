<?php
declare(strict_types=1);

function base_asset_version(string $path, string $fallback): string {
	if (is_readable($path)) {
		$mtime = filemtime($path);
		if ($mtime !== false) {
			return (string) $mtime;
		}
	}

	return $fallback;
}

add_action('after_setup_theme', static function (): void {
	load_theme_textdomain('base', get_template_directory() . '/languages');
	add_theme_support('title-tag');
	add_theme_support('post-thumbnails');
	add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
	add_theme_support('responsive-embeds');
	add_theme_support('align-wide');
	add_theme_support('custom-logo');
	add_theme_support('appearance-tools');
	add_theme_support('wp-block-styles');
	add_theme_support('customize-selective-refresh-widgets');
	add_theme_support('editor-styles');
	add_editor_style([
		'assets/css/variables.css',
		'assets/css/editor-style.css',
	]);

	register_nav_menus([
		'primary' => __('Primary Menu', 'base'),
	]);
});

add_action('customize_register', static function ($wp_customize): void {
	$wp_customize->add_setting('dark_logo', [
		'default' => '',
		'sanitize_callback' => 'absint',
	]);

	$wp_customize->add_control(new WP_Customize_Media_Control($wp_customize, 'dark_logo', [
		'label' => __('Logo del sitio (modo oscuro)', 'base'),
		'section' => 'title_tagline',
		'mime_type' => 'image',
	]));
});

add_action('wp_head', static function (): void {
	if (is_admin()) {
		return;
	}

	$description = '';
	if (is_singular()) {
		$excerpt = get_the_excerpt();
		if (is_string($excerpt)) {
			$description = trim(wp_strip_all_tags($excerpt));
		}
	}

	if ($description === '') {
		$description = (string) get_bloginfo('description');
	}

	if ($description === '') {
		return;
	}

	echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
}, 1);

add_action('wp_enqueue_scripts', static function (): void {
	$enabled = apply_filters('base_enable_assets', true);
	if (!$enabled) {
		return;
	}

	$theme = wp_get_theme();
	$ver = $theme->get('Version');

	$varsPath = get_template_directory() . '/assets/css/variables.css';
	$cssPath = get_template_directory() . '/assets/css/main.css';
	$jsPath = get_template_directory() . '/assets/js/main.js';
	$varsVer = base_asset_version($varsPath, (string) $ver);
	$cssVer = base_asset_version($cssPath, (string) $ver);
	$jsVer = base_asset_version($jsPath, (string) $ver);

	wp_enqueue_style('base-vars', get_template_directory_uri() . '/assets/css/variables.css', [], $varsVer);
	wp_enqueue_style('base-main', get_template_directory_uri() . '/assets/css/main.css', [], $cssVer);
	wp_enqueue_script('base-main', get_template_directory_uri() . '/assets/js/main.js', [], $jsVer, true);
});
