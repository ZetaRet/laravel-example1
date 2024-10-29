<?php
namespace Database\Seeders;

use DB;
use Str;
use Hash;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UserSeeder extends Seeder
{

    public $limit = 10;

    use UserNamesTrait;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::connection()->disableQueryLog();
        $limit = $this->limit;
        $data = array();
        for ($i = 0; $i < $limit; $i ++) {
            $user = self::generateUser($i);
            array_push($data, $user);
        }
        DB::table('users')->insert($data);
        $user_ids = DB::table('users')->where('seeding', 2)->get();
        $phones = array();
        foreach ($user_ids as $user) {
            $phone = self::generatePhone($user->id, 'public');
            array_push($phones, $phone);
            $phone = self::generatePhone($user->id, 'private');
            array_push($phones, $phone);
            $phone = self::generatePhone($user->id, 'home');
            array_push($phones, $phone);
            $phone = self::generatePhone($user->id, 'office');
            array_push($phones, $phone);
            $phone = self::generatePhone($user->id, 'work');
            array_push($phones, $phone);
        }
        DB::table('users')->where('seeding', 2)->update(array(
            'seeding' => 1
        ));
        DB::table('phones')->insert($phones);
    }

    private function getUsername(): string
    {
        $c = count($this->usernames);
        $i = random_int(0, $c - 1);
        return $this->usernames[$i];
    }

    private function generateUser(int $i)
    {
        $now = Carbon::now();
        $time = time();
        $user = [
            'name' => $this->getUsername(),
            'name_parent' => $this->getUsername(),
            'name_family' => $this->getUsername(),
            'email' => Str::random(10) . '_' . $time . '_' . $i . '@email.mkom',
            'password' => Hash::make('nopassword'),
            'identity_number' => self::generateRandomNumber(14),
            'civil_id' => self::generateRandomNumber(11),
            'created_at' => $now,
            'updated_at' => $now,
            'seeding' => 2
        ];
        return $user;
    }

    private function generatePhone(int $userid, string $type)
    {
        $now = Carbon::now();
        $phone = [
            'user_id' => $userid,
            'phone_type' => $type,
            'phone_ext' => self::generateRandomNumber(3),
            'phone_number' => self::generateRandomNumber(11),
            'created_at' => $now,
            'updated_at' => $now,
            'seeding' => 1
        ];
        return $phone;
    }

    private function generateRandomNumber($length)
    {
        $characters = '0123456789';
        $charactersLength = strlen($characters);
        $randomString = '';

        for ($i = 0; $i < $length; $i ++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}

?>