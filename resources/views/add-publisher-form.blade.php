<x-app-layout>
    <x-slot name="header">
        <div class="sm:text-sm">
            <a href="/games"> &#8592; Back to Games</a>
        </div>
        <div class=" md: m-4">
            <h1 class="font-semibold text-xl text-center">
                <span><b>Add publisher</b></span>
            </h1>
        </div>

    </x-slot>
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 font-semibold text-xl text-gray-900 leading-tight border-b border-gray-200">
            <form method="POST" action="{{route('add-publisher')}}">
            @csrf
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="name">Name</label>
                    <input class="w-7/12" type="text" id="name" name="name" required>
                </div>
                <div class="flex py-2 place-content-center">
                    <label class="w-1/3" for="code">Code</label>
                    <input class="w-7/12" type="text" id="code" name="code" required>
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
                    <input class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="Add Publisher">
                    </div>
                    
            </form>
            
            </div>
        </div>
    </div>
</x-app-layout>