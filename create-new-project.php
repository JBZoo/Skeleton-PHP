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

$packageName = $GLOBALS['argv'][1] ?? null;

if (!$packageName || $packageName === '__CHANGE_ME__') {
    echo 'Undefined package name! Plz, check config' . \PHP_EOL;
    exit(1);
}

$packageName = \ucfirst(\trim($packageName));
$namespace   = \str_replace('-', '', $packageName);

global $config;

$config = [
    'root'    => \realpath(__DIR__),
    'exclude' => [
        '.',
        '..',
        '.git',
        '.idea',
        'vendor',
        'build',
        \pathinfo(__FILE__, \PATHINFO_BASENAME),
    ],
    'defines' => [
        '__PACKAGE__'        => $packageName,
        '__PACKAGE_LOW__'    => \strtolower($packageName),
        '__NS__'             => $namespace,
        'jbzoo/skeleton-php' => 'jbzoo/' . \strtolower($packageName),
    ],
];

\print_r($config);

function openFile(string $path): ?string
{
    $contents = null;

    if (\realpath($path)) {
        $handle   = \fopen($path, 'r');
        $contents = \fread($handle, \filesize($path));
        \fclose($handle);
    }

    return $contents;
}

function getFileList(string $dir, array &$results = []): array
{
    $files = \scandir($dir);

    global $config;

    foreach ($files as $value) {
        $path = $dir . \DIRECTORY_SEPARATOR . $value;

        if (!\is_dir($path) && !\in_array($value, $config['exclude'], true)) {
            $results[] = \realpath($path);
        } elseif (\is_dir($path) && !\in_array($value, $config['exclude'], true)) {
            getFileList($path, $results);
        }
    }

    return $results;
}

// Replace all files
$list = getFileList($config['root']);

foreach ($list as $file) {
    $content = openFile($file);

    foreach ($config['defines'] as $const => $value) {
        $content = \str_replace($const, $value, $content);
    }

    if (\strpos($content, '# Cutline')) {
        $regexp  = '/\n# Cutline.*/ius';
        $content = \preg_replace($regexp, '', $content);
    }

    if (\strpos($file, 'main.yml')) {
        $content = \str_replace('skel-build ', '', $content);
    }

    \file_put_contents($file, $content);
}

// Change Readme file

$map = [
    'src/__NS__.php'                    => "src/{$namespace}.php",
    'tests/__NS__Test.php'              => "tests/{$namespace}Test.php",
    'tests/__NS__PackageTest.php'       => "tests/{$namespace}PackageTest.php",
    'tests/__NS__PhpStormProxyTest.php' => "tests/{$namespace}PhpStormProxyTest.php",
    '/README.dist.md'                   => 'README.md',
];

foreach ($map as $oldName => $newName) {
    \rename("{$config['root']}/{$oldName}", "{$config['root']}/{$newName}");
}

// Self-destruction
\unlink(__DIR__ . '/CLAUDE.md');
\unlink(__FILE__);

// Success
echo $packageName . ' is ready!' . \PHP_EOL;
exit(0);
