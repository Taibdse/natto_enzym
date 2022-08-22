<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

use App\Models\System\Admin;

class AdminTableSeeder extends Seeder
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

        for ($i = 1; $i <= 5; $i++) {
            Admin::create([
                'name' => $faker->name,
                'email' => "admin{$i}@gmail.com",
                'role_id' => -1,
                'password' => Hash::make("admin{$i}@gmail.com"),
            ]);
        }
    }
}
