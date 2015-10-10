<?php


global $config;

$config = array(
    'root'    => realpath('../'),
    'exclude' => array(
        '.',
        '..',
        '.idea',
        '.git',
        'codeStyleTest.php',
        pathinfo(__FILE__, PATHINFO_BASENAME),
    ),
    'defines' => array(
        '__PACKAGE__'    => 'SqlBuilder',
        '__CLASS_NAME__' => 'SqlBuilder',
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

/********** Replace all files **********/
$list = getFileList($config['root']);
foreach ($list as $file) {
    $content = openFile($file);

    foreach ($config['defines'] as $const => $value) {
        $content = str_replace($const, $value, $content);
    }

    file_put_contents($file, $content);
}

/********** Replace test file **********/
$commonTest = $config['root'] . '/tests/common/codeStyleTest.php';
$content    = openFile($commonTest);
$content    = str_replace('___PACKAGE___', $config['defines']['__PACKAGE__'], $content);
file_put_contents($commonTest, $content);

/********** Change Readme file **********/
rename($config['root'] . '/README.dist.md', $config['root'] . '/README.md');

/********** Rename main file **********/
rename($config['root'] . '/src/__PACKAGE__.php', $config['root'] . '/src/' . $config['defines']['__PACKAGE__'] . '.php');

/********** Composer info! **********/
echo "EXCECUTE COMMAND --> 'composer update'" . PHP_EOL;
echo "EXCECUTE COMMAND --> 'phpunit'";
