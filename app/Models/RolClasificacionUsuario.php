<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolClasificacionUsuario extends Model
{

    protected $table = 'rol_clasificacion_usuario';
    
    protected $fillable = [
        'cliente_id',
        'roles_id',
        'valor_clasificacion_usuario_id',
        'orden'
    ];
    
    public static $rules = [
        'cliente_id' => 'required',
        'roles_id' => 'required'
    ];
    
    public function ClasificacionUsuario()
    {
        return $this->belongsTo('App\Models\ClasificacionUsuario', 'clasificacion_usuario_id');
    }
    
    public function Cliente()
    {
        return $this->belongsTo('App\Models\Cliente', 'cliente_id');
    }
    
    public function Role()
    {
        return $this->belongsTo('App\Models\Role', 'roles_id');
    }

}
