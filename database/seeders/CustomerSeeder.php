<?php

namespace Database\Seeders;

use App\Models\Customer;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $customerType = array('Corporate', 'Local', 'Whole Salar', 'Others');
        // for ($i = 1; $i < 10; $i++) :
        //     $customer = new Customer();
        //     $customer->business_name = "ABC"; //$faker->company;
        //     $customer->customer_type = $customerType[rand(0, 3)];
        //     $customer->branch_id = rand(1, 10);
        //     $customer->customerCode = 'CU' . str_pad($i, 5, "0", STR_PAD_LEFT);
        //     $customer->name = $faker->name;
        //     $customer->email = $faker->email;
        //     $customer->phone = $faker->phoneNumber;
        //     $customer->address = $faker->address;
        //     $customer->city = rand(1, 4); //$faker->city;
        //     $customer->state = rand(1, 4); //$faker->city;
        //     $customer->country = rand(1, 4); //$faker->country;
        //     $customer->pay_term = $faker->languageCode;
        //     $customer->pay_term_type = $faker->languageCode;
        //     $customer->status = 1;
        //     $customer->updated_by = 1;
        //     $customer->created_by = 1;
        //     $customer->deleted_by = 1;
        //     $customer->save();
        // endfor;
        $customers = array(
            array(
                'business_name' => NULL, 'customer_type' => NULL, 'branch_id' => '0', 'customerCode' => 'CU00010', 'name' => 'Engr. T.S. Ayub (Chairman, Saimax Group)', 'email' => 'example101@gmail.com', 'phone' => '080980-90', 'address' => NULL, 'city' => NULL, 'state' => NULL, 'country' => NULL, 'pay_term' => NULL, 'pay_term_type' => NULL, 'status' => 'Active', 'updated_by' => '1', 'created_by' => '1', 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:15:22', 'updated_at' => '2021-12-27 05:18:34'
            ),
            array('business_name' => NULL, 'customer_type' => NULL, 'branch_id' => '0', 'customerCode' => 'CU00015', 'name' => 'Mijanur Rahman Badol ( Chairman, Choloman Shomoy )', 'email' => 'example104@gmail.com', 'phone' => '6465464565', 'address' => NULL, 'city' => NULL, 'state' => NULL, 'country' => NULL, 'pay_term' => NULL, 'pay_term_type' => NULL, 'status' => 'Active', 'updated_by' => NULL, 'created_by' => '1', 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:23:32', 'updated_at' => '2021-12-27 05:23:32'),
            array('business_name' => NULL, 'customer_type' => NULL, 'branch_id' => '0', 'customerCode' => 'CU00016', 'name' => 'Mohammad Amanullah (Chief Consultant)', 'email' => 'example105@gmail.com', 'phone' => '7545454878', 'address' => NULL, 'city' => NULL, 'state' => NULL, 'country' => NULL, 'pay_term' => NULL, 'pay_term_type' => NULL, 'status' => 'Active', 'updated_by' => NULL, 'created_by' => '1', 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:26:15', 'updated_at' => '2021-12-27 05:26:15'),
            array('business_name' => NULL, 'customer_type' => NULL, 'branch_id' => '0', 'customerCode' => 'CU00013', 'name' => 'Mahmudur Rahman Babor ( Founder, University of Comilla )', 'email' => 'example102@gmail.com', 'phone' => '4564646465', 'address' => NULL, 'city' => NULL, 'state' => NULL, 'country' => NULL, 'pay_term' => NULL, 'pay_term_type' => NULL, 'status' => 'Active', 'updated_by' => '1', 'created_by' => '1', 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:17:51', 'updated_at' => '2021-12-27 05:19:14'),
            array('business_name' => NULL, 'customer_type' => NULL, 'branch_id' => '0', 'customerCode' => 'CU00014', 'name' => 'Nurul Huda Bhuiyan Afsari ( Chairman, Quranic Research Foundation )', 'email' => 'example103@gmail.com', 'phone' => '554123131', 'address' => NULL, 'city' => NULL, 'state' => NULL, 'country' => NULL, 'pay_term' => NULL, 'pay_term_type' => NULL, 'status' => 'Active', 'updated_by' => NULL, 'created_by' => '1', 'deleted_by' => NULL, 'deleted_at' => NULL, 'created_at' => '2021-12-27 05:21:27', 'updated_at' => '2021-12-27 05:21:27'),
            array('business_name' => NULL, 'customer_type' => NULL, 'branch_id' => '0', 'customerCode' => 'CU00010', 'name' => 'Dabba', 'email' => 'mrdabba@gmail.com', 'phone' => '+8801529820098', 'address' => 'address', 'city' => NULL, 'state' => NULL, 'country' => NULL, 'pay_term' => NULL, 'pay_term_type' => NULL, 'status' => 'Active', 'updated_by' => NULL, 'created_by' => '1', 'deleted_by' => NULL, 'deleted_at' => '2021-12-27 05:08:42', 'created_at' => '2021-12-27 05:07:16', 'updated_at' => '2021-12-27 05:08:42'),
            array('business_name' => NULL, 'customer_type' => NULL, 'branch_id' => '0', 'customerCode' => 'CU00011', 'name' => 'Timothy Rivers', 'email' => 'bamifu@mailinator.com', 'phone' => '052100', 'address' => 'jory@mailinator.com', 'city' => NULL, 'state' => NULL, 'country' => NULL, 'pay_term' => NULL, 'pay_term_type' => NULL, 'status' => 'Active', 'updated_by' => NULL, 'created_by' => '1', 'deleted_by' => NULL, 'deleted_at' => '2021-12-27 05:09:17', 'created_at' => '2021-12-27 05:07:57', 'updated_at' => '2021-12-27 05:09:17'),
        );

        Customer::insert($customers);
    }
}
