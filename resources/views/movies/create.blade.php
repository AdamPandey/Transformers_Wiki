<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create New movie') }} <!-- Display the header for the create new movie page -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> <!-- Corrected the class 'max-w-7x1' to 'max-w-7xl' -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Add a New Movie:</h3>
                    
                    <!-- :action="route('movies.store')" is theRoute to store the new movie -->
                    <!-- :method="'POST'" is the HTTP method for creating a new movie -->
                    <x-movie-form
                        :action="route('movies.store')"
                        :method="'POST'"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>