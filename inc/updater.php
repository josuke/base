<?php
declare(strict_types=1);

require_once __DIR__ . '/plugin-update-checker/plugin-update-checker.php';

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$baseUpdateChecker = PucFactory::buildUpdateChecker(
	'https://github.com/josuke/base/',
	get_template_directory() . '/style.css',
	'base'
);

$baseUpdateChecker->setBranch('main');
$baseUpdateChecker->getVcsApi()->enableReleaseAssets();
