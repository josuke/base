<?php
declare(strict_types=1);

function base_font_choices(): array {
	return [
		'roboto' => [
			'label' => 'Roboto',
			'stack' => 'Roboto, sans-serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap',
		],
		'inter' => [
			'label' => 'Inter',
			'stack' => 'Inter, sans-serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
		],
		'open-sans' => [
			'label' => 'Open Sans',
			'stack' => 'Open Sans, sans-serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap',
		],
		'lato' => [
			'label' => 'Lato',
			'stack' => 'Lato, sans-serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap',
		],
		'montserrat' => [
			'label' => 'Montserrat',
			'stack' => 'Montserrat, sans-serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap',
		],
		'poppins' => [
			'label' => 'Poppins',
			'stack' => 'Poppins, sans-serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap',
		],
		'raleway' => [
			'label' => 'Raleway',
			'stack' => 'Raleway, sans-serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Raleway:wght@400;600;700&display=swap',
		],
		'source-sans-3' => [
			'label' => 'Source Sans 3',
			'stack' => 'Source Sans 3, sans-serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;600;700&display=swap',
		],
		'merriweather' => [
			'label' => 'Merriweather',
			'stack' => 'Merriweather, serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Merriweather:wght@400;700&display=swap',
		],
		'playfair-display' => [
			'label' => 'Playfair Display',
			'stack' => 'Playfair Display, serif',
			'google' => 'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&display=swap',
		],
	];
}

function base_customizer_defaults(): array {
	return [
		'color_brand' => '#a01443',
		'color_accent' => '#1e6bf3',
		'color_bg' => '#ffffff',
		'color_text' => '#000000',
		'font_body' => 'roboto',
		'font_heading' => 'montserrat',
	];
}

function base_sanitize_font_choice(string $value): string {
	$choices = base_font_choices();
	if (isset($choices[$value])) {
		return $value;
	}

	$defaults = base_customizer_defaults();
	return $defaults['font_body'];
}

function base_get_font_stack(string $choice): string {
	$choices = base_font_choices();
	if (isset($choices[$choice])) {
		return $choices[$choice]['stack'];
	}

	$defaults = base_customizer_defaults();
	return $choices[$defaults['font_body']]['stack'];
}

function base_enqueue_font_choice(string $choice, string $handle): void {
	$choices = base_font_choices();
	if (!isset($choices[$choice])) {
		return;
	}

	$url = $choices[$choice]['google'] ?? '';
	if ($url !== '') {
		wp_enqueue_style($handle, $url, [], null);
	}
}

add_action('customize_register', static function ($wp_customize): void {
	$defaults = base_customizer_defaults();
	$choices = base_font_choices();
	$fontOptions = [];
	foreach ($choices as $key => $data) {
		$fontOptions[$key] = $data['label'];
	}

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

	$wp_customize->add_setting('base_font_body_choice', [
		'default' => $defaults['font_body'],
		'sanitize_callback' => 'base_sanitize_font_choice',
	]);
	$wp_customize->add_control('base_font_body_choice', [
		'label' => __('Body font', 'base'),
		'section' => 'base_design_tokens',
		'type' => 'select',
		'choices' => $fontOptions,
	]);

	$wp_customize->add_setting('base_font_heading_choice', [
		'default' => $defaults['font_heading'],
		'sanitize_callback' => 'base_sanitize_font_choice',
	]);
	$wp_customize->add_control('base_font_heading_choice', [
		'label' => __('Heading font', 'base'),
		'section' => 'base_design_tokens',
		'type' => 'select',
		'choices' => $fontOptions,
	]);
});

add_action('wp_enqueue_scripts', static function (): void {
	$defaults = base_customizer_defaults();
	$bodyChoice = get_theme_mod('base_font_body_choice', $defaults['font_body']);
	$headingChoice = get_theme_mod('base_font_heading_choice', $defaults['font_heading']);

	base_enqueue_font_choice($bodyChoice, 'base-font-body');
	if ($headingChoice !== $bodyChoice) {
		base_enqueue_font_choice($headingChoice, 'base-font-heading');
	}
}, 5);

add_action('enqueue_block_editor_assets', static function (): void {
	$defaults = base_customizer_defaults();
	$bodyChoice = get_theme_mod('base_font_body_choice', $defaults['font_body']);
	$headingChoice = get_theme_mod('base_font_heading_choice', $defaults['font_heading']);

	base_enqueue_font_choice($bodyChoice, 'base-font-body-editor');
	if ($headingChoice !== $bodyChoice) {
		base_enqueue_font_choice($headingChoice, 'base-font-heading-editor');
	}
});

add_action('wp_head', static function (): void {
	$defaults = base_customizer_defaults();

	$brand = get_theme_mod('base_color_brand', $defaults['color_brand']);
	$accent = get_theme_mod('base_color_accent', $defaults['color_accent']);
	$bg = get_theme_mod('base_color_bg', $defaults['color_bg']);
	$text = get_theme_mod('base_color_text', $defaults['color_text']);
	$bodyChoice = get_theme_mod('base_font_body_choice', $defaults['font_body']);
	$headingChoice = get_theme_mod('base_font_heading_choice', $defaults['font_heading']);

	$fontBody = base_get_font_stack($bodyChoice);
	$fontHeading = base_get_font_stack($headingChoice);

	if ($brand === $defaults['color_brand']
		&& $accent === $defaults['color_accent']
		&& $bg === $defaults['color_bg']
		&& $text === $defaults['color_text']
		&& $bodyChoice === $defaults['font_body']
		&& $headingChoice === $defaults['font_heading']) {
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
