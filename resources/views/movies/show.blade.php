<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Transformers Movies') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-900">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Backdrop Image -->
            <div class="relative">
                @if(!empty($backdrops) && isset($backdrops[0]))
                    <img src="{{ $backdrops[0] }}" alt="{{ $movie->title }}" class="w-full h-64 object-cover rounded-lg shadow-lg">
                @else
                    <img src="{{ asset('images/toys/1734520945.jpg') }}" alt="Default Backdrop" class="w-full h-64 object-cover rounded-lg shadow-lg">
                @endif
                <div class="absolute inset-0 bg-black opacity-50"></div>
                <div class="absolute inset-0 flex items-center justify-center">
                    <h1 class="text-white text-3xl font-bold">{{ $movie->title }}</h1>
                </div>
            </div>

            <div class="bg-gray-800 rounded-lg shadow-lg mt-6 p-6">
                <h3 class="font-semibold text-lg text-white mb-4">Details about the Transformer Movie</h3>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <x-movie-details
                        :title="$movie->title"
                        :image="$movie->image"
                        :release_date="$movie->release_date"
                        :director="$movie->director"
                    />
                </div>


                    <div class="text-white mt-4 lg:mt-0 lg:ml-6 lg:w-1/2">
                        <h2 class="text-xl font-semibold">Overview</h2>

                        <h2 class="text-xl font-semibold mt-4">Videos</h2>
                        @if(!empty($videos))
                            @foreach($videos as $index => $video)
                                @if($index < 3) <!-- Limit to 3 videos -->
                                    <div class="inline-block w-1/3 p-2">
                                        <h3 class="text-lg font-semibold mt-2">{{ $video['name'] }}</h3>
                                        <iframe width="100%" height="200" src="https://www.youtube.com/embed/{{ $video['key'] }}" frameborder="0" allowfullscreen class="rounded-lg shadow-md"></iframe>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <p>No videos available.</p>
                        @endif
                    </div>

                <h4 class="font-semibold text-md mt-8 text-white">Related Characters</h4>
                @if($movie->characters->isEmpty())
                    <p class="text-gray-400">No characters associated with this movie.</p>
                @else
                    <ul class="mt-4 space-y-4">
                        @foreach($movie->characters as $character)
                            <li class="bg-gray-700 p-4 rounded-lg">
                                <p class="font-semibold text-white">{{ $character->name }}</p>
                                <p class="text-gray-300">Biography: {{ $character->bio }}</p>
                                <p class="text-gray-300">Faction: {{ $character->faction }}</p>
                                <p class="text-gray-300">Personality: {{ $character->personality }}</p>
                            </li>
                        @endforeach
                    </ul>
                @endif

                <h4 class="font-semibold text-md mt-8 text-white">Toys Featured in This Movie</h4>
                @if($movie->toys->isEmpty())
                    <p class="text-gray-400">No toys added yet.</p>
                @else
                    <ul class="mt-4 space-y-4">
                        @foreach($movie->toys as $toy)
                        <li class="bg-gray-700 p-4 rounded-lg">
                                <p class="font-semibold text-white">{{ $toy->user->name }} ({{ $toy->created_at->format('M, d, Y') }})</p>
                                <p class="text-gray-300">Type: {{ $toy->type }}</p>
                                <img src="{{ asset('images/toys/' . $toy->image) }}" alt="{{ $toy->type }}" class="w-32 h-32 object-cover rounded-lg shadow-md">
                                <p class="text-gray-300">Toyline: {{ $toy->toyline }}</p>
                                <p class="text-gray-300">Issue Date: {{ $toy->issue_date }}</p>

                                @if ($toy->user->is(auth()->user()) || auth()->user()->role === 'admin')
                                    <div class="mt-2 flex space-x-2">
                                        <a href="{{ route('toys.edit', $toy) }}" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded">
                                            {{ __('Edit Toy Listing') }}
                                        </a>
                                        <form method="POST" action="{{ route('toys.destroy', $toy) }}">
                                            @csrf
                                            @method('delete')
                                            <x-danger-button :href="route('toys.destroy', $toy)"
                                                             onclick="event.preventDefault();this.closest('form').submit();">
                                                {{ __('Delete Toy Listing') }}
                                            </x-danger-button>
                                        </form>
                                    </div>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                @endif

                <h4 class="font-semibold text-md mt-8 text-white">Add Your Toy</h4>
                <form action="{{ route('toys.store', $movie) }}" method="POST" enctype="multipart/form-data" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="type" class="block font-medium text-sm text-gray-300">Toy Type</label>
                        <select name="type" id="type" class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm" required>
                            <option value="Voyager class">Voyager class</option>
                            <option value="Commander Class">Commander Class</option>
                            <option value="Legion Class">Legion Class</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="image" class="block text-sm font-medium text-gray-300">Image</label>
                        <input 
                            type="file"
                            name="image"
                            id="image"
                            required
                            class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm" 
                        />
                        @error('image')
                        <p class="text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="toyline" class="block font-medium text-sm text-gray-300">Select the Toyline</label>
                        <select name="toyline" id="toyline" class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm" required>
                            <option value="Main Line">Main Line</option>
                            <option value="Studio Series">Studio Series</option>
                            <option value="Buzzworthy Bumblebee">Buzzworthy Bumblebee</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="issue_date" class="block font-medium text-sm text-gray-300">Select the Issue Date</label>
                        <select name="issue_date" id="issue_date" class="mt-1 block w-full bg-gray-700 text-white border-gray-600 rounded-md shadow-sm" required>
                            <option value="1990">1990</option>
                            <option value="2000">2000</option>
                            <option value="2010">2010</option>
                            <option value="2020">2020</option>
                        </select>
                    </div>

                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Add Your Toy to Show Everybody!
                    </button>
                </form>

                <h2 class="text-xl font-semibold mt-4 text-white">Cast</h2>
                <div class="max-h-60 overflow-y-auto bg-gray-800 rounded-lg p-4">
                    @if(!empty($cast))
                        <ul class="list-disc list-inside">
                            @foreach($cast as $actor)
                                <li class="text-white">{{ $actor['name'] }} as {{ $actor['character'] }}</li>
                            @endforeach
                        </ul>
                    @else
                        <p class="text-gray-400">No cast information available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>