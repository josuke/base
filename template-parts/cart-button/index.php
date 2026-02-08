<?php
$enabled = apply_filters('base_cart_button_enabled', true);
if (!$enabled) {
	return;
}

if (!function_exists('WC')) {
	return;
}

$cart = WC()->cart;
if (!$cart || !method_exists($cart, 'get_cart_contents_count')) {
	return;
}

$cart_url = function_exists('wc_get_cart_url') ? wc_get_cart_url() : '';
if ($cart_url === '') {
	return;
}

$count = (int) $cart->get_cart_contents_count();
$count = (int) apply_filters('base_cart_button_count', $count);
$label = __('Cart', 'base');
$classes = 'site-cart';
if ($count === 0) {
	$classes .= ' is-empty';
}
?>

<a class="<?php echo esc_attr($classes); ?>" href="<?php echo esc_url($cart_url); ?>" aria-label="<?php echo esc_attr($label); ?>">
	<span class="site-cart__label"><?php echo esc_html($label); ?></span>
	<span class="site-cart__count" aria-hidden="true"><?php echo esc_html($count); ?></span>
</a>