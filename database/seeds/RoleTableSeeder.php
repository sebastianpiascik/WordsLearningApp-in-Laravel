<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $role_user = new Role();
        $role_user->name = 'uzytkownik';
        $role_user->description = 'Osoba zarejestrowana';
        $role_user->save();

        $role_redaktor = new Role();
        $role_redaktor->name = 'redaktor';
        $role_redaktor->description = 'redaktor';
        $role_redaktor->save();

        $role_sredaktor = new Role();
        $role_sredaktor->name = 'super_redaktor';
        $role_sredaktor->description = 'super_redaktor';
        $role_sredaktor->save();

        $role_admin = new Role();
        $role_admin->name = 'admin';
        $role_admin->description = 'admin';
        $role_admin->save();
    }
}
