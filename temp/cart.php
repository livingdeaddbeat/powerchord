<div class="container admin-cont "  data-bs-theme="dark">
	<div style="max-width: 930px; width:100%;">
		<h1 class="mb-4">Список товаров в корзине</h1>
		<div class="userListBorder users-cont" >
			<table class="table mb-0 table users-cont-table">
			<thead class="tableHeader">
				<tr>
				<th scope="col">Наименование</th>
				<th scope="col">Цена</th>
				<th scope="col">Действие</th>
				</tr>
			</thead>
			<tbody>
				<?=getVar('data')?>
				<tr>
				<td>Всего товаров: <strong><?=getVar('cartCount')?></strong>, на сумму: <strong><?=getVar('total')?></strong></td>
				<td></td>
				<td></td>
				</tr>
			</tbody>
			</table>
		</div>
		<div class="py-3">
			<a class="btn buttons" href="/?do=setorder" role="button" style="width:200px;">Заказать</a>
			<a class="btn btn-dark mx-2" href="/?do=deletecart&action=clearbasket" role="button"> Очистить корзину</a>
		</div>
	</div>
<?
    include 'temp/sidebar.php';
?>
</div>