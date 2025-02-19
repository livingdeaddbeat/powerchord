<?php
    // inc/userList.php

    // Protection
    if (!defined('ENGINE')) {
        die("Hack attempt!");
    }

    // Переопределение заголовков модуля
    $metatags = [
        'title' => 'Список всех пользователей сайта',
        'description' => '...',
        'keywords' => '...'
    ];

    if (isAdmin()) {
        // Step 1: Determine the total number of users
        $totalUsersQuery = "SELECT COUNT(*) as total FROM `powerchord_users`";
        $result = mysqli_query($db, $totalUsersQuery);
        $totalUsersArray = mysqli_fetch_assoc($result);
        $totalUsers = $totalUsersArray['total'];

        // Step 2: Calculate the number of pages
        $usersPerPage = 9; // Number of users per page
        $totalPages = ceil($totalUsers / $usersPerPage); // Calculate total pages

        // Step 3: Fetch users for the current page
        $currentPage = isset($_GET['page']) && is_numeric($_GET['page']) ? (int) $_GET['page'] : 1;

        if ($currentPage > $totalPages) {
            $currentPage = $totalPages;
        }

        if ($currentPage < 1) {
            $currentPage = 1;
        }

        $offset = ($currentPage - 1) * $usersPerPage;
        $userQuery = "SELECT `id`, `email`, `regdate`, `userstatus` FROM `powerchord_users` LIMIT $offset, $usersPerPage";
        $result = mysqli_query($db, $userQuery);

        // Generate the table with users
        $userRows = '';
        if (mysqli_num_rows($result)) {
            $allUsers = mysqli_fetch_all($result, MYSQLI_ASSOC);
            foreach ($allUsers as $user) {
                $user['regdate'] = timestampToString($user['regdate']);
                $user['userstatus'] = getUserStatus($user['userstatus']);
                $userRows .= <<<HTML
<tr>
  <th scope="row">{$user['id']}</th>
  <td>{$user['email']}</td>
  <td>{$user['regdate']}</td>
  <td>{$user['userstatus']}</td>
  <td><a href="/?do=edituser&userId={$user['id']}"><i class="bi bi-gear-fill text-white-50"></i></a> <a href="/?do=deleteuser&userId={$user['id']}"><i class="bi bi-trash-fill text-danger"></i></a></td>
</tr>
HTML;
            }
        }
  // Generate pagination links
        $paginationLinks = '<nav><ul class="pagination">';
        if ($currentPage > 1) {
            $paginationLinks .= '<li class="page-item"><a class="page-link" href="?do=userslist&page=' . ($currentPage - 1) . '"><</a></li>';
        }
        for ($i = 1; $i <= $totalPages; $i++) {
            if ($i == $currentPage) {
                $paginationLinks .= '<li class="page-item active"><span class="page-link">' . $i . '</span></li>';
            } else {
                $paginationLinks .= '<li class="page-item"><a class="page-link" href="?do=userslist&page=' . $i . '">' . $i . '</a></li>';
            }
        }
        if ($currentPage < $totalPages) {
            $paginationLinks .= '<li class="page-item"><a class="page-link" href="?do=userslist&page=' . ($currentPage + 1) . '">></a></li>';
        }
        $paginationLinks .= '</ul></nav>';

        // Подключение файла шаблона модуля
        $content .= getTemplate('usersList');
    } else {
        $content = returnError('Ошибка доступа', 'У Вас недостаточно прав для просмотра данного контента.');
    }
?>
