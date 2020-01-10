<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(BusinessStreamsTableSeeder::class);
        // $this->call(UserTypesTableSeeder::class);
        // $this->call(JobCategoriesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        $this->call(JobPostsSeeder::class);
        // $this->call(CompaniesTableSeeder::class);
    }
}
