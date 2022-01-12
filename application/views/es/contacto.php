<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/contacto.css">
</head>

<body>
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Contacta con nosotros</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="wrapper">
                        <div class="row mb-5">
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-map-marker"></span>
                                    </div>
                                    <div class="text">
                                        <!-- <span>Dirección: </span> -->
                                        <p>Calle Puerta de Martos, 85 23004 Jaén</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-phone"></span>
                                    </div>
                                    <div class="text">
                                        <!-- <span>Teléfono: </span> -->
                                        <p> <a href="tel://(+34) 953 295002">(+34) 953 295 002</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-paper-plane"></span>
                                    </div>
                                    <div class="text">
                                        <!-- <span>Email:</span>  -->
                                        <p><a href="mailto:eip4@estypro.es">eip4@estypro.es</a></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="dbox w-100 text-center">
                                    <div class="icon d-flex align-items-center justify-content-center">
                                        <span class="fa fa-globe"></span>
                                    </div>
                                    <div class="text">
                                        <!-- <span>Website</span>  -->
                                        <p><a href="https://eypingenieria.com/">https://eypingenieria.com/</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row no-gutters">
                            <div class="col-md-7">
                                <div class="contact-wrap w-100 p-md-5 p-4">
                                    <h3 class="mb-4">Contacta con nosotros</h3>
                                    <div id="form-message-warning" class="mb-4"></div>
                                    <div id="form-message-success" class="mb-4">
                                        Tu mensaje fue enviado, ¡gracias!
                                    </div>
                                    <form method="POST" id="contactForm" name="contactForm" class="contactForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="name">Nombre y Apellido</label>
                                                    <input type="text" class="form-control" name="name" id="name" placeholder="Nombre y Apellido">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="label" for="email">Correo electrónico</label>
                                                    <input type="email" class="form-control" name="email" id="email" placeholder="Correo electrónico">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="subject">Asunto</label>
                                                    <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label class="label" for="#">Mensaje</label>
                                                    <textarea name="message" class="form-control" id="message" cols="30" rows="4" placeholder="Mensaje"></textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <input type="submit" value="Enviar Mensaje" class="btn btn-primary">
                                                    <div class="submitting"></div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-md-5 d-flex align-items-stretch">
                                <!-- <div class="info-wrap w-100 p-5 img"> -->
                                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3153.68577816684!2d-3.804497184682384!3d37.77396537975949!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6dd715d68ff3f5%3A0x37cc246d3e559918!2sC.%20Prta%20de%20Martos%2C%2085%2C%2023004%20Ja%C3%A9n!5e0!3m2!1ses!2ses!4v1641992228571!5m2!1ses!2ses" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                                <!-- </div> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="<?php echo base_url(); ?>assets/js/jquery.validate.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/contacto.js"></script>