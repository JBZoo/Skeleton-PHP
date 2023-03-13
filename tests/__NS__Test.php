<?php

/**
 * JBZoo Toolbox - __PACKAGE__.
 *
 * This file is part of the JBZoo Toolbox project.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 *
 * @license    MIT
 * @copyright  Copyright (C) JBZoo.com, All rights reserved.
 * @see        https://github.com/JBZoo/__PACKAGE__
 */

declare(strict_types=1);

namespace JBZoo\PHPUnit;

use JBZoo\__NS__\__NS__;

final class __NS__Test extends PHPUnit
{
    public function testShouldDoSomeStreetMagic(): void
    {
        $obj = new __NS__();
        isSame('street magic', $obj->doSomeStreetMagic());
    }
}
