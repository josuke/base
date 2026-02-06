<?php
/*
Template Name: Demo
*/
?>

<?php get_header(); ?>

<?php base_component('header'); ?>

<main id="main">

	<section>
		<h2>
			<?php esc_html_e('Theme Toggle', 'base'); ?>
			<?php base_component('theme-toggle', ['label' => __('Theme', 'base')]); ?>
		</h2>
	</section>

</main>

<?php base_component('footer'); ?>

<?php get_footer(); ?>
