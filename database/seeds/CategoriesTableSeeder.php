<?php

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new \App\Category();
        $cat->name = 'Własne zestawy';
        $cat->save();

        $cat = new \App\Category();
        $cat->name = 'Podstawy';
        $cat->save();

        $cat = new \App\Category();
        $cat->name = 'Dom';
        $cat->save();

        $cat = new \App\Category();
        $cat->name = 'Człowiek';
        $cat->save();


    }
}
