<?php

use App\Models\Admin;
use App\Models\Role;
use Illuminate\Database\Seeder;

class AdminsTableSeeder extends Seeder {

    /**
     * Seed the application's admins (backend users).
     *
     * @return void
     */
    public function run() {
        $this->createAdmin('superadmin', 'superadmin', 'Super', 'Admin', [Role::SUPERADMIN]);
    }

    protected function createAdmin($username, $password, $name, $lastname, $rolenames) {
        $admin = Admin::where('username', $username)->first();
        if (!$admin) {
            $admin = new Admin();
            $admin->username = $username;
            $admin->password = Hash::make($password);
        }
        $admin->name = $name;
        $admin->lastname = $lastname;

        $admin->save();

        $roles = Role::whereIn('name', $rolenames)->pluck('id');
        $admin->roles()->sync($roles);
    }
}
