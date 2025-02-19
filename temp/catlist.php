<div class="container admin-cont">

<div class="catlist">
	<h1 class="mb-4">Список всех категорий сайта</h1>
	<div class="userListBorder users-cont" data-bs-theme="dark">
	<table class="table mb-0 users-cont-table">
	  <thead class="tableHeader">
		<tr>
		  <th scope="col">ID</th>
		  <th scope="col">Имя</th>
		  <th scope="col">Дата добавления</th>
		  <th scope="col">Добавил</th>
		  <th scope="col" style="text-align:start;">Действие</th>
		</tr>
	  </thead>
	  <tbody>
		<?=getVar('data')?>
		<tr>
		  <td>Всего: <strong><?=getVar('catsCount')?></strong></td>
		  <td></td>
		  <td></td>
		  <td></td>
		  <td></td>
		  
		</tr>
	  </tbody>
	</table>
</div>

<div class="py-3">
	<a class="btn buttons" href="/?do=addcat" role="button">Добавить категорию</a>
</div>

</div>

<?
	include 'temp/sidebar.php';
?>
</div>