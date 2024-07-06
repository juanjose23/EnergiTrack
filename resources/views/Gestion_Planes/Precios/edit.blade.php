@extends('Layouts.app')
@section('title', 'Precios')

@section('content')
    <div class="col-xl">
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Historial de precios</h5>
                <small class="text-muted float-end">Campos requeridos *</small>
            </div>
            <div class="card-body">

                <form action="{{ route('precios.update', $precio->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="usuario" class="form-label text-dark">Plan:</label>
                                <input type="text" id="usuario" name="usuario" placeholder="Escriba el usuario"
                                    class="form-control @error('usuario') is-invalid @enderror"
                                    value="{{ $precio->planes->nombre }}" disabled>
                                @error('usuario')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    
<input type="text" name="planes" value="{{$precio->planes_id}}" hidden>


                       

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="precios" class="form-label text-dark">Precio:</label>
                                <input type="number" id="precios" name="precios" placeholder="Escriba la cantidad"
                                    class="form-control @error('precios') is-invalid @enderror" value="{{old('precios')}}">
                                @error('precios')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                      
                        <div class="col-md-12">
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-2">
                                <a href="{{ route('precios.index') }}" class="btn btn-danger mb-2 me-md-2">Volver al
                                    inicio</a>
                                <button type="submit" class="btn btn-primary mb-2">Registrar nueva precio</button>
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
                        <h5 class="card-title mb-0 text-black">Historico de precios</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table mb-0">
                                <thead>
                                    <tr>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">#</span>
                                        </th>

                                        <th scope="col" class="px-4 py-3">Precio</th>
                                        <th scope="col" class="px-4 py-3">Fecha de registro</th>
                                        <th scope="col" class="px-4 py-3">Fecha de Actualizacion</th>
                                        <th scope="col" class="px-4 py-3">Estado</th>
                                        <th scope="col" class="px-4 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($historial as $precios)
                                        <tr>
                                            <td>{{ $loop->index + 1 }}</td>

                                          
                                            <td>{{ $precios->precios }}</td>
                                            <td>{{ $precios->created_at }}</td>
                                            <td>{{ $precios->updated_at }}</td>
                                            <td><span
                                                    class="badge rounded-pill {{ $precios->estado == 1 ? 'bg-success' : 'bg-danger' }}">
                                                    {{ $precios->estado == 1 ? 'Activo' : 'Inactivo' }}
                                                </span></td>
                                            <td>
                                                <div class="mr-1">

                                                    <!-- Botón para activar/desactivar -->
                                                    @if ($precios->estado == 1)
                                                        <button type="button"
                                                            class="btn btn-{{ $precios->estado == 1 ? 'danger' : 'success' }}"
                                                            role="button" onclick="confirmAction({{ $precios->id }})">
                                                            <i
                                                                class="bx bx-{{ $precios->estado == 1 ? 'trash' : 'power' }}"></i>
                                                        </button>
                                                    @endif


                                                </div>
                                                <form id="deleteForm{{ $precios->id }}"
                                                    action="{{ route('precios.destroy', ['precios' => $precios->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')

                                                    <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                                    <button id="submitBtn{{ $precios->id }}" type="submit"
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
    function confirmAction(PrecioId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado ?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + PrecioId);

                // Agregar un campo oculto al formulario para indicar la acción
                var actionInput = document.createElement('input');
                actionInput.type = 'hidden';
                actionInput.name = '_method';
                actionInput.value = 'DELETE';
                form.appendChild(actionInput);

                // Enviar el formulario
                form.submit();
            }
        });
    }
</script>
