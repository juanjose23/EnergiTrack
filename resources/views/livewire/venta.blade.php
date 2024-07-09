<div>
    <div>
        <div class="row">

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión Ventas /</span> Ventas</h4>

                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center flex-wrap">
                            <!-- Campo de búsqueda -->
                            <div class="input-group mb-3" style="max-width: 300px;">
                                <input type="text" wire:model.live.debounce.300ms="buscar"
                                    class="form-control form-control rounded-start" placeholder="Buscar...">
                            </div>

                            <!-- Botones -->
                            <div class="d-flex justify-content-end flex-wrap mt-3 mt-md-0">
                                <!-- Botón para crear una categoría -->
                            
                                    <div class="btn-group me-2 mb-2 mb-md-0">
                                        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                                            <i class='bx bx-plus'></i> Exportar a excel
                                        </a>
                                    </div>
                             



                                <!-- Selector de cantidad de registros -->
                                <div>
                                    <select name="buscador" id="buscador" wire:model.live="perPage"
                                        class="form-select mt-2 mt-md-0">
                                        <option value="">Mostrar en:</option>
                                        <option value="10">10</option>
                                        <option value="20">20</option>
                                        <option value="50">50</option>
                                        <option value="0">Todos</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive text-nowrap">
                        <table class="table">
                            <caption class="ms-4">
                                Lista de ventas
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">#</span>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('personas')">
                                            Nombre
                                            @if($ordenarPor === 'personas')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc")  @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('apellido')">
                                            Apellidos
                                            @if($ordenarPor === 'apellido')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc")  @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('email')">
                                            usuario
                                            @if($ordenarPor === 'email')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc")  @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a wire:click="ordenar('categoria')">
                                             Categoría
                                            @if ($ordenarPor === 'categoria')
                                                <i
                                                    class='bx bx-sort-alt-2 @if ($direccion === 'asc')  @endif'></i>
                                            @else
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('nombre')">
                                            Plan
                                            @if($ordenarPor === 'nombre')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc") bx-rotate-180 @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('precio')">
                                            Precio
                                            @if($ordenarPor === 'precio')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc") bx-rotate-180 @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('iva')">
                                            Iva
                                            @if($ordenarPor === 'iva')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc") bx-rotate-180 @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('total')">
                                            Total
                                            @if($ordenarPor === 'total')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc") bx-rotate-180 @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('estado')">
                                            Estado
                                            @if($ordenarPor === 'estado')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc") bx-rotate-180 @endif'></i>
                                            @else
                                            <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    
                                    
                                    <th scope="col" class="px-4 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($ventas as $venta)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>


                                        <td>{{ $venta->personas }}</td>
                                        <td>{{ $venta->apellido }}</td>
                                        <td>{{ $venta->email }}</td>
                                        <td>{{ $venta->categoria }}</td>
                                        <td>{{ $venta->nombre }}</td>
                                        <td>{{ $venta->precio }}</td>
                                        <td>{{ $venta->iva }}</td>
                                        <td>{{ $venta->total }}</td>
                                        <td><span
                                                class="badge  {{ $venta->estado == 1 ? 'bg-label-primary ' : 'bg-label-danger' }}">
                                                {{ $venta->estado == 1 ? 'Completada' : 'Anulada' }}
                                            </span>
                                        </td>
                                        <td>

                                            <div class="d-inline-block text-nowrap">
                                                
                                                @can('delete', App\Models\Categorias::class)
                                                    <button type="button" class="btn btn-sm btn-icon delete-record"
                                                        role="button" onclick="confirmAction({{ $venta->id }})">
                                                        <i
                                                            class="bx bx-{{ $venta->estado == 1 ? 'trash' : 'toggle-right' }}"></i>
                                                    </button>
                                                @endcan
                                            </div>

                                            <form id="deleteForm{{ $venta->id }}"
                                                action="{{ route('ventas.destroy', ['ventas' => $venta->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                                <button id="submitBtn{{ $venta->id }}" type="submit"
                                                    style="display: none;"></button>
                                            </form>

                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <!-- Botón para la página anterior -->
                                <li class="page-item {{ $ventas->onFirstPage() ? 'disabled' : '' }}">
                                    <button type="button" class="page-link" wire:click="previousPage"
                                        {{ $ventas->onFirstPage() ? 'disabled' : '' }}>
                                        Previo
                                    </button>
                                </li>

                                <!-- Botones para cada página -->
                                @foreach ($ventas->links()->elements as $element)
                                    @if (is_string($element))
                                        <li class="page-item disabled"><span
                                                class="page-link">{{ $element }}</span></li>
                                    @endif

                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            <li class="page-item {{ $page == $ventas->currentPage() ? 'active' : '' }}">
                                                <button type="button" class="page-link"
                                                    wire:click="gotoPage({{ $page }})">
                                                    {{ $page }}
                                                </button>
                                            </li>
                                        @endforeach
                                    @endif
                                @endforeach

                                <!-- Botón para la página siguiente -->
                                <li class="page-item {{ $ventas->hasMorePages() ? '' : 'disabled' }}">
                                    <button type="button" class="page-link" wire:click="nextPage"
                                        {{ $ventas->hasMorePages() ? '' : 'disabled' }}>
                                        Siguiente
                                    </button>
                                </li>
                            </ul>
                        </nav>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function confirmAction(roleId) {
        Swal.fire({
            title: '¿Estás seguro?',
            text: '¿Quieres cambiar el estado?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, cambiar estado'
        }).then((result) => {
            if (result.isConfirmed) {
                var form = document.getElementById('deleteForm' + roleId);

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
