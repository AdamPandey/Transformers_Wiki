@props(['action', 'method', 'movie'])
<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT' || $method === 'PATCH')
        @method($method)
    @endif
    <div class="mb-4">
        <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
        <input
            type="text"
            name="title"
            id="title"
            value="{{ old('title', $movie->title ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('title')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="release_date" class="block text-sm font-medium text-gray-700">Release date</label>
        <input
            type="integer"
            name="release_date"
            id="release_date"
            value="{{ old('release_date', $movie->release_date ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('release_date')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Poster</label>
        <input 
            type="file"
            name="image"
            id="image"
            {{ isset($book) ? '' : 'required' }}
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
        />
        @error('image')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    @isset($movie->image)
        <div class="mb-4">
            <img src="{{asset('images/movies/'.$movie->image)}}" alt="$movie->title" class="w-24 h-32 object-cover">
        </div>
    @endisset
    <div class="mb-4">
        <label for="director" class="block text-sm font-medium text-gray-700">Director</label>
        <input
            type="text"
            name="director"
            id="director"
            value="{{ old('director', $movie->director ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('director')
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>
    <div>
        <x-primary-button>
            {{ isset($movie) ? 'Update movie' : 'Add movie' }}
        </x-primary-button>
    </div>
</form>
