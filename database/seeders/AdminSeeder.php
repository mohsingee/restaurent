<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Traits\HasRoles;
use Spatie\Permission\PermissionRegistrar;
class AdminSeeder extends Seeder
{
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'admin',
            'last_name' => 'admin',
            'email' => 'admin@sep.com',
            'password' => bcrypt('00000000'),
            'role' => '0',
        ]);
        $user->syncRoles('Admin');
    }
}
