<head>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/proyectos.css">
</head>

<body>
    <section>
        <div class="section-presentacion">
            <div class="container">
                <div class="row parte">
                    <div class="col-md-4 col-sm-4">
                        <div class="info-icon">
                            <div class="icon">
                                <i class="fas fa-industry"></i>
                            </div>
                            <h3>Cálculo Estructural</h3>
                            <p class="description">Con más de 30 años de experiencia en el cálculo estructural, es el punto fuerte de la ingeniería. Asegurando la seguridad y optimización de las distintas construcciones.
                            </p>
                            <p class="description">Dirección de obra.</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="info-icon">
                            <div class="icon">
                                <i class="fas fa-plug"></i>
                            </div>
                            <h3>Cálculo Instalaciones Industriales</h3>
                            <p class="description">Diseño y cálculo de cualquier instalación necesaria: electricidad, fontanería, contraincendios, aire comprimido, climatización, telecomunicaciones, residuos, …</p>
                            <p class="description">Diseño 3D en BIM</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="info-icon">
                            <div class="icon">
                                <i class="fas fa-solar-panel"></i>
                            </div>
                            <h3>Eficiencia energética</h3>
                            <p class="description">Experiencia en distintos proyectos eficientes desde el punto de vista ambiental. Geotermia, energía solar y aerotermia como ejemplos así como recirculación de agua de pozos.</p>
                        </div>
                    </div>
                </div>
                <div class="row parte">
                    <div class="col-md-4 col-sm-4">
                        <div class="info-icon">
                            <div class="icon">
                                <i class="fas fa-check"></i>
                            </div>
                            <h3>Certificado Ce de Máquina</h3>
                            <p class="description">Se realizan certificados de cualquier máquina.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="info-icon">
                            <div class="icon">
                                <i class="fas fa-layer-group"></i>
                            </div>
                            <h3>Expedientes Técnicos</h3>
                            <p class="description">Expedientes técnicos de cualquier adaptación, máquina o proyecto que lo necesite</p>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-4">
                        <div class="info-icon">
                            <div class="icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3>Certificados Energéticos</h3>
                            <p class="description">Cálculo de certificación energética de edificios. Desde viviendas para su compra-venta hasta centros comerciales. Cualquier tipo de edificio que requiera un certificado. Igualmente se realizan estudios de mejora de la eficiencia.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="section-galeria">
            <div class="container-fluid">
                <div class="row parte">
                    <?php for ($i = 0; $i < 4; $i++) { ?>
                        <div class="col-md-3 col-sm-3 contenedor-imagen">
                            <div class="imagen-galeria" style="background-image: url('<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png')"></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row parte">
                    <?php for ($i = 0; $i < 4; $i++) { ?>
                        <div class="col-md-3 col-sm-3 contenedor-imagen">
                            <div class="imagen-galeria" style="background-image: url('<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png')"></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row parte">
                    <?php for ($i = 0; $i < 4; $i++) { ?>
                        <div class="col-md-3 col-sm-3 contenedor-imagen">
                            <div class="imagen-galeria" style="background-image: url('<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png')"></div>
                        </div>
                    <?php } ?>
                </div>
                <div class="row parte">
                    <?php for ($i = 0; $i < 4; $i++) { ?>
                        <div class="col-md-3 col-sm-3 contenedor-imagen">
                            <div class="imagen-galeria" style="background-image: url('<?php echo base_url(); ?>assets/img/galeria/proyectos-industriales.png')"></div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
</body>