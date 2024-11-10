<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use Carbon\Carbon; // Import Carbon for date and time manipulation

class MovieSeeder extends Seeder // Define the MovieSeeder class that extends the Seeder class
{
    /**
     * Run the database seeds.
     */
    public function run(): void // Method that will be executed to seed the movies table
    {
        $currentTimestamp = Carbon::now();// Get the current timestamp using Carbon (not used in the insert but can be useful)
         // Insert multiple movie records into the movies table
        Movie::insert([
            ['title'=> 'Transformers','release_date'=>'2007','image'=>'1.jpg',
                'director'=>'Michael Bay'],
            ['title'=> 'Transformers Revenge of the fallen','release_date'=>'2009','image'=>'2.jpg',
                'director'=>'Michael Bay'],
            ['title'=> 'Transformers Dark of The Moon','release_date'=>'2011','image'=>'3.jpg',
                'director'=>'Michael Bay'],
            ['title'=> 'Transformers Age Of Extinction','release_date'=>'2014','image'=>'4.jpg',
                'director'=>'Michael Bay'],
            ['title'=> 'Transformers The Last Knight','release_date'=>'2017','image'=>'5.jpg',
                'director'=>'Michael Bay'],
            ['title'=> 'Transformers One','release_date'=>'2024','image'=>'6.jpg',
            'director'=>'Josh Cooley'],
            ['title'=> 'Bumblebee','release_date'=>'2018','image'=>'7.jpg',
            'director'=>'Travis Knight'],
            ['title'=> 'Transformers Rise of The Beasts','release_date'=>'2023','image'=>'8.jpg',
            'director'=>'Stephen Caple'],
            ['title'=> 'Transformers Predacons Rising','release_date'=>'2013','image'=>'9.jpg',
            'director'=>'Scooter Tidwell'],
            ['title'=> 'The Transformers','release_date'=>'1984','image'=>'10.jpg',
            'director'=>'Nelson Shinn'],
            ['title'=> 'Beast Wars','release_date'=>'1996','image'=>'11.jpg',
            'director'=>'Akira Nishimori'],
            ['title'=> 'Beast Machines','release_date'=>'1999','image'=>'12.jpg',
            'director'=>'Marty Isenberg'],
            ['title'=> 'Robots in Disguise','release_date'=>'2000','image'=>'13.jpg',
            'director'=>'Osamu Sekita'],
            ['title'=> 'Armada','release_date'=>'2002','image'=>'14.jpg',
            'director'=>'Hidehito Ueda'],
            ['title'=> 'Energon','release_date'=>'2004','image'=>'15.jpg',
            'director'=>'Eugene Ishikawa'],
            ['title'=> 'Transformers Cybertron','release_date'=>'2005','image'=>'16.jpg',
            'director'=>'Manabu Ono'],
            ['title'=> 'Transformers Animated','release_date'=>'2007','image'=>'17.jpg',
            'director'=>'Sam Register'],
            ['title'=> 'Transformers Prime','release_date'=>'2010','image'=>'18.jpg',
            'director'=>'Roberto Orci']
        ]);
    }
}
