<?php

use Illuminate\Database\Seeder;

class WordsListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new \App\WordsList();
        $cat->name = 'Łatwe';
        $cat->type = 'publiczny';
        $cat->subcategory_id = 1;
        $cat->user_id = 1; // Every words list default owner is admin
        $cat->save();
    }
}
