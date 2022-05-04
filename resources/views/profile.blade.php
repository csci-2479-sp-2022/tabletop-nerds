<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Profile') }}
        </h2>
        <hr>
        <p class='leading-normal py-2'><b> <span> Username: </span> </b> {{  Auth::user()->name }} </p>
        <p class='leading-normal py-2'><b> <span> Email: </span> </b> {{  Auth::user()->email }} </p>
        <p class='leading-normal py-2'><b> <span> Admin Status: </span> </b> {{  Auth::user()->is_admin }} </p>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="dark:bg-gray-900">


                    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 py-12">
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 font-semibold text-xl text-gray-900 leading-tight border-b border-gray-200">
                            <div class="flex text-center py-2 place-content-center">Edit your profile</div>
                            <form method="POST" action="#">
                                @auth
                                    <div class="flex py-2 place-content-center">
                                        <label class="w-1/3" for="title">Username</label>
                                        <x-input id="name" class="w-7/10" type="text" name="name" value="{{  Auth::user()->name }}" required autofocus />
                                    </div>
                                    <div class="flex py-2 place-content-center">
                                        <label class="w-1/3" for="title">Email</label>
                                        <x-input id="email" class="w-7/10" type="email" name="email" value="{{  Auth::user()->email }}" required />
                                    </div>
                                    <div class="flex py-2 place-content-center">
                                        <label class="w-1/3" for="title">Password</label>
                                        <x-input id="password" class="w-7/10" type="password" name="password" required autocomplete="new-password" />
                                    </div>
                                    <div class="flex py-2 place-content-center">
                                        <label class="w-1/3" for="title">Confirm Password</label>
                                        <x-input id="password_confirmation" class="w-7/10" type="password" name="password_confirmation" required />
                                    </div>
                                @endauth
                                <div class="flex py-2 place-content-center">
                                    <input class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" type="submit" value="Save">
                                </div>
                            </form>
            </div>
        </div>
    </div>
</x-app-layout>
