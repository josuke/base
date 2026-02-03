<?php get_header(); ?>

<?php base_component('header'); ?>

<main>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>
			<?php base_component('content'); ?>
		<?php endwhile; ?>
	<?php else : ?>
		<p><?php esc_html_e('No posts found.', 'base'); ?></p>
	<?php endif; ?>
</main>

<?php base_component('footer'); ?>

<?php get_footer(); ?>
