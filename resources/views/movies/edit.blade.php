<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Movie') }} <!-- Display the header for the edit movie page -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Key comments for the movie form -->
                    <!-- The movie form component is used here to edit the movie details. -->
                    <!-- It passes the action route, method type, and the movie object to the form component. -->
                    
                    <h3 class="font-semibold text-lg mb-4">Edit Movie:</h3>
                    <!-- "route('movies.update', $movie)"  is the route to update the movie, passing the movie object -->
                    <!--method="'PUT'" is the HTTP method for updating the movie -->
                    <!--:movie="$movie" passes the current movie data to the form -->
                    <x-movie-form
                        :action="route('movies.update', $movie)" 
                        :method="'PUT'" 
                        :movie="$movie"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>