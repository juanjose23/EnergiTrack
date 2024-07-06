@extends('Layouts.app')
@section('title', 'Planes')
@section('content')
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-3">
                <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home"
                        type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">
                        <i class="bx bx-info-circle"></i> Información
                    </button>
                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile"
                        aria-selected="false">
                        <i class="bx bx-list-ul"></i> Condiciones
                    </button>
                </div>
            </div>
            <div class="col-md-9 card">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel"
                        aria-labelledby="v-pills-home-tab" tabindex="0">

                        <div class="d-flex justify-content-start align-items-center customer-name">
                            <div class="avatar-wrapper">
                                <div class="image-fluid me-3"><img src="{{ $planes->imagenes->url }}" alt="Avatar"
                                        width="80" height="80" class="rounded-circle">
                                </div>
                            </div>
                            <div class="d-flex flex-column">
                                <a>
                                    <span class="fw-medium">{{ $planes->nombre }}</span>
                                </a>
                            </div>
                        </div>
                        <br>
                        <ul class="list-unstyled">
                            <li class="mb-2">
                                <i class="bx bxs-category"></i> Categoría: {{ $planes->categorias->nombre }}
                            </li>
                            <li class="mb-2">
                                <i class="bx bxs-info-circle"></i> Acerca del plan: {{ $planes->descripcion }}
                            </li>
                            <li class="mb-2">
                                <i class='bx bxs-megaphone'></i> Límites de dispositivos: {{ $planes->dispositivos }}
                            </li>
                            <li class="mb-2">
                                <i class="bx bxs-badge-check"></i> Estado:
                                <span class="badge {{ $planes->estado == 1 ? 'bg-label-primary' : 'bg-label-danger' }}">
                                    {{ $planes->estado == 1 ? 'Activo' : 'Inactivo' }}
                                </span>
                            </li>
                        </ul>


                    </div>
                    <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab"
                        tabindex="0">
                        <form action="{{route('plan.nuevascondiciones')}}" method="POST" class="row form-inline">
                            @csrf
                            <div class="col-md-9">
                                <div class="form-group d-flex align-items-center">
                                    <label for="descripcion" class="mr-2">Nueva Condición</label>
                                    <select style="width: 80%" id="condiciones" name="condiciones[]"
                                        class="select2 form-select @error('condiciones') is-invalid @enderror"
                                        multiple="multiple">
                                        <option>Seleccionar Condiciones</option>
                                        @foreach ($condicionSelect as $condicions)
                                            <option value="{{ $condicions->id }}"
                                                {{ old('condiciones') == $condicions->id ? 'selected' : '' }}>
                                                {{ $condicions->descripcion }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('condiciones')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <input type="hidden" name="id" value="{{ $planes->id }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary">Agregar </button>
                            </div>
                        </form>
                        <br>
                   
                        <div class="row">
                           
                            <div class="col-md-12">
                                <h1>Condiciones del Plan</h1>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>Descripción</th>
                                            <th>Acciones</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($condiciones as $condicion)
                                        <tr>
                                            <td>{{ $condicion->descripcion }}</td>
                                            <td>
                                                <form action="{{ route('plan.destroycon', ['id' => $condicion->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="text" name="id_condicion" value="{{$condicion->id}}" hidden>
                                                    <input type="text" name="id" value="{{$planes->id}}" hidden>
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('¿Estás seguro?')">Eliminar</button>
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
    </div>
@endsection
