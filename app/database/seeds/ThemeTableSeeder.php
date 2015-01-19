<?php
class ThemeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('book_theme')->delete();
        DB::table('themes')->delete();

        Theme::create(array(
            'name' => 'Roman historique'
        ));
        Theme::create(array(
            'name' => 'Thriller'
        ));
    }

}