<?php

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        for($i = 0; $i < 1000; $i++) {
            App\Models\Person::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'birthday' => $faker->dateTimeThisCentury,
                'address' => $faker->address,
                'salary' => $faker->randomFloat(NULL, 20000, 300000)
            ]);
        }
    }
}
