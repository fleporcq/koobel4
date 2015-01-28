<?php

class UserTableSeeder extends Seeder
{

    public function run()
    {
        DB::table('users')->delete();

        User::create(array(
           "email" => "fleporcq@gmail.com",
           "password" => Hash::make('fleporcq')
        ));
    }
}