<?php
namespace Database\Seeders;

class UserSeeder100 extends UserSeeder
{

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->limit = 100;
        parent::run();
    }
}

?>