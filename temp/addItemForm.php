<div class="add-item-form-cont">
<h1>Добавить товар</h1>
<form method="POST" action="" enctype="multipart/form-data" >
    <div>
      <div class="mb-3">
        <label for="itemName" class="form-label">Укажите имя товара</label>
        <input type="text" class="form-control form-add-item" name="itemName" placeholder=""/>
      </div>
      <div class="mb-3 ">
        <label for="itemCategory" class="form-label">Укажите бренд</label>
      <select name="itemBrand" class="form-select" style="width:60%;" aria-label="Default select example">
        <option selected disabled>Выбрать</option>
      <?=renderBrands()?>
      </select>
      </div>
      <div class="mb-3 ">
        <label for="itemCategory" class="form-label">Укажите категорию товара</label>
      <select name="itemCategory" class="form-select" style="width:60%;" aria-label="Default select example">
        <option selected disabled>Выбрать категорию</option>
      <?=renderCategory()?>
      </select>
      </div>
      <div class="mb-3">
        <label for="itemName" class="form-label">Количество струн</label>
        <input type="number" class="form-control form-add-item" name="itemStringNum" style="width:40%;" placeholder=""/>
      </div>
      <div class="mb-3">
        <label for="itemName" class="form-label">Звукосниматели</label>
        <input type="text" class="form-control form-add-item" style="width:50%;" name="itemPickups" placeholder=""/>
      </div>
    </div>
    
    <div class="mb-3">
      <label for="itemCost" class="form-label">Укажите цену товара в тенге</label>
      <input type="" class="form-control form-add-item-price" name="itemCost" >
    </div>
    <div class="mb-3">
      <label for="itemCount" class="form-label">Укажите количество единиц товара на складе</label>
      <input type="" class="form-control form-add-item-price" name="itemCount" />
    </div>
    <div class="mb-3">
    <label for="itemImages" class="form-label">Выбрать главное изображение товара</label></br>
    <input type="file" name="itemImages" />
    </div>
    <div class="mb-3">
    <label for="itemImages" class="form-label">Загрузка галереи изобраэжений товара</label></br>
    <input type="file" name="galleryImagesItem[]" /></br>
    <input type="file" name="galleryImagesItem[]" /></br>
    <input type="file" name="galleryImagesItem[]" /></br>
    <input type="file" name="galleryImagesItem[]" />
    </div>
    <div class="mb-3">
    <label for="itemDescription" class="form-label">Укажите описание товара</label>
    <textarea name="itemDescription" placeholder="Описание товара..." class="form-control form-control-textarea"></textarea>
    </div>
    <button type="submit" class="btn buttons mb-5">Добавить</button>
  </form>
  </div>