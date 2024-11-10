<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{_('All Transformers movies')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">List of Transformers movies:</h3>
                    <form action="{{ route('movies.index') }}" method="GET" class="mb-4">
                        <div class="flex flex-col sm:flex-row sm:space-x-4">
                            <input type="text" name="search" value="{{ old('search', $search) }}" placeholder="Search for movies..." class="border rounded p-2 flex-1">
                            
                            <input type="text" name="director" value="{{ old('director', $director) }}" placeholder="Filter by director..." class="border rounded p-2 flex-1 mt-2 sm:mt-0">
                            
                            <input type="number" name="release_year" value="{{ old('release_year', $releaseYear) }}" placeholder="Filter by release year..." class="border rounded p-2 flex-1 mt-2 sm:mt-0" min="1900" max="{{ date('Y') }}">
                            
                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 sm:mt-0">
                                Filter
                            </button>
                        </div>
                    </form>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($movies as $movie)
                    <div class="border p-4 rounded-lg shadow-md">    
                        <a href="{{ route('movies.show', $movie)}}">
                            <x-movie-card
                                :title="$movie->title"
                                :image="$movie->image"
                                :release_date="$movie->release_date"
                                :director="$movie->director"
                            />
                        </a>

                        
                            <div class="mt-4 flex space-x-2">
                                <a href="{{ route('movies.edit', $movie) }}" class="text-gray-600bg-orange-300 hover:bg-orange-700 font-bold py-2 px-4 rounded">
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
                    <div class="mt-4">
                        {{ $movies->links() }} <!-- This will render the pagination links -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <x-alert-success>
        {{session('success')}}
    </x-alert-success>

</x-app-layout> 