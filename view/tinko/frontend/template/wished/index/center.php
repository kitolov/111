<?php
/**
 * Список товаров, отложенных посетителем сайта,
 * файл view/example/frontend/template/wished/center.php,
 * общедоступная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * $thisPageUrl - URL этой страницы
 * $wishedProducts - массив отложенных товаров
 * $units - массив единиц измерения товара
 * $pager - постраничная навигация
 * $page - текущая страница
 *
 * $wishedProducts = Array (
 *   [0] => Array (
 *     [id] => 37
 *     [code] => 001007
 *     [name] => ИП 212
 *     [title] => Извещатель пожарный дымовой
 *     [price] => 123.45
 *     [shortdescr] =>
 *     [image] => 8710c4a3ed9f660b5549092b5378c42c.jpg
 *     [ctg_id] => 2
 *     [ctg_name] => Извещатели пожарные
 *     [mkr_id] => 5
 *     [mkr_name] => Болид
 *     [date] => 28.11.2014
 *     [time] => 11:50:36
 *     [url] => Array (
 *       [product] => /catalog/product/37
 *       [maker] => /catalog/maker/5
 *       [image] => /files/catalog/products/small/8710c4a3ed9f660b5549092b5378c42c.jpg
 *     )
 *     [action] => Array (
 *       [basket] => /basket/addprd/37
 *       [compared] => /compared/addprd/37
 *       [wished] => /wished/rmvprd/37
 *     )
 *   )
 *   [1] => Array (
 *     .....
 *   )
 *   [2] => Array (
 *     .....
 *   )
 * )
 * 
 * $units = Array (
 *     0 => 'руб',
 *     1 => 'руб/шт',
 *     2 => 'руб/компл',
 *     3 => 'руб/упак',
 *     4 => 'руб/метр',
 *     5 => 'руб/пара',
 * )
 * 
 * $pager = Array (
 *     [first] => 1
 *     [prev] => 2
 *     [current] => 3
 *     [next] => 4
 *     [last] => 5
 *     [left] => Array (
 *         [0] => 2
 *     )
 *     [right] => Array (
 *         [0] => 4
 *     )
 * )
 * 
 */

defined('ZCMS') or die('Access denied');
?>

<!-- Начало шаблона view/example/frontend/template/wished/center.php -->

<?php if (!empty($breadcrumbs)): // хлебные крошки ?>
    <div id="breadcrumbs">
        <?php foreach ($breadcrumbs as $item): ?>
            <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<h1>Отложенные товары</h1>

<?php if (!empty($wishedProducts)): // отложенные товары ?>
    <div class="products-list-line">
    <?php foreach($wishedProducts as $product): ?>
        <div>
            <div class="product-line-added">
                <?php echo $product['date']; ?>
                <?php echo $product['time']; ?>
            </div>
            <div class="product-line-heading">
                <h2><a href="<?php echo $product['url']['product']; ?>"><?php echo $product['name']; ?></a></h2>
                <?php if (!empty($product['title'])): ?>
                    <h3><?php echo $product['title']; ?></h3>
                <?php endif; ?>
            </div>
            <div class="product-line-image">
                <a href="<?php echo $product['url']['product']; ?>">
                    <?php if ($product['hit']): ?><span class="hit-product">Лидер продаж</span><?php endif; ?>
                    <?php if ($product['new']): ?><span class="new-product">Новинка</span><?php endif; ?>
                    <img src="<?php echo $product['url']['image']; ?>" alt="" />
                </a>
            </div>
            <div class="product-line-info">
                <div>
                    <span>Цена, <?php echo $units[$product['unit']]; ?></span>
                        <span>
                            <span><strong><?php echo number_format($product['price'], 2, '.', ''); ?></strong><span>розничная</span></span>
                            <span><strong><?php echo number_format($product['price2'], 2, '.', ''); ?></strong><span>мелкий опт</span></span>
                            <span><strong><?php echo number_format($product['price3'], 2, '.', ''); ?></strong><span>оптовая</span></span>
                        </span>
                </div>
                <div>
                    <span>Код</span>
                    <span><?php echo $product['code']; ?></span>
                </div>
                <div>
                    <span>Производитель</span>
                    <span><a href="<?php echo $product['url']['maker']; ?>"><?php echo $product['mkr_name']; ?></a></span>
                </div>
            </div>
            <div class="product-line-basket">
                <form action="<?php echo $product['action']['basket']; /* добавить в корзину */ ?>" method="post" class="add-basket-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
                    <input type="text" name="count" value="1" size="5" />
                    <input type="hidden" name="return" value="wished" />
                    <?php if ($page > 1): ?>
                        <input type="hidden" name="page" value="<?php echo $page; ?>" />
                    <?php endif; ?>
                    <input type="submit" name="submit" value="В корзину" title="Добавить в корзину" />
                </form>
                <form action="<?php echo $product['action']['wished']; /* удалить из отложенных */ ?>" method="post">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
                    <input type="hidden" name="return" value="wished" />
                    <?php if ($page > 1): ?>
                        <input type="hidden" name="page" value="<?php echo $page; ?>" />
                    <?php endif; ?>
                    <input type="submit" name="submit" value="Удалить" title="Удалить из отложенных" class="selected" />
                </form>
                <form action="<?php echo $product['action']['compared']; /* добавить к сравнению */ ?>" method="post" class="add-compared-form">
                    <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
                    <input type="hidden" name="return" value="wished" />
                    <?php if ($page > 1): ?>
                        <input type="hidden" name="page" value="<?php echo $page; ?>" />
                    <?php endif; ?>
                    <input type="submit" name="submit" value="К сравнению" title="Добавить к сравнению" />
                </form>
            </div>
            <div class="product-line-descr"><?php echo $product['shortdescr']; ?></div>
        </div>
    <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Нет отложенных товаров</p>
<?php endif; ?>

<?php if (!empty($pager)): // постраничная навигация ?>
    <ul class="pager">
        <?php if (isset($pager['first'])): ?>
            <li>
                <a href="<?php echo $thisPageUrl; ?><?php echo ($pager['first'] != 1) ? '/page/'.$pager['first'] : ''; ?>" class="first-page"></a>
            </li>
        <?php endif; ?>
        <?php if (isset($pager['prev'])): ?>
            <li>
                <a href="<?php echo $thisPageUrl; ?><?php echo ($pager['prev'] != 1) ? '/page/'.$pager['prev'] : ''; ?>" class="prev-page"></a>
            </li>
        <?php endif; ?>
        <?php if (isset($pager['left'])): ?>
            <?php foreach ($pager['left'] as $left) : ?>
                <li>
                    <a href="<?php echo $thisPageUrl; ?><?php echo ($left != 1) ? '/page/'.$left : ''; ?>"><?php echo $left; ?></a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>

        <li>
            <span><?php echo $pager['current']; // текущая страница ?></span>
        </li>

        <?php if (isset($pager['right'])): ?>
            <?php foreach ($pager['right'] as $right) : ?>
                <li>
                    <a href="<?php echo $thisPageUrl; ?>/page/<?php echo $right; ?>"><?php echo $right; ?></a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($pager['next'])): ?>
            <li>
                <a href="<?php echo $thisPageUrl; ?>/page/<?php echo $pager['next']; ?>" class="next-page"></a>
            </li>
        <?php endif; ?>
        <?php if (isset($pager['last'])): ?>
            <li>
                <a href="<?php echo $thisPageUrl; ?>/page/<?php echo $pager['last']; ?>" class="last-page"></a>
            </li>
        <?php endif; ?>
    </ul>
<?php endif; ?>

<!-- Конец шаблона view/example/frontend/template/wished/center.php -->

