<?php

// Define constants
define('ADVENT_OF_CODE_2023_NAMESPACE', 'Mentosmenno2\\AdventOfCode2023\\');
define('ADVENT_OF_CODE_2023_ROOT_DIR', __DIR__);
define('ADVENT_OF_CODE_2023_CLI', php_sapi_name() === 'cli');

// Autoload
require_once __DIR__ . '/autoloader.php';

if (ADVENT_OF_CODE_2023_CLI) {
	require_once ADVENT_OF_CODE_2023_ROOT_DIR . '/run-cli.php';
} else {
	require_once ADVENT_OF_CODE_2023_ROOT_DIR . '/run-web.php';
}
