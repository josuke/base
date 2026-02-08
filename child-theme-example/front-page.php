<?php get_header(); ?>

<?php base_component('header'); ?>

<main id="main">
	<div class="site-wrap">
		<?php
		base_component('hero', [
			'title' => 'Arranca tu tema hijo rapido',
			'subtitle' => 'Este es un ejemplo listo para extender el theme base con componentes y assets propios.',
			'cta_text' => 'Explorar',
			'cta_url' => '#main',
		]);
		?>

		<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>
				<?php base_component('content'); ?>
			<?php endwhile; ?>
		<?php endif; ?>
	</div>
</main>

<?php base_component('footer'); ?>

<?php get_footer(); ?>