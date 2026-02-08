<?php
declare(strict_types=1);

function base_customizer_defaults(): array {
	return [
		'color_brand' => '#a01443',
		'color_accent' => '#1e6bf3',
		'color_bg' => '#ffffff',
		'color_text' => '#000000',
		'font_body' => '"Roboto", sans-serif',
		'font_heading' => '"Montserrat", sans-serif',
	];
}

add_action('customize_register', static function ($wp_customize): void {
	$defaults = base_customizer_defaults();

	$wp_customize->add_section('base_design_tokens', [
		'title' => __('Base: Design Tokens', 'base'),
		'priority' => 30,
	]);

	$wp_customize->add_setting('base_color_brand', [
		'default' => $defaults['color_brand'],
		'sanitize_callback' => 'sanitize_hex_color',
	]);
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'base_color_brand', [
		'label' => __('Brand color', 'base'),
		'section' => 'base_design_tokens',
	]));

	$wp_customize->add_setting('base_color_accent', [
		'default' => $defaults['color_accent'],
		'sanitize_callback' => 'sanitize_hex_color',
	]);
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'base_color_accent', [
		'label' => __('Accent color', 'base'),
		'section' => 'base_design_tokens',
	]));

	$wp_customize->add_setting('base_color_bg', [
		'default' => $defaults['color_bg'],
		'sanitize_callback' => 'sanitize_hex_color',
	]);
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'base_color_bg', [
		'label' => __('Background color', 'base'),
		'section' => 'base_design_tokens',
	]));

	$wp_customize->add_setting('base_color_text', [
		'default' => $defaults['color_text'],
		'sanitize_callback' => 'sanitize_hex_color',
	]);
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'base_color_text', [
		'label' => __('Text color', 'base'),
		'section' => 'base_design_tokens',
	]));

	$wp_customize->add_setting('base_font_body', [
		'default' => $defaults['font_body'],
		'sanitize_callback' => 'sanitize_text_field',
	]);
	$wp_customize->add_control('base_font_body', [
		'label' => __('Body font (CSS font-family)', 'base'),
		'section' => 'base_design_tokens',
		'type' => 'text',
	]);

	$wp_customize->add_setting('base_font_heading', [
		'default' => $defaults['font_heading'],
		'sanitize_callback' => 'sanitize_text_field',
	]);
	$wp_customize->add_control('base_font_heading', [
		'label' => __('Heading font (CSS font-family)', 'base'),
		'section' => 'base_design_tokens',
		'type' => 'text',
	]);
});

add_action('wp_head', static function (): void {
	$defaults = base_customizer_defaults();

	$brand = get_theme_mod('base_color_brand', $defaults['color_brand']);
	$accent = get_theme_mod('base_color_accent', $defaults['color_accent']);
	$bg = get_theme_mod('base_color_bg', $defaults['color_bg']);
	$text = get_theme_mod('base_color_text', $defaults['color_text']);
	$fontBody = get_theme_mod('base_font_body', $defaults['font_body']);
	$fontHeading = get_theme_mod('base_font_heading', $defaults['font_heading']);

	if ($brand === $defaults['color_brand']
		&& $accent === $defaults['color_accent']
		&& $bg === $defaults['color_bg']
		&& $text === $defaults['color_text']
		&& $fontBody === $defaults['font_body']
		&& $fontHeading === $defaults['font_heading']) {
		return;
	}

	echo "\n<style id=\"base-design-tokens\">\n";
	echo ":root{\n";
	echo "\t--color-brand:" . esc_attr($brand) . ";\n";
	echo "\t--color-accent:" . esc_attr($accent) . ";\n";
	echo "\t--color-bg:" . esc_attr($bg) . ";\n";
	echo "\t--color-text:" . esc_attr($text) . ";\n";
	echo "\t--font-body:" . esc_attr($fontBody) . ";\n";
	echo "\t--font-heading:" . esc_attr($fontHeading) . ";\n";
	echo "}\n";
	echo "</style>\n";
}, 20);