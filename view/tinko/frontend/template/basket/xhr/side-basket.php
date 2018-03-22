<?php
/**
 * Покупательская корзина, правая колонка,
 * файл view/example/frontend/template/basket/xhr/side-basket.php,
 * общедоступная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $sideBasketProducts - товары в корзине
 * $sideBasketTotalCost - общая стоимость товаров в корзине
 * $basketUrl - URL страницы с корзиной
 * $checkoutUrl - URL страницы с формой для оформления заказа
 */

defined('ZCMS') or die('Access denied');
?>

<?php if (!empty($sideBasketProducts)): /* покупательская корзина */ ?>
    <table>
        <tr>
            <th>Код</th>
            <th>Наименование</th>
            <th>Кол.</th>
        </tr>
        <?php foreach ($sideBasketProducts as $item): ?>
            <tr>
                <td><a href="<?php echo $item['url']; ?>"><?php echo $item['code']; ?></a></td>
                <td><?php echo $item['name']; ?></td>
                <td><?php echo $item['quantity']; ?></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="3"><span><?php echo number_format($sideBasketTotalCost, 2, '.', ' '); ?></span> руб.</td>
        </tr>
    </table>
    <ul id="goto-basket-checkout">
        <li><a href="<?php echo $basketUrl; ?>">Перейти в корзину</a></li>
        <li><a href="<?php echo $checkoutUrl; ?>">Оформить заявку</a></li>
    </ul>
<?php else: ?>
    <p class="empty-list-right">Ваша <a href="<?php echo $basketUrl; ?>">корзина</a> пуста</p>
<?php endif; ?>
