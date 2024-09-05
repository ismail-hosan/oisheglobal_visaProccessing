<?php

namespace Database\Seeders;

use App\Models\UserManage;
use Illuminate\Database\Seeder;

class UserManageSeeder extends Seeder
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
            $userManage = new UserManage();
            $userManage->firstname = "sdnaffo";
            $userManage->lastname = "sdnaffo";
            $userManage->email = "sdnaffo";
            $userManage->phone = "sdnaffo";
            $userManage->branch_id = rand(1, 10);
            $userManage->status_id = rand(1, 10);
            $userManage->role_id = rand(1, 10);
            $userManage->updated_by = 1;
            $userManage->created_by = 1;
            $userManage->deleted_by = 1;
            // $userManage->deleted_at = $faker->dateTime($unixTimestamp);
            $userManage->save();
        endfor;
    }
}
