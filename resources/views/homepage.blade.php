<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Table Top Nerds') }}
        </h1>
    </x-slot>
    <div class="container mx-auto py-9 md:py-12 lg:py-24">
        <div class="flex flex-col lg:flex-row justify-center items-strech mx-4">
            <div class="lg:w-4/12 flex justify-center items-center">
                <div>
                    @auth
                    <h2 class="dark:text-white text-3xl md:text-5xl xl:text-4xl font-semibold text-gray-900 w-7/12">Welcome {{ Auth::user()->name }}</h2>
                    @else
                    <h2 class="dark:text-white text-3xl md:text-5xl xl:text-4xl font-semibold text-gray-900 w-7/12">Welcome</h2>
                    @endauth
                    <p class="dark:text-gray-300 md:w-7/12 lg:w-11/12 xl:w-10/12 mt-4 lg:mt-5 text-base leading-normal text-gray-600">Playing board games is great for reducing stress and makes for laughter. A side effect of board game playing is laughter. It is one of the vital ingredients for an enjoyable learning experience and increasing creativity. Also, laughing and having a good time in general helps to decrease stress.</p>
                </div>
            </div>
            <div class="lg:w-8/12 mt-6 md:mt-8 lg:mt-0">
                <div class="relative w-full h-full">
                    <img src="https://images.unsplash.com/photo-1642009189383-56dc22a2862d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2340&q=80" alt="A lounge sofa" role="img" class="w-full h-full relative hidden lg:block" />
                    <img src="https://images.unsplash.com/photo-1642009189383-56dc22a2862d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=2340&q=80" alt="A lounge sofa" role="img" class="w-full h-full lg:hidden" />
                    <div class="hidden lg:block absolute bottom-0 right-0 bg-red-200 w-1/2">
                        <a href="/games"  class="dark:hover:bg-gray-800 dark:bg-white dark:hover:text-gray-50 dark:text-gray-800 bg-gray-800 text-xl xl:text-2xl font-medium text-white flex justify-between w-full items-center p-5 xl:p-6 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 hover:bg-gray-700">
                            Discover Our Games
                            <div>
                                <svg class="fill-stroke dark:hover:text-gray-600" width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M6.66663 16H25.3333" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20 21.3333L25.3333 16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M20 10.667L25.3333 16.0003" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="mt-6 md:mt-8 lg:hidden">
                    <a href="/games" class="dark:hover:bg-gray-800 dark:bg-white dark:hover:text-gray-50 dark:text-gray-800 bg-gray-800 text-base md:text-xl font-semibold leading-tight text-white flex justify-between items-center px-5 py-4 lg:py-7 lg:px-7 w-full md:w-5/12 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-800 hover:bg-gray-700">
                        Discover More
                        <div>
                            <svg class="fill-stroke" width="22" height="24" viewBox="0 0 22 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <g clip-path="url(#clip0)">
                                    <path d="M0.453735 12H14.4537" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.4539 16L14.4539 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    <path d="M10.4539 8L14.4539 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </g>
                                <defs>
                                    <clipPath id="clip0">
                                        <rect width="21.7269" height="24" fill="white" />
                                    </clipPath>
                                </defs>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
