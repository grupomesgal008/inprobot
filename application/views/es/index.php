<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/index.css">
</head>

<body>
    <div class="seccion cabecera">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-10">
                    <div class="texto">
                        <p class="titulo">E&P<br>ESTUDIOS&nbsp;Y&nbsp;GESTIÓN DE PROYECTOS&nbsp;INDUSTRIALES&nbsp;SL</p>
                        <p class="subtitulo">Nuestra ingeniería situada en Jaén está presente en todas las fases de los proyectos. Licencias iniciales necesarias, asesoramiento, proyecto, pliego de contratación, coordinación de seguridad y salud y dirección de obra</p>
                    </div>
                    <div class="contenedor_boton">
                        <a href="<?php echo base_url(); ?>es/contacto" class="b_contacto">Contacto</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row seccion simulador">
            <div class="col-12">
                <div class="texto">
                    <p class="titulo">FDS Fire Dynamics Simulator</p>
                    <p>En E&P realizamos estudios del diseño prestacional de un sistema de control de humos por medio de un Modelo de Simulación Conputacional de incendios denominado FDS (Fire Dynamics Simulator) desarrollado por el Building and Fire Research Laboratory del National Institute of Standards and Technology – NIST (USA), con la colaboración del VTT Building and Transport in Finland.</p>
                    <p>Se hace uso así mismo de un programa informático, CYPE MEP CYPETHERM, una interfaz gráfica de usuario para Fire Dynamics Simulator (FDS). Este programa permite crear y administrar rápidamente los detalles de modelos complejos de incendio, importar datos CAD o modelos FDS diseñados con otros programas, diseñar espacios y situaciones de manera intuitiva, o acceder a su extensa base de datos para superficies, reacciones, materiales, etc.</p>
                    <p>Además, en cualquier momento durante el análisis, se puede lanzar el programa Smokeview, también desarrollado por NIST para funcionar sinérgicamente con el software FDS. Este programa permite ver el humo, las temperaturas, las velocidades, la toxicidad y otros resultados del análisis FDS.</p>
                </div>
            </div>
        </div>

        <div class="row seccion proyectos">
            <div class="col-12">
                <div class="texto">
                    <p class="titulo">Proyectos</p>
                </div>
            </div>
            <div class="col-12">
                <div class="featured-carousel owl-carousel">
                    <div class="item">
                        <img src="<?php echo base_url(); ?>assets/img/header/hero_1.jpg" alt="">
                    </div>
                    <div class="item">
                        <img src="<?php echo base_url(); ?>assets/img/fds/proyecto1.png" alt="">
                    </div>
                    <div class="item">
                        <img src="<?php echo base_url(); ?>assets/img/fds/proyecto2.png" alt="">
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>

<script src="<?php echo base_url(); ?>assets/js/owl.carousel.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/fds.js"></script>