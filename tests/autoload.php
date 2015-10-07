<?php
/**
 * JBZoo __PACKAGE__
 *
 * This file is part of the JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   __PACKAGE__
 * @license   MIT
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      https://github.com/JBZoo/__PACKAGE__
 */

namespace JBZoo\__PACKAGE__;


// @codingStandardsIgnoreFile
// @codeCoverageIgnoreStart
if (!defined('ROOT_PATH')) { // for PHPUnit process isolation
    define('ROOT_PATH', realpath('.'));
}

// main autoload
if ($autoload = realpath(ROOT_PATH . '/vendor/autoload.php')) {
    require_once $autoload;
} else {
    echo 'Please execute "composer install --no-dev" !' . PHP_EOL;
    exit(1);
}


// test tools and important includes
require_once ROOT_PATH . '/tests/phpunit.php';
require_once ROOT_PATH . '/tests/fixtures.php';


// @codeCoverageIgnoreEnd