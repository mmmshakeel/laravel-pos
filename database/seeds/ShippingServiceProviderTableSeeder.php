<?php

use Illuminate\Database\Seeder;

class ShippingServiceProviderTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('shipping_service_provider')->insert([
            [
                'name' => 'Ship service 1'
            ],
            [
                'name' => 'Ship service 2'
            ]
        ]);
    }

}
