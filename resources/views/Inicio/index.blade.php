@extends('Layouts.app')
@section('title', 'Inicio')
@section('content')

    <div class="row">
        <div class="col-lg-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-7">
                        <div class="card-body">
                            <h5 class="card-title text-primary">¡Bienvenido,{{Session::get('nombre') }}! 🎉</h5>
                            <p class="mb-4">
                                Te damos la bienvenida a nuestra plataforma. Estamos emocionados de tenerte con nosotros.
                                ¡Prepárate para una experiencia increíble!
                            </p>
                            

                           
                        </div>
                    </div>
                    <div class="col-sm-5 text-center text-sm-left">
                        <div class="card-body pb-0 px-0 px-md-4">
                            <img src="https://res.cloudinary.com/dxtlbsa62/image/upload/v1718344031/Verdies/Page/cdj5z5xxxmov0ep3qh04.png" height="140"
                                alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                data-app-light-img="illustrations/man-with-laptop-light.png" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection
