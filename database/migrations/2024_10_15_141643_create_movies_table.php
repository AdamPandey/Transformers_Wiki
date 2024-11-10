<?php

use Illuminate\Database\Migrations\Migration; // Import Migration class for creating migrations
use Illuminate\Database\Schema\Blueprint; // Import Blueprint class for defining table structure
use Illuminate\Support\Facades\Schema; // Import Schema facade for database operations

return new class extends Migration // Define an anonymous class that extends the Migration class
{
    /**
     * Run the migrations.
     */
    public function up(): void // Method to create the database table
    {
        Schema::create('movies', function (Blueprint $table) { // Create the 'movies' table
            $table->id(); // Create an auto-incrementing primary key column named 'id'
            $table->string('title'); 
            $table->integer('release_date'); 
            $table->text('image'); 
            $table->string('director'); 
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void // Method to drop the database table
    {
        Schema::dropIfExists('movies'); // Drop the 'movies' table if it exists
    }
};
