<x-app-layout>
    <x-slot name="header">
        <div class="sm:text-sm">
            <a href="/games"> &#8592; Back to Games</a>
        </div>
        <div class=" md: m-4">
            <h1 class="font-semibold text-xl text-center">
                <span><b>Add Game</b></span>
            </h1>
        </div>

    </x-slot>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 font-semibold text-xl text-gray-900 leading-tight border-b border-gray-200">
            <form method="POST" action="{{route('add-game')}}">
            @csrf
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="title">Title</label>
                    <input class="w-7/12" type="text" id="title" name="title" required>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="complexity_rating">Complexity rating</label>
                    <input class="w-7/12" type="text" id="complexity_rating" name="complexity_rating" required>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="cost">Price</label>
                    <input class="w-7/12" type="text" id="cost" name="cost" required>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="release_year">Release year</label>
                    <input class="w-7/12" type="text" id="release_year" name="release_year" required>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="playing_time_minutes">Minutes of playing time</label>
                    <input class="w-7/12" type="text" id="playing_time_minutes" name="playing_time_minutes" required>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="min_number_players">Minimum # of players</label>
                    <input class="w-7/12" type="text" id="min_number_players" name="min_number_players" required>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="max_number_players">Maximum # of players</label>
                    <input class="w-7/12" type="text" id="max_number_players" name="max_number_players" required>
                </div>
                <div class="flex py-2 place-content-center ">
                    <label class="w-1/3" for="description">Description</label>
                    <textarea class="w-7/12" style="min-height:200px" id="description" name="description" required></textarea>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="img_url">Image URL</label>
                    <input class="w-7/12" type="text" id="img_url" name="img_url" required>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="publisher_id">Publisher</label>
                    <select class="w-7/12" id="publisher_id" name="publisher_id">
                        @foreach($publishers as $publisher)
                        <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="category[]">Categories</label>
                    <div class="w-7/12 flex">
                        @foreach($categories as $category)
                        <div class="px-2">
                            <input type="checkbox" name="category[]" value="{{$category->id}}">{{$category->name}}
                        </div>
                        @endforeach
                    </div>
                </div>
                @if ($errors->any())
                <div class="flex py-2 place-content-center">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li class="text-red-600">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div class="flex py-2 place-content-center">
                    <div class="px-4">
                    <input class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="Add Game">
                    </div>
            </form>
            
            </div>
        </div>
    </div>
</x-app-layout>