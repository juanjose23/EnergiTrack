<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUsers;
use App\Http\Requests\UpdateUser;
use App\Models\Media;
use App\Models\Personas;
use App\Models\RolesModel;
use App\Models\RolesUsuarios;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;


class UsersController extends Controller
{

    public function index()
    {
        return view('Gestion_usuarios.usuarios.index');
    }

    public function create()
    {

        $rol = new RolesModel();
        $roles = $rol->SelectRoles();

        return view('Gestion_usuarios.usuarios.create', compact('roles'));
    }

    public function store(StoreUsers $request)
    {
        $user = new User();

        $persona = new Personas();
        $persona->nombre = $request->nombre;
        $persona->telefono = $request->telefono;
        $persona->apellido = $request->apellido;
        $persona->tipo_identificacion = $request->tipo;
        $persona->identificacion = $request->identificacion;
        $persona->save();

        $ultimoId = $persona->id;
        $usuario = $user->generarNombreUsuario($request->nombre);
        $user->personas_id = $ultimoId;
        $user->email = $usuario;
        $user->password = bcrypt($request->telefono);
        $user->email_verified_at = now();
        $user->estado = $request->estado;
        $user->save();

        if ($request->hasFile('foto')) {
            $imagen = $request->file('foto');
            $nombreArchivo = $imagen->getClientOriginalName(); // Obtener el nombre original del archivo
          
            // Crear una nueva entrada de imagen en la base de datos
            $nuevaImagen = new Media();
            $nuevaImagen->url = Storage::url('empleados/' . $nombreArchivo); // Esto es correcto
            $nuevaImagen->imagenable_id = $ultimoId;
            $nuevaImagen->imagenable_type = get_class($user);
            $nuevaImagen->save();
        }

        // Obtener el último ID después de guardar el usuario
        $userId = $user->id;

        $userRol = new RolesUsuarios();
        $userRol->roles_id = $request->roles;
        $userRol->users_id = $userId;
        $userRol->estado = 1;
        $userRol->save();


        // Redirige a la ruta usuarios.index después de enviar el PDF adjunto
        Session::flash('success', 'Se ha registrado con éxito el usuario');

        return redirect()->route('usuarios.index')->with('success', 'Usuarios registrado correctamente');
    }

    public function edit($usuarios)
    {
        //Roles
        $roles = new RolesModel();
        $usuario = User::findOrFail($usuarios);
        $rolesusuarios = RolesUsuarios::where('users_id', $usuarios)->get();
        $rolesdisponibles = $roles->obtenerRolesDisponiblesParaUsuario($usuarios);

        return view('Gestion_usuarios.usuarios.edit', compact('usuario', 'rolesusuarios', 'rolesdisponibles'));
    }
    public function update(UpdateUser $request, User $usuarios)
    {
        $actualizar = $request->has('actualizar');

        if ($actualizar) {
            $personas = Personas::findOrFail($usuarios->personas_id);
            $personas->nombre=$request->nombre;
            $personas->apellido=$request->apellido;
            $personas->tipo_identificacion=$request->tipo;
            $personas->identificacion=$request->identificacion;
            $personas->save();
        } else {
            $userRol = new RolesUsuarios();
            $userRol->roles_id = $request->roles;
            $userRol->users_id = $usuarios;
            $userRol->estado = 1;
            $userRol->save();
        }
        
         return redirect()->back()->with('success', 'Nuevo rol asignado correctamente');
    }
    public function destroy($usuarios)
    {
        $usuario = User::findOrFail($usuarios);

        // Cambia el estado del cargo
        $usuario->estado = $usuario->estado == 1 ? 0 : ($usuario->estado == 2 ? 1 : 2);

        $usuario->save();


        // Redirige de vuelta a la página de índice con un mensaje flash
        Session::flash('success', 'El estado del usuario ha sido cambiado exitosamente.');

        return redirect()->route('usuarios.index');
    }


    public function destroyroles($id)
    {

        $rol = RolesUsuarios::findOrFail($id);

        // Cambia el estado del cargo
        $rol->estado = $rol->estado == 1 ? 0 : 1;
        $rol->save();
        return redirect()->back()->with('success', 'Rol desactivado correctamente');
    }
}


