<?php

use Illuminate\Database\Seeder;

class TermTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('term')->insert([
            [
                'description' => 'T30',
                'days' => 30
            ],
            [
                'description' => 'T7',
                'days' => 7
            ]
        ]);
    }

}
