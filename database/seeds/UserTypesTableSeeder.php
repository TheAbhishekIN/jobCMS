<?php

use Illuminate\Database\Seeder;

class UserTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('user_types')->insert([
            'user_type_name' => 'Seeker',
        ]);
         DB::table('user_types')->insert([
            'user_type_name' => 'Recruiter',
        ]);
         DB::table('user_types')->insert([
            'user_type_name' => 'Super Admin',
        ]);
    }
}
