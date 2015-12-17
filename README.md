# Skeleton (PHP) [![Build Status](https://travis-ci.org/JBZoo/Skeleton-PHP.svg?branch=master)](https://travis-ci.org/JBZoo/Skeleton-PHP)   [![Coverage Status](https://coveralls.io/repos/JBZoo/Skeleton-PHP/badge.svg?branch=master&service=github)](https://coveralls.io/github/JBZoo/Skeleton-PHP?branch=master)

[![License](https://poser.pugx.org/JBZoo/Skeleton-PHP/license)](https://packagist.org/packages/JBZoo/Skeleton-PHP)
[![Latest Stable Version](https://poser.pugx.org/JBZoo/Skeleton-PHP/v/stable)](https://packagist.org/packages/JBZoo/Skeleton-PHP) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/JBZoo/Skeleton-PHP/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/JBZoo/Skeleton-PHP/?branch=master)

Это не библиотека, а лишь заготовка. Она призвана навести порядок в головах программистов и стандартизировать разработку open-source библиотек для JBZoo.

**Все что тут написано, относится лишь к репозиториям на Github.com**

### План действий

 * Создаем новый репозиторий (MIT без .gitignore).
 * Делаем checkout чистого репозитория на рабочую машину.
 * [Скачиваем последнюю версию скелета](https://github.com/JBZoo/Skeleton/archive/master.zip).
 * В файле ``composer.json`` заменяем ``__CHANGE_ME__`` на название библиотеки в CamelCase. Например, "MyLoveLibrary".
 * Запускаем скрипт сборки скелета для вашего пакета через ``composer skeleton``
 * Если все хорошо, то скрипт завершится без ошибок.
 * Пишем код только по TDD.
 * Отправляем в репозиторий, проверяем через сервисы тесты, покрытие и т.д.


### Обязательные требования к библиотеке

 * Проходит все(!) тесты через ``composer test``
 * Опубликована на [Packagist.org](https://packagist.org/packages/JBZoo)
 * [Travis](https://travis-ci.org/JBZoo) показазывает что билды всех версий PHP успешно прошли тестирование.
 * Покрытие unit-тестами не ниже 80-95% (зависит от типа и важности библиотеки).
 * Сделан хотя бы один тег - "1.0.0"
 * Нумерация версий [по стандартнам composer](https://getcomposer.org/doc/articles/versions.md)
 * README.md должен содержать
    * Краткую информацию (Пример содержимого в файле README.dist.md)
    * Бейдж статуса билда
    * Номер актуальной версии
    * Простейший и рабочий пример запуска
    * Особенности запуска или тестирования (если есть)
 * ...само собой, поддерживать репозиторий чистым!


### Желательно...

 * Давать названия тестам в стиле BDD
 * Стабильные билды отмечать тегами (без фанатизма).
 * Использовать автозагрузки "psr-4", "classmap", "file" (в порядке приоритетов).
 * Пройти все тесты и репорты в нашем TeamCity с помощью ``JBZoo/PHPunit``


### License

MIT
