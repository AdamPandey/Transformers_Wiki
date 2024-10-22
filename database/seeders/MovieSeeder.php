<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie;
use Carbon\Carbon;

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentTimestamp = Carbon::now();
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
            'director'=>'Josh Cooley']
        ]);
    }
}
