<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('users')->insert([
            'id' => 1,
            'branch_id' => 3,
            'login_name' => 'test1234',
            'password' => bcrypt('test1234'),
            'is_admin' => 0
        ]);
    }

}
