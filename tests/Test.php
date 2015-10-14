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

namespace JBZoo\PHPUnit;

use JBZoo\__PACKAGE__\__PACKAGE__;
use JBZoo\__PACKAGE__\Exception;

/**
 * Class Test
 * @package JBZoo\PHPUnit
 */
class Test extends PHPUnit
{

    public function testShouldDoSomeStreetMagic()
    {
        $obj = new __PACKAGE__();
        is('street magic', $obj->doSomeStreetMagic());
    }

    /**
     * @expectedException \JBZoo\__PACKAGE__\Exception
     */
    public function testShouldShowException()
    {
        throw new Exception('Test message');
    }
}
