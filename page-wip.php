<?php
/*
Template Name: WIP
*/
?>

<?php get_header(); ?>

<main id="main">
	<?php while (have_posts()) : the_post(); ?>
		<?php the_content(); ?>
	<?php endwhile; ?>
</main>

<?php get_footer(); ?>
