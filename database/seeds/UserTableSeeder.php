<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->delete();
        $data = [
            [
                'name'=>'Global Nepalese',
                'email'=>'info@globalnepalese.com',
                'password'=>bcrypt('global@123nepalese'),
                'publish'=>1,
                'role'=>'admin',
                'flag'=>1,
               
            ],
            [
                'name'=>'Global',
                'email'=>'info@user.com',
                'password'=>bcrypt('secret'),
                'publish'=>1,
                'role'=>'admin',
                'flag'=>1,
                           ]
            ];
        \App\User::insert($data);
    }
}
