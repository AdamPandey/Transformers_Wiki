@props(['title', 'release_date', 'image', 'director']) <!-- Define the properties that this component will accept -->

<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300"> <!-- Card container with styles -->
    <h4 class="font-bold text-lg">{{ $title }}</h4> <!-- Movie title displayed in bold -->
    
    <img src="{{ asset('images/movies/' . $image) }}" alt="{{ $title }}" class="w-full h-auto mt-2"> <!-- Movie image with proper asset path -->
    
    <p class="text-gray-600">{{ $release_date }}</p> <!-- Release date of the movie -->
    
    <p class="text-gray-800 mt-4">{{ $director }}</p> <!-- Director of the movie -->
</div>