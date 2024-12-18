@props(['action', 'method', 'movie']) <!-- Define the properties that this component will accept -->

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"> <!-- Form element with action and method -->
    @csrf <!-- CSRF token for security -->
    @if($method === 'PUT' || $method === 'PATCH') <!-- Check if the method is PUT or PATCH -->
        @method($method) <!-- Include the method as a hidden input -->
    @endif

    <!-- Title Input -->
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
        @error('title') <!-- Display error message for title input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Release Date Input -->
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
        @error('release_date') <!-- Display error message for release date input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Image Upload Input -->
    <div class="mb-4">
        <label for="image" class="block text-sm font-medium text-gray-700">Poster</label>
        <input 
            type="file"
            name="image"
            id="image"
            {{ isset($movie) ? '' : 'required' }} 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
        />
        @error('image') <!-- Display error message for image upload -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Display Existing Movie Image -->
    @isset($movie->image) <!-- Check if the movie has an existing image -->
        <div class="mb-4">
            <img src="{{ asset('images/movies/' . $movie->image) }}" alt="{{ $movie->title }}" class="w-24 h-32 object-cover"> <!-- Display the existing movie image -->
        </div>
    @endisset

    <!-- Director Input -->
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
        @error('director') <!-- Display error message for director input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div>
        <x-primary-button>
            {{ isset($movie) ? 'Update movie' : 'Add movie' }} <!-- Change button text based on whether editing or adding a movie -->
        </x-primary-button>
    </div>
</form>

<!-- Explanation of the Code:
1. **Props Declaration**: The component accepts three properties: `action`, `method`, and `movie`.
2. **Form Element**: The form uses the specified action and method, including CSRF protection.
3. **Method Handling**: If the method is PUT or PATCH, it adds a hidden input for the method.
4. **Title Input**: A text input for the movie title, with error handling for validation.
5. **Release Date Input**: An input for the release date; note that it should ideally be