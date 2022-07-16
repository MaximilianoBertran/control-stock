<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Passport\HasApiTokens;
use App\Models\TipoRol;
use App\Models\Role;
use App\Models\Reconocimiento;
use App\Models\Evento;
use App\Models\CanjeRegalo;
use App\Models\CarritoCanjes;
use App\Models\HistorialCanjes;
use App\Models\PinDestinatario;
use App\Models\PinEnviado;
use App\Models\EstadoPin;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class User extends Authenticatable {

    use Filters;
    use HasApiTokens;
    use Notifiable;
    use SoftDeletes;

    const LOGITUD_MINIMA_PASSWORD = 8;

    //public $incrementing = false;
    //protected $keyType = 'string';

    protected $table = 'users';

    protected $appends = [
        //
    ];

    protected $fillable = ['username', 'nombre', 'apellido', 'password', 'email', 'cliente_id',
    		'foto', 'foto_filename', 'foto_mimetype', 'sucursal', 'fecha_nacimiento', 'genero_id',
    		'estado_id', 'genera_reconocimientos', 'aprueba_reconocimientos',
            'visibilidad_todos_clientes', 'tope_puntos', 'sector_id', 'puntos_canjear', 'jefe_nivel_uno', 'jefe_nivel_dos',
            'dni', 'ultimo_login', 'legajo', 'codigo_compras', 'idioma', 'cargo_id', 'nacionalidad_id','punto_entrega_id','puntos_otorgados',
            'can_choose_privacy_of_pines', 'gerencia_id', 'site', 'notification_points'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'email_verified_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public static function rules($id = null) {
        $required = ($id == null ? 'required' : 'nullable');
        return [
            'username' => 'required|unique:users,username,NULL,id,deleted_at,NULL',
            "email" => "required|string|email|max:255|unique:users,email," . ($id ?: 'NULL'),
            "apellido" => "required|string|max:60",
            "nombre" => "required|string|max:60",
            "password" => "$required|string|min:8|strong|confirmed",
            'tope_puntos' => 'integer|min:0'
        ];
    }

    public static function updatePassword($id = null) {
        $required = ($id == null ? 'required' : 'nullable');
        return [
            "password" => "$required|string|confirmed",
            'tope_puntos' => 'integer|min:0'
        ];
    }
    public static  function rulesStore($cliente_id) {
        return $validatorRules = [
            'username' => 'required|unique:users,username,NULL,id,cliente_id,'.$cliente_id.',deleted_at,NULL',
            'dni' => 'required|alpha_num|digits_between:1,30',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            'email' => 'required|email|unique:users,email,NULL,id,cliente_id,'.$cliente_id.',deleted_at,NULL',
            'password' => 'required',
            'fecha_nacimiento' => 'required'
        ];
    }
    public function getFullnameAttribute() {
        return $this->name . ' ' . $this->lastname;
    }

    /**
     * @param $user
     * @return string
     */
    public function userNameWithData()
    {
        $userNameData = $this->nombre . ' ' . $this->apellido;

        switch ($this->cliente->mostrar_dato) {
            case 0:
                break;
            case 1:
                $userNameData = $userNameData . ' (' . $this->username . ')';
                break;
            case 2:
                $userNameData = $userNameData . ' (' . $this->dni . ')';
                break;
            case 3:
                $userNameData = $userNameData . ' (' . $this->legajo . ')';
                break;
            case 4:
                if (!is_null($this->gerencia))
                {
                    $userNameData = $userNameData . ' (' . $this->gerencia->descripcion . ')';
                }
                else
                {
                    $userNameData = $userNameData . ' (' . __('Unassigned management') . ')';
                }
                break;
            case 5:
                if (!is_null($this->sector))
                {
                    $userNameData = $userNameData . ' (' . $this->sector->descripcion . ')';
                }
                else
                {
                    $userNameData = $userNameData . ' (' . __('Unassigned sector') . ')';
                }
                break;
            case 6:
                if (!is_null($this->cargo))
                {
                    $userNameData = $userNameData . ' (' . $this->cargo->descripcion . ')';
                }
                else
                {
                    $userNameData = $userNameData . ' (' . __('Unassigned position') . ')';
                }
                break;
        }

        return $userNameData;
    }

    public static $messages = [
        'username.unique'=>'El nombre de usuario que intenta ingresar ya existe en el sistema. Por favor verifiquelo.',
    ];

    public function cliente()
    {
    	return $this->belongsTo('App\Models\Cliente', 'cliente_id')->withTrashed();
    }

    public function sector()
    {
    	return $this->belongsTo('App\Models\Sector', 'sector_id')->withTrashed();
    }

    public function gerencia()
    {
        return $this->belongsTo(Gerencia::class, 'gerencia_id')->withTrashed();
    }

    public function nacionalidad()
    {
    	return $this->belongsTo('App\Models\Nacionalidad', 'nacionalidad_id');
    }

    public function puntoEntrega()
    {
    	return $this->belongsTo('App\Models\PuntoDeEntrega', 'punto_entrega_id')->withTrashed();
    }

    public function genero()
    {
    	return $this->belongsTo('App\Models\Genero', 'genero_id');
    }

    public function cargo()
    {
    	return $this->belongsTo('App\Models\Cargo', 'cargo_id')->withTrashed();
    }

    public function estado()
    {
    	return $this->belongsTo('App\Models\EstadoCliente', 'estado_id');
    }
    
    public function pinDestinatario(){
        return $this->hasMany('App\Models\PinDestinatario','users_id');
    }

    public function pinesEnviados()
    {
        return $this->hasMany(PinEnviado::class, 'user_id');
    }

    public function likes(){
        return $this->hasMany('App\Models\Likes','users_id');
    } 
    
    public function comentarios(){
        return $this->hasMany('App\Models\Comentario','users_id');
    }

    public function historialCanjes(){
        return $this->hasMany('App\Models\HistorialCanjes','users_id');
    }
    
    public function valores(){
    	return $this->hasMany('App\Models\ValorClasificacionPorUsuario', 'users_id');
    }
    
    public function jefeNivelUno(){
        return $this->belongsTo('App\Models\User', 'jefe_nivel_uno', 'id');
    }
    public function jefeNivelDos(){
        return $this->belongsTo('App\Models\User', 'jefe_nivel_dos', 'id');
    }

    public static function nivelUno(){
        $Validator = array(
            'jefe_nivel_uno' => 'numeric|min:1',
        );
    return $Validator;
    }
    public static function nivelDos(){
        $Validator = array(
            'jefe_nivel_uno' => 'required|numeric|min:1',
            'jefe_nivel_dos' => 'numeric|min:1'
        );               
        return $Validator;
    }
    public function esJefe(){
        
        return User::where('jefe_nivel_uno', $this->id)->orWhere('jefe_nivel_dos', $this->id)->exists();
        
    }
    
    public function poolEntregados(){
        
        $entregados = Reconocimiento::where('users_id', $this->id)->sum('puntos');
        
        return (isset($entregados) ? $entregados : 0);
    }

    public function poolInicial(){        
        return $this->tope_puntos + $this->poolEntregados();
    }
    
    public function getNombreApellidoAttribute(){
        return $this->nombre . ' ' . $this->apellido;
    }

    public static function getJefes( $typeJefe, $cliente_id){

        return User::select('*', DB::raw('concat(nombre, " ", apellido) as fullName') )
                    ->whereRaw('id in ( select u.'.$typeJefe.' from users as u where cliente_id = '. $cliente_id .' )')
                    ->where('users.cliente_id', $cliente_id)
                    ;
    }
    
    public function isJefe(){

        $subordinates = self::where('jefe_nivel_uno', $this->id)
            ->orWhere('jefe_nivel_dos', $this->id)
            ->whereNull('deleted_at')
            ->get();
        
        return count($subordinates) > 0 ? true : false;
    }

    public static  function rulesUpdate($user) {
        return $validatorRules = [
            'username' => 'required|unique:users,username,'. $user->id .',id,cliente_id,'.$user->cliente_id.',deleted_at,NULL',
            'dni' => 'required|alpha_num|digits_between:1,30',
            'nombre' => 'required|string',
            'apellido' => 'required|string',
            //'email' => 'required|email|unique:users,email',
            'fecha_nacimiento' => 'required'
        ];
    }
    public static function ClasificacionesDescFromUser($user_id){
        $user = self::find($user_id);
        if(isset($user)){
            return $user->clasificaciones_desc;
        }
            return null;
    }
    public function getClasificacionesDescAttribute(){
    	$aux = array();
    	foreach ($this->valores as $valor){
    		$existe = false;
    		foreach ($aux as $r){
    			if($r->clasificacion == $valor->valorClasificacion->ClasificacionUsuario->descripcion){
    				$r->valores[] = $valor->valorClasificacion->descripcion;
    				$existe = true;
    				break;
    			}
    		}
    		
    		if(!$existe){
    			$nuevo = new \stdClass;
    			$nuevo->clasificacion = $valor->valorClasificacion->ClasificacionUsuario->descripcion;
    			$nuevo->valores = array();
    			$nuevo->valores[] = $valor->valorClasificacion->descripcion;
    			$aux[] = $nuevo;
    		}
    	}
    	
    	$rta = array();
    	
        usort($aux, function($a, $b)
        {
            return strcmp($a->clasificacion, $b->clasificacion);
        });
        
    	foreach ($aux as $a){
    		$rta[] = $a->clasificacion . ': ' . implode(", ", $a->valores); 
    	}
    	
    	return implode("; ", $rta);
    }
    public function getApruebaRecoDescAttribute(){
        if($this->aprueba_reconocimientos){
            return "SI";
        } else {
            return "NO";
        }
    }
    public function getGeneraRecoDescAttribute(){
        if($this->genera_reconocimientos){
            return "SI";
        } else {
            return "NO";
        }
    }

    public function isAdmin(){
        return false;
    }

    public function getImageProfile(){
        if($this->foto != null){
            $actualStorage = "CLIENTE_" . $this->cliente_id . "/USUARIOS/PERFIL_".$this->id ."/". $this->foto;
            return 'data:image;base64,'.base64_encode(Storage::get($actualStorage));
        } else {
            return asset('frontend/images/user.jpg');
        }

    }

    public static function getUserImage($id){
        $user = User::withTrashed()->where('id', $id)->first();
        if($user->foto != null){
            $actualStorage = "CLIENTE_" . $user->cliente_id . "/USUARIOS/PERFIL_".$user->id ."/". $user->foto;
            return 'data:image;base64,'.base64_encode(Storage::get($actualStorage));
        } else {
            return asset('frontend/images/user.jpg');
        }

    }

    public function getCarritoStatus(){
        $producto = CarritoCanjes::where('user_id', $this->id)->where('pin_env_id', null)->count();
        if($producto > 0){
            return 'activo';
        }
    }

    public function getCarritoSecretoStatus(){
        $producto = CarritoCanjes::where('user_id', $this->id)->where('pin_env_id', '!=', null)->count();
        if($producto > 0){
            return 'activo';
        }
    }

    public function filtroActividad(){
        $historial = HistorialCanjes::where('user_id',$this->id)->count();
        $carrito = CarritoCanjes::where('user_id',$this->id)->count();
        if($historial > 0 || $carrito > 0){
            return true;
        } else {
            return false;
        }
    }

    public function generaPines(){
        $genera = false;

        $role = Role::where('name', Role::GENERADOR_FRONTEND)->first();

        foreach($this->valores as $valor){
            foreach ($this->cliente->rolesClasificacionUsuario as $rol) {
                if($valor->valor_clasificacion_usuario_id == $rol->valor_clasificacion_usuario_id && $rol->roles_id == $role->id){
                    $genera = true;
                }
            }
        }

        if($this->genera_reconocimientos && $this->cliente->rolesClasificacionUsuario->count() < 1 || $this->genera_reconocimientos && $genera){
            return true;
        } else {
            return false;
        }
    }

    public function generaPinesSecretos(){
        $canje = false;

        foreach (explode(",",json_decode($this->cliente->puntos_disponibles)) as $puntos) {
            if($puntos < $this->puntos_otorgados){
                $canje = true;
            }
        }

        if($this->puntos_otorgados > 0 && $canje){
            return true;
        } else {
            return false;
        }
    }

    public function apruebaPines(){
        $genera = false;

        $role = Role::where('name', Role::APROBADOR_FRONTEND)->first();

        foreach($this->valores as $valor){
            foreach ($this->cliente->rolesClasificacionUsuario as $rol) {
                if($valor->valor_clasificacion_usuario_id == $rol->valor_clasificacion_usuario_id && $rol->roles_id == $role->id){
                    $genera = true;
                }
            }
        }

        if($this->aprueba_reconocimientos && $this->cliente->rolesClasificacionUsuario->count() < 1 || $this->aprueba_reconocimientos && $genera){
            return true;
        } else {
            return false;
        }
    }

    public function filtroSecretMarket(){
        $pines = PinEnviado::where('user_id',$this->id)->where('estado_pin_id', EstadoPin::EN_PROCESO)->count();

        if($pines < 1){
            return false;
        } else {
            return true;
        }
    }

    public function puntosPinSecreto(){
        $pin = PinEnviado::where('user_id',$this->id)->where('estado_pin_id', EstadoPin::EN_PROCESO)->first();

        if($pin && $pin->count() > 0){
            return $pin->puntos;
        }
    }

    public function filtroMarket()
    {
        $historial = HistorialCanjes::where('user_id', $this->id)->count();
        if($this->puntos_canjear >= 1 || $historial > 0)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function catalogueFilter()
    {
        $historial = PinDestinatario::where('user_id',$this->id)->count();

        if ($historial >= 1)
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function getCantidadPinesEnviados($desde, $hasta)
    {
        $pinEnviado = PinEnviado::where('user_id', $this->id)->get();

        if ($hasta != null)
        {
            $pinEnviado = $pinEnviado->where('created_at', '<=', $hasta);
        }

        if ($desde != null)
        {
            $pinEnviado = $pinEnviado->where('created_at', '>=', $desde);
        }

        return $pinEnviado->count();
    }

    public function getCantidadReconocidos($desde, $hasta)
    {
        $pinesEnviados = PinEnviado::where('user_id', $this->id)->get();

        if ($hasta != null)
        {
            $pinesEnviados = $pinesEnviados->where('created_at', '<=', $hasta);
        }

        if ($desde != null)
        {
            $pinesEnviados = $pinesEnviados->where('created_at', '>=', $desde);
        }

        $cantidad = 0;
        foreach ($pinesEnviados as $pinesEnviado)
        {
            $cantidad = $cantidad + $pinesEnviado->pinesDestinatario->count();
        }

        return $cantidad;
    }

    public function getCantidadGrupales($desde, $hasta)
    {
        $pinesEnviados = PinEnviado::where('user_id', $this->id)->get();

        if ($hasta != null)
        {
            $pinesEnviados = $pinesEnviados->where('created_at', '<=', $hasta);
        }

        if ($desde != null)
        {
            $pinesEnviados = $pinesEnviados->where('created_at', '>=', $desde);
        }

        $cantidad = 0;
        foreach ($pinesEnviados as $pinesEnviado)
        {
            if ($pinesEnviado->pinesDestinatario->count() > 1)
            {
                $cantidad++;
            }
        }

        return $cantidad;
    }

    public function getCantidadIndividuales($desde, $hasta)
    {
        $pinesEnviados = PinEnviado::where('user_id', $this->id)->get();

        if ($hasta != null)
        {
            $pinesEnviados = $pinesEnviados->where('created_at', '<=', $hasta);
        }

        if ($desde != null)
        {
            $pinesEnviados = $pinesEnviados->where('created_at', '>=', $desde);
        }

        $cantidad = 0;
        foreach ($pinesEnviados as $pinesEnviado)
        {
            if ($pinesEnviado->pinesDestinatario->count() == 1)
            {
                $cantidad++;
            }
        }

        return $cantidad;
    }

    public function cantidadDeVecesQueFueReconocido($desde, $hasta)
    {
        $pinesDestinatarios = PinDestinatario::where('user_id', $this->id)->get();

        if ($desde != null)
        {
            $pinesDestinatarios = $pinesDestinatarios->where('created_at', '>=', $desde);
        }

        if ($hasta != null)
        {
            $pinesDestinatarios = $pinesDestinatarios->where('created_at', '<=', $hasta);
        }

        return $pinesDestinatarios->count();
    }

    public function cantidadComentariosRealizados($desde, $hasta)
    {
        $pinesComentario = PinesComentario::where('user_id', $this->id)->get();

        if ($desde != null)
        {
            $pinesComentario = $pinesComentario->where('created_at', '>=', $desde);
        }

        if ($hasta != null)
        {
            $pinesComentario = $pinesComentario->where('created_at', '<=', $hasta);
        }

        return $pinesComentario->count();
    }

    public function cantidadDeLikesRealizados($desde, $hasta)
    {
        $pinesLikes = PinesLike::where('user_id', $this->id)->get();

        if ($desde != null)
        {
            $pinesLikes = $pinesLikes->where('created_at', '>=', $desde);
        }

        if ($hasta != null)
        {
            $pinesLikes = $pinesLikes->where('created_at', '<=', $hasta);
        }

        return $pinesLikes->count();
    }

    public function tienePendientes(){
        $pendientes = PinEnviado::where('aprobador_id', $this->id)
                                ->where('estado_pin_id', EstadoPin::PENDIENTE)
                                ->where('user_id', '!=', $this->id)
                                ->where('cliente_id', $this->cliente_id)
                                ->orWhere('aprobador_id', null)
                                ->where('estado_pin_id', EstadoPin::PENDIENTE)
                                ->where('user_id', '!=', $this->id)
                                ->where('cliente_id', $this->cliente_id)
                                ->get();
        return $pendientes->count();
    }
}
