<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;


class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       

        $role_customer = new Role();
        $role_customer->name = "customer";
        $role_customer->description = "A role for customer";
        $role_customer->save();

        $role_admin = new Role();
        $role_admin->name = "admin";
        $role_admin->description = "A role for admin";
        $role_admin->save();

    }
}
