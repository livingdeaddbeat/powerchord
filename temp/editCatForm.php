<form method="POST" action="">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Имя категории</label>
    <input type="text" class="form-control" name="name" value="<?=getVar('categoryInfo')['name']?>" />
  </div>
  <button type="submit" class="btn buttons" style="width:130px;">Сохранить</button>
</form>