<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Transformers Movies') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 rounded-lg shadow-lg p-6">
                <h3 class="font-semibold text-lg text-white mb-4">List of Transformers Movies:</h3>

                <!-- Search and filter form -->
                <form action="{{ route('movies.index') }}" method="GET" class="mb-4">
                    <div class="flex flex-col sm:flex-row sm:space-x-4">
                        <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Search for movies..." class="border rounded p-2 flex-1 bg-gray-700 text-white placeholder-gray-400">
                        
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0">
                            Search
                        </button>
                    </div>
                    <div class="flex flex-col sm:flex-row sm:space-x-4 mt-4">
                        <input type="text" name="director" value="{{ old('director', $director) }}" placeholder="Filter by director..." class="border rounded p-2 flex-1 bg-gray-700 text-white placeholder-gray-400">
                        
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0">
                            Filter
                        </button>
                    </div>
                </form>

                <!-- Movie cards grid -->
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($movies as $movie)
                        <div class="bg-gray-900 rounded-lg overflow-hidden shadow-md transition-transform transform hover:scale-105">
                            <a href="{{ route('movies.show', $movie) }}">
                                <x-movie-card
                                    :title="$movie->title"
                                    :image="$movie->image"
                                    :release_date="$movie->release_date"
                                    :director="$movie->director"
                                />
                            </a>

                            <!-- Edit and Delete buttons -->
                            @if(auth()->user()->role === 'admin')
                                <div class="mt-4 flex space-x-2">
                                    <a href="{{ route('movies.edit', $movie) }}" class="text-gray-600 bg-orange-300 hover:bg-orange-500 font-bold py-2 px-4 rounded">
                                        Edit
                                    </a>
                
                                    <form action="{{ route('movies.destroy', $movie) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Pagination links -->
                <div class="mt-4">
                    {{ $movies->links() }}
                </div>
            </div>
        </div>
    </div>

    <!-- Success alert for operations -->
    <x-alert-success>
        {{ session('success') }}
    </x-alert-success>
</x-app-layout>