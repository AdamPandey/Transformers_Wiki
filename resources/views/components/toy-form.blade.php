@props(['action', 'method', 'movie', 'toy']) <!-- Define the properties that this component will accept -->

<form action="{{ $action }}" method="POST" enctype="multipart/form-data"> <!-- Form element with action and method -->
    @csrf <!-- CSRF token for security -->
    @if($method === 'PUT' || $method === 'PATCH') <!-- Check if the method is PUT or PATCH -->
        @method($method) <!-- Include the method as a hidden input -->
    @endif

    <!-- Type Input -->
    <div class="mb-4">
        <label for="type" class="block text-sm font-medium text-gray-700">Title</label>
        <input
            type="string"
            name="type"
            id="type"
            value="{{ old('type', $toy->type ?? '') }}" 
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('type') <!-- Display error message for title input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Release Date Input -->
    <div class="mb-4">
        <label for="issue_date" class="block text-sm font-medium text-gray-700">Issue date</label>
        <input
            type="integer" 
            name="issue_date"
            id="issue_date"
            value="{{ old('issue_date', $toy->issue_date ?? '') }}"
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('issue_date') <!-- Display error message for release date input -->
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
            {{ isset($toy) ? '' : 'required' }} 
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
        />
        @error('image') <!-- Display error message for image upload -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Display Existing Movie Image -->
    @isset($toy->image) <!-- Check if the movie has an existing image -->
        <div class="mb-4">
            <img src="{{ asset('images/toys/' . $toy->image) }}" alt="{{ $toy->type }}" class="w-24 h-32 object-cover"> <!-- Display the existing movie image -->
        </div>
    @endisset

    <!-- Director Input -->
    <div class="mb-4">
        <label for="toyline" class="block text-sm font-medium text-gray-700">Toyline</label>
        <input
            type="text"
            name="toyline"
            id="toyline"
            value="{{ old('toyline', $toy->toyline ?? '') }}" 
            required
            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm
                focus:ring-indigo-500 focus:border-indigo-500"
        />
        @error('toyline') <!-- Display error message for director input -->
            <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror
    </div>

    <!-- Submit Button -->
    <div>
        <x-primary-button>
            {{ isset($toy) ? 'Update Toy' : 'Save Toy' }} <!-- Change button text based on whether editing or adding a movie -->
        </x-primary-button>
    </div>
</form>