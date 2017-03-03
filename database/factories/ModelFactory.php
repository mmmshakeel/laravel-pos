<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\Staff::class, function (Faker\Generator $faker) {
    return [
        'code' => $faker->numberBetween(1000, 5000),
        'title' => $faker->title,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'joined_date' => $faker->date,
        'address' => $faker->address,
        'city' => $faker->city,
        'country_id' => 203
        'mobile' => $faker->e164PhoneNumber,
        'date_of_birth' => $faker->date,
        'gender' => 'M'
        'contact_person_title' => $faker->title,
        'contact_person_first_name' $faker->firstName,
        'contact_person_relation' => 'Relation',
        'contact_person_contact_no' => $faker->e164PhoneNumber
    ];
}

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'branch_id' => 1,
        'staff_id' => function() {
            return factory(App\Staff::class)->create()->id;
        },
        'login_name' => $faker->userName,
        'is_admin' => 1
    ];
});
