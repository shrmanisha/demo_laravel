<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'role_id' => '1',
            'name' => 'Admin',
            'username' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin123')
        ]);
        DB::table('users')->insert([
            'role_id' => '2',
            'name' => 'First Author',
            'username' => 'First Author',
            'email' => 'satu@mail.com',
            'password' => bcrypt('test1234')
        ]);
    }
}
