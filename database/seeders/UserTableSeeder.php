<?php

namespace Database\Seeders;

use App\Models\Profile;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        $user = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'admin'     => 1,
            'password'  => Hash::make('password'),
            'created_at'=> now()
        ]);

        Profile::create([
            'user_id' => $user->id,
            'avatar'  => 'uploads/avatars/default.jpg',
            'about'   => 'This is profile',
            'facebook'=> 'www.facebook.com',
            'youtube' => 'www.youtube.com'
        ]);
        
    }
}
