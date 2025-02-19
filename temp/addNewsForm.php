<div class="container admin-cont">
  <div class="users-cont-news">
    <h1 class="mb-4">Добавить новость</h1>
  <form method="POST" action="" enctype="multipart/form-data">
    <div class="mb-3 ">
    <label for="newsImage" class="form-label">Выбрать главное изображение товара</label></br>
    <input type="file" name="newsImage" />
    </div>
    <br/>
    <div class="mb-3">
      <label for="title" class="form-label">Укажите заголовок новости</label>
      <input  class="form-control form-control-news" name="title" >
    </div>
    <br/>
    <div class="mb-3 ">
    <label for="description" class="form-label">Укажите описание товара</label>
    <textarea name="description" placeholder="Описание товара..." class="form-control editor form-control-news" style="height: 250px; width:100%;"></textarea>
    </div>
    <br/>
    <button type="submit" class="btn buttons">Добавить</button>
  </form>

</div>

<?
  include 'temp/sidebar.php';
?>
</div>