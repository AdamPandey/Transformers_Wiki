<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{_('All Transformers_movies')}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">List of Transformers movies:</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($movies as $movie)
                        <a href="{{ route('movies.show', $movie)}}">
                            <x-movie-card
                                :title="$movie->title"
                                :image="$movie->image"
                                :release_date="$movie->release_date"
                                :director="$movie->director"
                            />
                        </a>
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