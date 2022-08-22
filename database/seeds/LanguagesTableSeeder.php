<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Hash;

use App\Models\System\Language;

class LanguagesTableSeeder extends Seeder
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

        Language::create([
            'title' => 'Tiếng Việt',
            'locale' => "vi",
            'code' => "vi_VN",
            'default' => "1",
            'flag' => "",
            'ordering' => "1",
        ]);

        Language::create([
            'title' => 'English',
            'locale' => "en",
            'code' => "en_GB",
            'default' => "0",
            'flag' => "",
            'ordering' => "2",
        ]);
    }
}
