<?php get_header(); ?>

<main>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php base_component('content'); ?>
		<?php endwhile; ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
