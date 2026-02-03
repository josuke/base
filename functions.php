<?php
declare(strict_types=1);

require_once __DIR__ . '/inc/setup.php';
require_once __DIR__ . '/inc/cleanup.php';
require_once __DIR__ . '/inc/components.php';

if (defined('BASE_ENABLE_UPDATER') && BASE_ENABLE_UPDATER && is_admin()) {
	require_once __DIR__ . '/inc/updater.php';
}
