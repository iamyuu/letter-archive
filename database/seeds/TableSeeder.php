<?php

use App\User;
use App\Role;
use App\Type;
use App\Letter;
use App\Forward;
use Faker\Factory;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$Faker = Factory::create();

    	Role::create(['role' => 'sa']);
        Role::create(['role' => 'direktur']);
    	Role::create(['role' => 'seketaris']);
    	Role::create(['role' => 'division']);

    	User::create([
    		'name'	 	=> 'Super Admin',
            'gender' 	=> 1,
            'email'  	=> 'sa@example.net',
            'phone'  	=> $Faker->phoneNumber,
            'address'	=> $Faker->address,
            'username'	=> 'sys',
            'password'	=> bcrypt('root'),
            'role_id'	=> 1
    	]);

        User::create([
            'name'      => 'Yuu',
            'gender'    => 1,
            'email'     => 'yuu@example.net',
            'phone'     => $Faker->phoneNumber,
            'address'   => $Faker->address,
            'username'  => 'yuu',
            'password'  => bcrypt('root'),
            'role_id'   => 2
        ]);

    	User::create([
    		'name'	 	=> $Faker->name,
            'gender' 	=> 2,
            'email'  	=> $Faker->safeEmail,
            'phone'  	=> $Faker->phoneNumber,
            'address'	=> $Faker->address,
            'username'	=> 'seketaris',
            'password'	=> bcrypt('root'),
            'role_id'	=> 3
    	]);

        User::create([
            'name'      => 'Raffe',
            'gender'    => 2,
            'email'     => 'raffe@example.net',
            'phone'     => $Faker->phoneNumber,
            'address'   => $Faker->address,
            'username'  => 'raffe',
            'password'  => bcrypt('root'),
            'role_id'   => 4
        ]);

        User::create([
            'name'      => 'Emmpy',
            'gender'    => 2,
            'email'     => 'emmy@example.net',
            'phone'     => $Faker->phoneNumber,
            'address'   => $Faker->address,
            'username'  => 'emmy',
            'password'  => bcrypt('root'),
            'role_id'   => 4
        ]);

    	Type::create(['type' => 'Surat Pengajuan']);
    	Type::create(['type' => 'Surat Dinas']);

        $msg = 'I enjoyed meeting with you last week to discuss the available Staff Supervisor position at New Parkland Hospital. While I am certainly grateful for your job offer, and still firmly believe it will be an exciting opportunity for me, I would like to continue negotiations concerning the salary you suggested.<br><br> Your salary offer was certainly generous. However, I would like to counter for a salary of $47,000. I believe this is justified due to my extensive experience working within the medical field, including more than a decade in administrative positions. Additionally, I have continued to take occasional online courses to keep me updated on urrent technology and trends.<br><br> I have researched Staff Supervisor salaries extensively before making this counter offer to ensure that I was making a fair request. As I mentioned during our interview, I think this position offers a lot of exciting possibilities. Since I am a people person with proven leadership abilities, I believe I will make a valuable addition to your staff after working out this remaining detail.<br><br> I look forward to the opportunity to schedule another meeting with you at your convenience to further discuss my reasonable salary request. Thank you for your time.<br><br>';

        $mail_id = "";
        for ($i = 1; $i <= 15; $i++) {
            if ($i < 10) {
                $mail_id = "#LTR000".$i;
            } elseif ($i < 100) {
                $mail_id = "#LTR00".$i;
            } elseif ($i < 1000) {
                $mail_id = "#LTR0".$i;
            } elseif ($i < 10000) {
                $mail_id = "#LTR".$i;
            } else {
                $mail_id = "#LTR0001";
            }
        }

        foreach (range(1, 30) as $i) {
            Letter::create([
                'id' => '#LTR'.$mail_id,
                'incoming_at'  => '2017-'.mt_rand(01, 12).'-'.mt_rand(01, 20),
                'mail_code'    => mt_rand(001, 999).'/LTR/'.date('Y'),
                'mail_from'    => 'Example Company',
                'mail_to'      => 'Example Company',
                'mail_subject' => 'Example',
                'mail_content' => $msg,
                'in_out' => mt_rand(1, 2)
            ]);
        }
    }
}
