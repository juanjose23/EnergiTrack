@extends('Layouts.app')
@section('title', 'Roles')

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Crear Usuarios</h5>
                <small class="text-muted float-end">Campos requeridos *</small>
            </div>
            <div class="card-body">
                <form action="{{ route('usuarios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="nombre" class="form-label text-dark">Nombre  *</label>
                                <input style="width: 100%" id="nombre" name="nombre"
                                    class=" form-control @error('nombre') is-invalid @enderror" value="{{old('nombre')}}">


                                @error('nombre')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="apellido" class="form-label text-dark">Apellido  *</label>
                                <input style="width: 100%" id="apellido" name="apellido"
                                    class=" form-control @error('apellido') is-invalid @enderror"  value="{{old('apellido')}}">


                                @error('apellido')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo" class="form-label text-dark">Tipo de identificación:</label>
                                <select id="tipo" name="tipo" class="form-select buscador @error('tipo') is-invalid @enderror">
                                    <option selected disabled>Elegir identificación</option>
                                    <option value="Cedula" {{ old('tipo') == 'Cedula' ? 'selected' : '' }}>Cédula</option>
                                    <option value="Cédula de Residencia Temporal"
                                        {{ old('tipo') == 'Cédula de Residencia Temporal' ? 'selected' : '' }}>Cédula de Residencia
                                        Temporal</option>
                                    <option value="Cédula de Residencia" {{ old('tipo') == 'Pasaporte' ? 'selected' : '' }}>Cédula de
                                        Residencia</option>
                                </select>
                                @error('tipo')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="identificacion" class="form-label text-dark">Número de identificación:</label>
                                <input type="identificacion" id="identificacion" name="identificacion"
                                    placeholder="Escribe el número de identificación"
                                    class="form-control @error('identificacion') is-invalid @enderror"
                                    value="{{ old('identificacion') }}">
                                @error('identificacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="telefono" class="form-label text-dark">Télefono:</label>
                                <input type="number" id="telefono" name="telefono" placeholder="Escribe el número telefonico"
                                    class="form-control @error('telefono') is-invalid @enderror" value="{{ old('telefono') }}">
                                @error('telefono')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="roles" class="form-label text-dark">Roles*</label>
                                <select style="width: 100%" id="roles" name="roles"
                                    class="buscador form-select @error('roles') is-invalid @enderror">
                                    <option>Seleccionar roles</option>
                                    @foreach ($roles as $rol)
                                        <option value="{{ $rol->id }}"
                                            {{ old('roles') == $rol->id ? 'selected' : '' }}>
                                            {{ $rol->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('roles')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="foto" class="form-label text-dark">Foto:</label>
                                <input type="file" id="foto" name="foto" 
                                    class="form-control @error('foto') is-invalid @enderror" value="{{ old('foto') }}">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="estado" class="form-label text-dark">Estado</label>
                                <select id="estado" name="estado"
                                    class="form-select buscador  @error('estado') is-invalid @enderror">
                                    <option selected disabled>Elegir estado</option>
                                    <option value="2" {{ old('estado') == '1' ? 'selected' : '' }}>Verificar</option>
                                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-danger mb-2 me-md-2">Cancelar</a>
                                <button type="submit" class="btn btn-primary mb-2">Registrar</button>
                            </div>

                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection
