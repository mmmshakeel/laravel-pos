<?php

use Illuminate\Database\Seeder;

class ModelTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('model')->insert([
            [
                'name' => 'model1',
                'description' => 'Test model1',
                'brand_id' => 1
            ],
            [
                'name' => 'model2',
                'description' => 'Test model2',
                'brand_id' => 2
            ],
            [
                'name' => 'model3',
                'description' => 'Test model3',
                'brand_id' => 3
            ]
        ]);
    }

}
