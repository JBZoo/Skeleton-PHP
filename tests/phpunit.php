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

/**
 * Class PHPUnit
 * @package JBZoo\__PACKAGE__
 */
class PHPUnit extends \PHPUnit_Framework_TestCase
{
    protected $namespace = '\\JBZoo\\__PACKAGE__\\';

    protected static $times = array();
    protected static $memories = array();

    /**
     * @var array
     */
    protected $excludeList = array(
        '.',
        '..',
        '.idea',
        '.git',
        'build',
        'vendor',
        'reports',
        'composer.phar',
        'composer.lock',
    );

    /**
     * @param $testList
     */
    public function batchEquals($testList)
    {
        foreach ($testList as $test) {
            $this->assertEquals($test[0], $test[1]);
        }
    }

    /**
     * Start profiler
     */
    public function startProfiler()
    {
        array_push(self::$times, microtime(true));
        array_push(self::$memories, memory_get_usage(false));
    }

    /**
     * Simple profiler
     * @param int $count
     * @return array
     */
    public function markProfiler($count = 1, $measure = null)
    {
        $time   = microtime(true);
        $memory = memory_get_usage(false);

        $timeDiff   = $time - end(self::$times);
        $memoryDiff = $memory - end(self::$memories);

        array_push(self::$times, $time);
        array_push(self::$memories, $memory);

        // build report
        $count  = (int)abs($count);
        $result = array(
            'count'      => $count,
            'time'       => $timeDiff,
            'memory'     => $memoryDiff,
            'timeOne'    => $timeDiff / $count,
            'memoryOne'  => $memoryDiff / $count,
            'timeF'      => number_format($timeDiff * 1000, 2, '.', ' ') . ' ms',
            'memoryF'    => number_format($memoryDiff / 1024, 2, '.', ' ') . ' KB',
            'timeOneF'   => number_format($timeDiff * 1000 / $count, 2, '.', ' ') . ' ms',
            'memoryOneF' => number_format($memoryDiff / 1024 / $count, 2, '.', ' ') . ' KB',
        );

        if ($measure && isset($result[$measure])) {
            return $result[$measure];
        }

        return $result;
    }

    /**
     * Get file list in directory
     * @param       $dir
     * @param null  $filter
     * @param array $results
     * @return array
     */
    protected function getFileList($dir, $filter = null, &$results = array())
    {
        $files = scandir($dir);

        foreach ($files as $key => $value) {
            $path = $dir . DIRECTORY_SEPARATOR . $value;

            if (!is_dir($path) && !in_array($value, $this->excludeList, true)) {

                if ($filter) {
                    if (preg_match('#' . $filter . '#iu', $path)) {
                        $results[] = $path;
                    }
                } else {
                    $results[] = $path;
                }

            } elseif (is_dir($path) && !in_array($value, $this->excludeList, true)) {
                $this->getFileList($path, $filter, $results);
            }
        }

        return $results;
    }

    /**
     * Binary save to open file
     * @param $path
     * @return null|string
     */
    protected function openFile($path)
    {
        $contents = null;

        if ($realPath = realpath($path)) {
            $handle   = fopen($path, "rb");
            $contents = fread($handle, filesize($path));
            fclose($handle);
        }

        return $contents;
    }
}