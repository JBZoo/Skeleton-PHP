# Skeleton (PHP) [![Build Status](https://travis-ci.org/JBZoo/Skeleton-PHP.svg?branch=master)](https://travis-ci.org/JBZoo/Skeleton-PHP)   [![Coverage Status](https://coveralls.io/repos/JBZoo/Skeleton-PHP/badge.svg?branch=master&service=github)](https://coveralls.io/github/JBZoo/Skeleton-PHP?branch=master)

Это не библиотека, а лишь заготовка. Она призвана навести порядок в головах программистов и стандартизировать разработку open-source библиотек для JBZoo.

**Все что тут написано, относится лишь к репозиториям на Github.com**

### План действий

 * Создаем новый репозиторий (MIT без .gitignore).
 * Делаем checkout чистого репозитория на рабочую машину.
 * [Скачиваем последнюю версию скелета](https://github.com/JBZoo/Skeleton/archive/master.zip).
 * Заменяем через консоль (ну или руками) все константы.
    * ``__PACKAGE__`` на название библиотеки в CamelCase. Например, "MyLoveLibrary".
    * Проверяем содержимое общих тестов, в частности "common/codeStyleTest.php".
    * Указываем валидное название пакета в composer.json (т.е значение ``__PACKAGE__`` в нижнем регистре).


### Обязательные требования к библиотеке

 * Опубликована на [Packagist.org](https://packagist.org/packages/JBZoo)
 * [Travis](https://travis-ci.org/JBZoo) показазывает что билды всех версий PHP успешно прошли тестирование.
 * Покрытие unit-тестами не ниже 80-95% (зависит от типа и важности библиотеки).
 * Сделан хотя бы один тег  - "1.0.0"
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
 * В корневом файле demo.php показать пример использования библиотеки (особенно если там что-то хитрое).
 * Стабильные билды отмечать тегами (без фанатизма).
 * Использовать автозагрузки "psr-4", "classmap", "file" (в порядке приоритетов).
 * Пройти все тесты и репорты в нашем TeamCity.


### License
MIT
