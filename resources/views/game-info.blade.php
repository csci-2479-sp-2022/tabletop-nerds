<x-app-layout>
    <x-slot name="header">
        <a href="/games"> &#8592; Back to Games</a>
        <h1 class="font-semibold text-xl text-gray-900 leading-tight text-center">
            {{$game->title}}
        </h1>
    </x-slot>

    <div class="py-12 py-4 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-md mx-auto">
                    <div class='relative m-0 flex p-6'>
                        <div class='flex-no-shrink w-img py-2'>
                            <img alt='{{$game->description}}' class='block mx-auto' src='{{$game->img_url}}'>
                        </div>
                        <div class='flex-1 card-block relative'>
                            <div class="px-4 text-lg">

                                <p class='leading-normal py-2'><b> <span> Name: </span> </b> {{ $game->title}}</p>
                                <p class='leading-normal py-2'><b> <span> Publisher: </span> </b> {{ $game->publisher->name}} </p>
                                <p class='leading-normal py-2'><b> <span> Description: </span> </b> {{ $game->description}}</p>
                                <p class='leading-normal py-2'><b> <span> Release Year: </span> </b> {{ $game->release_year}}</p>
                                <p class='leading-normal py-2'><b> <span> Category: </span> </b> {{ $game->categoryList()}}</p>
                                <p class='leading-normal py-2'><b> <span> Complexity rating: </span> </b> {{ $game->complexity_rating}}</p>
                                <p class='leading-normal py-2'><b> <span> Estimated playing time: </span> </b> {{ $game->playing_time_minutes}} min</p>
                                <p class='leading-normal py-2'><b> <span> Players number: </span> </b> {{ $game->min_number_players}} to {{ $game->max_number_players}} </p>
                                <p class='leading-normal py-2'><b> <span> Price:  </span> </b> ${{ $game->cost}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
