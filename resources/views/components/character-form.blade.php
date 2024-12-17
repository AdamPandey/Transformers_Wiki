@props(['name', 'image', 'bio', 'alt_mode','personality', 'faction','action', 'method', 'movie']) <!-- Define the properties that this component will accept -->

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"> <!-- Form element with action and method -->
    @csrf <!-- CSRF token for security -->
    @if($method === 'PUT' || $method === 'PATCH') <!-- Check if the method is PUT or PATCH -->
        @method($method) <!-- Include the method as a hidden input -->
    @endif

    <!-- Title Input -->
    <div class="mb-4">
        <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
        <input
            type="string"
            name="name"
            id="name"
            value="{{ old('name', $character->name ?? '') }}" 
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('name') <!-- Display error message for title input -->
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
            {{ isset($book) ? '' : 'required' }} 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
        />
        @error('image') <!-- Display error message for image upload -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Display Existing Movie Image -->
    @isset($character->image) <!-- Check if the movie has an existing image -->
        <div class="mb-4">
            <img src="{{ asset('images/characters/' . $character->image) }}" alt="{{ $character->title }}" class="w-24 h-32 object-cover"> <!-- Display the existing movie image -->
        </div>
    @endisset

    <div class="mb-4">
        <label for="bio" class="block text-sm font-medium text-gray-700">Biography</label>
        <input
            type="string"
            name="bio"
            id="bio"
            value="{{ old('bio', $character->bio ?? '') }}" 
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('bio') <!-- Display error message for title input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="alt_mode" class="block text-sm font-medium text-gray-700">Alternate Form</label>
        <input
            type="string"
            name="alt_mode"
            id="alt_mode"
            value="{{ old('alt_mode', $character->alt_mode ?? '') }}" 
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('alt_mode') <!-- Display error message for title input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="personality" class="block text-sm font-medium text-gray-700">Personality</label>
        <input
            type="string"
            name="personality"
            id="personality"
            value="{{ old('personality', $character->personality ?? '') }}" 
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('personality') <!-- Display error message for title input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="faction" class="block text-sm font-medium text-gray-700">Faction</label>
        <input
            type="string"
            name="faction"
            id="faction"
            value="{{ old('faction', $character->faction ?? '') }}" 
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('faction') <!-- Display error message for title input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>


    <!-- Submit Button -->
    <div>
        <x-primary-button>
            {{ isset($character) ? 'Update Character' : 'Add Your own Character' }} <!-- Change button text based on whether editing or adding a movie -->
        </x-primary-button>
    </div>
</form>