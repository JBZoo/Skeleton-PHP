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
 * @author    Denis Smetannikov <denis@jbzoo.com>
 */


$packageName = '';


if (!$packageName) {
    throw new Exception('Undefined package name! Plz, check config');
}

global $config;

$config = array(
    'root'    => realpath('../'),
    'exclude' => array(
        '.',
        '..',
        '.idea',
        '.git',
        pathinfo(__FILE__, PATHINFO_BASENAME),
    ),
    'defines' => array(
        '__PACKAGE__'        => $packageName,
        'jbzoo/skeleton-php' => 'jbzoo/' . strtolower($packageName),
    ),
);


/**********************************************************************************************************************/

/**
 * @param $path
 * @return null|string
 */
function openFile($path)
{
    $contents = null;

    if ($realPath = realpath($path)) {
        $handle   = fopen($path, "rb");
        $contents = fread($handle, filesize($path));
        fclose($handle);
    }

    return $contents;
}

/**
 * @param       $dir
 * @param null  $filter
 * @param array $results
 * @return array
 */
function getFileList($dir, $filter = null, &$results = array())
{
    $files = scandir($dir);

    global $config;

    foreach ($files as $key => $value) {
        $path = $dir . DIRECTORY_SEPARATOR . $value;

        if (!is_dir($path) && !in_array($value, $config['exclude'], true)) {
            if ($filter) {
                if (preg_match('#' . $filter . '#iu', $path)) {
                    $results[] = realpath($path);
                }
            } else {
                $results[] = realpath($path);
            }

        } elseif (is_dir($path) && !in_array($value, $config['exclude'], true)) {
            getFileList($path, $filter, $results);
        }
    }

    return $results;
}


/********** Replace all files *****************************************************************************************/
$list = getFileList($config['root']);
foreach ($list as $file) {
    $content = openFile($file);

    foreach ($config['defines'] as $const => $value) {
        $content = str_replace($const, $value, $content);
    }

    file_put_contents($file, $content);
}


/********** Change Readme file ****************************************************************************************/
rename(
    $config['root'] . '/README.dist.md',
    $config['root'] . '/README.md'
);


/********** Rename main file ******************************************************************************************/
rename(
    $config['root'] . '/src/Package.php',
    $config['root'] . '/src/' . $config['defines']['__PACKAGE__'] . '.php'
);


/********** Useful info! **********************************************************************************************/
echo "EXCECUTE COMMAND --> 'composer update'" . PHP_EOL;
echo "EXCECUTE COMMAND --> 'phpunit'";
