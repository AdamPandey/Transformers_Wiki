@props(['name', 'image', 'bio', 'alt_mode','personality', 'faction'])

<div class="border rounded-lg shadow-md p-6 bg-white hover:shadow-lg transition duration-300 max-w-xl mx-auto"> <!-- Limit the overall container width to make the component more compact --> 

<!-- Movie Title --> 

<h1 class="font-bold text-black-600 mb-2" style="font-size: 3rem;">{{ $name }}</h1> <!-- Heading with larger text and color --> 

 

<!-- Movie Poster --> 
<div class="overflow-hidden rounded-lg mb-4 flex justify-center"> 
<!-- Image is further restricted to a smaller size --> 

<img src="{{ asset('images/characters/' . $image) }}" alt="{{ $name }}" class="w-full max-w-xs h-auto object-cover"> <!-- Restrict image to max-w-xs (20rem) and ensure responsiveness --> 

</div> 

 


<h2 class="text-gray-500 text-sm italic mb-4" style="font-size: 1rem;">Biography: {{ $bio }}</h2> <!-- Emphasizing year with italics and smaller text --> 

<h2 class="text-gray-500 text-sm italic mb-4" style="font-size: 1rem;">Alternate mode: {{ $alt_mode }}</h2>

<h2 class="text-gray-500 text-sm italic mb-4" style="font-size: 1rem;">Personality: {{ $personality }}</h2>

<h2 class="text-gray-500 text-sm italic mb-4" style="font-size: 1rem;">Faction: {{ $faction }}</h2>
</div> 

