<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subcategory_user')->insert([
            [
                'subcategory_id' => 1,
                'user_id' => 1,
            ],
            [
                'subcategory_id' => 1,
                'user_id' => 2,
            ],
            [
                'subcategory_id' => 1,
                'user_id' => 3,
            ],
            [
                'subcategory_id' => 1,
                'user_id' => 4,
            ],
        ]);
    }
}
