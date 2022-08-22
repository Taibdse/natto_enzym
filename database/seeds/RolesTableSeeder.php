<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

use App\Models\System\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        Role::create([
            'title' => 'Admin',
            'description' => '',
            'permission' => '',
            'default' => 1,
            'ordering' => 1,
        ]);

        Role::create([
            'title' => 'Staff',
            'description' => '',
            'permission' => '',
            'default' => 0,
            'ordering' => 2,
        ]);
    }
}
