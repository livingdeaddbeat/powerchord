<a href="/?do=item&id=<?=$tempData['id']?>">
	<div class="card item-card item-card-guitars" data-bs-theme="dark">
	  <img src="/uploads/<?=$tempData['images']?>" class="card-img-top" alt="...">
	  <div class="card-body">
		<h5 class="card-title"><?=getBrand($tempData['itemBrand'])?> <?=$tempData['name']?></h5>
		<p class="card-text fs-4"><?=$tempData['cost']?> тг.</p>
	  </div>
	</div>
	</a>