<?php

class tp_public extends toba_tp_basico {

    function encabezado() {
        $this->cabecera_html();
        $this->menu();
    }

    protected function cabecera_html() {
        echo "<!DOCTYPE html>\n";
        //-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/
        echo '<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="es"> <![endif]-->';
        echo '<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="es"> <![endif]-->';
        echo '<!--[if IE 8]>    <html class="no-js lt-ie9" lang="es"> <![endif]-->';
        echo '<!--[if gt IE 8]><!--> <html class="no-js" lang="es"> <!--<![endif]-->';
        echo "<head>\n";
        echo "<title>" . $this->titulo_pagina() . "</title>\n";
        $this->encoding();
        $this->plantillas_css();
        $this->estilos_css();
        toba_js::cargar_consumos_basicos();
        $this->plantillas_js();
        echo "</head>\n";
    }

    protected function encoding() {
        echo '<meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
		<!-- Chrome, Firefox OS y Opera -->
		<meta name="theme-color" content="#286090"/>
		<!-- Windows Phone -->
		<meta name="msapplication-navbutton-color" content="#286090"/>
		
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="blue-translucent"/>
		';
    }

    protected function plantillas_css() {
        parent::plantillas_css();
        $url = $this->get_url_public();		
        echo "<link rel='shortcut icon' href='$url/tecnibook.ico' type='image/x-icon' />			
		<link href='$url/css/bootstrap.css' rel='stylesheet'>
        <link href='$url/css/heroic-features.css' rel='stylesheet'>
        <link href='$url/css/slick.css' rel='stylesheet'>
        <link href='$url/css/jquery.bxslider.css' rel='stylesheet'>
        <link href='$url/css/font-awesome.css' rel='stylesheet'>
        <link href='https://cdn.datatables.net/1.10.13/css/dataTables.bootstrap.min.css' rel='stylesheet'>
        <link rel='stylesheet' type='text/css' href='$url/css/slick-theme.css'>\n";
    }

    protected function plantillas_js() {
        $carrousel = toba::tabla('carrousel')->obtener_string_public();
        $url = $this->get_url_public();

        $minSlides = 4;
        $maxSlides = 6;
        $slideWidth = 150;
        if (tecnibooks::is_mobile() || tecnibooks::is_tablet()) {
            $minSlides = 1;
            $maxSlides = 1;
            $slideWidth = 2000;
        }

        echo "<script src='$url/js/jquery.js'></script>
        <!-- Bootstrap Core JavaScript -->
        <script src='$url/js/bootstrap.min.js'></script>
        <!-- Tiny carrousel Core JavaScript -->        
        <script src='$url/js/slick.js'></script>
        <script src='$url/js/jquery.bxslider.js'></script>
        <script src='$url/js/dataTable.js'></script>
        <script type='text/javascript'>
            $(document).ready(function(){
                $('.slider1').bxSlider({
                    slideWidth: $slideWidth,
                    minSlides: $minSlides,
                    maxSlides: $maxSlides,
		    auto: true,
					
            });
                $('.slider2').bxSlider({
                    slideWidth: $slideWidth,
                    minSlides: $minSlides,
                    maxSlides: $maxSlides,
                    auto: true,		                        
            });
        });
        </script>";
    }

    protected function get_url_public() {
        return toba_recurso::url_proyecto() . '/public';
    }
    
    protected function get_redes($red)
    {
        if ($red == 'facebook') {
            return 'https://www.facebook.com/tecnibook.ediciones';
        }
        else 
	if ($red == 'twitter') {
            return 'https://twitter.com/Tecnibook?lang=es';
        }
	else
	if ($red == 'linkedin') {
	    return 'https://linkedin.com/';
	}

    }

    protected function menu() {
        $index = 'home.php';
        $quienes = 'quienes.php';
        $busqueda = 'busqueda.php';
        $autores = 'autores.php';
        $autores2 = 'coleccion.php';
        $contacto = 'contacto.php';
        $www = toba::proyecto()->get_www();
        
        $estilo_barra = 'navbar-left';
        if (tecnibooks::is_mobile() || tecnibooks::is_tablet()) {
            $estilo_barra = 'navbar-rigth';
        }
        
        echo "<body>

            <!-- Navigation -->
            <div class='container'>
                <div class='row'>
                <div class='col-lg-3'><a href='$index'><img src='{$www['url']}/public/imagenes/tecnibook.png' />
                        </a></div>
                <div class='col-lg-1'></div>
                <div class='frase text-white col-lg-3'> <br><br><i>\"Mejor que Face es un buen Book\"</i></div>
                <div class='col-lg-5'><br><br>
                <form class='navbar-form $estilo_barra' action='$busqueda' id='busqueda' method='post'>
                    <a class='btn btn-facebook' target='_blank' href='".$this->get_redes('facebook')."'>
                        <i class='fa fa-facebook'></i>
                    </a>

                    <a class='btn btn-twitter' target='_blank' href='".$this->get_redes('twitter')."'>
                        <i class='fa fa-twitter'></i>
                    </a>
                
                    <a class='btn btn-linkedin' target='_blank' href='".$this->get_redes('linkedin')."'>
                        <i class='fa fa-linkedin'></i>
                    </a>
		    
			     <div class='form-group'>
                                <input id='autor' required name='autor' type='text' class='form-control' placeholder='Búsqueda por autor'>
                            </div>
                            <button type='submit' class='btn btn-success'><span class='glyphicon glyphicon-search'></span> Buscar</button>
                    </form>
            </div>
                </div>
                </div>
                </div>
            <nav class='navbar navbar-inverse navbar-static-top' role='navigation'>
                <div class='container'>
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <div class='navbar-header'>
                        <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='#bs-example-navbar-collapse-1'>
                            <span class='sr-only'>Toggle navigation</span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                            <span class='icon-bar'></span>
                        </button>                        
                    </div>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class='collapse navbar-collapse' id='bs-example-navbar-collapse-1'>
                        <ul class='nav navbar-nav'>
                            <li>
                                <a href='$index'><span class='glyphicon glyphicon-home'></span> Inicio</a>
                            </li>
                            <li>
                                <a href='$quienes'><span class='glyphicon glyphicon-comment'></span> Quienes Somos</a>
                            </li>
                            <li>
                                <a href='$autores'><span class='glyphicon glyphicon-user'></span> Autores</a>
                                
                            </li>
                            <li>
                                <a href='$autores2'><span class='glyphicon glyphicon-book'></span> Colección completa</a>
                            </li>
                            <li>
                                <a href='$contacto'><span class='glyphicon glyphicon-envelope'></span> Contáctenos</a>
                            </li>
                       <!--     <li>
                                <a href='#'><span class='fa fa-facebook'></span> Facebook
                                </a> -->
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-collapse -->
                </div>
                <!-- /.container -->
            </nav>
            ";
    }

    function pie() {
		
		$logo = toba_recurso::imagen_proyecto('logo_itdbservices_trans.png', true, '58px', '42px');
		
        echo "<hr>        
                <!-- Footer -->
                <footer>
                    <div class='row'>
                        <div class='col-lg-3'>
                            <script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
                            <!-- banner_izquierdo -->
                            <ins class='adsbygoogle'
                                 style='display:inline-block;width:320px;height:100px'
                                 data-ad-client='ca-pub-4197701840299017'
                                 data-ad-slot='7762751480'></ins>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>
                        </div>
                        <div class='col-lg-6'>
                          <p class='text-muted row text-center'>
                            Copyright &copy; Tecnibook 2016
                          </p>
                          <p class='text-muted text-center'>
                            <a class='text-muted text-center' target='_blank' href='http://www.itdbservices.com'>Created By $logo</a>
                          </p>
                        </div>
                        <div class='col-lg-3'>
                            <script async src='//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js'></script>
                            <!-- banner_derecho -->
                            <ins class='adsbygoogle'
                                 style='display:inline-block;width:320px;height:100px'
                                 data-ad-client='ca-pub-4197701840299017'
                                 data-ad-slot='9239484684'></ins>
                            <script>
                            (adsbygoogle = window.adsbygoogle || []).push({});
                            </script>                        
                        </div>
                    </div>
	         </footer>
                </div>
            ";
        echo "</body>\n";
        echo "</html>\n";
    }

}
