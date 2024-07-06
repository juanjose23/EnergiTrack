<div>
    <div>
        <div class="row">

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión Planes /</span> Categorias</h4>

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
                                @can('create', App\Models\Categorias::class)
                                    <div class="btn-group me-2 mb-2 mb-md-0">
                                        <a href="{{ route('categorias.create') }}" class="btn btn-primary">
                                            <i class='bx bx-plus'></i> Registrar categoria
                                        </a>
                                    </div>
                                @endcan



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
                                Lista de categorias
                            </caption>
                            <thead>
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">#</span>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('nombre')">
                                            Nombre
                                            @if($ordenarPor === 'nombre')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i class='bx bx-sort-alt-2 @if($direccion === "asc")  @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a  wire:click="ordenar('descripcion')">
                                            Descripción
                                            @if($ordenarPor === 'descripcion')
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
                                @foreach ($categorias as $categoria)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>


                                        <td>{{ $categoria->nombre }}</td>

                                        <td class="text-wrap">{{ wordwrap($categoria->descripcion, 50, "\n", true) }}</td>
                                        <td><span
                                                class="badge  {{ $categoria->estado == 1 ? 'bg-label-primary ' : 'bg-label-danger' }}">
                                                {{ $categoria->estado == 1 ? 'Activo' : 'Inactivo' }}
                                            </span>
                                        </td>
                                        <td>

                                            <div class="d-inline-block text-nowrap">
                                                @can('update', App\Models\Categorias::class)
                                                    <a href="{{ route('categorias.edit', ['categorias' => $categoria->id]) }}"
                                                        class="btn btn-sm btn-icon" role="button">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                @endcan
                                                @can('delete', App\Models\Categorias::class)
                                                    <button type="button" class="btn btn-sm btn-icon delete-record"
                                                        role="button" onclick="confirmAction({{ $categoria->id }})">
                                                        <i
                                                            class="bx bx-{{ $categoria->estado == 1 ? 'trash' : 'toggle-right' }}"></i>
                                                    </button>
                                                @endcan
                                            </div>

                                            <form id="deleteForm{{ $categoria->id }}"
                                                action="{{ route('categorias.destroy', ['categorias' => $categoria->id]) }}"
                                                method="POST">
                                                @csrf
                                                @method('DELETE')

                                                <!-- Este botón no es visible, pero se utilizará para activar el SweetAlert -->
                                                <button id="submitBtn{{ $categoria->id }}" type="submit"
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
                                <li class="page-item {{ $categorias->onFirstPage() ? 'disabled' : '' }}">
                                    <button type="button" class="page-link" wire:click="previousPage"
                                        {{ $categorias->onFirstPage() ? 'disabled' : '' }}>
                                        Previo
                                    </button>
                                </li>

                                <!-- Botones para cada página -->
                                @foreach ($categorias->links()->elements as $element)
                                    @if (is_string($element))
                                        <li class="page-item disabled"><span
                                                class="page-link">{{ $element }}</span></li>
                                    @endif

                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            <li class="page-item {{ $page == $categorias->currentPage() ? 'active' : '' }}">
                                                <button type="button" class="page-link"
                                                    wire:click="gotoPage({{ $page }})">
                                                    {{ $page }}
                                                </button>
                                            </li>
                                        @endforeach
                                    @endif
                                @endforeach

                                <!-- Botón para la página siguiente -->
                                <li class="page-item {{ $categorias->hasMorePages() ? '' : 'disabled' }}">
                                    <button type="button" class="page-link" wire:click="nextPage"
                                        {{ $categorias->hasMorePages() ? '' : 'disabled' }}>
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
