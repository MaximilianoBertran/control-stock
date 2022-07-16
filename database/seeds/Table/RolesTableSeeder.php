<?php

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $this->createRole(Role::SUPERADMIN, 'Super Administrador', 'Super Administrador del sistema.', Permission::all());
        $this->createRole(Role::GENERADOR_FRONTEND, 'Usuario', 'Rol para acceso de usuario al Frontend sin privilegios.', '');
        $this->createRole(Role::APROBADOR_FRONTEND, 'Usuario Supervisor', 'Usuario con capacidad de aprobar Pines.', '');
    }

    private function createRole($name, $display_name, $description, $permissions) {
        $role = Role::where('name', '=', $name)->first();
        if (!isset($role)) {
            $role = new Role();
        }
        $role->name = $name;
        $role->display_name = $display_name;
        $role->description = $description;

        $role->save();
        if($permissions != ''){
            $role->permissions()->sync($permissions->pluck('id'));
        }
        
    }

}
