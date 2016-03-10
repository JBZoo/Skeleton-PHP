<?php
/**
 * JBZoo __PACKAGE__
 *
 * This file is part of tPerformanceTesthe JBZoo CCK package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @package   __PACKAGE__
 * @license   MIT
 * @copyright Copyright (C) JBZoo.com,  All rights reserved.
 * @link      https://github.com/JBZoo/__PACKAGE__
 */

namespace JBZoo\PHPUnit;

use JBZoo\__PACKAGE__\Package;

/**
 * Class PerformanceTest
 * @package JBZoo\__PACKAGE__
 */
class PerformanceTest extends PHPUnit
{
    public function testLeakMemoryCreate()
    {
        runBench([
            'Test name' => function () {
                // Your code start
                $obj = new Package();
                $obj->doSomeStreetMagic();
                unset($obj);
                // Your code finish
            },
        ]);
    }
}
