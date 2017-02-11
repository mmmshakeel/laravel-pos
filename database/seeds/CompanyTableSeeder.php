<?php

use Illuminate\Database\Seeder;


class CompanyTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('company')->truncate();
        $faker = Faker\Factory::create();

        DB::table('company')->insert([
            'name' => $faker->company,
            'streetName' => $faker->streetName,
            'streetAddress' => $faker->streetAddress,
            'city' => $faker->city,
            'postcode' => $faker->postcode,
            'country_id' => 203,
            'phone' => $faker->phoneNumber
        ]);
    }

}
