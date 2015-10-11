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
 * Class CodeStyleTest
 * @package JBZoo\__PACKAGE__
 */
class CodeStyleTest extends PHPUnit
{
    protected $le = "\n";

    protected $replace = array(
        '_LINK_'       => 'https://github.com/JBZoo/_PACKAGE_',
        '_NAMESPACE_'  => 'JBZoo\_PACKAGE_',
        '_PACKAGE_'    => '__PACKAGE__', // change me!
        '_LICENSE_'    => 'MIT',
        '_COPYRIGHTS_' => 'Copyright (C) JBZoo.com,  All rights reserved.',
    );

    /**
     * Valid copyright header
     * @var array
     */
    protected $validHeader = array(
        '<?php',
        '/**',
        ' * JBZoo _PACKAGE_',
        ' *',
        ' * This file is part of the JBZoo CCK package.',
        ' * For the full copyright and license information, please view the LICENSE',
        ' * file that was distributed with this source code.',
        ' *',
        ' * @package   _PACKAGE_',
        ' * @license   _LICENSE_',
        ' * @copyright _COPYRIGHTS_',
        ' * @link      _LINK_',
    );

    /**
     * Ignore list for
     * @var array
     */
    protected $excludeList = array(
        '.',
        '..',
        '.idea',
        '.git',
        'build',
        'vendor',
        'composer.phar',
        'composer.lock',
    );

    /**
     * Render copyrights
     * @param $text
     * @return mixed
     */
    protected function replaceCopyright($text)
    {
        foreach ($this->replace as $const => $value) {
            $text = str_replace($const, $value, $text);
        }

        return $text;
    }

    /**
     * Test line endings
     */
    public function testFiles()
    {
        $files = $this->getFileList(ROOT_PATH, '[/\\\\](src|tests)[/\\\\].*\.php$');

        foreach ($files as $file) {
            $content = $this->openFile($file);
            self::assertNotContains("\r", $content);
        }
    }

    /**
     * Test copyright headers
     */
    public function testHeaders()
    {
        $files = $this->getFileList(ROOT_PATH, '[/\\\\](src|tests)[/\\\\].*\.php$');

        foreach ($files as $file) {
            $content = $this->openFile($file);

            // build copyrights
            $validHeader = $this->validHeader;
            if (isset($this->replace['_AUTHOR_'])) {
                $validHeader[] = ' * @author    _AUTHOR_';
            }
            $validHeader[] = ' */';

            $namespace = $this->replaceCopyright('namespace _NAMESPACE_');
            if (strpos($content, $namespace)) {
                $validHeader[] = '';
                $validHeader[] = 'namespace _NAMESPACE_';
            }

            $valid = $this->replaceCopyright(implode($validHeader, $this->le));
            self::assertContains($valid, $content, 'File has no valid header: ' . $file);
        }
    }

    /**
     * Try to find cyrilic symbols in the code
     */
    public function testCyrillic()
    {
        $files = $this->getFileList(ROOT_PATH, '/src/.*\.php$');

        foreach ($files as $file) {
            $content = $this->openFile($file);

            self::assertEquals(0, preg_match('/[А-Яа-яЁё]/u', $content), 'File has no valid chars: ' . $file);
        }
    }

}
