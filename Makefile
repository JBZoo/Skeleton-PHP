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
	@echo ""
	@echo ">>> >>> >>> >>> Update project"
	composer update --optimize-autoloader --no-interaction

validate:
	@echo ""
	@echo ">>> >>> >>> >>> Composer validate"
	composer validate --no-interaction

autoload:
	@echo ""
	@echo ">>> >>> >>> >>> Composer autoload"
	composer dump-autoload --optimize --no-interaction

test:
	@echo ""
	@echo ">>> >>> >>> >>> Run unit-tests"
	sh ./vendor/bin/phpunit --configuration ./phpunit.xml.dist

phpmd:
	@echo ""
	@echo ">>> >>> >>> >>> Check PHPmd"
	sh ./vendor/bin/phpmd ./src text ./vendor/jbzoo/misc/phpmd/jbzoo.xml --verbose

phpcs:
	@echo ""
	@echo ">>> >>> >>> >>> Check Code Style"
	sh ./vendor/bin/phpcs ./src --extensions=php --standard=./vendor/jbzoo/misc/phpcs/JBZoo/ruleset.xml --report=full

phpcpd:
	@echo ""
	@echo ">>> >>> >>> >>> Check Copy&Paste"
	sh ./vendor/bin/phpcpd ./src --verbose

phploc:
	@echo ""
	@echo ">>> >>> >>> >>> Show statistic"
	sh ./vendor/bin/phploc ./src --verbose

reset:
	@echo ""
	@echo ">>> >>> >>> >>> Hard reset"
	git reset --hard

test-all:
	@echo ""
	@echo ">>> >>> >>> >>> Run all tests"
	make validate build test phpmd phpcs phpcpd phploc

coveralls:
	@echo ""
	@echo ">>> >>> >>> >>> Send coverage to coveralls.io"
	sh ./vendor/bin/coveralls --verbose
