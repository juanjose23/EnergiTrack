@extends('Layouts.app')
@section('title', 'Roles')

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Actualizar Usuarios</h5>
                <small class="text-muted float-end">Campos requeridos *</small>
            </div>
            <div class="card-body">

                <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="empleado" class="form-label text-dark">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" value="{{ $usuario->personas->nombre }} ">
                                <input type="text" name="empleados" value="{{ $usuario->id }}" hidden>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="empleado" class="form-label text-dark">Apellido:</label>
                                <input type="text" class="form-control" name="apellido" value="{{ $usuario->personas->apellido }} ">
                                <input type="text" name="empleados" value="{{ $usuario->id }}" hidden>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tipo" class="form-label text-dark">Tipo de identificación:</label>
                                <select id="tipo" name="tipo"
                                    class="form-select @error('tipo') is-invalid @enderror">
                                    <option selected disabled>Elegir identificación</option>
                                    <option value="Cedula"
                                        {{ old('tipo', $usuario->personas->tipo_identificacion) == 'Cedula' ? 'selected' : '' }}>
                                        Cédula</option>
                                    <option value="Cédula de Residencia Temporal"
                                        {{ old('tipo', $usuario->personas->tipo_identificacion) == 'Cédula de Residencia Temporal' ? 'selected' : '' }}>
                                        Cédula de Residencia
                                        Temporal</option>
                                    <option value="Cédula de Residencia"
                                        {{ old('tipo', $usuario->personas->tipo_identificacion) == 'Pasaporte' ? 'selected' : '' }}>
                                        Pasaporte</option>
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
                                    value="{{ old('identificacion', $usuario->personas->identificacion) }}">
                                @error('identificacion')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>


                        <div class="col-md-4">
                            <div class="form-group">

                                <label for="usuario" class="form-label text-dark">Correo Asignado:</label>
                                <input type="text" id="usuario" name="usuario" placeholder="Escriba el usuario"
                                    class="form-control @error('usuario') is-invalid @enderror"
                                    value="{{ $usuario->email }}" disabled>
                                @error('usuario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group mt-4">
                                <input class="form-check-input" name="actualizar" type="checkbox" value=""
                                    id="defaultCheck1" onchange="toggleButtonText()">
                                <label class="form-check-label" for="defaultCheck1"> Actualizar informacion del usuario
                                </label>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="roles" class="form-label text-dark">Agregar nuevo rol:</label>
                                <select style="width: 100%" id="roles" name="roles"
                                    class="buscador form-select @error('roles') is-invalid @enderror">
                                    <option value="">Seleccionar roles</option>
                                    @foreach ($rolesdisponibles as $rol)
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
                                <label for="estado" class="form-label text-dark">Estado</label>
                                <select id="estado" name="estado"
                                    class="form-select   @error('estado') is-invalid @enderror">
                                    <option selected disabled>Elegir estado</option>
                                    <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Activo</option>
                                    <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Inactivo</option>
                                </select>
                                @error('estado')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                <a href="{{ route('usuarios.index') }}" class="btn btn-danger mb-2 me-md-2">Volver al
                                    inicio</a>
                                <button id="submitButton" type="submit" class="btn btn-primary mb-2">Registrar nuevo rol</button>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container-fluid p-0">
        <h3 class="h3 mb-3"></h3>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0 text-black">Lista de Roles asignados</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">#</span>
                                        </th>

                                        <th scope="col" class="px-4 py-3">Rol</th>
                                        <th scope="col" class="px-4 py-3">Fecha de registro</th>
                                        <th scope="col" class="px-4 py-3">Fecha de Actualizacion</th>
                                        <th scope="col" class="px-4 py-3">Estado</th>
                                        <th scope="col" class="px-4 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($rolesusuarios as $roles)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                            <td>{{ $roles->rolesmodel->nombre }}</td>
                                            <td>{{ $roles->created_at }}</td>
                                            <td>{{ $roles->updated_at }}</td>
                                            <td><span
                                                    class="badge rounded-pill {{ $roles->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $roles->estado == 1 ? 'Activo' : 'Inactivo' }}
                                                </span></td>
                                            <td>
                                                <div class="mr-1">

                                                    <!-- Botón para activar/desactivar -->
                                                    <button type="button"
                                                        class="btn btn-{{ $roles->estado == 1 ? 'danger' : 'success' }}"
                                                        role="button" onclick="confirmAction({{ $roles->id }})">
                                                        <i
                                                            class="bx bx-{{ $roles->estado == 1 ? 'trash' : 'power' }}"></i>
                                                    </button>


                                                </div>
                                                <form id="deleteForm{{ $roles->id }}"
                                                    action="{{ route('usuarios.destroyroles', ['id' => $roles->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                                    <button id="submitBtn{{ $roles->id }}" type="submit"
                                                        style="display: none;"></button>
                                                </form>

                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function toggleButtonText() {
        var checkbox = document.getElementById('defaultCheck1');
        var submitButton = document.getElementById('submitButton');

        if (checkbox.checked) {
            submitButton.textContent = 'Actualizar información del usuario';
        } else {
            submitButton.textContent = 'Registrar nuevo rol';
        }
    }
</script>
