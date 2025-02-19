<?php
// inc/deauthorization.php

// Protection
if (!defined('ENGINE')) {
    die("Hack no attempt!");
}

// Переопределение заголовков модуля
$metatags = [
    'title' => 'Избранное',
    'description' => '...',
    'keywords' => '...'
];

if (isLogged()) {
    // Параметры пагинации
    $table = 'powerchord_favorites';
    $fields = ['id', 'userid', 'itemid', 'adddate'];
    $conditions = ''; // Условия выборки, если нужно
    
    $paginationData = paginate($db, $table, $fields, $conditions, 10);

    $userFavoriteData = $paginationData['data'];
    $currentPage = $paginationData['currentPage'];
    $totalPages = $paginationData['totalPages'];
    
    $total = 0;
    $data = '';

    if ($userFavoriteData) {
        foreach ($userFavoriteData as &$favoriteItem) {
            $favoriteItem['itemdata'] = getShortItemById($favoriteItem['itemid']);
        }

        unset($favoriteItem);

        foreach ($userFavoriteData as $favoriteItem) {
            $total += $favoriteItem['itemdata']['cost'];
            $addDate = timestampToString($favoriteItem['adddate']);
            $data .= <<<HTML
<tr>
  <td><a href="/?do=item&id={$favoriteItem['itemdata']['id']}" target="_Blank">{$favoriteItem['itemdata']['name']}</a></td>
  <td>{$favoriteItem['itemdata']['cost']}</td>
  <td>{$addDate}</td>
  <td><a href="/?do=deletefav&action=deleteitem&itemId={$favoriteItem['id']}">Удалить</a></td>
</tr>
HTML;
        }
    }

    // Генерация ссылок для пагинации
    $paginationLinks = generatePaginationLinks($currentPage, $totalPages, '?do=favorites');

    // Подключение файла шаблона модуля
    $content = getTemplate('favorite');
} else {
    $content = '<div class="container">';
    $content .= returnError('Ошибка доступа', 'Для работы с избранными необходимо пройти авторизацию.');
    $content .= '</div>';
}
?>
