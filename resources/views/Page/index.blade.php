@extends('Layouts.layout')
@section('content')
    <!-- Header Start -->
    <section class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">EnergiTrack: Monitoreo Energético en Tiempo Real</h1>
                <p class="animated fadeIn mb-4 pb-2">Este sistema de monitoreo energético en tiempo real permite recopilar y
                    analizar datos precisos sobre el consumo y la generación de energía en su hogar. Además, este sitio le
                    permitirá acceder a los datos recopilados, visualizarlos de manera intuitiva y tomar decisiones
                    informadas sobre el uso eficiente de la energía.</p>
                <a href="#" class="btn btn-primary py-3 px-5 me-3 animated fadeIn">Comenzar</a>
            </div>
            <div class="col-md-6 animated fadeIn">
                <div class="owl-carousel header-carousel">
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="Page/img/carousel-1.jpg" alt="">
                    </div>
                    <div class="owl-carousel-item">
                        <img class="img-fluid" src="Page/img/carousel-2.jpg" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="container-xxl py-5">
        <div class="container-xxl py-5">
            <div class="container">
                <div class="row g-0 gx-5 align-items-end">
                    <div class="col-lg-6">
                        <div class="text-start mx-auto mb-5 wow slideInLeft" data-wow-delay="0.1s">
                            <h1 class="mb-3">Nuestros planes</h1>
                            <p>Eirmod sed ipsum dolor sit rebum labore magna erat. Tempor ut dolore lorem kasd vero ipsum
                                sit eirmod sit diam justo sed rebum.</p>
                        </div>
                    </div>
                </div>
                <livewire:tarjetas-precios />
            </div>
        </div>
    </section>
@endsection
