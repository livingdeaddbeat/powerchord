<form method="POST" action="">
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Тип аккаунта</label>
	<select class="form-select" name="userstatus">
	  <option selected disabled>Тип аккаунта</option>
		<?=renderUserStatus(getVar('userData')['userstatus'])?>
	</select>
  </div>
  
  <div class="mb-3" data-bs-theme="dark">
    <label for="exampleInputPassword1" class="form-label">Почта</label>
    <input type="text" class="form-control" disabled name="fio" value="<?=getVar('userData')['email']?>" />
  </div>
  
  <button type="submit" class="btn button-back-error">Сохранить</button>
</form>