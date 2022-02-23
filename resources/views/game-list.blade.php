<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @foreach($games as $game)
                <div class="flex p-6 bg-white border-b border-gray-200 justify-between items-center">
                    <div class="text-xl">{{$game['name']}}</div>
                    <div class="px-6" >{{$game['description']}}</div>
                    <div class="">{{$game['rating']}}</div>
                    <div class="p-6"> <a class="btn-details p-2" href="/game/{{$game->id}}"> Details</a> </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>


