<div class="container user-cont" data-bs-theme="dark">
	<div class="userListBorder flex-column">
	<h1 class="mb-4">Список товаров в избранном</h1>
		<table class="table mb-0 users-cont-table">
		<thead class="tableHeader">
			<tr>
			<th scope="col">Наименование</th>
			<th scope="col">Цена</th>
			<th scope="col">Добавлено</th>
			<th scope="col">Действие</th>
			</tr>
		</thead>
		<tbody>
			<?=getVar('data')?>
			<tr>
			<td>Всего товаров: <strong><?=getVar('favoriteCount')?></strong>, на сумму: <strong><?=getVar('total')?></strong></td>
			<td></td>
			<td></td>
			<td></td>
			</tr>
		</tbody>
		</table>
		<div class="py-3">
			<!-- <a class="btn btn-primary" href="/?do=setorder" role="button"><i class="bi bi-bag-plus-fill"></i> Заказать</a> -->
			<!-- <a class="btn btn-danger" href="/?do=deletefav&action=clearfav" role="button"></i> Очистить избранные</a> -->
		</div>
		
		<?=getVar('paginationLinks')?>
	</div>
	<?
		include 'temp/sidebar.php';
	?>
</div>


