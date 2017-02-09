<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        DB::table('user')->insert([
            'branch_id' => 3,
            'login_name' => 'admin',
            'password' => bcrypt('admin1234'),
            'is_admin' => 1
        ]);
    }

}
