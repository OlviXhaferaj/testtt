<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
// use Illuminate\Support\Fasades\DB;
use Illuminate\Support\Str;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // $faker = Faker::create();

        \DB::table('users')->insert([
            'name'=>Str::random(4),
            'lastName'=>Str::random(4),
            'nikName'=>Str::random(4),
            'gender' => Str::random(['male','female']),
            'date_of_birth' => 2000/12/12,
            'city' => Str::random(5),
            'email' => Str::random(5).'@gmail.com',
            // 'email_verified_at' => Str::now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
    }
}
