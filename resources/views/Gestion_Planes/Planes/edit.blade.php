@extends('Layouts.app')
@section('title', 'Planes')


@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Editar Plan</h5>
                <small class="text-muted float-end">Campos requeridos *</small>
            </div>
            <div class="card-body">
                <form action="{{ route('plan.update', ['plan' => $plan->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="form-label text-dark">Nombre *</label>
                                <input type="text" id="nombre" name="nombre" placeholder="Escribe el nombre del plan"
                                    class="form-control @error('nombre') is-invalid @enderror" value="{{ old('nombre',$plan->nombre) }}">
                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="categorias" class="form-label text-dark">Categorias *</label>
                                <select style="width: 100%" id="categorias" name="categorias"
                                    class="buscador form-select @error('categorias') is-invalid @enderror">
                                    <option>Seleccionar categorias</option>
                                    @foreach ($categorias as $categoria)
                                        <option value="{{ $categoria->id }}"
                                            {{ old('categorias',$plan->categorias_id) == $categoria->id ? 'selected' : '' }}>
                                            {{ $categoria->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('categorias')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dispositivos" class="form-label text-dark">Limite de dispositivos *</label>
                                <input type="number" id="dispositivos" name="dispositivos" placeholder="Escribe el limite de dispositivos"
                                    class="form-control @error('dispositivos') is-invalid @enderror" value="{{ old('dispositivos',$plan->dispositivos) }}">
                                @error('dispositivos')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombre" class="form-label text-dark">Imagen *</label>
                                <input type="file" id="imagen" name="imagen" placeholder="Escribe el nombre de la categoria"
                                    class="form-control @error('imagen') is-invalid @enderror" value="{{ old('imagen') }}">
                                @error('imagen')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado" class="form-label text-dark">Estado *</label>
                                <select id="estado" name="estado"
                                    class="form-select @error('estado') is-invalid @enderror">
                                    <option selected disabled>Elegir estado</option>
                                    <option value="1" {{ old('estado',$plan->estado) == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('estado',$plan->estado) == '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="descripcion" class="form-label text-dark">Descripción</label>
                                <textarea id="descripcion" name="descripcion" rows="3"
                                    class="form-control @error('descripcion') is-invalid @enderror">{{ old('descripcion',$plan->descripcion) }}</textarea>
                                @error('descripcion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                <a href="{{ route('plan.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
