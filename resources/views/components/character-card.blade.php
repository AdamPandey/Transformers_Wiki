@props(['name', 'image', 'bio', 'alt_mode','personality', 'faction']) <!-- Define the properties that this component will accept -->

<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300"> <!-- Card container with styles -->
    <h4 class="font-bold text-lg">{{ $name }}</h4> <!-- Movie title displayed in bold -->
    
    <img src="{{ asset('images/characters/' . $image) }}" alt="{{ $name }}" class="w-full h-auto mt-2"> <!-- Movie image with proper asset path -->
    
    <p class="text-gray-600">{{ $bio }}</p> <!-- Release date of the movie -->
    
    <p class="text-gray-800 mt-4">{{ $alt_mode }}</p> <!-- Director of the movie -->

    <p class="text-gray-800 mt-4">{{ $personality }}</p>

    <p class="text-gray-800 mt-4">{{ $faction }}</p>
</div>