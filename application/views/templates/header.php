<!DOCTYPE html>
<html lang="es">

<head>
	<title>123emprende</title>
	<!-- etiquetas meta -->
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, shrink-to-fit=no">
	<!-- Fuentes -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<!-- Fuente Mulish -->
	<link href="https://fonts.googleapis.com/css2?family=Imbue:wght@100;200;300;400&family=Mulish:ital,wght@0,200;0,300;0,400;0,700;0,900;1,200;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
	<!-- Fuente Poppins -->
	<link href="https://fonts.googleapis.com/css2?family=Imbue:wght@100;200;300;400&family=Mulish:ital,wght@0,200;0,300;0,400;0,700;0,900;1,200;1,300;1,400;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,400;0,700;1,100;1,200;1,400;1,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<!-- jQuery CDN -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<!-- Font Awesome JS -->
	<script src="https://kit.fontawesome.com/b22df7fc9e.js" crossorigin="anonymous"></script>
	<!-- Scripts -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>

	<!-- Bootstrap CSS CDN -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
	<!-- Popper.JS -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
	<!-- Bootstrap JS -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
	<!-- CSS -->
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/estilos.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/css/header.css">

</head>

<body>
	<section class="ftco-section">
		<!-- <div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h2 class="heading-section">Website menu #07</h2>
				</div>
			</div>
		</div> -->

		<div class="container-fluid px-md-5">
			<div class="row justify-content-between" style="align-items: center;">
				<div class="col-md-8 order-md-last">
					<div class="row" style="align-items: center;">
						<div class="col-md-6 text-center">
							<a class="navbar-brand" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/icons/logotipo-principal.svg" alt="Logo" width="250"></a>
						</div>
						<div class="col-md-6 d-md-flex justify-content-end mb-md-0 mb-3">
							<form action="#" class="searchform order-lg-last">
								<div class="form-group d-flex">
									<input type="text" class="form-control pl-3" placeholder="¿Qué estás buscando?">
									<button type="submit" placeholder="" class="form-control search"><span class="fa fa-search"></span></button>
								</div>
							</form>
						</div>
					</div>
				</div>
				<div class="col-md-4 d-flex">
					<div class="social-media">
						<p class="mb-0 d-flex">
							<a href="https://www.facebook.com/123emprende" class="d-flex align-items-center justify-content-center"><span class="fa fa-facebook"><i class="sr-only">Facebook</i></span></a>
							<a href="https://twitter.com/123emprende" class="d-flex align-items-center justify-content-center"><span class="fa fa-twitter"><i class="sr-only">Twitter</i></span></a>
							<a href="https://www.linkedin.com/company/10955858" class="d-flex align-items-center justify-content-center"><span class="fa fa-linkedin"><i class="sr-only">LinkedIn</i></span></a>
							<a href="https://www.instagram.com/123emprende" class="d-flex align-items-center justify-content-center"><span class="fa fa-instagram"><i class="sr-only">Instagram</i></span></a>
							<a href="https://www.youtube.com/channel/UCft2IRTJifchIYjlu-JHs4Q" class="d-flex align-items-center justify-content-center"><span class="fa fa-youtube"><i class="sr-only"></i></span></a>
						</p>
					</div>
				</div>
			</div>
		</div>
		<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
			<div class="container-fluid">

				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
					<span class="fa fa-bars"></span> Menu
				</button>
				<div class="collapse navbar-collapse" id="ftco-nav">
					<ul class="navbar-nav m-auto">
						<li class="nav-item"><a href="#" class="nav-link">Home</a></li>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" id="dropdown04" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Page</a>
							<div class="dropdown-menu" aria-labelledby="dropdown04">
								<a class="dropdown-item" href="#">Page 1</a>
								<a class="dropdown-item" href="#">Page 2</a>
								<a class="dropdown-item" href="#">Page 3</a>
								<a class="dropdown-item" href="#">Page 4</a>
							</div>
						</li>
						<li class="nav-item"><a href="#" class="nav-link">Otra cosa</a></li>
						<li class="nav-item" id="nav-item-blog"><a href="<?php echo base_url(); ?>es/blog" class="nav-link">Blog</a></li>
						<li class="nav-item"><a href="#" class="nav-link">Contacto</a></li>
					</ul>
				</div>
			</div>
		</nav>
		<!-- END nav -->

	</section>



</body>

</html>


<script>
	$(document).ready(function() {
		if (window.location.host == "localhost") {
			switch (window.location.pathname) {
				case "/123emprende/es/blog":
					$("#nav-item-blog").addClass("active");
					break;
				case "/123emprende/es/blog":
					$("#nav-item-blog").addClass("active");
					break;
			}
		} else {
			switch (window.location.pathname) {
				case "/es/blog":
					$("#nav-item-blog").addClass("active");
					break;
				case "/es/blog":
					$("#nav-item-blog").addClass("active");
					break;
			}
		}
	});
</script>