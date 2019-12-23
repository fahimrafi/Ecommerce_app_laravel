<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_customer = Role::where('name','customer')->first();
        $role_admin = Role::where('name','admin')->first();



        $customer = new User();
        $customer->name = "Ibrahim Siddiqui";
        $customer->username = "ibrahim";
        $customer->email = "ibrahim@gmail.com";
        $customer->email_verified_at = now();
        $customer->password = bcrypt('12345678');
        $customer->phone_no = "01753797718";
        $customer->division_id = "1";
        $customer->district_id = "1";
        $customer->street_address = "37/4";
        $customer->save();
        $customer->roles()->attach($role_customer);
        

        $admin = new User();
        $admin->name = "admin";
        $admin->username = "admin";
        $admin->email = "s.m.fahim.ju@gmail.com";
        $admin->email_verified_at = now();
        $admin->password = bcrypt('12345678');
        $admin->phone_no = "01678620172";
        $admin->division_id = "1";
        $admin->district_id = "1";
        $admin->street_address = "37/4";
        $admin->save();
        $admin->roles()->attach($role_admin);
        


    }
}
