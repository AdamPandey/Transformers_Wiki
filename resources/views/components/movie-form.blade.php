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
    @isset($movie->image)
        <div class="mb-4">
            <img src="{{asset('images/movies/'.$movie->image)}}" alt="$movie->title" class="w-24 h-32 object-cover">
        </div>
    @endisset
    <div>
        <x-primary-button>
            {{ isset($movie) ? 'Update movie' : 'Add movie' }}
        </x-primary-button>
    </div>
</form>
