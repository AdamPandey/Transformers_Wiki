<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Transformers movies') }} <!-- Display the header for the movies page -->
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">List of Transformers movies:</h3>

                    <!-- Search and filter form  -->
                    <form action="{{ route('movies.index') }}" method="GET" class="mb-4">
                        <div class="flex flex-col sm:flex-row sm:space-x-4">
                            <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Search for movies..." class="border rounded p-2 flex-1">
                            
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0">
                                Search
                            </button>
                        </div>
                        <div class="flex flex-col sm:flex-row sm:space-x-4 mt-4">
                            <input type="text" name="director" value="{{ old('director', $director) }}" placeholder="Filter by director..." class="border rounded p-2 flex-1">
                            
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0">
                                Filter
                            </button>
                        </div>
                    </form>

                    <!-- Movie cards grid -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($movies as $movie) <!-- Loop through each movie -->
                            <div class="border p-4 rounded-lg shadow-md">    
                                <a href="{{ route('movies.show', $movie) }}">
                                    <x-movie-card
                                        :title="$movie->title"
                                        :image="$movie->image"
                                        :release_date="$movie->release_date"
                                        :director="$movie->director"
                                    />
                                </a>

                                <!-- Edit and Delete buttons -->
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('movies.edit', $movie) }}" class="text-gray-600 bg-orange-300 hover:bg-orange-700 font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>
            
                                    <form action="{{ route('movies.destroy', $movie) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-gray-600 font-bold py-2 px-4 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Pagination links -->
                    <div class="mt-4">
                        {{ $movies->links() }} <!-- This will render the pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Success alert for operations -->
    <x-alert-success>
        {{ session('success') }} <!-- Display success message if available -->
    </x-alert-success>
</x-app-layout>