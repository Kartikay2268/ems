<?php

use App\Http\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $password = bcrypt("password1234");

        for($i = 0 ; $i < 20; $i++) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => $password,
                'empId' => (int) $faker->numerify('####'),
                'role'=> $faker->randomElement(['emp', 'manager']),
                'designation' => $faker->randomElement(['Software Developer', 'Product Support Engineer',
                                                            'Product Engineer', 'Billing Associate']),
                'phone' => $faker->numerify('##########'),
                'address' => $faker->address,
                'bloodGroup' => $faker->randomElement(['A+', 'A-', 'B+', 'B-', 'O+', 'O-', 'AB+']),
                'dob' => $faker->date('Y/m/d'),
                'doj' => $faker->date('Y/m/d')
            ]);
        }
    }
}
