<div>
    <div class="row g-4">
        @foreach ($planes as $plan)
            <div class="col-lg-4 col-md-6">
                <div class="property-item rounded overflow-hidden">
                    <div class="position-relative overflow-hidden">
                        <a href=""><img class="img-fluid" src="{{$plan->imagenes->url}}" alt=""></a>
                        <div class="bg-primary rounded text-white position-absolute start-0 top-0 m-4 py-1 px-3">
                            {{$plan->categorias->nombre}}</div>
                        <div class="bg-white rounded-top text-primary position-absolute start-0 bottom-0 mx-4 pt-1 px-3">
                            Monitoreo Energético</div>
                    </div>
                    <div class="p-4 pb-0">
                        <h5 class="text-primary mb-3">C$ @if ($plan->precios->isNotEmpty())
                            {{ $plan->precios->first()->precios }}
                        @else
                            No tiene precio vigente
                        @endif</h5>
                        <a class="d-block h5 mb-2" href="">{{$plan->descripcion}}</a>
                       
                    </div>
                    
                    <div class="text-center py-3">
                        <a href="{{route('subcripciones')}}" class="btn btn-primary">Obtener Ahora</a>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
