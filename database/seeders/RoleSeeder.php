<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'id'    => 1,
                'name' => 'Admin',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
            [
                'id'    => 2,
                'name' => 'Reviewer',
                'guard_name' => 'web',
                'created_at' =>\DB::raw('CURRENT_TIMESTAMP'),
                'updated_at' =>\DB::raw('CURRENT_TIMESTAMP'),
            ],
        ];
        Role::insert($roles);   
    }
}
