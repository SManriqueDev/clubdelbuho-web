<?php

use App\Models\Account;
use App\Models\Contact;
use App\Models\Organization;
use App\Models\User;
use Database\Seeders\ExerciseSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        User::firstOrCreate(
            ['email' => 'johndoe@example.com'],
            factory(User::class)->make([
                'name' => 'John Doe',
            ])->toArray()
        );

        $this->call([
            CountrySeeder::class,
            DepartmentSeeder::class,
            CitySeeder::class,
        ]);
    }
}
