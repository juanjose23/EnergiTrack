@extends('Layouts.layout')
@section('content')
<header class="container-fluid header bg-white p-0">
    <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
        <div class="col-md-6 p-5 mt-lg-5">
            <h1 class="display-5 animated fadeIn mb-4">Acerca de Nosotros</h1> 
                <nav aria-label="breadcrumb animated fadeIn">
                <ol class="breadcrumb text-uppercase">
                    <li class="breadcrumb-item"><a href="{{route('inicio')}}">Inicio</a></li>
                    <li class="breadcrumb-item"><a href="#">Pagina</a></li>
                    <li class="breadcrumb-item text-body active" aria-current="page">Nosotros</li>
                </ol>
            </nav>
        </div>
        <div class="col-md-6 animated fadeIn">
            <img class="img-fluid" src="Page/img/header.jpg" alt="">
        </div>
    </div>
</header>
<div class="container-xxl py-5">
    <div class="container">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.1s">
                <div class="about-img position-relative overflow-hidden p-5 pe-0">
                    <img class="img-fluid w-100" src="Page/img/about.jpg">
                </div>
            </div>
            <div class="col-lg-6 wow fadeIn" data-wow-delay="0.5s">
                <h1 class="mb-4">#1 Lugar Para Monitorear tu Consumo Energético</h1>
                <p class="mb-4">La idea de EnergiTrack nació de la necesidad de proporcionar a los usuarios una herramienta intuitiva y poderosa para monitorear su consumo energético en tiempo real. Nos dimos cuenta de que muchas personas querían tomar decisiones informadas sobre el uso eficiente de la energía en sus hogares, pero no tenían acceso a datos precisos y fáciles de entender. Por lo tanto, creamos EnergiTrack para ofrecer una solución a este problema.</p>
                <p><i class="fa fa-check text-primary me-3"></i>Monitorea tu consumo de energía en tiempo real.</p>
                <p><i class="fa fa-check text-primary me-3"></i>Recibe alertas sobre patrones de consumo inusuales.</p>
                <p><i class="fa fa-check text-primary me-3"></i>Accede a soporte técnico dedicado para resolver cualquier problema.</p>
               
            </div>
            
        </div>
    </div>
</div>
@endsection
