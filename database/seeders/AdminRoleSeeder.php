<?php

namespace Database\Seeders;

use App\Models\AdminRole;
use Illuminate\Database\Seeder;

class AdminRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $unixTimestamp = time();
        for ($i = 0; $i < 10; $i++) :
            $admin_role = new AdminRole();
            $admin_role->admin_role_id = rand(1, 10);
            $admin_role->admin_id = rand(1, 10);
            $admin_role->navigation_id = rand(1, 10);
            $admin_role->parent_id = rand(1, 10);
            $admin_role->test = "Test";
            $admin_role->updated_by = 1;
            $admin_role->created_by = 1;
            $admin_role->deleted_by = 1;
            $admin_role->save();
        endfor;
    }
}
