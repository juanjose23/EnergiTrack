<div>
    <div>
        <div class="row">

            <div class="container-xxl flex-grow-1 container-p-y">
                <h4 class="py-3 mb-4"><span class="text-muted fw-light">Gestión Planes /</span> Precios</h4>

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
                                        <a href="{{ route('precios.create') }}" class="btn btn-primary">
                                            <i class='bx bx-plus'></i> Registrar precio
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


                            <thead>
                                <tr>
                                    <th scope="col" class="px-4 py-3">
                                        <span class="sr-only">#</span>
                                    </th>

                                    <th scope="col" class="px-4 py-3">
                                        <a wire:click="ordenar('nombre')">
                                            Nombre
                                            @if ($ordenarPor === 'nombre')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i
                                                    class='bx bx-sort-alt-2 @if ($direccion === 'asc')  @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a wire:click="ordenar('descripcion')">
                                            Descripcion
                                            @if ($ordenarPor === 'descripcion')
                                                <!-- Icono de boxeo para indicar orden ascendente o descendente -->
                                                <i
                                                    class='bx bx-sort-alt-2 @if ($direccion === 'asc')  @endif'></i>
                                            @else
                                                <!-- Icono de boxeo predeterminado -->
                                                <i class='bx bx-sort-alt-2'></i>
                                            @endif
                                        </a>
                                    </th>
                                    <th scope="col" class="px-4 py-3">
                                        <a >
                                            Precios
                                          
                                        </a>
                                    </th>
                                   
                                   

                                    <th scope="col" class="px-4 py-3">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>


                                @foreach ($planes as $plan)
                                    <tr>
                                        <td>{{ $loop->index + 1 }}</td>

                                        <td>{{ $plan->nombre }}</td>
                                        <td>{{ $plan->descripcion }}</td>
                                        <td>
                                            @if ($plan->precios->isNotEmpty())
                                                {{ $plan->precios->first()->precios }}
                                            @else
                                                No tiene precio vigente
                                            @endif
                                        </td>
                                       

                                        <td>

                                            <div class="d-inline-block text-nowrap">
                                                @can('update', App\Models\Categorias::class)
                                                    <a href="{{ route('precios.edit', ['precios' => $plan->id]) }}"
                                                        class="btn btn-sm btn-icon" role="button">
                                                        <i class="bx bx-edit"></i>
                                                    </a>
                                                @endcan
                                               
                                            

                                            </div>



                                           

                                        </td>
                                    </tr>
                                @endforeach

                        </table>

                    </div>
                    <div class="mt-4">
                        <nav aria-label="Page navigation">
                            <ul class="pagination justify-content-center">
                                <!-- Botón para la página anterior -->
                                <li class="page-item {{ $planes->onFirstPage() ? 'disabled' : '' }}">
                                    <button type="button" class="page-link" wire:click="previousPage"
                                        {{ $planes->onFirstPage() ? 'disabled' : '' }}>
                                        Previo
                                    </button>
                                </li>

                                <!-- Botones para cada página -->
                                @foreach ($planes->links()->elements as $element)
                                    @if (is_string($element))
                                        <li class="page-item disabled"><span
                                                class="page-link">{{ $element }}</span></li>
                                    @endif

                                    @if (is_array($element))
                                        @foreach ($element as $page => $url)
                                            <li
                                                class="page-item {{ $page == $planes->currentPage() ? 'active' : '' }}">
                                                <button type="button" class="page-link"
                                                    wire:click="gotoPage({{ $page }})">
                                                    {{ $page }}
                                                </button>
                                            </li>
                                        @endforeach
                                    @endif
                                @endforeach

                                <!-- Botón para la página siguiente -->
                                <li class="page-item {{ $planes->hasMorePages() ? '' : 'disabled' }}">
                                    <button type="button" class="page-link" wire:click="nextPage"
                                        {{ $planes->hasMorePages() ? '' : 'disabled' }}>
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
