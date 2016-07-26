#
# JBZoo __PACKAGE__
#
# This file is part of the JBZoo CCK package.
# For the full copyright and license information, please view the LICENSE
# file that was distributed with this source code.
#
# @package   __PACKAGE__
# @license   MIT
# @copyright Copyright (C) JBZoo.com,  All rights reserved.
# @link      https://github.com/JBZoo/__PACKAGE__
#

.PHONY: build test tests

build:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Update project\033[0m"
	@composer update --optimize-autoloader --no-interaction
	@echo ""

test-all:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Run all tests\033[0m"
	@make validate build test phpmd phpcs phpcpd phploc
	@echo ""

validate:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Composer validate\033[0m"
	@composer validate --no-interaction

autoload:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Composer autoload\033[0m"
	@composer dump-autoload --optimize --no-interaction
	@echo ""

test:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Run unit-tests\033[0m"
	@php ./vendor/phpunit/phpunit/phpunit --configuration ./phpunit.xml.dist
	@echo ""

phpmd:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Check PHPmd\033[0m"
	@php ./vendor/phpmd/phpmd/src/bin/phpmd ./src text  \
         ./vendor/jbzoo/misc/phpmd/jbzoo.xml --verbose

phpcs:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Check Code Style\033[0m"
	@php ./vendor/squizlabs/php_codesniffer/scripts/phpcs ./src  \
        --extensions=php                                         \
        --standard=./vendor/jbzoo/misc/phpcs/JBZoo/ruleset.xml   \
        --report=full
	@echo ""

phpcpd:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Check Copy&Paste\033[0m"
	@php ./vendor/sebastian/phpcpd/phpcpd ./src --verbose
	@echo ""

phploc:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Show statistic\033[0m"
	@php ./vendor/phploc/phploc/phploc ./src --verbose
	@echo ""

reset:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Hard reset\033[0m"
	@git reset --hard
	@echo ""

coveralls:
	@echo -e "\033[0;33m>>> >>> >>> >>> >>> >>> >>> >>> Send coverage to coveralls.io\033[0m"
	@php ./vendor/satooshi/php-coveralls/bin/coveralls --verbose
	@echo ""
