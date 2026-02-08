<?php
$args = (array) get_query_var('base_component_args', []);

$title = $args['title'] ?? get_bloginfo('name');
$subtitle = $args['subtitle'] ?? get_bloginfo('description');
$ctaText = $args['cta_text'] ?? 'Ver proyectos';
$ctaUrl = $args['cta_url'] ?? '#main';
?>

<section class="hero">
	<p class="hero__eyebrow">Base Child</p>
	<h1 class="hero__title"><?php echo esc_html($title); ?></h1>
	<p class="hero__subtitle"><?php echo esc_html($subtitle); ?></p>
	<a class="hero__cta" href="<?php echo esc_url($ctaUrl); ?>">
		<?php echo esc_html($ctaText); ?>
	</a>
</section>