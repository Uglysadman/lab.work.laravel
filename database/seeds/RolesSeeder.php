<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = Role::create([
            'name' => 'User',
            'slug' => 'user',
            'permissions' => [
                'add-comments' => true
            ]
        ]);
        $admin = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'permissions' => [
                'add-posts' => true,
                'add-comments' =>true,
                'edit-posts' => true,
                'edit-comments' => true
            ]
        ]);
    }
}
