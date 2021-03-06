
        <?php include "maestros/link_meta_script_iniciales.php" ?>
    <body id="body">
		<!-- preloader -->
		<div id="preloader">
			<img src="img/load.gif" alt="Preloader">
		</div>
		<!-- end preloader -->

        <!-- 
        Fixed Navigation Boton bootstrap en responsive
        ==================================== -->
        <header id="navigation" class="navbar-fixed-top navbar">
            <div class="container">
                <div class="navbar-header">
                    <!-- responsive nav button -->
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Barra de navegacion</span>
                        <i class="fa fa-bars fa-2x"></i>
                    </button>
					<!-- /responsive nav button -->
					<!-- logo -->
                    <a class="navbar-brand" href="#body">
						<h1 id="logo">
							<img src="img/logo2.png" alt="Brandi">
						</h1>
					</a>
					<!-- /logo -->
                </div>

                <?php include "maestros/menu.php" ?>
            </div>
        </header>
        <!--End Fixed Navigation==================================== -->

        <!--Home Slider==================================== -->
		
		<section id="slider">
			<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
			
				<!-- Ruedas indicadoras -->
                <?php
                /*Esta pequeña  linea quita errores molestos que muestra php*/
                error_reporting(E_ALL ^ E_NOTICE);
                require("bd.php");
                /*Se llama la libreria de paginacion*/
                $sql = "SELECT * FROM noticias LIMIT 0,1";
                $data = "";
                foreach($PDO->query($sql) as $row) {
                    $data .= "<ol class='carousel-indicators'>";
                    $data .= "<li data-target='#carousel-example-generic' data-slide-to='0' class='active'></li>";
                }
                print($data);
                $sql = "SELECT * FROM noticias LIMIT 1,566";
                $sql = "SELECT COUNT(*)-1 as indicador FROM noticias ";
                $data = "";
                foreach($PDO->query($sql) as $row) {
                    $data .= "<li data-target='#carousel-example-generic' data-slide-to='$row[indicador]'></li>";
                    $data .= "</ol>";
                }
                print($data);
                ?>
				<!-- Fin de ruedas indicadoras -->				
				
				<!-- Wrapper for slides -->
				<div class="carousel-inner" role="listbox">
                    <!-- PHP CARROUSEL-->
                            <?php
                            /*Esta pequeña  linea quita errores molestos que muestra php*/
                            error_reporting(E_ALL ^ E_NOTICE);
                            /*Se llama la libreria de paginacion*/
                            $sql = "SELECT titulo, subtitulo, leyenda, foto FROM noticias ORDER BY id_noticia LIMIT 0,1";
                            $data = "";
                            foreach($PDO->query($sql) as $row) {
                                $data .= "<div class='item active' style='background-image:  url(../backend/Mantenimientos/$row[foto])'>";
                                $data .= "<div class='carousel-caption'>";
                                $data .= "<h2 data-wow-duration='700ms' data-wow-delay='500ms' class='wow bounceInDown animated'><span>$row[titulo] </span></h2>";
                                $data .= "<h3 data-wow-duration='1000ms' class='wow slideInLeft animated'><span class='color'>$row[subtitulo]</span></h3>";
                                $data .= "<p data-wow-duration='1000ms' class='wow slideInRight animated'>$row[leyenda]</p>";
                                $data .= "</div>";
                                $data .= "</div>";
                            }
                            print($data);
                            $sql = "SELECT titulo, subtitulo, leyenda, foto FROM noticias ORDER BY id_noticia LIMIT 1, 566";
                            $data = "";
                            foreach($PDO->query($sql) as $row) {
                                $data .= "<div class='item' style='background-image: url(../backend/Mantenimientos/$row[foto])'>";
                                $data .= "<div class='carousel-caption'>";
                                $data .= "<h2 data-wow-duration='700ms' data-wow-delay='500ms' class='wow bounceInDown animated'><span>$row[titulo] </span></h2>";
                                $data .= "<h3 data-wow-duration='1000ms' class='wow slideInLeft animated'><span class='color'>$row[subtitulo]</span></h3>";
                                $data .= "<p data-wow-duration='1000ms' class='wow slideInRight animated'>$row[leyenda]</p>";
                                $data .= "</div>";
                                $data .= "</div>";
                            }
                            print($data);
                            ?>
                            <ul class="social-links text-center">
                                <li><a href="https://twitter.com/winefunoficial" target="_blank"><i class="fa fa-twitter fa-lg"></i></a></li>
                                <li><a href="https://www.facebook.com/winefunofficial" target="_blank" ><i class="fa fa-facebook fa-lg"></i></a></li>
                                <li><a href="https://instagram.com/winefun_official/" target="_blank"><i class="fa fa-instagram fa-lg"></i></a></li>
                            </ul>
                        </div>
                    <!-- PHP CARROUSEL-->
				<!-- End Wrapper for slides -->
		</section>
		
        <!--
        End Home SliderEnd
        ==================================== -->
		
        <!--
        Features
        ==================================== -->
		
		<section id="features" class="features">
			<div class="container">
				<div class="row">
				
					<div class="sec-title text-center mb50 wow bounceInDown animated" data-wow-duration="500ms">
						<h2>Características</h2>
						<div class="devider"><i class="fa fa-trophy fa-lg"></i></div>
					</div>
                    <?php
                    $sql = "SELECT titulo, descripcion FROM caracteristicas ORDER BY id_caracteristica";
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<div class='col-md-4 wow fadeInLeft' data-wow-duration='500ms'>";
                        $data .= " <div class='service-item'>";
                        $data .= "<div class=service-icon'>";
                        $data .= "<i class='fa fa-glass fa-2x'></i>";
                        $data .= "</div>";
                        $data .= "<div class='service-desc'>";
                        $data .= "<h3>$row[titulo]</h3>";
                        $data .= "<p>$row[descripcion]</p>";
                        $data .= "</div>";
                        $data .= "</div>";
                        $data .= "</div>";
                    }
                    print($data);
                    ?>
					<!-- services item -->
					<!-- end services item -->
				</div>
			</div>
		</section>
		
        <!--
        End Features
        ==================================== -->
		
		
        <!--
        Servicios
        ==================================== -->
		
		<section id="servicios" class="servicios">
			<div class="container">
				<div class="row">
				
					<div class="sec-title text-center">
						<h2>Servicios</h2>
						<div class="devider"><i class="fa fa-trophy fa-lg"></i></div>
					</div>
					
					<div class="sec-sub-title text-center">
						<p>Te ofrecemos diferentes opciones de planificacion de fiestas como:</p>
					</div>

				</div>
			</div>
            <div class="work-filter wow fadeInRight animated" data-wow-duration="500ms">
                <ul class="text-center">
                    <li><a href='#' data-filter='*' class='current'>Todos</a></li>
            <?php
            $sql = "SELECT tipo, descripcion FROM servicios ORDER BY id_servicio";
            $data = "";
            foreach($PDO->query($sql) as $row) {
                $data .= "<li><a href='#' data-filter='.$row[tipo]'>$row[tipo]</a></li>";
            }
            print($data);
            ?>
                </ul>
            </div>
			<div class="project-wrapper">
                <?php
                $sql = "SELECT imagenes_servicios.id_servicio, url, titulo, imagenes_servicios.descripcion as des, tipo FROM imagenes_servicios, servicios  WHERE imagenes_servicios.id_servicio= servicios.id_servicio ORDER BY id_imagen";
                $data = "";
                foreach($PDO->query($sql) as $row) {
                    $data .= "<figure class='work-item $row[tipo]'>";
                    $data .= "<img src='../backend/Mantenimientos/$row[url]' alt=''>";
                    $data .= "<figcaption class='overlay'>";
                    $data .= "<a class='fancybox' rel='../backend/Mantenimientos/img_servicios' title='$row[des]' href='../backend/Mantenimientos/$row[url]'><i class='fa fa-eye fa-lg'></i></a>";
                    $data .= "<h4>$row[titulo]</h4>";
                    $data .= "</figcaption>";
                    $data .= "</figure>";
                }
                print($data);
                ?>
			</div>
		</section>
		
		
        <!--
        Fin de servicios
        ==================================== -->
		
        <!--
        Meet Our Team
        ==================================== -->		
		
		<section id="team" class="team">
			<div class="container">
				<div class="row">
		
					<div class="sec-title text-center wow fadeInUp animated" data-wow-duration="700ms">
						<h2>Conoce nuestro equipo</h2>
						<div class="devider"><i class="fa fa-trophy fa-lg"></i></div>
					</div>
					
					<div class="sec-sub-title text-center wow fadeInRight animated" data-wow-duration="500ms">
						<p>En esta sección se dan a conocer los desarrolladores de está página web, quienes a su vez ejercen el cargo de CEO de WineFun. </p>
					</div>

                    <?php
                    $sql = "SELECT nombre, apellido, cargo, frase, twitter, facebook, foto FROM equipos ORDER BY id_equipo LIMIT 0,1";
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<figure class='team-member  col-md-offset-3 col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated' data-wow-duration='500ms' data-wow-delay='300ms'>";
                        $data .= " <div class='member-thumb'>";
                        $data .= "<img src='../backend/Mantenimientos/$row[foto]' alt='Team Member' class='img-responsive'>";
                        $data .= "<figcaption class='overlay'>";
                        $data .= "<h5>$row[nombre]  $row[apellido]</h5>";
                        $data .= "<p>$row[frase]</p>";
                        $data .= "<ul class='social-links text-center'>";
                        $data .= "<li><a href='$row[twitter]' target='_blank'><i class='fa fa-twitter fa-lg'></i></a></li>";
                        $data .= "<li><a href='$row[facebook]' target='_blank'><i class='fa fa-facebook fa-lg'></i></a></li>";
                        $data .= "</ul>";
                        $data .= "</figcaption>";
                        $data .= "</div>";
                        $data .= "<h4>$row[nombre]  $row[apellido]</h4>";
                        $data .= "<span>$row[cargo]</span>";
                        $data .= "</figure>";
                    }
                    print($data);
                    $sql = "SELECT nombre, apellido, cargo, frase, twitter, facebook, foto FROM equipos ORDER BY id_equipo LIMIT 1,566";
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<figure class='team-member  col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated' data-wow-duration='500ms' data-wow-delay='300ms'>";
                        $data .= " <div class='member-thumb'>";
                        $data .= "<img src='../backend/Mantenimientos/$row[foto]' alt='Team Member' class='img-responsive'>";
                        $data .= "<figcaption class='overlay'>";
                        $data .= "<h5>$row[nombre]  $row[apellido]</h5>";
                        $data .= "<p>$row[frase]</p>";
                        $data .= "<ul class='social-links text-center'>";
                        $data .= "<li><a href='$row[twitter]' target='_blank'><i class='fa fa-twitter fa-lg'></i></a></li>";
                        $data .= "<li><a href='$row[facebook]' target='_blank'><i class='fa fa-facebook fa-lg'></i></a></li>";
                        $data .= "</ul>";
                        $data .= "</figcaption>";
                        $data .= "</div>";
                        $data .= "<h4>$row[nombre]  $row[apellido]</h4>";
                        $data .= "<span>$row[cargo]</span>";
                        $data .= "</figure>";
                    }
                    print($data);
                    ?>
					<!-- Primer Miembro -->
					<!--figure class="team-member  col-md-offset-3 col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms"-->
				</div>
			</div>
		</section>
		
        <!--
        End Meet Our Team
        ==================================== -->



		<!--
        Some fun facts
        ==================================== -->		
		
		<section id="politicas" class="politicas">
			<div class="parallax-overlay">
				<div class="container">
					<div class="row number-counters">
						
						<div class="sec-title text-center mb50 wow rubberBand animated" data-wow-duration="1000ms">
							<h2>Políticas de Empresa</h2>
							<div class="devider"><i class="fa fa-trophy fa-lg"></i></div>
						</div>
                         <?php
                        $sql = "SELECT titulo, descripcion FROM politicas ORDER BY id_politica ";
                        $data = "";
                        foreach($PDO->query($sql) as $row) {
                            $data .= "<div class='col-md-3 col-sm-6 col-xs-12 text-center wow fadeInUp animated' data-wow-duration='500ms'>";
                            $data .= " <div class='counters-item'>";
                            $data .= "<i class='fa fa-paypal fa-3x'></i>";
                            $data .= "<p>$row[titulo]</p>";
                            $data .= "<h5>$row[descripcion]</h5>";
                            $data .= "</div>";
                            $data .= "</div>";
                        }
                        print($data);
                        ?>
					</div>
				</div>
			</div>
		</section>
        <?php
        //creamos la sesion
        session_start();
        error_reporting(E_ALL ^ E_NOTICE);

        //validamos si se ha hecho o no el inicio de sesion correctamente
        //si no se ha hecho la sesion nos regresará a login.php
        if(!isset($_SESSION['alias_cliente']))
        {
            echo '
        <section id="login_registro" >
           <div class="container">
           <div class="row">
               <div class="col-md-6 col-md-offset-3">
                  <div class="panel panel-login">
                 <div class="panel-heading">
                           <div class="row">
                                 <div class="col-xs-4">
                                <a href="#" class="active" id="login-form-link">Login</a>
                             </div>
                              <div class="col-xs-4">
                                <a href="#" id="register-form-link">Registro</a>
                                </div>
                           <div class="col-xs-4">
                               <a href="#" id="forgot-form-link">¿Olvidaste tu contraseña?</a>
                               </div>
                       <hr>
                       </div>
                       <div class="panel-body">
                            <div class="row">
                               <div class="col-lg-12">
                                 <form id="login-form"  method="post" role="form" style="display: block;">
                                        <div class="form-group">
                                         <input type="text" name="username" id="ususario" tabindex="1" class="form-control" placeholder="Usuario" maxlength="15" value="">
                                    </div>
                                         <div class="form-group">
                                       <input type="password" name="password" id="contrasena" tabindex="2" class="form-control" maxlength="15" placeholder="Contraseña">
                                            </div>

                                        <div class="form-group">
                                           <div class="row">
                                               <div class="col-sm-6 col-sm-offset-3">
                                               <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Ingresar">
                                                </div>
                                          </div>
                                       </div>

                                     </form>
                                    <form id="register-form" method="post" role="form" style="display: none;">
                                       <div class="form-group">
       <input class="form-control" name="nombres" placeholder="Nombres" required="required" id="nombres" type="text" autofocus autocomplete="off" maxlength="45">
                                     </div>
        <div class="form-group">
                                          <input class="form-control" name="apellidos" placeholder="Apellidos" type="text" required="required" id="apellidos" autocomplete="off" maxlength="60"  />
                                         </div>
                                        <div class="form-group ">
        <input class="form-control" name="identificador" placeholder="DUI" type="text" required="required" id="identificador" autocomplete="off" maxlength="10" />

                                       </div>
                                       <div class="form-group">
                                        <input class="form-control" name="telefono" placeholder="Telefono" type="text" required="required" id="telefono" autocomplete="off" maxlength="9"/>
                                        </div>
                                        <div class="form-group">
         <input class="form-control" name="correo" placeholder="Correo" type="email" required="required" id="correo" autocomplete="off" maxlength="75" />
                                       </div>
  <div class="form-group">
                                 <div class="input-group input-append date" id="dateRangePicker">
              <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" min="1950-01-01" max="1997-10-31"/>

                                            </div>
       </div>
                                   <div class="form-group">
        <select name="sexo" required="required" id="sexo" class="form-control">
                                            <option></option>
         <option value="Masculino">Masculino</option>
                                         <option value="Femenino">Femenino</option>
          </select>

                                        </div>
        <div class="form-group ">
                                     <input class="form-control" name="alias" placeholder="Alias" type="text" required="required" id="alias" autocomplete="off" maxlength="15" />

         </div>
             <div class="form-group ">
         <div class="g-recaptcha" data-sitekey="6LeRCw4TAAAAAOoQcioyh5jn-G2aP0A_WyVdgCfC"></div>
         </div>

                                      <div class="form-group">
        <div class="row">
                                               <div class="col-sm-6 col-sm-offset-3">
         <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                               </div>
       </div>
                                       </div>
       </form>
                                   <form id="forgot-form" method="post" role="form" style="display: none;">
            <div class="form-group">
                                        <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Correo Electrónico" value="">
            </div>
                                   <div class="form-group">
        <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
   <input type="submit" name="register-submit" id="forgot-submit" tabindex="4" class="form-control btn btn-register" value="Recuperar contraseña">
                                             </div>
    </div>
                                     </div>
     </form>
                            </div>
        </div>
                 </div>
         </div>
            </div>
        </div>
        </div>
     </section>
     ';
        }
        ?>
        <!--
       registro y login !-->


		<!-- 
        Contact Us
        ==================================== -->		
		
		<section id="contact" class="contact">
			<div class="container">
				<div class="row mb50">
				
					<div class="sec-title text-center mb50 wow fadeInDown animated" data-wow-duration="500ms">
						<h2>Contáctanos</h2>
						<div class="devider"><i class="fa fa-trophy fa-lg"></i></div>
					</div>
					
					<div class="sec-sub-title text-center wow rubberBand animated" data-wow-duration="1000ms">
						<p>No dudes en contáctarnos para cualquier duda, sugerencia u opinión. Será un honor para nosotros el saber si sus espectactivas fueron satisfechas o no. De esa manera podemos mejorar nuestros servicios.</p>
					</div>
					
					<!-- contact address -->
					<div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 wow fadeInLeft animated" data-wow-duration="500ms">
						<div class="contact-address">
							<h3>Interactúa con nosotros!</h3>
							<p>Altos de San Francissco</p>
							<p>Santa Elena, Antiguo Cuscatlán</p>
							<p>(+503) 2564 9832</p>
						</div>
					</div>
					<!-- end contact address -->
					
					<!-- contact form -->
					<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12 wow fadeInDown animated" data-wow-duration="500ms" data-wow-delay="300ms">
						<div class="contact-form">
							<h3>Di hola!</h3>
							<form action="#" id="contact-form">
								<div class="input-group name-email">
									<div class="input-field">
										<input type="text" name="name" id="name" placeholder="Nombre" class="form-control">
									</div>
									<div class="input-field">
										<input type="email" name="email" id="email" placeholder="Email" class="form-control">
									</div>
								</div>
								<div class="input-group">
									<textarea name="message" id="message" placeholder="Mensaje" class="form-control"></textarea>
								</div>
								<div class="input-group">
									<input type="submit" id="form-submit" class="pull-right " value="Enviar Mensaje">
								</div>
							</form>
						</div>
					</div>
					<!-- end contact form -->
					
					<!-- footer social links -->
					<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 wow fadeInRight animated" data-wow-duration="500ms" data-wow-delay="600ms">
						<ul class="footer-social">
							<li><a href="https://twitter.com/winefunoficial" target="_blank"><i class="fa fa-twitter fa-2x"></i></a></li>
							<li><a href="https://www.facebook.com/winefunofficial" target="_blank"><i class="fa fa-facebook fa-2x"></i></a></li>
                            <li><a href="https://www.instagram.com/winefun_official/" target="_blank"><i class="fa fa-instagram fa-2x"></i></a></li>
						</ul>
					</div>
					<!-- end footer social links -->
					
				</div>
			</div>
			
			<!-- Google map <div id="map_canvas" class="wow bounceInDown animated" data-wow-duration="500ms"></div>-->


				 
				<div class="google-maps">
							<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1938.4267499442747!2d-89.2654591521177!3d13.666670718021175!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8f632e38d8691fab%3A0x317bd8e9aa3ae54b!2sSanta+Elena!5e0!3m2!1ses-419!2ssv!4v1424628917466" width="1262" height="200" frameborder="0" style="border:0"></iframe>
				</div>
			<!-- End Google map -->
		</section>
       <!--PREGUNTAS FRECUENTES --------------------------->
        <section id="preguntas" class="preguntas">
			<div class="container">
				<div class="row mb50" style="width:auto; height:350px; overflow: scroll;">

				
					<div class="sec-title text-center mb50 wow fadeInDown animated" data-wow-duration="500ms">
						<h2>Preguntas Frecuentes</h2>
						<div class="devider"><i class="fa fa-trophy fa-lg"></i></div>
					</div>
                    <div class="sec-sub-title text-center wow rubberBand animated" data-wow-duration="1000ms">
                        <p>Si tienes alguna duda, tómate unos minutos para leer las preguntas más comunes sobre WineFun</p>
                    </div>
					<!--Preguntas-->
                    <?php
                    require_once("../backend/libs/Zebra_Pagination.php");
                    $sql0 = "SELECT COUNT(*) as total_datos FROM preguntas";
                    foreach ($PDO->query($sql0) as $row0) {
                        $totaldatos = "$row0[total_datos]";
                    }
                    /*Numero de registros que se quiere por tabla*/
                    $filas = 5;
                    /*Aqui instanciamos la clase*/
                    $paginacion = new Zebra_Pagination();
                    /*Definimos el numero de registros que se quieren mostrar en las tablas*/
                    $paginacion->records($totaldatos);
                    $paginacion->records_per_page($filas);
                    $paginacion->padding(false);
                    $sql = "SELECT pregunta, respuesta FROM preguntas ORDER BY id_pregunta " ;
                    $data = "";
                    foreach($PDO->query($sql) as $row) {
                        $data .= "<div class='frecuentes' data-wow-duration='1000ms'>";
                        $data .= "<h3 class='preg'><p>$row[pregunta]</p></h3>";
                        $data .= "<h4 class='res'><p>$row[respuesta]</p></h4>";
                        $data .= "</div>";
                    }
                    print($data);
                    ?>
				</div>
                <!-- Aqui se imprime la paginacion-->
                <div>

                </div>
            </div>
        </section>
        <!--FIN PREGUNTAS FRECUENTES------------------------>
		<footer id="footer" class="footer">
			<div class="container">
				<div class="row">
				
					<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp animated" data-wow-duration="500ms">
						<div class="footer-single">
							<img src="img/footer-logo.png" alt="">
							<p><img src="../backend/img_page/WineFun.png" alt=""></p>
						</div>
					</div>
				
					<!--div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="300ms">
						<div class="footer-single">
							<h6>Subscribe </h6>
							<form action="#" class="subscribe">
								<input type="text" name="subscribe" id="subscribe">
								<input type="submit" value="&#8594;" id="subs">
							</form>
							<p>eusmod tempor incididunt ut labore et dolore magna aliqua. </p>
						</div>
					</div-->
				
					<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="600ms" >
						<div class="footer-single">
							<h6>Menú</h6>
							<ul>
								<li><a href="#body">Inicio</a></li>
								<li><a href="#features">Características</a></li>
								<li><a href="#servicios">Servicios</a></li>
								<li><a href="#team">Equipo</a></li>
							</ul>
						</div>
					</div>
				
					<div class="col-md-3 col-sm-6 col-xs-12 wow fadeInUp animated" data-wow-duration="500ms" data-wow-delay="900ms">
						<div class="footer-single">
							<h6>Menú</h6>
							<ul>
								<li><a href="#politicas">Políticas</a></li>
								<li><a href="#contact">Contacto</a></li>
								<li><a href="#preguntas">Preguntas Frecuentes</a></li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>
		</footer>
		<a href="javascript:void(0);" id="back-top"><i class="fa fa-angle-up fa-3x"></i></a>

    <?php include "maestros/jquery_plugins.php" ?>
    </body>
</html>
