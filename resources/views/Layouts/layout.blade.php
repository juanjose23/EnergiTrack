<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title></title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Inter:wght@700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('Page/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('Page/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">


    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('Page/css/bootstrap.min.css') }}" rel="stylesheet">


    <!-- Template Stylesheet -->
    <link href="{{ asset('Page/css/style.css') }}" rel="stylesheet">

</head>

<body class="container-xxl bg-white p-0">

    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">cargando...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <div class="container-fluid nav-bar bg-transparent">
        <nav class="navbar navbar-expand-lg bg-white navbar-light py-0 px-4">
            <a href="" class="navbar-brand d-flex align-items-center text-center">
                <div class="icon p-2 me-2">
                    <img class="img-fluid" src="{{asset('page/img/Logo.png')}}" alt="Icon"  width="50" height="50">
                </div>
                <h1 class="m-0 text-primary">EnergiTrack</h1>
            </a>
            <button type="button" class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto">
                    <a href="{{ route('inicio') }}"
                        class="nav-item nav-link{{ Request::is('/') ? ' active' : '' }}">Inicio</a>
                    <a href="{{ route('acerca') }}"
                        class="nav-item nav-link{{ Request::is('acerca') ? ' active' : '' }}">Acerca</a>
                    <a href="{{ route('contacto') }}"
                        class="nav-item nav-link{{ Request::is('contacto') ? ' active' : '' }}">Contacto</a>
                </div>
                @guest
                    <a href="{{ route('login') }}" class="btn btn-primary px-3 d-none d-lg-flex">Adquiere tu plan</a>
                  
                @else
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><img src="{{ Session::get('Foto') }}" class="rounded-circle" alt="Foto de perfil" width="50"
                            height="50"></a>
                        
                        <div class="dropdown-menu rounded-0 m-0">
                            <li><a class="dropdown-item" href="{{ route('acerca') }}">Perfil</a></li>
                            <li><a class="dropdown-item" href="{{ route('acerca') }}">Mis Planes</a></li>
                            <li>
                                <form action="{{ route('logout') }}" method="post">
                                    @csrf
                                    <button class="dropdown-item" type="submit">Logout</button>
                                </form>
                            </li>
                        </div>
                    </div>

                @endguest

            </div>
        </nav>
    </div>
    <!-- Navbar End -->
    @yield('content')
    <!-- Footer Start -->
    <footer class="container-fluid bg-dark text-white-50 footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Contáctanos</h5>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Avenida Universitaria</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>(505) 2270-1509</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@dcom.uni.edu.ni</p>
                    <p class="mb-2">Apartado Postal: 5595</p>
                    <p class="mb-2">Managua, Nicaragua</p>
                    <p class="mb-2">Telefax (505) 2267-3709</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i class="fab fa-youtube"></i></a>
                        <a class="btn btn-outline-light btn-social" href=""><i
                                class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <h5 class="text-white mb-4">Enlaces rápidos</h5>
                    <a class="btn btn-link text-white-50" href="">Acerca de nosotros</a>
                    <a class="btn btn-link text-white-50" href="">Contáctanos</a>
                    <a class="btn btn-link text-white-50" href="">Nuestros servicios</a>
                    <a class="btn btn-link text-white-50" href="">Política de privacidad</a>
                    <a class="btn btn-link text-white-50" href="">Términos y condiciones</a>
                </div>


                <div class="col-lg-5 col-md-6">
                    <h5 class="text-white mb-4">Boletín informativo</h5>
                    <p>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control bg-transparent w-100 py-3 ps-4 pe-5" type="text"
                            placeholder="Tu correo electrónico">
                        <button type="button"
                            class="btn btn-primary btn-sm py-2 position-absolute top-0 end-0 mt-2 me-2">Suscribirse</button>
                    </div>
                </div>

            </div>
        </div>
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#"> EnergiTrack</a>, Todos los derechos reservados


                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="">Inicio</a>
                            <a href="">Cookies</a>
                            <a href="">Ayudas</a>
                            <a href="">Preguntas frecuentes</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('Page/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('Page/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('Page/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('Page/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('Page/js/main.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.min.css') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @if (Session::has('success'))
                Swal.fire({
                    icon: 'success',
                    title: '¡Éxito!',
                    text: '{{ Session::get('success') }}',
                    confirmButtonText: 'Aceptar'
                });
            @endif
            @if (Session::has('error'))
                Swal.fire({
                    icon: 'error',
                    title: '¡Error!',
                    text: '{{ Session::get('error') }}',
                    confirmButtonText: 'Aceptar'
                });
            @endif
        });
    </script>


</body>

</html>
