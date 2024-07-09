<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\ForgetPasswordRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRegister;
use App\Models\Media;
use App\Models\Personas;
use Illuminate\Http\Request;
use App\Models\Privilegios;
use App\Models\RolesUsuarios;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\PageController;
use App\Models\session as inicio;
use Jenssegers\Agent\Agent;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class LoginController extends Controller
{
    //
    public function login()
    {

        return view("Auth.login");
    }
    public function validarLogin(Request $request)
    {

        // Validar los datos del formulario
        $request->validate([
            'email' => 'required|string',
            'password' => 'required',
        ]);

        $usuarios = new User();
        $user = $usuarios->ValidarUsuario($request->email);
        if ($user !== null) {
            $privilegio = new Privilegios();
            $userId = $user['id'];
            $InformacionPersonal = $usuarios->ObtenerInformacionUsuario($userId);
            $privilegios = $privilegio->ObtenerPrivilegiosUsuario($userId);
            $credenciales = $request->only('email', 'password');
            if (!Auth::attempt($credenciales, $request->filled('recordar'))) {
                return redirect()->back()->withInput()->with('error', 'Credenciales incorrectas');
            }
            $request->session()->regenerate();

            $validarRol = RolesUsuarios::where('users_id', $userId)
                ->where('roles_id', '!=', 1)
                ->where('estado', 1)
                ->exists();


            $redirectRoute = $validarRol ? 'inicio' : 'usuarios';
            $redirectMessage = $validarRol ? '¡Bienvenido!' : '¡Bienvenido!';

            // Crear las sesiones
            Session::put('IdUser', $userId);
            Session::put('nombre', $InformacionPersonal['nombre']);
            Session::put('Foto', $InformacionPersonal['foto']);
            Session::put('privilegios', $privilegios);


            // Obtener los datos de sesión y agregar los datos adicionales al payload
            $sessionData = [
                'IdUser' => $userId,
                'nombre' => $InformacionPersonal['nombre'],
                'Foto' => $InformacionPersonal['foto'],
                'privilegios' => $privilegios
            ];
            $sessionId = $request->session()->getId();
            $payload = Crypt::encrypt(json_encode($sessionData));

            // Almacenar los datos en la tabla sessions
            DB::table('sessions')->insert([
                'id' => $sessionId,
                'user_id' => $userId,
                'ip_address' => $request->ip(),
                'user_agent' => $request->userAgent(),
                'payload' => $payload,
                'last_activity' => now()->timestamp,
                'active' => true,
            ]);
            return redirect()->route($redirectRoute)->with('success', $redirectMessage);
        }
        return redirect()->back()->withInput()->with('error', 'Credenciales incorrectas');
    }

    public function logout(Request $request)
    {
        // Obtener el identificador único de la sesión actual
        $sessionId = $request->session()->getId();
        // Cerrar la sesión del usuario
        Auth::logout();
        DB::table('sessions')
            ->where('id', $sessionId)
            ->delete();
        // Invalidar la sesión actual
        $request->session()->invalidate();

        // Regenerar el token de CSRF
        $request->session()->regenerateToken();


        // Redirigir al usuario a la página de inicio
        return redirect('/');
    }
    public function registro()
    {

        return view("Auth.register");
    }
    public function register(StoreRegister $request)
    {
        try {
            $persona = new Personas();
            $persona->nombre = $request->name;

            $persona->save();

            $user = new User();
            $user->personas_id = $persona->id;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);


            $user->save();
            $user->sendEmailVerificationNotification();
            if ($request->has('persona')) {
                $rol=2;
            } else {
                $rol=1;
            }
            $userRol = new RolesUsuarios();
            $userRol->roles_id = $rol;
            $userRol->users_id = $user->id;
            $userRol->estado = 1;
            $userRol->save();

            return redirect()->route('login')->with('success', 'Se ha enviado un correo de verificacion');
        } catch (ValidationException $e) {
            Log::error($e->getMessage());

            return response()->json(['errors' => $e->validator->errors()], 422);
        }

    }

    //Verficacion de correos
    public function verify(Request $request, $id, $hash)
    {
        $user = User::findOrFail($id);

        if (!hash_equals((string) $hash, sha1($user->getEmailForVerification()))) {
            return redirect()->route('login')->with('error', 'El enlace de verificación es inválido.');
        }

        if ($user->hasVerifiedEmail()) {
            return redirect()->route('login')->with('info', 'La cuenta ya ha sido verificada anteriormente.');
        }

        $user->markEmailAsVerified();
        return redirect()->route('login')->with('success', '¡Tu cuenta ha sido verificada con éxito!');
    }


    //
    public function sendResetLinkEmail(Request $request)
    {
        $request->validate(['email' => 'required|email']);

        $status = Password::sendResetLink([
            'email' => $request->email
        ]);

        return $status === Password::RESET_LINK_SENT
            ? response()->json(['message' => 'Correo electrónico de restablecimiento de contraseña enviado'])
            : response()->json(['error' => 'No se pudo enviar el correo electrónico de restablecimiento de contraseña'], 500);
    }
    public function reset(Request $request)
    {

    }
    public function showResetForm($token)
    {
        return response()->json(['token' => $token]);
    }

    public function resetPassword(ForgetPasswordRequest $request)
    {


        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user, $password) {
                $user->forceFill([
                    'password' => bcrypt($password)
                ])->save();
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Contraseña restablecida con éxito'], 200);
        } else {
            return response()->json(['error' => 'No se pudo restablecer la contraseña'], 500);
        }
    }
    public function error403()
    {
        return view('Error.403');
    }

    public function inicios()
    {
        $idUsuario = session('IdUser');


        $user = User::findOrFail($idUsuario);
        $sessiones = inicio::where('user_id', $idUsuario)->where('active', true)->orderBy('last_activity', 'DESC')->get();

        $agent = new Agent();
        foreach ($sessiones as $session) {
            $agent->setUserAgent($session->user_agent);
            $session->browser_name = $agent->browser();
            $session->platform_name = $agent->platform();
        }
        return view('Inicio.perfil', compact('user', 'sessiones'));
    }

    public function closeSessionForDevice(Request $request)
    {
        // Verificar si el usuario está autenticado
        if (Auth::check()) {

            // Verificar la contraseña proporcionada
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return redirect()->back()->with('error', 'Se ha ingresado la contraseña incorrecta.');
            }


            // Cerrar la sesión en otros dispositivos
            Auth::logoutOtherDevices($request->current_password);

            // Eliminar los registros de sesión en otros dispositivos
            $this->deleteOtherSessionRecords($request);

            // Redirigir al usuario con un mensaje de éxito
            return redirect()->back()->with('success', 'Sesiones en otros dispositivos cerradas exitosamente.');
        } else {
            // El usuario no está autenticado, redirigir a la página de inicio de sesión
            return redirect()->back()->with('error', 'Debes iniciar sesión para realizar esta acción.');
        }
    }
    protected function deleteOtherSessionRecords(Request $request)
    {
        if (config('session.driver') !== 'database') {
            return;
        }

        DB::table(config('session.table', 'sessions'))

            ->where('id', '!=', $request->session()->getId())
            ->delete();
    }


    public function actualizar(Request $request)
    {
        try {
            $idUsuario = session('IdUser');

            $user = User::findOrFail($idUsuario);
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->save();

            if ($request->hasFile('imagen')) {
                // Subir la nueva imagen a Cloudinary y obtener el resultado
                $imagenes = $user->imagenes;

                if ($imagenes) {
                    $public_id = $imagenes['public_id'];
                    Cloudinary::destroy($public_id);
                    Media::destroy($imagenes['id']);
                }


                $result = $request->file('imagen')->storeOnCloudinary('Verdies/Users');

                // Crear una nueva entrada de imagen en la base de datos
                $imagen = new Media();
                $imagen->url = $result->getSecurePath();
                $imagen->public_id = $result->getPublicId();
                $imagen->imagenable_id = $idUsuario;
                $imagen->imagenable_type = get_class($user);
                $imagen->save();
                session(['Foto' => $result->getSecurePath()]);
                //return $result->getSecurePath();
            }
            session(['nombre' => $request->name]);
            return redirect()->back()->with('success', 'Se ha actualizado tu informacion');
        } catch (ValidationException $e) {
            Log::error($e->getMessage());

            return response()->json(['errors' => $e->validator->errors()], 422);
        }

    }

}
