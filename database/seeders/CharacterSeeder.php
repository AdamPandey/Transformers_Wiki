<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Character;

class CharacterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Character::insert([
            ['name' => 'Optimus Prime', 'image' => 'optimus.jpg', 'bio' => 'Leader of the autobots', 'alt_mode' => 'Semitruck' ,'personality' => 'wise and unrelenting in the face of danger and hardship', 'faction' => 'Autobots'],
        ]);
    }
}
