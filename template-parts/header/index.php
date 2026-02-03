<header>
	<a href="<?php echo esc_url(home_url('/')); ?>"><?php bloginfo('name'); ?></a>
	<nav>
		<?php wp_nav_menu(['theme_location' => 'primary']); ?>
	</nav>
</header>
