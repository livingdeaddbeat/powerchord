<!doctype html>
<html lang="ru">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?=$title?></title>
		<meta type="description" content="<?=$description?>" />
		<meta type="keywords" content="<?=$keywords?>" />
		<link href="/temp/styles/bootstrap.min.css" rel="stylesheet" />
		<link href="/temp/styles/bootstrap-icons.min.css" rel="stylesheet" />
		<link rel="stylesheet" href="/temp/styles/swiper-bundle.min.css">
		<link href="/temp/styles/main.css" rel="stylesheet" />
		<link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css">
		<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

	</head>
	
	<body>
		<div class="container-fluid sticky-top" style="background-color:#121212;"> 
			<?
				include '/temp/navigation.php';
			?>
		</div>
		<div class="container-fluid wrapper " >
			<?=$content?>
		</div>
		<div class="container-fluid mt-5  w-100">
			<?
				include '/temp/footer.php';
			?>
		</div>
		<script src="/temp/js/bootstrap.bundle.min.js"></script>
		<script src="/temp/js/swiper-bundle.min.js"></script>
		<script>
			var swiper = new Swiper('.swiper', {
			loop: true,
			autoplay: {
				delay: 4000,
				disableOnInteraction: false,
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true,
			},
			navigation: {
				nextEl: '.swiper-button-next',
				prevEl: '.swiper-button-prev',
			},
			});
		</script>
		
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel" data-bs-theme="dark">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasExampleLabel">
	<a class="navbar-brand" href="/">powerchord</a>
	</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body">
    <div>
	<ul class="navbar-nav" id="navbar-items-box">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Главная</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/?do=guitars">Электрогитары</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/?do=guitars&amp;catid=17">Бас-гитары</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="/?do=about">О нас</a>
        </li>
      </ul>
    </div>
    <div class="dropdown mt-3">
	  <a class="nav-link dropdown-toggle active" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Категории
          </a>
      <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="/?do=guitars&amp;catid=2">Superstrat</a></li><li><a class="dropdown-item" href="/?do=guitars&amp;catid=4">V</a></li><li><a class="dropdown-item" href="/?do=guitars&amp;catid=6">Explorer</a></li><li><a class="dropdown-item" href="/?do=guitars&amp;catid=15">ML</a></li><li><a class="dropdown-item" href="/?do=guitars&amp;catid=16">Arrow</a></li><li><a class="dropdown-item" href="/?do=guitars&amp;catid=17">Бас-гитары</a></li>          </ul>
    </div>
  </div>
</div>
	</body>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" data-bs-theme="dark">
	<div class="modal-dialog">
		<div class="modal-content">
		<div class="modal-header">
			<div class="modal-header-box">
					<?=$userInfo['userEmail']?>
					<?
					if(isAdmin()){
					?>
					<button class="btn button-back-error">
						<?=$userInfo['userStatusName']?>
					</button>
					<?}?>
				</div>
			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		</div>
		<div class="modal-body">
			<div class="log-form-cont form-cont">
				<?
					if(isAdmin()){
						echo <<<HTML
						<div class="mb-3">
							<a href="/?do=userslist" class="list-group-item list-group-item-action">Список пользователей</a>
							<a href="/?do=additem" class="list-group-item list-group-item-action">Добавить товар</a>
							<a href="/?do=neworders" class="list-group-item list-group-item-action">Список новых заказов</a>
							<a href="/?do=catlist" class="list-group-item list-group-item-action">Категории</a>
							<a href="/?do=addcat" class="list-group-item list-group-item-action">Добавить категорию</a>
							<a href="/?do=addnews" class="list-group-item list-group-item-action">Добавить новость</a>
						</div>
HTML;
					}
					if(isLogged()){ echo <<<HTML
						<a href="/?do=cart" class="list-group-item list-group-item-action">Корзина</a>
						<a href="/?do=userorders" class="list-group-item list-group-item-action">Список заказов</a>
HTML;
						}
					if(!isLogged()){
					?>
					<div class="form-cont-block">
						<span>Авторизация</span>
						<a href="/?do=login">
						<button  class="btn-reg" id="btn-reg">
							Войти
							</button>
						</a>
					</div>
					<div class="form-cont-block">
						<span>Еще нет аккаунта?</span>
						<a href="/?do=registration">
						<button  class="btn-reg" id="btn-reg">
							Зарегистрироваться
							</button>
						</a>
					</div>
					<div class="form-cont-block">
						<?}else if(isLogged()){
							echo '<span>Вы авторизованы</span><a href="/?do=logout">
							
						<button  class="btn-reg" id="btn-logout">
							Выйти
							</button>
						</a>';
						}?>
					</div>
			</div>
		</div>
    </div>
	
</body>
  </div>
</div>
</html>