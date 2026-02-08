<?php
$args = (array) get_query_var('base_component_args', []);
$enabled = apply_filters('base_shop_actions_enabled', true, $args);
if (!$enabled) {
	return;
}

$showCart = $args['show_cart'] ?? true;
$showAccount = $args['show_account'] ?? false;
$showLogout = $args['show_logout'] ?? true;
$accountLabelIn = $args['account_label_logged_in'] ?? __('My account', 'base');
$accountLabelOut = $args['account_label_logged_out'] ?? __('My account', 'base');
$logoutLabel = $args['logout_label'] ?? __('Logout', 'base');

if (!function_exists('WC')) {
	return;
}

$items = [];

if ($showCart) {
	$cart = WC()->cart;
	$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : '';
	if ($cart && $cart_url !== '' && method_exists($cart, 'get_cart_contents_count')) {
		$count = (int) $cart->get_cart_contents_count();
		$count = (int) apply_filters('base_shop_actions_cart_count', $count);
		$items[] = [
			'type' => 'cart',
			'label' => __('Cart', 'base'),
			'url' => $cart_url,
			'count' => $count,
		];
	}
}

if ($showAccount && function_exists('wc_get_page_permalink')) {
	$account_url = wc_get_page_permalink('myaccount');
	if (is_string($account_url) && $account_url !== '') {
		if (is_user_logged_in()) {
			$label = $accountLabelIn;
			$url = $account_url;
		} else {
			$label = $accountLabelOut;
			$url = $account_url;
		}

		$items[] = [
			'type' => 'account',
			'label' => $label,
			'url' => $url,
		];

		if (is_user_logged_in() && $showLogout) {
			$items[] = [
				'type' => 'logout',
				'label' => $logoutLabel,
				'url' => wp_logout_url($account_url),
			];
		}
	}
}

if (!$items) {
	return;
}
?>

<div class="shop-actions" aria-label="<?php echo esc_attr(__('Shop actions', 'base')); ?>">
	<?php foreach ($items as $item) : ?>
		<?php if ($item['type'] === 'cart') : ?>
			<?php $classes = 'shop-actions__link shop-actions__cart' . (($item['count'] ?? 0) === 0 ? ' is-empty' : ''); ?>
			<a class="<?php echo esc_attr($classes); ?>" href="<?php echo esc_url($item['url']); ?>" aria-label="<?php echo esc_attr($item['label']); ?>">
				<?php echo base_svg('shopping-cart', ['class' => 'shop-actions__icon', 'aria-hidden' => 'true']); ?>
				<span class="shop-actions__label"><?php echo esc_html($item['label']); ?></span>
				<span class="shop-actions__count" aria-hidden="true"><?php echo esc_html((int) $item['count']); ?></span>
			</a>
		<?php elseif ($item['type'] === 'logout') : ?>
			<a class="shop-actions__link shop-actions__logout" href="<?php echo esc_url($item['url']); ?>">
				<?php echo base_svg('user', ['class' => 'shop-actions__icon', 'aria-hidden' => 'true']); ?>
				<span class="shop-actions__text"><?php echo esc_html($item['label']); ?></span>
			</a>
		<?php else : ?>
			<a class="shop-actions__link shop-actions__account" href="<?php echo esc_url($item['url']); ?>">
				<?php echo base_svg('user', ['class' => 'shop-actions__icon', 'aria-hidden' => 'true']); ?>
				<span class="shop-actions__label"><?php echo esc_html($item['label']); ?></span>
			</a>
		<?php endif; ?>
	<?php endforeach; ?>
</div>
