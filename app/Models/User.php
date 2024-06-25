<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Str;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function imagenes()
    {
        return $this->morphOne('App\Models\Media', 'imagenable');
    }
    public function rolesusuarios()
    {
        return $this->hasMany('App\Models\RolesUsuarios', 'users_id');
    }
  

    public function session()
    {
        return $this->hasMany('App\Models\session', 'user_id');
    }
    public function personas()
    {
        return $this->belongsTo('App\Models\Personas');
    }

  
  
    /**
     * Genera un nombre de usuario único combinando el nombre y el apellido de una persona.
     *
     * @param int $idPersona El ID de la persona.
     * @return string|null El nombre de usuario generado o null si no se puede generar.
     */
    public function generarNombreUsuario($nombreCompleto)
    {
        // Convertir el nombre completo a minúsculas
        $nombre = strtolower($nombreCompleto);
    
        // Obtener el primer nombre
        $primerNombre = explode(' ', $nombre)[0];
    
        // Generar un número aleatorio
        $numeroAleatorio = rand(100, 999);
    
        // Formar el nombre de usuario
        $nombreUsuario = $primerNombre . '.' . $numeroAleatorio;
    
        // Verificar si el nombre de usuario ya existe en la base de datos
        while (User::where('email', $nombreUsuario . '@energitrack.com')->exists()) {
            // Generar un nuevo número aleatorio
            $numeroAleatorio = rand(100, 999);
            // Formar el nuevo nombre de usuario
            $nombreUsuario = $primerNombre . '.' . $numeroAleatorio;
        }
    
        // Devolver el nombre de usuario con el dominio
        return $nombreUsuario . '@energitrack.com';
    }

    /**
     * Genera una contraseña segura siguiendo estándares de seguridad comunes.
     *
     * @param int $longitud La longitud de la contraseña a generar (por defecto: 12).
     * @return string La contraseña generada.
     */
    public static function generarContrasenaSegura()
    {
        $caracteres = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $longitud_caracteres = strlen($caracteres);
        $contraseña = '';

        for ($i = 0; $i < 8; $i++) {
            $indice_aleatorio = mt_rand(0, $longitud_caracteres - 1);
            $contraseña .= $caracteres[$indice_aleatorio];
        }

        return $contraseña;
    }


    /**
     * Valida si el usuario existe en la base de datos y retorna su ID y el ID de la persona asociada.
     *
     * @param string $usuario El nombre de usuario a validar.
     * @return array|null Un array con el ID del usuario y el ID de la persona asociada si el usuario existe, o null si no existe.
     */
    public function ValidarUsuario($usuario)
    {
        $user = User::where('email', $usuario)
            ->where('estado', 1)
            ->first();


        if ($user !== null) {
            return ['id' => $user->id];
        }
        return null;
    }

    /**
     * Valida si la contraseña proporcionada es correcta para el usuario especificado.
     *
     * @param int $Id El ID del usuario.
     * @param string $contrasena La contraseña a validar.
     * @return bool True si la contraseña es válida para el usuario, False en caso contrario.
     */
    public function ValidarContrasena($Id, $contrasena)
    {
        $user = User::find($Id);
        if ($user !== null) {
            return password_verify($contrasena, $user->password);
        }
        return false;
    }

    /**
     * Obtener información detallada de un usuario.
     *
     * @param int $UserId El ID del Usuario de la que se desea obtener la información.
     * @return array La información detallada del usuario.
     */
    public function ObtenerInformacionUsuario($UserId)
    {
        // Obtener la información básica de la persona
        $User = User::findOrFail($UserId);
        $imagen = Media::where('imagenable_type', 'App\Models\Users')
            ->where('imagenable_id', $User->id)
            ->first();
        $fotoPerfil = $imagen ? $imagen->url : $this->ObtenerFotoPerfilStatica($User->personas->nombre);
        // Retornar la información recopilada
        return [
            'nombre' => $User->personas->nombre,
            'foto' => $fotoPerfil,
        ];
    }

    /**
     * Obtener IdCliente y foto
     */
    public function ObtenerCodigoCliente($Id)
    {
        return null;
    }

    public static function hasPrivilege($UserId, $privilegeId): bool
    {
        // Ejecuta la consulta para verificar si el usuario tiene el privilegio deseado
        $result = DB::table('privilegiosroles as pr')->select('m.id AS id_modulo')
            ->join('submodulos AS sm', 'sm.id', '=', 'pr.submodulos_id')
            ->join('modulos AS m', 'm.id', '=', 'sm.modulos_id')
            ->leftJoin('rolesusuarios AS rt', 'rt.roles_id', '=', 'pr.roles_id')
            ->leftJoin('users AS u', 'rt.users_id', '=', 'u.id')
            ->where('rt.users_id', '=', $UserId)
            ->where('rt.estado', '=', 1)
            ->where('pr.submodulos_id', '=', $privilegeId)
            ->exists();
        return $result;
    }



    /**
     * Obtiene un enlace con una foto de perfil estática basada en la inicial del nombre de usuario.
     *
     * @param string $nombreUsuario El nombre del usuario del cual se desea obtener la foto de perfil.
     * @return string La URL de la foto de perfil estática.
     */
    public function ObtenerFotoPerfilStatica($nombreUsuario)
    {
        // Obtener la primera letra del nombre de usuario
        $primerLetra = substr($nombreUsuario, 0, 1);

        // Construir la URL de la foto de perfil estática utilizando la API ui-avatars.com
        $url = "https://ui-avatars.com/api/?name=" . urlencode($primerLetra);
        return $url;
    }

    public static function ObternerAlidados()
    {
        $usuarios = RolesUsuarios::join('users', 'rolesusuarios.users_id', '=', 'users.id')
        ->select('users.id', 'users.email', 'users.name')
        ->where('rolesusuarios.roles_id', 6)
        ->where('rolesusuarios.estado', 1)
        ->get();

    return $usuarios;
    }



    // Obtener el token de recuerdo
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    // Establecer el token de recuerdo
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function sendEmailVerificationNotification()
    {
        $this->notify(new \Illuminate\Auth\Notifications\VerifyEmail);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new \Illuminate\Auth\Notifications\ResetPassword($token));
    }
}
