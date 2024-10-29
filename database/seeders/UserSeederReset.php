<?php
namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserSeederReset extends Seeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->where('seeding', 1)->delete();
        DB::table('phones')->where('seeding', 1)->delete();
        $max = DB::table('users')->max('id') + 1;
        DB::statement("ALTER TABLE users AUTO_INCREMENT =  $max");
        $max = DB::table('phones')->max('id') + 1;
        DB::statement("ALTER TABLE phones AUTO_INCREMENT =  $max");
    }
}
