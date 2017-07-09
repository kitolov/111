<?php
defined('ZCMS') or die('Access denied');

/*
 * Данные могут кэшироваться на двух логических и двух физических уровнях. Логический уровень
 * определяет, в каких местах приложения кэшируются данные. Физический уровень кэширования
 * определяет, где хранится кэш: в оперативной памяти или в файлах.
 *
 * КЭШИРОВАНИЕ
 *   1. Логический уровень
 *     a. кэширование на уровне данных
 *     b. кэширование на уровне шаблонов
 *   2. Физический уровень
 *     a. кэширование в оперативной памяти
 *     b. кэширование с использванием файлов
 *
 * ЛОГИЧЕСКИЙ УРОВЕНЬ КЭШИРОВАНИЯ — на уровне данных и на уровне шаблонов:
 *
 * 1. Кэширование на уровне данных происходит при получении от модели данных, необходимых для
 *    формирования страницы:
 *    a. Кэширование запросов к БД: если при вызове методов класса Database fetchAll(), fetch(),
 *       fetchOne() параметр $cache установлен в true. Такое кэширование часто используется в
 *       методах классов моделей, если метод содержит только вызов метода класса Database.
 *    b. Кэширование данных в методах моделей: если метод класса модели содержит не только вызов
 *       метода БД, но и производит (сложные) вычисления.
 *    c. Кроме того, иногда идет обращение к кэшу напрямую, чтобы записать/получить какие-то
 *       данные. Экземпляр класса Cache доступен практически везде, см. Base::__construct()
 * 2. Кэширование на уровне шаблонов используется, когда контроллер получил от модели данные и
 *    «прогоняет» их через шаблон, см. метод Frontend_Controller::render().
 *
 * Обычно, чтобы ускорить работу приложения и снизить нагрузку на сервер, достаточно включить
 * кэширование на уровне данных — либо с использованием файлов, либо в оперативной памяти.
 * Дополнительное включение кэширования на уровне шаблонов еще немного ускоряет работу, но резко
 * увеличивает размер кэша (как файлового, так и в оперативной памяти — если он включен).
 *
 * ФИЗИЧЕСКИЙ УРОВЕНЬ КЭШИРОВАНИЯ — с использованием файлов и в оперативной памяти:
 *
 * Если кэширование разрешено, оно всегда использует файлы. Дополнительно можно включить кэширование
 * в оперативной памяти. Нельзя включить только кэш в оперативной памяти и не использовать при этом
 * файловый кэш. Но, допускается использовать только файловый кэш. Кэш в оперативной памяти — «быстрый»,
 * файловый кэш — «медленный», они дополняют друг друга.
 *
 * Если приложение работает под высокой нагрузкой на выделенном сервере, можно снизить нагрузку
 * и увеличить производительность, включив кэш в оперативной памяти, в дополнение к файловому.
 * Для этого устанавливаем демон Memcached (http://memcached.org/) и расширение PHP memcache
 * (http://php.net/manual/ru/book.memcache.php). В этом случае физический кэш будет двухуровневый:
 * сперва данные запрашиваются из оперативной памяти, а потом из файлового кэша.
 */

// см. файл app/config/config.php
$cache = array(
    /*
     * включить/выключить кэширование
     */
    'enable' => array(
        'data' => false,           // кэширование данных разрешено?
        'html' => false,          // кэширование шаблонов разрешено?
    ),
    /*
     * кэш с использованием файлов
     */
    'file'   => array(
        'time' => 7200,          // время хранения файлового кэша в секундах
        'lock' => 10,            // максимальное время блокировки на чтение в секундах
        'dir'  => 'cache',       // директория для хранения файлов кэша
    ),
    /*
     * кэш в оперативной памяти
     */
    'mem'    => array(
        'enable' => false,       // кэширование с использованием Memcached разрешено?
        'time'   => 3600,        // время хранения кэша в секундах
        'lock'   => 10,          // максимальное время блокировки на чтение в секундах
        'host'   => 'localhost',
        'port'   => 11211,
    ),
);