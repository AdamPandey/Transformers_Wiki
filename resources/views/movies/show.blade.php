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
                    <h3 class="font-semibold text-lg mb-4">Details about the transformer movie</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                        <x-movie-details
                            :title="$movie->title"
                            :image="$movie->image"
                            :release_date="$movie->release_date"
                            :director="$movie->director"

                        />
                    </div>
                    <h4 class="font-semibold text-md mt-8">Toys featured in this movie</h4>
                    @if($movie->toys->isEmpty())
                        <p class="text-gray-600">No Toys added yet.<p>
                    @else
                        <ul class="mt-4 space-y-4">
                            @foreach($movie->toys as $toy)
                                <li class="bg-gray-100 p-4 rounded-lg">
                                    <p class="font-semibold">{{$toy->user->name}} ({{$toy->created_at->format('M, d, Y')}})</p>
                                    <p>Type: {{$toy->type}}</p>
                                    <p>{{$toy->image}}</p>
                                    <p>Toyline: {{$toy->toyline}}</p>
                                    <p>{{$toy->issue_date}}</p>


                                    @if($toy->user->is(auth()->user()) || auth()->user()->role === 'admin')
                                        <a href="{{ route('toys.edit', $toy) }}" class="bg-yellow-500 hover:bg-orange-700 text-white font-bold py-2 px-4 rounded">
                                            {{__('Edit Toy listing')}}
                                        </a>
                                        <form method="POST" action="{{ route('toys.destroy', $toy)}}">
                                            @csrf
                                            @method('delete')
                                            <x-danger-button :href="route('toys.destroy', $toy)"
                                                                onclick="event.preventDefault();this.closest('form')submit();"
                                                {{__('Delete Review')}}
                                            </x-danger-button>
                                        </form>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    @endif

                    <h4 class="font-semibold text-md mt-8">Add your toy</h4>
                    <form action="{{ route('toys.store', $movie) }}"method="POST" enctype="multipart/form-data" class="mt-4">
                        @csrf
                        <div class="mb-4">
                            <label for="type" class="block font-medium text-sm text-gray-700">Toy Type</label>
                            <select name="type" id="type" class="mt-1 block w-full" required>
                                <option value="Voyager class">Voyager class</option>
                                <option value="Commander Class">Commander Class</option>
                                <option value="Legion Class">Legion Class</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input 
                                type="file"
                                name="image"
                                id="image"
                                required
                                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                            />
                            @error('image') <!-- Display error message for image upload -->
                            <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="toyline" class="block font-medium text-sm text-gray-700">Select the toyline</label>
                            <select name="toyline" id="toyline" class="mt-1 block w-full" required>
                                <option value="Main Line">Main Line</option>
                                <option value="Studio Series">Studio Series</option>
                                <option value="Buzzworthy Bumblebee">Buzzworthy Bumblebee</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="issue_date" class="block font-medium text-sm text-gray-700">Select the Issue date</label>
                            <select name="issue_date" id="issue_date" class="mt-1 block w-full" required>
                                <option value="1990">1990</option>
                                <option value="2000">2000</option>
                                <option value="2010">2010</option>
                                <option value="2010">2020</option>
                            </select>
                        </div>

                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Add Your Toy to show everybody!
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
