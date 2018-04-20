<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("ALTER TABLE roles AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE users AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE categories AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE subcategories AUTO_INCREMENT = 1");
        DB::statement("ALTER TABLE words AUTO_INCREMENT = 1");
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(WordsListsTableSeeder::class);
        $this->call(WordsTableSeeder::class);
        $this->call(PermissionsSeeder::class);
    }
}
