<?php

use Illuminate\Database\Seeder;

class StaffTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('staff')->truncate();
        DB::table('staff')->insert([
            'code' => 'T0001',
            'title' => 'Mr',
            'first_name' => 'John',
            'last_name' => 'Mitchel',
            'joined_date' => '2015-11-01',
            'address' => 'test address1',
            'city' => 'test city',
            'country_id' => 203,
            'mobile' => '0727505061',
            'email' => 'mmmshakeel@gmail.com'
        ]);
    }

}
