<?php
/**
 * Класс Xhr_Index_Basket_Frontend_Controller принимает запрос XmlHttpRequest,
 * обновляет (и удаляет, если кол-во=0) количество товаров в корзине, работает
 * с моделью Basket_Frontend_Model, общедоступная часть сайта. Возвращает
 * результат в формате JSON:
 * 1. HTML корзины в правой колонке,
 * 2. HTML корзины в центральной колонке
 * 3. HTML списка рекомендованных товаров
 */
class Xhr_Index_Basket_Frontend_Controller extends Basket_Frontend_Controller {

    /**
     * результат работы в формате JSON
     */
    private $output;

    public function __construct($params = null) {
        if ( ! $this->isPostMethod()) {
            header($_SERVER['SERVER_PROTOCOL'].' 404 Not Found');
            die();
        }
        parent::__construct($params);
        // не использовать кэширование шаблонов
        $this->notUseCache = true;
    }

    public function request() {

        // обращаемся к модели, чтобы обновить корзину
        $this->basketFrontendModel->updateBasket();

        // получаем от модели массив товаров в корзине (для правой колонки)
        $sideBasketProducts = $this->basketFrontendModel->getSideBasketProducts();

        // общая стоимость товаров в корзине (для правой колонки)
        $sideBasketTotalCost = $this->basketFrontendModel->getSideTotalCost();

        // тип пользователя
        $type = ($this->authUser) ? $this->userFrontendModel->getUserType() : 0;

        // получаем от модели массив товаров в корзине (для центральной колонки)
        $basketProducts = $this->basketFrontendModel->getBasketProducts();

        // общая стоимость товаров в корзине (для центральной колонки)
        $temp = $this->basketFrontendModel->getTotalCost();
        // общая стоимость товаров в корзине без учета скидки
        $amount = $temp['amount'];
        // общая стоимость товаров в корзине с учетом скидки
        $userAmount = $temp['user_amount'];

        // получаем от модели массив рекомендованных товаров
        $ids = array(); // массив идентификаторов товаров в корзине
        foreach ($basketProducts as $value) {
            $ids[] = $value['id'];
        }
        $recommendedProducts = $this->basketFrontendModel->getRecommendedProducts($ids);

        // получаем html-код товаров в корзине: для правой и центральной колонки
        $output = $this->render(
            $this->config->site->theme . '/frontend/template/basket/xhr/basket.php',
            array(
                // массив товаров в корзине (для правой колонки)
                'sideBasketProducts'  => $sideBasketProducts,
                // общая стоимость товаров в корзине (для правой колонки)
                'sideBasketTotalCost' => $sideBasketTotalCost,
                // URL страницы покупательской корзины
                'thisPageURL'         => $this->basketFrontendModel->getURL('frontend/basket/index'),
                // URL страницы оформления заказа
                'checkoutURL'         => $this->basketFrontendModel->getURL('frontend/basket/checkout'),
                // атрибут action тега form
                'action'              => $this->basketFrontendModel->getURL('frontend/basket/index'),
                // ссылка для удаления всех товаров из корзины
                'clearBasketURL'      => $this->basketFrontendModel->getURL('frontend/basket/clear'),
                // массив товаров в корзине (для центральной колонки)
                'basketProducts'      => $basketProducts,
                // стоимость товаров в корзине без учета скидки (для центральной колонки)
                'amount'              => $amount,
                // стоимость товаров в корзине с учетом скидки (для центральной колонки)
                'userAmount'          => $userAmount,
                // массив единиц измерения товара
                'units'               => $this->basketFrontendModel->getUnits(),
                // тип пользователя
                'type'                => $type,
                // массив рекомендованных товаров
                'recommendedProducts' => $recommendedProducts,
            )
        );
        $output = explode('¤', $output);
        $result = array('side' => $output[0], 'center' => $output[1], 'upsell' => $output[2]);
        $this->output = json_encode($result);
    }

    public function getContentLength() {
        return strlen($this->output);
    }

    public function sendHeaders() {
        header('Content-type: application/json; charset=utf-8');
        header('Content-Length: ' . $this->getContentLength());
    }

    public function getPageContent() {
        return $this->output;
    }

}