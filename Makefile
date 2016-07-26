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

.PHONY: build update test-all validate autoload test phpmd phpcs phpcpd phploc reset coveralls

build: update

test-all:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Run all tests \e[0m"
	@make validate update test phpmd phpcs phpcpd phploc

update:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Update project \e[0m"
	@composer update --optimize-autoloader --no-interaction
	@echo ""

validate:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Composer validate \e[0m"
	@composer validate --no-interaction
	@echo ""

autoload:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Composer autoload \e[0m"
	@composer dump-autoload --optimize --no-interaction
	@echo ""

test:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Run unit-tests \e[0m"
	@php ./vendor/phpunit/phpunit/phpunit --configuration ./phpunit.xml.dist
	@echo ""

phpmd:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Check PHPmd \e[0m"
	@php ./vendor/phpmd/phpmd/src/bin/phpmd ./src text  \
         ./vendor/jbzoo/misc/phpmd/jbzoo.xml --verbose

phpcs:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Check Code Style \e[0m"
	@php ./vendor/squizlabs/php_codesniffer/scripts/phpcs ./src  \
        --extensions=php                                         \
        --standard=./vendor/jbzoo/misc/phpcs/JBZoo/ruleset.xml   \
        --report=full
	@echo ""

phpcpd:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Check Copy&Paste \e[0m"
	@php ./vendor/sebastian/phpcpd/phpcpd ./src --verbose
	@echo ""

phploc:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Show stats \e[0m"
	@php ./vendor/phploc/phploc/phploc ./src --verbose
	@echo ""

reset:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Hard reset \e[0m"
	@git reset --hard

coveralls:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Send coverage to coveralls.io \e[0m"
	@php ./vendor/satooshi/php-coveralls/bin/coveralls --verbose
	@echo ""

# Cutline
new-project:
	@echo -e "\e[33m>>> >>> >>> >>> >>> >>> >>> >>> \e[30;46m Create new PHP project \e[0m"
	@php ./new-project.php ${NAME}
	@make update
