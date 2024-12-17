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
                    <h3 class="font-semibold text-lg mb-4">Details about the transformer character</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <x-character-details
                            :name="$character->name"
                            :image="$character->image"
                            :bio="$character->bio"
                            :alt_mode="$character->alt_mode"
                            :personality="$character->personality"
                            :faction="$character->faction"
                        />
                    </div>
                    <h3 class="font-semibold text-lg mt-8 mb-4">Movies your Transformer has been in:</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        @forelse ($character->movies as $movie)
                            <div class="bg-gray-100 p-4 rounded-lg shadow">
                                <h4 class="text-lg font-semibold">{{ $movie->title }}</h4>
                                @if($movie->poster)
                                    <img src="{{ asset('images/movies/' . $movie->poster) }}" 
                                         alt="{{ $movie->title }}" 
                                         class="w-full h-40 object-cover rounded mt-2">
                                @endif
                            </div>
                        @empty
                            <p class="text-gray-500">No movies related to this character.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
