<x-app-layout>
    <x-slot name="header">
        <a href="/wishlist"> &#8592; Back to Wishlist</a>
        <h1 class="font-semibold text-xl text-gray-900 leading-tight text-center">
            {{$wish['name']}}
        </h1>
    </x-slot>

    <div class="py-12 py-4 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="max-w-md mx-auto">
                    <div class='relative m-0 flex p-6'>
                        <div class='flex-no-shrink w-img py-2'>
                            <img alt='{{$wish->description}}' class='block mx-auto' src='{{$wish->img_url}}'>
                        </div>
                        <div class='flex-1 card-block relative'>
                            <div class="px-4 text-lg">
                                <p class='leading-normal py-2'><b> <span> Name: </span> </b> {{ $wish['title']}}</p>
                                <p class='leading-normal py-2'><b> <span> Description: </span> </b> {{ $wish['content']}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
