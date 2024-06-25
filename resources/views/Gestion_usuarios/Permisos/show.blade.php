@extends('Layouts.app')
@section('title', 'Permisos')
@section('content')
<div class="col-xl">
    <div class="card mb-4">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Asignar permisos</h5>
            <small class="text-muted float-end">Campos requeridos *</small>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table id="tablaModulos" class="table mb-0">
                    <thead>
                        <tr>
                            <th scope="col" class="px-4 py-3">
                                <span class="sr-only">#</span>
                            </th>
                            <th scope="col" class="px-4 py-3">Permiso</th>
        
                            <th scope="col" class="px-4 py-3">Fecha de registro</th>
                            <th scope="col" class="px-4 py-3">Fecha de última actualizacion</th>
                            <th scope="col" class="px-4 py-3">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permisos as $modulo)
                            <tr class="bg-light">
                                <td colspan="5" class="text-center">
                                    <h5 class="mb-0">Accesos del módulo "{{ $modulo['nombre'] }}" con los permisos:</h5>
                                </td>
                            </tr>
                            @foreach ($modulo['permisos'] as $submodulo)
                                <tr>
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td class="px-4 py-3">{{ $submodulo['nombre'] }}</td>
                                    <td class="px-4 py-3">{{ $submodulo['fecha_registro'] }}</td>
                                    <!-- Debes proporcionar la variable $fechaRegistro -->
                                    <td class="px-4 py-3">{{ $submodulo['fecha_actualizacion'] }}</td>
                                    <!-- Debes proporcionar la variable $fechaActualizacion -->
                                    <td>
        
                                        <div class="d-flex mb-1 align-items-center">
                                            <div class="m-1">
                                                <!-- Botón para activar/desactivar -->
                                                <button type="button" class="btn btn-danger d-block" role="button"
                                                    onclick="confirmAction({{ $submodulo['id_permiso_modulo'] }})">
                                                    <i class="bx bx-trash"></i>
        
                                                </button>
                                            </div>
                                        </div>
        
                                        <form id="deleteForm{{ $submodulo['id_permiso_modulo'] }}"
                                            action="{{ route('permisos.destroy', ['permisos' => $submodulo['id_permiso_modulo']]) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
        
                                            <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                            <button id="submitBtn{{ $submodulo['id_permiso_modulo'] }}" type="submit"
                                                style="display: none;"></button>
                                        </form>
        
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
            </div>
           
        </div>
    </div>
</div>
@endsection