<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Migrations\Migration;

class CreateAdminPermissionView extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement("" .
            "CREATE VIEW admin_permission AS (" .
                "SELECT admin_id, permission_id " .
                  "FROM admin_role " .
                  "JOIN permission_role " .
                    "ON admin_role.role_id = permission_role.role_id" .
            ")" . 
        "");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP VIEW IF EXISTS admin_permission");
    }
}
