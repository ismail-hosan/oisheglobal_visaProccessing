<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email', 'info@itwaybd.com')->first();
        if (is_null($user)) {
            $user = new User();
            $user->name = "ITWAYBD Master";
            $user->phone = "01854125454";
            $user->email = "info@itwaybd.com";
            $user->password = Hash::make('12345678');
            $user->role_id = 1;
            $user->save();
        }
    }
}
