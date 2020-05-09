<!DOCTYPE html>	
<html lang="<?= $lang == "cat" ? 'ca' : 'es' ?>">
	<head>
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?= (isset($meta_title) && $meta_title) ? $meta_title . ' // ' : ''; ?>Cargol <?= ct('caravanas') ?></title>
		<meta name="description" content="<?= isset($meta_description) ? $meta_description : ct('meta_description'); ?>" />
		<meta name="keywords" content="<?= isset($meta_keywords) ? $meta_keywords : ct('meta_keywords'); ?>" />
		<meta name="theme-color" content="#FF6600"/>

		<meta property="og:title" content="<?= (isset($meta_title) && $meta_title) ? $meta_title . ' // ' : ''; ?>Cargol <?= ct('caravanas') ?>" />
		<meta property="og:type" content="website" />
		<meta property="og:url" content="<?= $config['base'] .  ( substr($_SERVER['REQUEST_URI'],1) ) ?>" />
		<meta property="og:image" content="<?= $config['base'] ?>images/ogimage.jpg" />
		<meta property="og:description" content="<?= isset($meta_description) ? $meta_description : ct('meta_description'); ?>" />

		<script
			  src="https://code.jquery.com/jquery-3.4.1.min.js"
			  integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
			  crossorigin="anonymous"></script>

		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.bundle.min.js" integrity="sha384-6khuMg9gaYr5AxOqhkVIODVIvm9ynTT5J4V1cfthmT+emCG6yVmEZsRHdxlotUnm" crossorigin="anonymous"></script>


		<link rel="shortcut icon" type="image/x-icon" href="/images/icons/favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Roboto|Roboto+Condensed:400,700" rel="stylesheet">

		

		<!--build:css /css/main.min.css-->
		<link rel="stylesheet" type="text/css" href="/bower_components/components-font-awesome/css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="/bower_components/owl.carousel/dist/assets/owl.carousel.min.css">
		<link rel="stylesheet" type="text/css" href="/bower_components/owl.carousel/dist/assets/owl.theme.default.min.css">
		<link rel="stylesheet" type="text/css" href="/bower_components/swipebox/src/css/swipebox.css">
		<link rel="stylesheet" type="text/css" href="/css/main.css?v=<?= time() ?>" />
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	   <!--endbuild-->
	</head>
	<body>
		<header class="page-header">
			<!-- Just an image -->
			<nav class="navbar navbar-expand-lg scrolling-navbar navbar-light bg-nav-color">
				<a class="navbar-brand" href="#"><img width="200" src="_var/res/logo.jpg"></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav mr-auto">
						<li class="nav-item active">
							<a class="nav-link" href="#">EL NOSTRE GRUP <span class="sr-only">(current)</span></a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">PROJECTES I+D</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">QUALITAT</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">TREBALLA AMB NOSALTRES</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" href="#">CONTACTE</a>
						</li>
						<li class="nav-item langs_in_mobile">
						<a class="nav-link" href="#">CAT</a>&nbsp;<a class="nav-link" href="#">CAST</a>&nbsp;<a class="nav-link" href="#">ENG</a>
						</li>
					</ul>
					<div class="la m-10">
						<div class="dropdown langs">
							<button class="el_menu dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								CATALÀ
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<a class="dropdown-item" href="#">ESPAÑOL</a>
								<a class="dropdown-item" href="#">ENGLISH</a>
							</div>
						</div>
					</div>
					<div class="la icon_profile_desktop">
						<img src="_var/res/pfl.png" width="25"/>
					</div>
				</div>
			</nav>
		</header>
