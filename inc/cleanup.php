<?php
declare(strict_types=1);

add_action('init', static function (): void {
	$options = apply_filters('base_head_cleanup_options', [
		'wp_head_meta' => true,
		'emoji' => true,
		'oembed' => true,
	]);

	if (!is_array($options)) {
		return;
	}

	if (!empty($options['wp_head_meta'])) {
		remove_action('wp_head', 'wp_generator');
		remove_action('wp_head', 'rsd_link');
		remove_action('wp_head', 'wlwmanifest_link');
		remove_action('wp_head', 'wp_shortlink_wp_head');
		remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
	}

	if (!empty($options['emoji'])) {
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('admin_print_styles', 'print_emoji_styles');
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
	}

	if (!empty($options['oembed'])) {
		remove_action('wp_head', 'wp_oembed_add_discovery_links');
		remove_action('wp_head', 'wp_oembed_add_host_js');
	}
});
