<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl ☐ text-gray-800 leading-tight">
            {{__('Create New movie') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7x1 mx-auto sm:px-6 1g:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="font-semibold text-lg mb-4">Add a New Movie:</h3>
                    {{-- Using the MovieForm component for movie creation --}}
                    <x-movie-form
                        :action="route('movies.store')"
                        :method="'POST'"
                    />
                </div>
            </div>
        </div>
    </div>
</x-app-layout>