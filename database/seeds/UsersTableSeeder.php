<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //create a user
       $user = App\User::create([
            'name'=>'Alex castillo',
            'email'=>'gcastillo@gmail.com',
            'password'=>bcrypt('password'),
            'admin'=>1
        ]);

        //create a profile
        App\Profile::create([
            'user_id'=>$user->id,
            'avatar'=>'uploads/avatars/nouname.jpg',
            'about'=>'he is an American actor. He began acting professionally in the early 2000s, and rose to prominence in the late 2000s for his leading role in the High School Musical franchise (2006–2008).',
            'facebook'=>'facebook.com',
            'youtube'=>'youtube.com'
        ]);
    }
}
