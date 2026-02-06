<?php get_header(); ?>

<?php base_component('header'); ?>

<main id="main">
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php base_component('content'); ?>
		<?php endwhile; ?>
	<?php else : ?>
		<?php base_component('content-none'); ?>
	<?php endif; ?>
</main>

<?php base_component('footer'); ?>

<?php get_footer(); ?>
