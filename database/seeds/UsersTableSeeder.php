<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => 'ouss97@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$Fk04FPZbZdSdMDHiJV7RnO2ZCu54Q4zYSqHfbdVxtxDnke0LGFmRC',
                'remember_token' => NULL,
                'created_at' => '2019-09-18 13:13:24',
                'updated_at' => '2019-09-18 13:13:24',
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'oussama@genio.ma',
                'email_verified_at' => NULL,
                'password' => '$2y$10$7C3.qrbULejl4vaz.RrYhO3qZwyTqwLIkiulnUpH5WB8crfXrjDPq',
                'remember_token' => NULL,
                'created_at' => '2019-09-18 13:13:56',
                'updated_at' => '2019-09-18 13:13:56',
            ),
            2 => 
            array (
                'id' => 3,
                'email' => 'ouss@gmail.com',
                'email_verified_at' => NULL,
                'password' => 'azer1234',
                'remember_token' => NULL,
                'created_at' => '2019-09-18 13:49:00',
                'updated_at' => '2019-09-18 13:49:00',
            ),
            3 => 
            array (
                'id' => 4,
                'email' => 'sou@gmail.com',
                'email_verified_at' => NULL,
                'password' => 'azer1234',
                'remember_token' => NULL,
                'created_at' => '2019-09-18 13:58:42',
                'updated_at' => '2019-09-18 13:58:42',
            ),
            4 => 
            array (
                'id' => 6,
                'email' => 'dez',
                'email_verified_at' => NULL,
                'password' => 'zefezf',
                'remember_token' => NULL,
                'created_at' => '2019-09-18 14:02:40',
                'updated_at' => '2019-09-18 14:02:40',
            ),
            5 => 
            array (
                'id' => 7,
                'email' => 'ouss@aa.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$D2qQ0al4wBpnPLez54S.yOHBp4LhxG.gOkzams8/X1Tsq/ExBzPvO',
                'remember_token' => NULL,
                'created_at' => '2019-09-18 14:06:58',
                'updated_at' => '2019-09-18 15:40:07',
            ),
            6 => 
            array (
                'id' => 8,
                'email' => 'zdz',
                'email_verified_at' => NULL,
                'password' => '$2y$10$AOaWM8HdnecdtU3tFa4DhenJMyNX6XmWJaswivME.SH1WVJ17blTe',
                'remember_token' => NULL,
                'created_at' => '2019-09-18 14:15:22',
                'updated_at' => '2019-09-18 14:15:22',
            ),
            7 => 
            array (
                'id' => 10,
                'email' => 'ouss@g.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$rgtN43PgFKmcpqpReUDWnO66h6/27p4BZghA4s1aZcq1X7BruZSMO',
                'remember_token' => NULL,
                'created_at' => '2019-09-18 15:28:13',
                'updated_at' => '2019-09-18 15:28:13',
            ),
            8 => 
            array (
                'id' => 11,
                'email' => 'test@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$wgvYekJiTlsqtXLYzzo16uOSgaLrIN5GqHxGhoP0gZtzyXOZGpkzm',
                'remember_token' => NULL,
                'created_at' => '2019-09-20 16:07:19',
                'updated_at' => '2019-09-20 16:07:19',
            ),
            9 => 
            array (
                'id' => 12,
                'email' => 'test@aa.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$tywwGiSzFHyoMNa/RJ5tpeUErTyE0x0eUWCufdjimCTUf6wl8S4OW',
                'remember_token' => NULL,
                'created_at' => '2019-09-20 16:09:24',
                'updated_at' => '2019-09-20 16:09:24',
            ),
        ));
        
        
    }
}