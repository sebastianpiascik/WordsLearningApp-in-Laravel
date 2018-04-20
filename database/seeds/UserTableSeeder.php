<?php

use App\Role;
use App\User;
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
        $role_user = Role::where('name', 'uzytkownik')->first();
        $role_redaktor = Role::where('name', 'redaktor')->first();
        $role_sredaktor = Role::where('name', 'super_redaktor')->first();
        $role_admin  = Role::where('name', 'admin')->first();

        $employee = new User();
        $employee->name = 'admin';
        $employee->email = 'admin@admin.pl';
        $employee->password = bcrypt('admin123');
        $employee->save();
        $employee->roles()->attach($role_admin);

        $employee = new User();
        $employee->name = 'sredaktor';
        $employee->email = 'sredaktor@sredaktor.pl';
        $employee->password = bcrypt('sredaktor123');
        $employee->save();
        $employee->roles()->attach($role_sredaktor);

        $employee = new User();
        $employee->name = 'redaktor';
        $employee->email = 'redaktor@redaktor.pl';
        $employee->password = bcrypt('redaktor123');
        $employee->save();
        $employee->roles()->attach($role_redaktor);

        $employee = new User();
        $employee->name = 'user';
        $employee->email = 'user@user.pl';
        $employee->password = bcrypt('user123');
        $employee->save();
        $employee->roles()->attach($role_user);
    }
}
