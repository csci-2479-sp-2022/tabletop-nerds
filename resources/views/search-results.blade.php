<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Search Results') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex p-6 bg-white border-b border-gray-200 justify-between items-center">
                    <p class="text-xl">No game found with name "<b>{{$result}}</b>". Pleas enter a valid game name or look our game list <a href='/games' style='color:blue'>here</a>.</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
