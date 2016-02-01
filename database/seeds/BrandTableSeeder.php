<?php

use Illuminate\Database\Seeder;

class BrandTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('brand')->insert([
            [
                'name' => 'brand1',
                'description' => 'Test brand1'
            ],
            [
                'name' => 'brand2',
                'description' => 'Test brand2'
            ],
            [
                'name' => 'brand3',
                'description' => 'Test brand3'
            ]
        ]);
    }

}
