@extends('Layouts.layout')
@section('content')
    <div class="container-xxl py-5">
        <div class="container">
            <div class="text-center mx-auto mb-5 wow fadeInUp" data-wow-delay="0.1s" style="max-width: 600px;">
                <h1 class="mb-3">Nuestros planes</h1>
                <p> Con nuestros planes de suscripción, podrás mantener un control preciso de tu consumo eléctrico,
                    optimizar el uso de energía y reducir costos, todo con la comodidad de pagos recurrentes y un servicio
                    sin interrupciones. Únete a nosotros y toma el control de tu energía hoy mismo.</p>
            </div>
            <div class="row g-4">

                @foreach ($planes as $plan)
                    <div class="col-lg-4 col-md-6">
                        <div class="property-item rounded overflow-hidden">
                            <div class="position-relative overflow-hidden">
                                <a href=""><img class="img-fluid" src="{{ $plan->imagenes->url }}"
                                        alt=""></a>
                                <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                                    {{ $plan->categorias->nombre }}</div>
                                <div
                                    class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                                    Monitoreo Energético</div>
                            </div>
                            <div class="p-4 pb-0">
                                <h5 class="text-primary mb-3">C$ @if ($plan->precios->isNotEmpty())
                                        {{ $plan->precios->first()->precios }}
                                    @else
                                        No tiene precio vigente
                                    @endif
                                </h5>
                                <a class="d-block h5 mb-2" href="">{{ $plan->descripcion }}</a>

                            </div>

                            <div class="text-center py-3">
                                <a href="#" class="btn btn-primary">Obtener Ahora</a>
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#detallesModal-{{ $plan->id }}">Ver detalles</button>
                                <div class="modal fade" id="detallesModal-{{ $plan->id }}" tabindex="-1"
                                    aria-labelledby="detallesModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="detallesModalLabel">Detalles del Plan
                                                    {{ $plan->nombre }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @if ($plan->condiciones->isNotEmpty())
                                                <h3>Condiciones del Plan {{ $plan->nombre }}</h3>
                                                <ul class="list-unstyled">
                                                    @foreach ($plan->condiciones as $condicion)
                                                    <li class="d-flex align-items-center mb-2">
                                                        <i class="bx bx-info-circle mr-2"></i> {{ $condicion->descripcion }}
                                                    </li>
                                                    @endforeach
                                                </ul>
                                            @else
                                                <p>Este plan no tiene condiciones asociadas.</p>
                                            @endif
                                            

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cerrar</button>
                                                <button type="button" class="btn btn-primary">Obtener</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
