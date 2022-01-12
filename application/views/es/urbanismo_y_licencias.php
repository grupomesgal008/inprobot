<head>
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/urbanismo_y_licencias.css">
    <link rel="stylesheet" href="<?php echo base_url() ?>assets/css/galeria-carousel.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.6.0/css/lightgallery.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/lightgallery-all.min.js"></script>
</head>

<body>
    <div class="section-proyectos">

        <div class="page-content page-container" id="page-content">
            <div class="padding">
                <div class="row container d-flex justify-content-center">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">light Gallery</h4>
                                <p class="card-text"> Click on any image to open in lightbox gallery </p>
                                <div id="lightgallery" class="row lightGallery">
                                    <a href="<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png" class="image-tile" data-abc="true">
                                        <img src="<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png" alt="image small">
                                    </a>
                                    <a href="<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png" class="image-tile" data-abc="true">
                                        <img src="<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png" alt="image small">
                                    </a>
                                    <a href="<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png" class="image-tile" data-abc="true">
                                        <img src="<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png" alt="image small">
                                    </a>
                                    <a href="<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png" class="image-tile" data-abc="true">
                                        <img src="<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

<script>
    $(document).ready(function() {
        $('#lightgallery').lightGallery();
    });
</script>