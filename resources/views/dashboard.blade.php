<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-white leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="min-h-screen" style="background-image: url('{{ asset('images/characters/1734517667.jpg') }}'); background-size: cover; background-position: center;">
        <div class="py-12 bg-black bg-opacity-70">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6 text-gray-300">
                        <h3 class="text-3xl font-bold mb-4 text-center">Welcome to the Transformers Dashboard!</h3>
                        <p class="mb-4 text-center">{{ __("You're logged in!") }}</p>
                        <p class="mb-4 text-center">Explore the latest Transformers movies, characters, and toys!</p>
                        
                        <div class="mt-6">
                            <h4 class="text-xl font-semibold mb-2 text-center">Quick Links</h4>
                            <ul class="space-y-2">
                                <li class="text-center">
                                    <a href="{{ route('movies.index') }}" class="block w-full text-center py-2 rounded-lg text-white transition duration-300 bg-gradient-to-r from-red-500 to-yellow-500 hover:from-red-600 hover:to-yellow-600">
                                        View Movies
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a href="{{ route('characters.index') }}" class="block w-full text-center py-2 rounded-lg text-white transition duration-300 bg-gradient-to-r from-blue-500 to-green-500 hover:from-blue-600 hover:to-green-600">
                                        View Characters
                                    </a>
                                </li>
                                <li class="text-center">
                                    <a href="{{ route('toys.index') }}" class="block w-full text-center py-2 rounded-lg text-white transition duration-300 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600">
                                        View Toys
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>