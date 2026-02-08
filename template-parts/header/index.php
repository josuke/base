<header class="site-header">
	<div class="site-header__left">
		<a class="site-header__brand" href="<?php echo esc_url(home_url('/')); ?>">
			<?php
			$logo_id = get_theme_mod('custom_logo');
			$dark_logo_id = get_theme_mod('dark_logo');
			$site_name = get_bloginfo('name');
			?>
			<?php if ($logo_id) : ?>
				<?php
				echo wp_get_attachment_image($logo_id, 'full', false, [
					'class' => 'site-header__logo site-header__logo--light',
					'alt' => $site_name,
				]);
				?>
			<?php endif; ?>
			<?php if ($dark_logo_id) : ?>
				<?php
				echo wp_get_attachment_image($dark_logo_id, 'full', false, [
					'class' => 'site-header__logo site-header__logo--dark',
					'alt' => $site_name,
				]);
				?>
			<?php endif; ?>
			<?php if (!$logo_id && !$dark_logo_id) : ?>
				<span class="site-header__name"><?php echo esc_html($site_name); ?></span>
			<?php endif; ?>
		</a>
	</div>
	<nav class="site-header__nav">
		<?php wp_nav_menu(['theme_location' => 'primary']); ?>
	</nav>
	<div class="site-header__right">
		<?php base_component('theme-toggle', ['label' => __('Theme', 'base')]); ?>
		<?php base_component('shop-actions', ['show_cart' => true, 'show_account' => true]); ?>
	</div>
</header>
