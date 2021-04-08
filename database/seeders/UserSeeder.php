<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserModel;
use App\Models\RoleModel;
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
        $user = UserModel::create([
            'name' => "Admin Name",
            'email' => "admin@example.com",
            'password' => Hash::make('password'),
            'verified' => 1,
        ]);
        $admin_role = RoleModel::create([
            'name' => 'admin',
        ]);
        $subscriber_role = RoleModel::create([
            'name' => 'subscriber'
        ]);
        $subscriber_role = RoleModel::create([
            'name' => 'teamMember'
        ]);
        $user->roles()->attach($admin_role->id);
    }
}
