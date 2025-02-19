<?php
// inc/guitars.php

if(!defined('ENGINE')){
    die("Hack no attempt!");
}

// Переменные для фильтрации
$filterConditions = [];
$orderCondition = '';
$conditionsString = '';

// Категория
if (!empty($_GET['catid'])) {
    $catId = (int)$_GET['catid'];
    $filterConditions[] = "catid = {$catId}";
}

// Бренд
if (!empty($_GET['brand'])) {
    $brand = (int)$_GET['brand'];
    $filterConditions[] = "itemBrand = {$brand}";
}

// Цена
if (!empty($_GET['price'])) {
    if ($_GET['price'] == 'low_high') {
        $orderCondition = 'ORDER BY cost ASC';
    } elseif ($_GET['price'] == 'high_low') {
        $orderCondition = 'ORDER BY cost DESC';
    }
}

// Количество струн
if (!empty($_GET['strings'])) {
    $strings = (int)$_GET['strings'];
    $filterConditions[] = "itemStringNum = {$strings}";
}

// Звукосниматели
if (!empty($_GET['pickups'])) {
    $pickups = mysqli_real_escape_string($db, $_GET['pickups']);
    $filterConditions[] = "itemPickups = '{$pickups}'";
}

// Формирование строки условий
if (!empty($filterConditions)) {
    $conditionsString = "WHERE " . implode(" AND ", $filterConditions);
}

// Вызов функции пагинации
$paginationResult = paginate($db, 'powerchord_items', ['id', 'catid', 'name', 'itemBrand', 'cost', 'count', 'itemStringNum', 'itemPickups', 'images', 'galleryimages', 'description', 'adddate', 'addauthor', 'views'], $conditionsString, 8);

$itemsData = $paginationResult['data'];
$currentPage = $paginationResult['currentPage'];
$totalPages = $paginationResult['totalPages'];

// Переопределение заголовков модуля
$metatags = [
    'title' => 'Электрогитары',
    'description' => 'Электрогитары на любой вкус: классические, современные модели и многое другое.',
    'keywords' => 'электрогитары, купить электрогитару, музыкальные инструменты',
];

// Динамическое обновление метатегов
if (!empty($_GET['catid'])) {
    if ($catId === 17) { // Категория "Бас-гитары"
        $metatags['title'] = 'Бас-гитары';
        $metatags['description'] = 'Бас-гитары высокого качества: джазовые, роковые и многое другое.';
        $metatags['keywords'] = 'бас-гитары, купить бас-гитару, музыкальные инструменты';
    }
}

// Генерация контента
if ($itemsData) {
    $data = '<div class="container d-flex justify-content-between mb-5 guitars-cont">';
    $content = getTemplate('guitars');
    $content .= '<div class="d-flex flex-column w-100">';
    $content .= '<div class="grid-container mb-5">';
    $content .= itemsWrapHandler($itemsData);
    $content .= '</div>';
    $paginationLinks = generatePaginationLinks($currentPage, $totalPages, '/?do=guitars');
    // Вставляем пагинацию в конец контента
    $content .= $paginationLinks;
    $content .= '</div>';
    $data .= '</div>';
} else {
    $content = '<div class="container d-flex justify-content-start mb-5 guitars-cont">';
    $content .= getTemplate('guitars');
    $content .= 'Нет товаров';
    $content .= '</div>';
}
?>
