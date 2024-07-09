@extends('Layouts.layout')
<style>
    @media (min-width: 1025px) {
        .h-custom {
            height: 100vh !important;
        }
    }
</style>
@php
    $subtotal = $plan->precios->isNotEmpty() ? $plan->precios->first()->precios : 0;
    $instalacion = 20.0; // Precio de instalación
    $iva = $subtotal * 0.15;
    $total = $subtotal + $instalacion + $iva;
@endphp
@section('content')
    <br>
    <header class="container-fluid header bg-white p-0">
        <div class="row g-0 align-items-center flex-column-reverse flex-md-row">
            <div class="col-md-6 p-5 mt-lg-5">
                <h1 class="display-5 animated fadeIn mb-4">Resumen de Compra</h1>
                <nav aria-label="breadcrumb animated fadeIn">
                    <ol class="breadcrumb text-uppercase">
                        <li class="breadcrumb-item"><a href="{{ route('inicio') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="#">Pagina</a></li>
                        <li class="breadcrumb-item text-body active" aria-current="page">Compra</li>
                    </ol>
                </nav>
            </div>
            <div class="col-md-6 animated fadeIn">
                <img class="img-fluid" src="Page/img/header.jpg" alt="">
            </div>
        </div>
    </header>

    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">

                            <div class="row">

                                <div class="col-lg-7">
                                    <h5 class="mb-3"><a href="{{ route('subcripciones') }}" class="text-body"><i
                                                class="fas fa-long-arrow-alt-left me-2"></i>Proceso de compra</a></h5>
                                    <hr>

                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        <div>
                                            <p class="mb-1">Compra</p>
                                            <p class="mb-0">Categoría: {{ $plan->categorias->nombre }}</p>
                                        </div>

                                    </div>

                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="{{ $plan->imagenes->url }}" class="img-fluid rounded-3"
                                                            alt="Shopping item" style="width: 65px;">
                                                    </div>
                                                    <div class="ms-3">
                                                        <h5>{{ $plan->nombre }}</h5>
                                                        <p class="small mb-0">256GB, Navy Blue</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex flex-row align-items-center">
                                                    <div style="width: 50px;">
                                                        <h5 class="fw-normal mb-0">2</h5>
                                                    </div>
                                                    <div style="width: 80px;">
                                                        <h5 class="mb-0">$900</h5>
                                                    </div>
                                                    <a href="#!" style="color: #cecece;"><i
                                                            class="fas fa-trash-alt"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                                <div class="col-lg-5">

                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">Metodos de pago</h5>
                                                <img src="{{ Session::get('Foto') }}" class="img-fluid rounded-3"
                                                    style="width: 45px;" alt="Avatar">
                                            </div>

                                            <p class="small mb-2">Metodos</p>
                                            <a href="#!" type="submit" class="text-white">
                                                <i class="bx bxl-stripe fa-2x me-2"></i> Stripe
                                            </a>


                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Subtotal</p>
                                                <p class="mb-2">
                                                    @if ($plan->precios->isNotEmpty())
                                                        {{ $plan->precios->first()->precios }}
                                                    @else
                                                        No tiene precio vigente
                                                    @endif
                                                </p>
                                            </div>

                                            <div class="d-flex justify-content-between">
                                                <p class="mb-2">Instalacion</p>
                                                <p class="mb-2">C$ {{ number_format($instalacion, 2) }}</p>
                                            </div>

                                            <div class="d-flex justify-content-between mb-4">
                                                <p class="mb-2">Total(Incl. IVA)</p>



                                                <p class="mb-2">C$ {{ number_format($total, 2) }}</p>


                                            </div>
                                            <form action="{{ route('stripe') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="id" value="{{$plan->id}}">
                                                <input type="hidden" name="product_name" value="{{$plan->nombre}}">
                                                <input type="hidden" name="quantity" value="1">
                                                <input type="hidden" name="price" value="{{ number_format($subtotal, 2) }}">
                                                <input type="hidden" name="instalacion" value="{{ number_format($instalacion, 2) }}">
                                                <input type="hidden" name="iva" value="{{ number_format($iva, 2) }}">
                                                <input type="hidden" name="total" value="{{ number_format($total, 2) }}">
                                                <button type="submit" data-mdb-button-init data-mdb-ripple-init
                                                    class="btn btn-secondary btn-block btn-lg">
                                                    <div class="d-flex justify-content-between">

                                                        <span>pagar <i class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                    </div>
                                                </button>

                                            </form>

                                        </div>
                                    </div>

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
