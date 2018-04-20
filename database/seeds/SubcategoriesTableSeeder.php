<?php

use Illuminate\Database\Seeder;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new \App\Subcategory();
        $cat->name = 'Prywatne zestawy słówek';
        $cat->category_id = 1;
        $cat->save();

        $cat = new \App\Subcategory();
        $cat->name = 'Dni tygodnia';
        $cat->category_id = 2;
        $cat->save();

        $cat = new \App\Subcategory();
        $cat->name = 'Kolory';
        $cat->category_id = 2;
        $cat->save();

        $cat = new \App\Subcategory();
        $cat->name = 'Osoby';
        $cat->category_id = 2;
        $cat->save();

        $cat = new \App\Subcategory();
        $cat->name = 'Ciało';
        $cat->category_id = 4;
        $cat->save();
    }
}
