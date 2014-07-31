<?php
/**
 * JARIZ.PRO
 * Date: 22/05/2014
 * Time: 09:55
 * Author: JariZ
 */

class AdminSeeder extends \Seeder{
    public function run() {
        \Model\User::truncate();

        $user = new \Model\User;
        $user->email = 'admin@trapped.io';
        $user->password = \Hash::make("123321");
        $user->name = 'Admin';
        $user->reset_code = str_random();
        $user->role_id = 1;
        $user->save();

        $user = new \Model\User;
        $user->email = 'editor@trapped.io';
        $user->password = \Hash::make("123321");
        $user->name = 'Editor';
        $user->reset_code = str_random();
        $user->role_id = 2;
        $user->save();
    }
} 