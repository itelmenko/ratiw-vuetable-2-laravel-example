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
        $count = 1000;
        $faker = Faker\Factory::create();

        $this->command->getOutput()->progressStart($count);

        for($i = 0; $i < $count; $i++) {
            $gender = ['male', 'female'][rand(0, 1)];
            App\Models\Person::create([
                'name' => $faker->name($gender),
                'email' => $faker->email,
                'birthday' => $faker->dateTimeThisCentury,
                'address' => $faker->address,
                'salary' => $faker->randomFloat(NULL, 20000, 300000),
                'gender' => $gender
            ]);
            $this->command->getOutput()->progressAdvance();
        }
        $this->command->getOutput()->progressFinish();
    }
}
