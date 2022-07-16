<?php

namespace App\Models;

use App\Traits\Filters;
use Illuminate\Database\Eloquent\Model;

class Role extends Model {

    use Filters;

    const SUPERADMIN = 'SUPERADMIN';
    Const GENERADOR_FRONTEND = 'GENERADOR_FRONTEND';
    Const APROBADOR_FRONTEND = 'APROBADOR_FRONTEND';

    protected $fillable = [
        'name',
        'display_name',
        'description',
    ];

    public static function rules($id = null) {
        return [
            'name' => 'required|string|unique:roles,name,' . ($id ?: "NULL"),
            'display_name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ];
    }
    
    /* public function moduloHTML()
    {
        return $this->hasOne('App\Models\ModuloHtml', 'roles_id', 'id');
    } */
    
    public function moduloExterno()
    {
        return $this->hasOne('App\Models\ModuloExterno', 'roles_id', 'id');
    }
    
    /* public function modulosHtml(){
        return $this->hasMany('App\Models\ModuloHtml', 'roles_id');
    } */

    public function admins() {
        return $this->belongsToMany(Admin::class);
    }

    public function permissions() {
        return $this->belongsToMany(Permission::class);
    }

    public function scopeHasPermission($query, $permission_id) {
        return $this->whereHas('permissions', function ($permissions) use ($permission_id) {
            return $permissions->where('id', $permission_id);
        });
    }

    public function hasPermission($permission_id) {
        return $this->permissions->contains('id', $permission_id);
    }

    private static function eliminarTiposRolEspeciales($tiposRoles){

    //hago el filtrado a mano en vez de usar filter porque me rompe sino (puede ser por la version de php quizas) 
        $filtrados = array();

        foreach($tiposRoles as $tipoRol){
                if($tipoRol->id != TipoRol::DESCUENTO && $tipoRol->id != TipoRol::MODULO_HTML){
                        $filtrados[] = $tipoRol->id;
                }
        }

        return $filtrados;
    }
}
