<x-app-layout>
    <x-slot name="header">
        <a href="/game/{{request('id')}}"> &#8592; Back to {{$gameTitle}}</a>
        <h1 class="font-semibold text-xl text-gray-900 leading-tight text-center">
            @if($body)
            Edit Review
            @else
            Create Review
            @endif
        </h1>
    </x-slot>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 font-semibold text-xl text-gray-900 leading-tight border-b border-gray-200">
            <form method="POST" action="{{route('review-create', request('id'))}}">
            @csrf
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="title">Add a title</label>
                    <input class="w-7/12" type="text" id="title" name="title" value="{{$title}}" required>
                </div>
                <div class="flex py-2 place-content-center ">
                    <label class="w-1/3" for="body">Write your review</label>
                    <textarea class="w-7/12" style="min-height:200px" id="body" name="body" required>{{$body}}</textarea>
                </div>
                <div class="flex text-center py-2">
                    <div class="w-2/3">
                        <label for="verdict">Would you recommend this game to others?</label>
                    </div>
                    <div class="w-1/3">
                        <input type="radio" id="verdict" value="1" name="verdict" required @if($recommended)checked
                        @endif>
                        <label for="yes">Yes</label>
                        <input type="radio" id="verdict" value="0" name="verdict" required @if(!$recommended)checked
                        @endif>
                        <label for="no">No</label>
                    </div>
                </div>
                <div class="flex py-2 place-content-center">
                    <div class="px-4">
                    @if($body)
                    <input class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="Update">
                    @else
                    <input class="inline-flex items-center px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="Create">
                    @endif
                    </div>
            </form>
            @if($body)
            <div class="px-4">
            <form method="POST" action="{{route('review-delete', request('id'))}}">
                @method('DELETE')
                @csrf
                
                    <input class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="Delete">
            </form>
            </div>
            @endif
            </div>
        </div>
    </div>
</x-app-layout>