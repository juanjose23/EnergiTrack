@extends('Layouts.app')
@section('title', 'Inicio')
@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="container-xxl flex-grow-1 container-p-y">
            <h4 class="py-3 mb-4"><span class="text-muted fw-light"> Perfil /</span> {{ Session::get('nombre') }}</h4>

            <div class="row">
                <div class="col-md-12">
                    <ul class="nav nav-pills flex-column flex-md-row mb-3">
                        <li class="nav-item">
                            <a class="nav-link active" href="javascript:void(0);"><i class="bx bx-user me-1"></i> Perfil</a>
                        </li>
                    </ul>
                    <div class="card mb-4">
                        <form action="actualizar"  method="post" enctype="multipart/form-data">
                            @csrf
                            <h5 class="card-header">Perfil detalle</h5>
                            <!-- Account -->
                            <div class="card-body">
                                <div class="d-flex align-items-start align-items-sm-center gap-4">
                                    <img src="{{ Session::get('Foto') }}" alt="user-avatar" class="d-block rounded"
                                        height="100" width="100" id="uploadedAvatar" />
                                    <div class="button-wrapper">
                                        <label for="upload" class="btn btn-primary me-2 mb-4" tabindex="0">
                                            <span class="d-none d-sm-block">Subir nueva foto</span>
                                            <i class="bx bx-upload d-block d-sm-none"></i>
                                            <input type="file" id="upload"  name="imagen" class="account-file-input" hidden
                                                accept="image/png, image/jpeg" />
                                        </label>


                                        <p class="text-muted mb-0">Se aceptan JPG, GIF or PNG. tamaño maximo 800K</p>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-0" />
                            <div class="card-body">
                                <div>
                                    <div class="row">
                                        <div class="mb-3 col-md-6">
                                            <label for="firstName" class="form-label">Nombre completo</label>
                                            <input class="form-control" type="text" id="firstName" name="name"
                                                value="{{ Session::get('nombre') }}" autofocus />
                                        </div>

                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Correo</label>
                                            <input class="form-control" type="text" id="email" name="correo"
                                                value="{{ $user->email }}" placeholder="" disabled />
                                        </div>
                                        <div class="mb-3 col-md-6">
                                            <label for="email" class="form-label">Nueva contraseña</label>
                                            <input class="form-control" type="password" id="email" name="password"
                                                value="" placeholder=""  />
                                        </div>

                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Guardar cambios</button>
                                            <button type="reset" class="btn btn-outline-secondary">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                                <!-- /Account -->
                            </div>
                        </form>

                        <div class="card">
                            <h5 class="card-header">Inicios de actividad</h5>
                            <div class="card-body">
                                <div class="mb-3 col-12 mb-0">

                                </div>

                                <strong>Inicios activos:</strong>
                                <div class="row g-4 mt-2">
                                    @foreach ($sessiones as $item)
                                        <div class="col-md-4">
                                            <div class="card bg-light border">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        @if ($item->platform_name == 'Mobile')
                                                            <i class="fas fa-mobile-alt fa-2x text-primary"></i>
                                                        @else
                                                            <i class="fas fa-desktop fa-2x text-primary"></i>
                                                        @endif
                                                        <span class="text-muted">{{ $item->platform_name }}
                                                            {{ $item->browser_name }}</span>
                                                    </div>
                                                    <p class="card-text mb-0">
                                                        <strong>IP:</strong> {{ $item->ip_address }}
                                                        @if ($item->ip_address === request()->ip() && $item->user_agent === request()->header('User-Agent'))
                                                            <span class="badge rounded-pill bg-primary">Esta es la
                                                                sesión actual </span>
                                                        @else
                                                            <strong>Actividad:</strong>
                                                            {{ \Carbon\Carbon::createFromTimeStamp($item->last_activity)->diffForHumans() }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <br>
                                @if ($sessiones->count() > 1)
                                    <form id="formCerrarSesion" action="{{ route('cerrar_sesion_dispositivo') }}"
                                        method="POST">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ session('IdUser') }}">
                                        <!-- Este botón desencadenará el SweetAlert -->
                                        <button type="button" class="btn btn-danger mt-3"
                                            onclick="confirmAction({{ session('IdUser') }})">
                                            <i class="fas fa-cancel"></i> Cerrar sesión en los otros dispositivos
                                        </button>
                                    </form>
                                @endif


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        async function confirmAction(SessionId) {
            const {
                value: password
            } = await Swal.fire({
                title: "Ingresa tu contraseña",
                input: "password",
                inputLabel: "Contraseña",
                inputPlaceholder: "Ingresa tu contraseña",
                inputAttributes: {
                    maxlength: "10",
                    autocapitalize: "off",
                    autocorrect: "off"
                },
                inputValidator: (value) => {
                    return new Promise((resolve) => {
                        if (value.trim() === "") {
                            resolve("Debes ingresar tu contraseña");
                        } else {
                            resolve();
                        }
                    });
                },
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Sí, cerrar todas las sesiones',
                cancelButtonText: 'Cancelar'
            });

            if (password) {
                // Si se ingresó una contraseña, proceder con el envío del formulario
                var form = document.getElementById('formCerrarSesion');
                var passwordInput = document.createElement('input');
                passwordInput.type = 'hidden';
                passwordInput.name = 'current_password';
                passwordInput.value = password;
                form.appendChild(passwordInput);
                form.submit();
            }
        }
    </script>
@endsection
