<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        Model::unguard();

        $this->call(BranchTableSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(CompanyTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(ModelTableSeeder::class);
        $this->call(ProductTypeTableSeeder::class);
        $this->call(ShippingServiceProviderTableSeeder::class);
        $this->call(StaffTableSeeder::class);
        $this->call(SupplierTableSeeder::class);
        $this->call(TermTableSeeder::class);
        $this->call(UsersTableSeeder::class);

        Model::reguard();
    }

}
