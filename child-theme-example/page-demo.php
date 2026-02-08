<?php
/*
Template Name: Demo
*/
?>

<?php get_header(); ?>

<?php base_component('loader', ['label' => __('Loading', 'base')]); ?>

<?php base_component('header'); ?>

<main id="main">
	<div class="site-wrap">
		<?php
		base_component('hero', [
			'title' => 'Demo del tema hijo',
			'subtitle' => 'Ejemplo de template parts con loader, header, hero y footer.',
			'cta_text' => 'Empezar',
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