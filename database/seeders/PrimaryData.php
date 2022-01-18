<?php

namespace Database\Seeders;

use App\Http\Controllers\Customers as ControllersCustomers;
use Illuminate\Database\Seeder;
use App\Models\customers;
use App\Models\Departments;
use App\Models\User;

class PrimaryData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Departments::create([
            'name' => 'Customer'
        ]);
        Departments::create([
            'name' => 'CEO'
        ]);
        User::create([
            'name' => 'Mr. Tester',
            'email' => 'test@gmail.com',
            'password' => '$2a$12$jsUQNDU63Q2Az4X.xaTQl.gjOwCNX7v1WgQMOwAnXQpc7XBgOayD6',
            'role' => 'admin',
            'status' => 'active',
            'department_id' => '2',
        ]);
        User::create([
            'name' => 'Mr. Customer',
            'email' => 'customer@gmail.com',
            'password' => '$2a$12$jsUQNDU63Q2Az4X.xaTQl.gjOwCNX7v1WgQMOwAnXQpc7XBgOayD6',
            'role' => 'customer',
            'status' => 'active',
            'department_id' => '1',
        ]);
        customers::create([
            'user_id' => '2',
            'company_name' => 'Test Company',
            'photo' => 'customer.jpg',
            'phone' => '01163839325',
            'address' => 'Dhaka, Bangladesh',
            'vat_number' => '8935629346',
        ]);
    }
}
