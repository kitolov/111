<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('ZCMS', true);

// идет обновление каталога
if (is_file('cron/update.txt')) {
    header('HTTP/1.1 503 Service Temporarily Unavailable');
    header('Status: 503 Service Temporarily Unavailable');
    header('Retry-After: 600');
    readfile('cron/update.html');
    die();
}

session_start();

// поддержка кодировки UTF-8
require 'app/include/utf8.php';
// автоматическая загрузка классов
require 'app/include/autoload.php';
// правила маршрутизации
require 'app/routing.php';
// настройки приложения
require 'app/settings.php';
// инициализация настроек
Config::init($settings);

try {
    // экземпляр класса роутера
    $router = Router::getInstance();
    /*
     * Получаем имя класса контроллера, например Index_Page_Frontend_Controller. Если
     * класс контроллера не найден, работает контроллер Index_Notfound_Frontend_Controller
     * или Index_Notfound_Backend_Controller
     */
    $controller = $router->getControllerClassName();
    // параметры, передаваемые контроллеру
    $params = $router->getParams();
    // создаем экземпляр класса контроллера
    $page = new $controller($params);
    // формируем страницу
    $page->request();
    if ($page->isNotFoundRecord()) {
        /*
         * Функция Base_Controller::isNotFoundRecord() возвращает true, если какому-либо
         * контроллеру, например Index_Page_Frontend_Controller, были переданы некорректные
         * параметры. Пример: frontend/page/index/id/12345, но страницы с уникальным id=12345
         * нет в таблице pages базы данных. Это возможно, если страница (новость, товар)
         * была удалена или пользователь ошибся при вводе URL страницы.
         */
        $router->setNotFound();
        // работет контроллер Index_Notfound_Frontend_Controller
        // или Index_Notfound_Backend_Controller
        $controller = $router->getControllerClassName();
        $page = new $controller();
        $page->request();
    }
} catch (Exception $e) { // если произошла какая-то ошибка
    $page = new Error($e);
    die();
}
// отправляем заголовки
$page->sendHeaders();
// выводим сформированную страницу в браузер
echo $page->getPageContent();
