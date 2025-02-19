<div class="d-md-flex container item-card-container">
	<div class="col-md-8 item-image">
		<div class="imageWrapper">
			<div id="carouselExample" class="carousel slide">
			  <div class="carousel-inner">
				<div class="carousel-item active">
				  <img src="/uploads/<?=getVar('itemInfo')['images']?>" class="d-block w-100" alt="...">
				</div>
				<?=getVar('galleryimages')?>
			  </div>
			  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
				<span class="carousel-control-prev-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Previous</span>
			  </button>
			  <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
				<span class="carousel-control-next-icon" aria-hidden="true"></span>
				<span class="visually-hidden">Next</span>
			  </button>
			</div>
		</div>
	</div>
	<div class="col-md-4 item-info">
		<div class="mt-4 ms-4">
			<h1 class="fs-2 fw-bold">Купить <?=getBrand((getVar('itemInfo')['itemBrand']))?>  <?=getVar('itemInfo')['name']?></h1>
			<p class="fs-4">Цена: <?=getVar('itemInfo')['cost']?> ₸</p>
			<div class="my-3 d-flex ">
				
				<a href="/?do=cartadditem&itemId=<?=getVar('itemInfo')['id']?>"><button type="button" class="btn buttons px-5 me-3 cart-add-btn" style="height:48px;background:#A821E8;white-space:nowrap;">Добавить в корзину</button></a>

				<a href="/?do=favoritesadditem&itemId=<?=getVar('itemInfo')['id']?>"><button type="button" class="btn fn-btn fav-btn-item"><img src="../temp/img/icons/fi_heart.svg" alt=""></button></a>
			</div>
			<div class="about-item-cont">
				<!-- <ul class="list-group list-group-flush" data-bs-theme="dark"> -->
				  <li class="list-group-item mb-1">Категория: <?=getCategoryNameById(getVar('itemInfo')['catid'])?></li>
				  <li class="list-group-item mb-1">Количество струн: <?=getVar('itemInfo')['itemStringNum']?></li>
				  <li class="list-group-item mb-1">Звукосниматели: <?=getVar('itemInfo')['itemPickups']?></li>
				  <li class="list-group-item mb-1">Количество на складке: <?=getVar('itemInfo')['count']?></li>
				  <li class="list-group-item mb-1">Просмотров: <?=getVar('itemInfo')['views']?></li>
				  <li class="list-group-item mb-1">Дата добавления: <?=timestampToString(getVar('itemInfo')['adddate'])?></li>
				<!-- </ul> -->
				<div class="mt-4 mb-2"><span class="fs-2 fw-bold">Описание товара:</span></div>
				<div>
				<?=getVar('itemInfo')['description']?>
				</div>
			</div>
		</div>
	</div>
</div>


<div>
	<?=getVar('data')?>
</div>
