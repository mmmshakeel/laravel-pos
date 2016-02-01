<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('category')->insert([
            [
                'name' => 'cat1',
                'description' => 'Test cat1'
            ],
            [
                'name' => 'cat2',
                'description' => 'Test cat2'
            ],
            [
                'name' => 'cat3',
                'description' => 'Test cat3'
            ]
        ]);
    }

}
