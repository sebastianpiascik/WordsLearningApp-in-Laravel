<?php

use Illuminate\Database\Seeder;

class WordsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cat = new \App\Word();
        $cat->word = 'poniedziałek;monday';
        $cat->words_list_id = 1;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'wtorek;tuesday';
        $cat->words_list_id = 1;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'środa;wednesday';
        $cat->words_list_id = 1;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'czwartek;thursday';
        $cat->words_list_id = 1;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'piątek;friday';
        $cat->words_list_id = 1;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'sobota;saturday';
        $cat->words_list_id = 1;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'niedziela;sunday';
        $cat->words_list_id = 1;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'czerwony;red';
        $cat->words_list_id = 2;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'niebieski;blue';
        $cat->words_list_id = 2;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'żółty;yellow';
        $cat->words_list_id = 2;
        $cat->save();

        $cat = new \App\Word();
        $cat->word = 'różowy;pink';
        $cat->words_list_id = 2;
        $cat->save();
    }
}
