<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
            'name'    => 'cinta',
            'email'    => 'cinta@gmail.com',
            'password'    => bcrypt('secret')
        ]);
    }
}
