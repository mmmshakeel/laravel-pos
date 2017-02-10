<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('supplier')->insert([
        'code' => 'SUP0001',
        'company_name' => 'Supplier 1',
        'address' => 'Test address 1',
        'city' => 'Test city',
        'country_id' => 203,
        'contact_title' => 'Mr',
        'contact_first_name' => 'Test First Name',
        'contact_last_name' => 'Test Last Name',
        'contact_mobile' => '0727505061',
        'phone' => '',
        'email' => 'exampletest@test.com'
        ]);
    }

}
