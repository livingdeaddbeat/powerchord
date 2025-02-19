<h1>Список всех товаров</h1>

<div class="userListBorder">
	<table class="table mb-0">
	  <thead class="tableHeader">
		<tr>
		  <th scope="col">ID</th>
		  <th scope="col">ФИО</th>
		  <th scope="col">Дата регистрации</th>
		  <th scope="col">Дата посл.посещения</th>
		  <th scope="col">Тип</th>
		  <th scope="col">Действие</th>
		</tr>
	  </thead>
	  <tbody>
		<?=getVar('data')?>
		<tr>
		  <td>Всего: <strong><?=getVar('userCount')?></strong></td>
		  <td></td>
		  <td></td>
		  <td></td>
		  <td></td>
		  <td></td>
		</tr>
	  </tbody>
	</table>
</div>


<div class="py-3">
	<a class="btn btn-primary" href="/?do=additem" role="button"><i class="bi bi-bag-plus-fill"></i> Добавить товар</a>
</div>