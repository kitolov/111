<?php
/**
 * Категория каталога: дочерние категории + фильтры + товары категории,
 * файл view/example/frontend/template/catalog/category/center.php,
 * общедоступная часть сайта
 *
 * Переменные, которые приходят в шаблон:
 * $breadcrumbs - хлебные крошки
 * $id - уникальный идентификатор категории
 * $name - наименование категории
 * $categories - массив дочерних категорий
 * $action - атрибут action тега form для фильтров
 * $view - представление списка товаров (линейный или плитка)
 * $group - id выбранной функциональной группы или ноль
 * $maker - id выбранного производителя или ноль
 * $hit - показывать только лидеров продаж?
 * $countHit - количество лидеров продаж
 * $new - показывать только новинки?
 * $countNew - количество новинок
 * $filter - массив выбранных параметров подбора
 * $groups - массив функциональных групп
 * $makers - массив всех производителей
 * $filters - массив всех параметров подбора
 * $sort - выбранная сортировка
 * $sortorders - массив всех вариантов сортировки
 * $units - массив единиц измерения товара
 * $products - массив товаров категории
 * $count - общее кол-во товаров категории
 * $clearFilterURL - URL ссылки для сброса фильтра
 * $pager - постраничная навигация
 * $page - текущая страница
 *
 * $categories = Array (
 *   [0] => Array (
 *     [id] => 30
 *     [name] => Извещатели тепловые максимальные
 *     [count] => 0
 *     [url] => //www.host.ru/catalog/category/30/group/459/maker/59
 *   )
 *   [1] => Array (
 *     [id] => 31
 *     [name] => Извещатели тепловые максимально-дифференциальные
 *     [count] => 0
 *     [url] => //www.host.ru/catalog/category/31/maker/59
 *   )
 *   [2] => Array (
 *     [id] => 33
 *     [name] => Извещатели дымовые
 *     [count] => 2
 *     [url] => //www.host.ru/catalog/category/33/maker/59
 *   )
 *   ..........
 * )
 *
 * $products = Array (
 *   [0] => Array (
 *     [id] => 37
 *     [code] => 005014
 *     [name] => ИП 212-43
 *     [title] => Извещатель пожарный дымовой оптико-электронный автономный
 *     [price] => 123.45
 *     [price2] => 110.00
 *     [price3] => 100.00
 *     [shortdescr] => Дымовой автономный, сирена встроенная 90 дБ, питание 4 батарейки ААА (в комплекте)
 *     [hit] = 1
 *     [new] = 0
 *     [ctg_id] => 2
 *     [ctg_name] => Извещатели пожарные
 *     [mkr_id] => 5
 *     [mkr_name] => Болид
 *     [grp_id] => 7
 *     [grp_name] => Извещатель пожарный
 *     [url] => Array (
 *       [product] => //www.host.ru/catalog/product/37
 *       [maker] => //www.host.ru/catalog/maker/5
 *       [image] => //www.host.ru/files/catalog/products/small/nophoto.jpg
 *     )
 *     [action] => Array (
 *       [basket] => //www.host.ru/basket/addprd
 *       [wished] => //www.host.ru/wished/addprd
 *       [compare] => //www.host.ru/compare/addprd
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
 * $groups = Array (
 *   [0] => Array (
 *     [id] => 11
 *     [name] => Видеокамеры корпусные
 *     [count] => 12
 *   )
 *   [1] => Array (
 *     [id] => 23
 *     [name] => Видеокамеры купольные
 *     [count] => 14
 *   )
 *   [2] => Array (
 *     .....
 *   )
 * )
 *
 * $filters = Array (
 *   [0] => Array (
 *     [id] => 5
 *     [name] => Напряжение питания
 *     [selected] = true
 *     [values] => Array (
 *       [0] => Array (
 *         [id] => 7
 *         [name] => 12 Вольт
 *         [count] => 3
 *         [selected] => false
 *       )
 *       [1] => Array (
 *         [id] => 9
 *         [name] => 24 Вольт
 *         [count] => 5
 *         [selected] => true
 *       )
 *     )
 *   )
 *   [1] => Array (
 *     [id] => 8
 *     [name] => Встроенная ИК подсветка
 *     [selected] => true
 *     [values] => Array (
 *       [0] => Array (
 *         [id] => 11
 *         [name] => есть
 *         [count] => 4
 *         [selected] => true
 *       )
 *       [1] => Array (
 *         [id] => 14
 *         [name] => нет
 *         [count] => 6
 *         [selected] => false
 *       )
 *     )
 *   )
 *   [2] => Array (
 *     .....
 *   )
 * )
 *
 * ключ элемента массива - id параметра (например, «Напряжение питания»)
 * значение элемента массива - id значения (например, «12 Вольт»)
 * $filter = Array (
 *   [5] => 7
 *   [8] => 11
 * )
 *
 * $makers = Array (
 *   [0] => Array (
 *     [id] => 380
 *     [name] => EverFocus
 *     [count] => 12
 *   )
 *   [1] => Array (
 *     [id] => 384
 *     [name] => MicroDigital
 *     [count] => 14
 *   )
 *   [2] => Array (
 *     .....
 *   )
 * )
 *
 * $sortorders = Array (
 *   [0] => Array (
 *     [url] => //www.host.ru/catalog/category/1
 *     [name] => без сортировки
 *   )
 *   [1] => Array (
 *     [url] => //www.host.ru/catalog/category/1/sort/1
 *     [name] => цена, возр.
 *   )
 *   [2] => Array (
 *     [url] => //www.host.ru/catalog/category/1/sort/2
 *     [name] => цена, убыв.
 *   )
 *   [3] => Array (
 *     [url] => //www.host.ru/catalog/category/1/sort/3
 *     [name] => название, возр.
 *   )
 *   [4] => Array (
 *     [url] => //www.host.ru/catalog/category/1/sort/4
 *     [name] => название, убыв.
 *   )
 *   [5] => Array (
 *     [url] => //www.host.ru/catalog/category/1/sort/5
 *     [name] => код, возр.
 *   )
 *   [6] => Array (
 *     [url] => //www.host.ru/catalog/category/1/sort/6
 *     [name] => код, убыв.
 *   )
 * )
 *
 * $units = Array (
 *   0 => '-',
 *   1 => 'шт',
 *   2 => 'компл',
 *   3 => 'упак',
 *   4 => 'метр',
 *   5 => 'пара',
 *   6 => 'кг'
 * )
 *
 * $pager = Array (
 *   [first] => Array (
 *     [num] => 1
 *     [url] => //www.host.ru/catalog/category/185
 *   )
 *   [prev] => Array (
 *     [num] => 2
 *     [url] => //www.host.ru/catalog/category/185/page/2
 *   )
 *   [current] => Array (
 *     [num] => 3
 *     [url] => //www.host.ru/catalog/category/185/page/3
 *   )
 *   [last] => Array (
 *     [num] => 32
 *     [url] => //www.host.ru/catalog/category/185/page/32
 *   )
 *   [next] => Array (
 *     [num] => 4
 *     [url] => //www.host.ru/catalog/category/185/page/4
 *   )
 *   [left] => Array (
 *     [0] => Array (
 *       [num] => 1
 *       [url] => //www.host.ru/catalog/category/185
 *     )
 *     [1] => Array (
 *       [num] => 2
 *       [url] => //www.host.ru/catalog/category/185/page/2
 *     )
 *   )
 *   [right] => Array (
 *     [0] => Array (
 *       [num] => 4
 *       [url] => //www.host.ru/catalog/category/185/page/4
 *     )
 *     [1] => Array (
 *       [num] => 5
 *       [url] => //www.host.ru/catalog/category/185/page/5
 *     )
 *   )
 * )
 *
 */

defined('ZCMS') or die('Access denied');

/*
 * Варианты сортировки:
 * 0 - по умолчанию,
 * 1 - по цене, по возрастанию
 * 2 - по цене, по убыванию
 * 3 - по наименованию, по возрастанию
 * 4 - по наименованию, по убыванию
 * 5 - по коду, по возрастанию
 * 6 - по коду, по убыванию
 * Можно переопределить текст по умолчанию:
 */
for ($i = 0; $i <= 6; $i++) {
    switch ($i) {
        case 0: $text = 'прайс-лист'; $class = '';               break;
        case 1: $text = 'цена';       $class = 'sort-asc-blue';  break;
        case 2: $text = 'цена';       $class = 'sort-desc-blue'; break;
        case 3: $text = 'название';   $class = 'sort-asc-blue';  break;
        case 4: $text = 'название';   $class = 'sort-desc-blue'; break;
        case 5: $text = 'код';        $class = 'sort-asc-blue';  break;
        case 6: $text = 'код';        $class = 'sort-desc-blue'; break;
    }
    if ($sort && $i == $sort) {
    	// выбранная сортировка выделена цветом
        $class = str_replace('blue', 'orange', $class);
    }
    $sortorders[$i]['name'] = $text;
    $sortorders[$i]['class'] = $class;
}

?>

<!-- Начало шаблона view/example/frontend/template/catalog/category/center.php -->

<?php if ( ! empty($breadcrumbs)): /* хлебные крошки */ ?>
    <div id="breadcrumbs"> <!-- хлебные крошки -->
    <?php foreach ($breadcrumbs as $item): ?>
        <a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a>&nbsp;&gt;
    <?php endforeach; ?>
    </div>
<?php endif; ?>

<span id="switch-line-grid"> <!-- линейный или плитка -->
    <i class="fa fa-bars<?php echo ($view == 'line') ? ' selected' : ''; ?>"></i>
    <i class="fa fa-th-large<?php echo ($view == 'grid') ? ' selected' : ''; ?>"></i>
</span>
<h1><?php echo $name; ?>&nbsp;<span><?php echo $count ?></span></h1>

<?php if ( ! empty($categories)): /* дочерние категории */ ?>
    <div id="category-childs"> <!-- дочерние категории -->
        <div>
            <span>Категории</span>
            <span><span>скрыть</span></span>
        </div>
        <div>
            <ul>
            <?php
                /*
                 * Определяем, нужно ли выводить список в две колонки (два элемента <ul>, оба float: left)
                 * или достаточно одной; если дочерних категорий мало, выводим список в одну колонку, если
                 * дочерних категорий много, выводим в две колонки
                 */
                $border = 0;
                $divide = 0;
                $cnt = count($categories);
                if ($cnt > 3) {
                    $divide = ceil($cnt/2);
                    $border = $cnt%2;
                }
            ?>
            <?php foreach ($categories as $key => $item): ?>
                <li<?php if (($key == $cnt-1) && $border) echo ' class="category-last-child-border"'; ?>>
                    <?php if ($item['count']): // есть товары в категории? ?>
                        <span><a href="<?php echo $item['url']; ?>"><?php echo $item['name']; ?></a> <span><?php echo $item['count']; ?></span></span>
                    <?php else: ?>
                        <span><span><?php echo $item['name']; ?></span> <span>0</span></span>
                    <?php endif; ?>
                </li>
                <?php if ($divide && $divide == ($key+1)): /* два элемента <ul>, две колонки */ ?>
                    </ul>
                    <ul>
                <?php endif; ?>
            <?php endforeach; ?>
            </ul>
        </div>
    </div> <!-- #category-childs -->
<?php endif; ?>

<?php if (empty($products) && empty($group) && empty($maker) && empty($hit) && empty($new)): ?>
    <p>Нет товаров в этой категории.</p>
    <?php return; ?>
<?php endif; ?>

<div id="catalog-filter"> <!-- фильтры товаров -->
    <div>
        <span>
            Фильтр
            <a href="<?php echo $clearFilterURL; ?>"<?php if ($group || $maker || $hit || $new) echo ' class="show-clear-filter"'; ?>>
                сбросить
            </a>
        </span>
        <span>
            <span>скрыть</span>
        </span>
    </div>
    <div>
        <form action="<?php echo $action; ?>" method="post">
            <div>
                <div> <!-- фильтры: функционал -->
                    <div>
                        <span>Функциональное назначение</span>
                    </div>
                    <div>
                        <span>
                        <select name="group">
                            <option value="0">Выберите</option>
                            <?php foreach ($groups as $item): ?>
                                <?php if (isset($item['bound'])): ?>
                                    <?php $bound = true; ?>
                                    <optgroup label="Разное">
                                <?php endif; ?>
                                <option value="<?php echo $item['id']; ?>"<?php echo ($item['id'] == $group) ? ' selected="selected"' : ''; ?><?php echo (!$item['count']) ? ' class="empty-option"' : ''; ?>><?php echo htmlspecialchars($item['name']) . ' ► ' . $item['count']; ?> шт.</option>
                            <?php endforeach; ?>
                            <?php if (isset($bound)): ?>
                                </optgroup>
                            <?php endif; ?>
                        </select>
                        </span>
                        <?php if ($group): ?><i class="fa fa-times"></i><?php endif; ?>
                    </div>
                </div>
                <div> <!-- фильтры: производители -->
                    <div>
                        <span>Производитель</span>
                    </div>
                    <div>
                        <span>
                        <select name="maker">
                            <option value="0">Выберите</option>
                            <?php foreach ($makers as $item): ?>
                                <option value="<?php echo $item['id']; ?>"<?php echo ($item['id'] == $maker) ? ' selected="selected"' : ''; ?><?php echo (!$item['count']) ? ' class="empty-option"' : ''; ?>><?php echo htmlspecialchars($item['name']) . ' ► ' . $item['count']; ?> шт.</option>
                            <?php endforeach; ?>
                        </select>
                        </span>
                        <?php if ($maker): ?><i class="fa fa-times"></i><?php endif; ?>
                    </div>
                </div>
                <?php if ( ! empty($filters)): ?>
                    <?php foreach ($filters as $item): ?>
                        <div> <!-- фильтры: параметры -->
                            <div>
                                <span><?php echo $item['name']; ?></span>
                            </div>
                            <div>
                                <span>
                                <select name="filter[<?php echo $item['id']; ?>]">
                                    <option value="0">Выберите</option>
                                    <?php foreach ($item['values'] as $value): ?>
                                        <option value="<?php echo $value['id']; ?>"<?php echo $value['selected'] ? ' selected="selected"' : ''; ?><?php echo (!$value['count']) ? ' class="empty-option"' : ''; ?>><?php echo htmlspecialchars($value['name']) . ' ► ' . $value['count']; ?> шт.</option>
                                    <?php endforeach; ?>
                                </select>
                                </span>
                                <?php if ($item['selected']): ?><i class="fa fa-times"></i><?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                <div> <!-- фильтры: лидер продаж и новинка -->
                    <div<?php echo empty($countHit) ? ' class="empty-checkbox"' : ''; ?>> <!-- фильтры: лидер продаж -->
                        <span>
                            <input type="checkbox" name="hit"<?php echo $hit ? ' checked="checked"' : ''; ?> value="1" id="hit-prd-box" />
                            <label for="hit-prd-box">Лидер продаж</label>
                        </span>
                    </div>
                    <div<?php echo empty($countNew) ? ' class="empty-checkbox"' : ''; ?>> <!-- фильтры: новинка -->
                        <span>
                            <input type="checkbox" name="new"<?php echo $new ? ' checked="checked"' : ''; ?> value="1" id="new-prd-box" />
                            <label for="new-prd-box">Новинка</label>
                        </span>
                    </div>
                </div>
            </div>
            <div>
                <?php if ($sort): /* скрытый input для передачи выбранной сортировки */ ?>
                    <input type="hidden" name="sort" value="<?php echo $sort; ?>" />
                <?php endif; ?>
                <?php if ($perpage): /* скрытый input для передачи выбранного кол-ва товаров на страницу */ ?>
                    <input type="hidden" name="perpage" value="<?php echo $perpage; ?>" />
                <?php endif; ?>
                <input type="hidden" name="change" value="0" />
                <input type="submit" name="submit" value="Применить" />
            </div>
        </form>
    </div>
</div> <!-- #catalog-filter -->

<?php if (empty($products)): ?>
    <div id="catalog-products">
        <p>По вашему запросу ничего не найдено.</p>
    </div>
    <?php return; ?>
<?php endif; ?>

<div id="catalog-products"> <!-- товары: сортировка и список -->

    <div id="sort-per-page"> <!-- сортировка товаров -->
        <ul>
            <li>Сортировка</li>
            <?php foreach ($sortorders as $key => $value): ?>
                <li>
                    <?php if ($key == $sort): ?>
                        <span class="selected<?php echo (!empty($value['class'])) ? ' ' . $value['class'] : ''; ?>"><?php echo $value['name']; ?></span>
                    <?php else: ?>
                        <a href="<?php echo $value['url']; ?>"<?php echo (!empty($value['class'])) ? ' class="' . $value['class'] . '"' : ''; ?>><span><?php echo $value['name']; ?></span></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
        <ul>
            <?php foreach($perpages as $item): ?>
                <li>
                    <?php if ($item['current']): ?>
                        <span class="selected"><?php echo $item['name']; ?></span>
                    <?php else: ?>
                        <a href="<?php echo $item['url']; ?>"><span><?php echo $item['name']; ?></span></a>
                    <?php endif; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    </div> <!-- #sort-per-page -->

    <div class="product-list-<?php echo $view; ?>"> <!-- список товаров -->
        <?php
            /*
             * При добавлении товара в корзину, в избранное, к сравнению — отправляются данные формы.
             * Если нет поддержки JavaScript, данные будут отправляться с перезагрузкой страницы,
             * т.е. без использования объекта XmlHttpRequest. На этот случай надо в форму добавить
             * множество скрытых полей (фильтр по функционалу, производителю, новинкам и лидерам
             * продаж, сортировка, номер страницы и т.п.), чтобы восстановить исходную страницу после
             * перезагрузки. Переменная $fltr содержит параметры подбора для категории каталога $id и
             * выбранной из списка <select name="group"> функциональной группы в формате 12.34-56.78,
             * где
             * 12, 56 — уникальные идентификаторы параметров подбора
             * 34, 78 — уникальные идентификаторы значений параметров подбора
             */
            if ( ! empty($filter)) {
                $temp = array();
                foreach ($filter as $key => $value) {
                    $temp[] = $key . '.' . $value;
                }
                if ( ! empty($temp)) {
                    $fltr = implode('-', $temp);
                }
            }
        ?>
        <?php foreach ($products as $product): /* список товаров */ ?>
            <div>
                <div class="product-list-heading">
                    <h2><a href="<?php echo $product['url']['product']; ?>"><?php echo $product['name']; ?></a></h2>
                    <?php if (!empty($product['title'])): ?>
                        <h3><?php echo $product['title']; ?></h3>
                    <?php endif; ?>
                </div> <!-- .product-list-heading -->
                <div class="product-list-image">
                    <a href="<?php echo $product['url']['product']; ?>">
                        <?php if ($product['hit']): ?><span class="hit-product">Лидер продаж</span><?php endif; ?>
                        <?php if ($product['new']): ?><span class="new-product">Новинка</span><?php endif; ?>
                        <img src="<?php echo $product['url']['image']; ?>" alt="" />
                    </a>
                </div> <!-- .product-list-image -->
                <div class="product-list-info">
                    <div>
                        <span>Цена, <i class="fa fa-rub"></i>/<?php echo $units[$product['unit']]; ?></span>
                        <span>
                            <span><strong><?php echo number_format($product['price'], 2, '.', ' '); ?></strong><span>розничная</span></span>
                            <span><strong><?php echo number_format($product['price2'], 2, '.', ' '); ?></strong><span>мелкий опт</span></span>
                            <span><strong><?php echo number_format($product['price3'], 2, '.', ' '); ?></strong><span>оптовая</span></span>
                        </span>
                    </div>
                    <div>
                        <span>Код</span>
                        <span><?php echo $product['code']; ?></span>
                    </div>
                    <div>
                        <span>Производитель</span>
                        <span><a href="<?php echo $product['url']['maker']; ?>"<?php echo ($maker) ? ' class="selected"' : ''; ?>><?php echo $product['mkr_name']; ?></a></span>
                    </div>
                </div> <!-- .product-list-info -->
                <div class="product-list-basket">
                    <form action="<?php echo $product['action']['basket']; ?>" method="post" class="add-basket-form"> <!-- добавить в корзину -->
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
                        <input type="text" name="count" value="1" size="5" />
                        <input type="hidden" name="return" value="category" />
                        <input type="hidden" name="return_ctg_id" value="<?php echo $id; /* куда перенаправить пользователя после добавления товара в корзину */ ?>" />
                        <?php if ($group): /* фильтры: выбранная функциональная группа */ ?>
                            <input type="hidden" name="group" value="<?php echo $group; ?>" />
                        <?php endif; ?>
                        <?php if ($maker): /* фильтры: выбранный производитель */ ?>
                            <input type="hidden" name="maker" value="<?php echo $maker; ?>" />
                        <?php endif; ?>
                        <?php if ($hit): /* фильтры: отмечен checkbox «Лидер продаж»? */ ?>
                            <input type="hidden" name="hit" value="1" />
                        <?php endif; ?>
                        <?php if ($new): /* фильтры: отмечен checkbox «Новинка»? */ ?>
                            <input type="hidden" name="new" value="1" />
                        <?php endif; ?>
                        <?php if ( ! empty($fltr)): /* фильтры: параметры подбора (напряжение питания, способ подключения и т.п.) */ ?>
                            <input type="hidden" name="filter" value="<?php echo $fltr; ?>" />
                        <?php endif; ?>
                        <?php if ($sort): /* выбрана сортировка, отличная от сортировки по умолчанию? */ ?>
                            <input type="hidden" name="sort" value="<?php echo $sort; ?>" />
                        <?php endif; ?>
                        <?php if ($perpage): /* выбрано кол-во товаров на страницу, отличное от значения по умолчанию? */ ?>
                            <input type="hidden" name="perpage" value="<?php echo $perpage; ?>" />
                        <?php endif; ?>
                        <?php if ($page > 1): /* номер текущей страницы, постраничная навигация */ ?>
                            <input type="hidden" name="page" value="<?php echo $page; ?>" />
                        <?php endif; ?>
                        <input type="submit" name="submit" value="В корзину" title="Добавить в корзину" />
                    </form>
                    <form action="<?php echo $product['action']['wished']; ?>" method="post" class="add-wished-form"> <!-- добавить в избранное -->
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
                        <input type="hidden" name="return" value="category" />
                        <input type="hidden" name="return_ctg_id" value="<?php echo $id; /* куда перенаправить пользователя после добавления товара в избранное */ ?>" />
                        <?php if ($group): /* фильтры: выбранная функциональная группа */ ?>
                            <input type="hidden" name="group" value="<?php echo $group; ?>" />
                        <?php endif; ?>
                        <?php if ($maker): /* фильтры: выбранный производитель */ ?>
                            <input type="hidden" name="maker" value="<?php echo $maker; ?>" />
                        <?php endif; ?>
                        <?php if ($hit): /* фильтры: отмечен checkbox «Лидер продаж»? */ ?>
                            <input type="hidden" name="hit" value="1" />
                        <?php endif; ?>
                        <?php if ($new): /* фильтры: отмечен checkbox «Новинка»? */ ?>
                            <input type="hidden" name="new" value="1" />
                        <?php endif; ?>
                        <?php if ( ! empty($fltr)): /* фильтры: параметры подбора (напряжение питания, способ подключения и т.п.) */ ?>
                            <input type="hidden" name="filter" value="<?php echo $fltr; ?>" />
                        <?php endif; ?>
                        <?php if ($sort): /* выбрана сортировка, отличная от сортировки по умолчанию? */ ?>
                            <input type="hidden" name="sort" value="<?php echo $sort; ?>" />
                        <?php endif; ?>
                        <?php if ($perpage): /* выбрано кол-во товаров на страницу, отличное от значения по умолчанию? */  ?>
                            <input type="hidden" name="perpage" value="<?php echo $perpage; ?>" />
                        <?php endif; ?>
                        <?php if ($page > 1): /* номер текущей страницы, постраничная навигация */ ?>
                            <input type="hidden" name="page" value="<?php echo $page; ?>" />
                        <?php endif; ?>
                        <input type="submit" name="submit" value="В избранное" title="Добавить в избранное" />
                    </form>
                    <form action="<?php echo $product['action']['compare']; ?>" method="post" class="add-compare-form" data-group="<?php echo $product['grp_id']; ?>"> <!-- добавить к сравнению -->
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>" />
                        <input type="hidden" name="return" value="category" />
                        <input type="hidden" name="return_ctg_id" value="<?php echo $id; /* куда перенаправить пользователя после добавления товара к сравнению */ ?>" />
                        <?php if ($group): /* фильтры: выбранная функциональная группа */ ?>
                            <input type="hidden" name="group" value="<?php echo $group; ?>" />
                        <?php endif; ?>
                        <?php if ($maker): /* фильтры: выбранный производитель */ ?>
                            <input type="hidden" name="maker" value="<?php echo $maker; ?>" />
                        <?php endif; ?>
                        <?php if ($hit): /* фильтры: отмечен checkbox «Лидер продаж»? */ ?>
                            <input type="hidden" name="hit" value="1" />
                        <?php endif; ?>
                        <?php if ($new): /* фильтры: отмечен checkbox «Новинка»? */ ?>
                            <input type="hidden" name="new" value="1" />
                        <?php endif; ?>
                        <?php if ( ! empty($fltr)): /* фильтры: параметры подбора (напряжение питания, способ подключения и т.п.) */ ?>
                            <input type="hidden" name="filter" value="<?php echo $fltr; ?>" />
                        <?php endif; ?>
                        <?php if ($sort): /* выбрана сортировка, отличная от сортировки по умолчанию? */ ?>
                            <input type="hidden" name="sort" value="<?php echo $sort; ?>" />
                        <?php endif; ?>
                        <?php if ($perpage): /* выбрано кол-во товаров на страницу, отличное от значения по умолчанию? */ ?>
                            <input type="hidden" name="perpage" value="<?php echo $perpage; ?>" />
                        <?php endif; ?>
                        <?php if ($page > 1): /* номер текущей страницы, постраничная навигация */ ?>
                            <input type="hidden" name="page" value="<?php echo $page; ?>" />
                        <?php endif; ?>
                        <input type="submit" name="submit" value="К сравнению" title="Добавить к сравнению" />
                    </form>
                </div> <!-- .product-list-basket -->
                <div class="product-list-descr"><?php echo $product['shortdescr']; ?></div>
            </div>
        <?php endforeach; ?>
    </div> <!-- .product-list-line или .product-list-grid -->

    <?php if ( ! empty($pager)): /* постраничная навигация */ ?>
        <ul class="pager"> <!-- постраничная навигация -->
        <?php if (isset($pager['first'])): ?>
            <li>
                <a href="<?php echo $pager['first']['url']; /* первая страница */ ?>" class="first-page"></a>
            </li>
        <?php endif; ?>
        <?php if (isset($pager['prev'])): ?>
            <li>
                <a href="<?php echo $pager['prev']['url']; /* предыдущая страница */ ?>" class="prev-page"></a>
            </li>
        <?php endif; ?>
        <?php if (isset($pager['left'])): /* 1,2,3 страницы слева от текущей */ ?>
            <?php foreach ($pager['left'] as $left) : ?>
                <li>
                    <a href="<?php echo $left['url']; ?>"><?php echo $left['num']; ?></a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>

            <li>
                <span><?php echo $pager['current']['num']; /* текущая страница */ ?></span>
            </li>

        <?php if (isset($pager['right'])): /* 1,2,3 страницы справа от текущей */  ?>
            <?php foreach ($pager['right'] as $right) : ?>
                <li>
                    <a href="<?php echo $right['url']; ?>"><?php echo $right['num']; ?></a>
                </li>
            <?php endforeach; ?>
        <?php endif; ?>
        <?php if (isset($pager['next'])): ?>
            <li>
                <a href="<?php echo $pager['next']['url']; /* следующая страница */ ?>" class="next-page"></a>
            </li>
        <?php endif; ?>
        <?php if (isset($pager['last'])): ?>
            <li>
                <a href="<?php echo $pager['last']['url']; /* последняя страница */ ?>" class="last-page"></a>
            </li>
        <?php endif; ?>
        </ul> <!-- .pager -->
    <?php endif; ?>

</div> <!-- #catalog-products -->

<!-- Конец шаблона view/example/frontend/template/catalog/category/center.php -->
