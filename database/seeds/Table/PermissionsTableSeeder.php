<?php

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {

        // Debug
        $this->addPermission('debug', 'Depurar (Debug)');

        // Admin
        $this->addPermission('view-admins', 'Visualizar Usuarios de Backend');
        $this->addPermission('create-admins', 'Crear Usuarios de Backend');
        $this->addPermission('edit-admins', 'Editar Usuarios de Backend');
        $this->addPermission('delete-admins', 'Eliminar Usuarios de Backend');

        // Role
        $this->addPermission('view-roles', 'Visualizar Roles');
        $this->addPermission('create-roles', 'Crear Roles');
        $this->addPermission('edit-roles', 'Editar Roles');
        $this->addPermission('delete-roles', 'Eliminar Roles');

        // Permission
        $this->addPermission('view-permissions', 'Visualizar Permisos');

        // User
        $this->addPermission('view-users', 'Visualizar Usuarios');
        $this->addPermission('create-users', 'Crear Usuarios');
        $this->addPermission('edit-users', 'Editar Usuarios');
        $this->addPermission('delete-users', 'Eliminar Usuarios');

        // Gift
        $this->addPermission('gift-admins', 'Administrar Regalos');

        // Cliente
        $this->addPermission('view-clients', 'Visualizar Clientes');
        $this->addPermission('create-clients', 'Crear Clientes');
        $this->addPermission('edit-clients', 'Editar Clientes');
        $this->addPermission('delete-clients', 'Eliminar Clientes');

    }

    private function addPermission($name, $display_name, $description = null) {
        $permission = Permission::where('name', '=', $name)->first();
        if (!isset($permission)) {
            $permission = new Permission();
            $permission->name = $name;
        }
        $permission->display_name = $display_name;
        $permission->description = $description ?: $display_name;
        $permission->save();
    }

}
