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
                </div>
            </div>
        </div>
    </div>
    <x-alert-success>
        {{session('success')}}
    </x-alert-success>

</x-app-layout> 