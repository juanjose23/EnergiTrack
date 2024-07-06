@extends('Layouts.app')
@section('title', 'Precios')
@section('content')

    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Registrar Plan</h5>
                <small class="text-muted float-end">Campos requeridos *</small>
            </div>
            <div class="card-body">
                <form action="{{ route('precios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="planes" class="form-label text-dark">Planes: *</label>
                                <select id="planes" name="planes"
                                    class="form-select buscador @error('planes') is-invalid @enderror"
                                    style="width: 100%">
                                    <option selected disabled>Seleccionar Plan</option>
                                    @foreach ($productos as $categorias => $sub)
                                        <optgroup label="{{ $categorias }}">
                                            @foreach ($sub as $subs)
                                                <option value="{{ $subs['id'] }}"
                                                    {{ old('planes') == $subs['id'] ? 'selected' : '' }}>
                                                    {{ $subs['nombre'] }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                                @error('planes')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>



                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precios" class="form-label text-dark">Precios *</label>
                               <input type="text" name="precios" class="form-control @error('precios') is-invalid @enderror" id="precio" value="{{old('precios')}}">
                                @error('precios')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                <a href="{{ route('precios.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
