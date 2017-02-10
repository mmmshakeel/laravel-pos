<?php

use Illuminate\Database\Seeder;

class BranchTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('branch')->insert([
            [
                'code' => 'BR001',
                'description' => 'Branch Nugegoda - EDITED',
                'address' => 'No 123, Main Road, Nugegoda - E',
                'city' => 'Nugegoda-E',
                'country_id' => '203',
                'contact_no' => '0112256111',
                'contact_email' => 'ngbranch@test.com'
            ],
            [
                'code ' => 'BR002',
                'description ' => 'Test 2',
                'address ' => 'Galle Road, Bambalapitiya',
                'city ' => 'Bambalapitiya',
                'country_id ' => '203',
                'contact_no ' => '0112256789',
                'contact_email ' => 'bmbranch@test.com'
            ]
        ]);
    }

}
