<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('users')->insert([
            'name' => 'Mario Speedwagon',
            'user_type_id' => 2,
            'gender' => 1,
            'is_active' => 1,
            'sms_notification_active' => 1,
            'email_notification_active' => 1,
            'date_of_birth' => strtotime('1995-10-08'),
            'registration_date' => time(),
            'contact_number' => ''.rand(100000000000,9999999999999).'',
            'email' => 'mspeedwagon@example.com',
            'password' => bcrypt('12345678'),
        ]);

         DB::table('users')->insert([
            'name' => 'Anna Sthesia',
            'user_type_id' => 3,
            'gender' => 2,
            'is_active' => 1,
            'sms_notification_active' => 1,
            'email_notification_active' => 1,
            'date_of_birth' => strtotime('1992-12-08'),
            'registration_date' => time(),
            'contact_number' => ''.rand(100000000000,9999999999999).'',
            'email' => 'asthesia@example.com',
            'password' => bcrypt('12345678'),
        ]);
         DB::table('users')->insert([
            'name' => 'John Wick',
            'user_type_id' => 3,
            'gender' => 2,
            'is_active' => 1,
            'sms_notification_active' => 1,
            'email_notification_active' => 1,
            'date_of_birth' => strtotime('1990-12-08'),
            'registration_date' => time(),
            'contact_number' => ''.rand(100000000000,9999999999999).'',
            'email' => 'jwick@exaample.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
