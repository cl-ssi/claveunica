<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Sitio web del Servicio de Salud Iquique">
    <meta name="author" content="Alvaro Torres Fuchslocher">
    <title>{{ config('app.name') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/cu.min.css') }}" rel="stylesheet">

    <!-- Favicons -->
    <meta name="theme-color" content="#563d7c">

    <style>
        h1 {
            font-family: Sans-serif;
            font-weight: 200;
            color: #006fb3;
            font-size: 2.4rem;
        }
        .gb_azul {
            color: #006fb3;
        }
        .gb_rojo {
            color: #fe6565;
        }
        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
</head>

<body>
    <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm container">
        <h5 class="my-0 mr-md-auto font-weight-normal"> <img src="{{ asset('images/gob-header.svg') }}" alt="Logo del gobierno de chile"> </h5>
        <nav class="my-2 my-md-0 mr-md-3">
            <a class="p-2 text-dark" href="http://www.saludiquique.cl">Web Servicio de Salud</a>
        </nav>
    </div>

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center container">
        <h1 class="display-5 mb-3">{{ config('app.name') }}</h1>
        <div class="d-flex justify-content-center">
            <table class="align-self-center">
                <tr>
                    <td style="background-color: #006fb3;" width="300" height="6"></td>
                    <td style="background-color: #fe6565;" width="300" height="6"></td>
                </tr>
            </table>
        </div>
        <p class="text-muted mt-4">Bienvenido al portal de sistemas del Servicio de Salud de Iquique.</p>

    </div>

    <div class="container">
        <div class="card-deck mb-3 text-center">

            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Tramites</h4>
                </div>
                <div class="card-body">

                    <ul class="list-unstyled mt-3 mb-4">
                        <h2>Título</h2>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Accusantium pariatur esse, eum quasi repudiandae, iste vero sunt ipsa nihil voluptate assumenda, voluptatibus veritatis odio facere saepe! Neque beatae asperiores accusamus.</p>

                    </ul>
                    <div class="row">
                        <div class="mx-auto">
                            <!-- Código para visualizar botón oficial iniciar sesión con ClaveÚnica-->
                            <a class="btn-cu btn-m btn-color-estandar" 
                                href="{{ route('claveunica.autenticar') }}" 
                                title="Este es el botón Iniciar sesión de ClaveÚnica">
                                <span class="cl-claveunica"></span>
                                <span class="texto">Iniciar sesión</span>
                            </a>
                            <!--./ fin botón-->
                        </div>
                    </div>

                </div>
            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Tramite 2</h4>
                </div>



                <table class="table table-sm">
                    <tr>
                        <th>Establecimiento</th>
                        <th>En espera</th>
                        <th>En box</th>
                    </tr>
                    
                        <tr>
                            <td>Cesfam Aguirre</td>
                            <td>2</td>
                            <td>4</td>
                        </tr>

                </table>

            </div>

            <div class="card mb-4 shadow-sm">
                <div class="card-header">
                    <h4 class="my-0 font-weight-normal">Título</h4>
                </div>
                <div class="card-body">

                    <ul class="list-unstyled mt-3 mb-4">
                        <h2></h2>
                        <p></p>

                    </ul>
                    <div class="row">

                    </div>

                </div>
            </div>


        </div>


        <footer class="pt-4 my-md-5 pt-md-5 border-top">
            <div class="row">
                <div class="col-12 col-md">
                    <small class="d-block mb-3 text-muted">&copy; 2020</small>
                </div>
                <div class="col-6 col-md">
                    <h5>Portales del estado</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="http://www.gob.cl">Gobierno de Chile</a></li>
                        <li><a class="text-muted" href="http://www.minsal.cl">Ministerio de Salud</a></li>
                        <li><a class="text-muted" href="http://www.saludiquique.cl">Servicio de Salud Iquique</a> </li>
                        <li><a class="text-muted" href="http://oirs.minsal.cl/">Oficina de Informaciones</a></li>
                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Relacionados</h5>
                    <ul class="list-unstyled text-small">
                        <li><a class="text-muted" href="https://www.gob.cl/coronavirus/">Coronavirus</a></li>
                        <li><a class="text-muted" href="https://www.gob.cl/coronavirus/cifrasoficiales/">Cifras oficiales coronavirus</a> </li>
                        <li><a class="text-muted" href="https://www.gob.cl/plannacionaldecancer/">Plan nacional de cancer</a></li>

                    </ul>
                </div>
                <div class="col-6 col-md">
                    <h5>Acerca</h5>
                    <ul class="list-unstyled text-small">
                        <li>Desarrollado por la Unidad TIC.</li>
                        <li><a class="text-muted" href="mailto:sistemas.ssi@redsalud.gobc.">sistemas.ssi@redsalud.gob.cl</a></li>
                    </ul>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
