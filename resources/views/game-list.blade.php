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
                <div class="flex p-6 bg-white border-b border-gray-200 items-center">
                    <div class="w-5/6">
                        <div class="text-2xl">{{$game->title}}</div>
                        <div class="py-3" >{{$game->description}}</div>
                    </div>
                    
                    <div class="flex w-1/6 px-4 mx-auto"> <a class="inline-flex items-center px-4 py-2 mx-auto bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" href="/game/{{$game->id}}"> Details</a> </div>
                    
                </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>


