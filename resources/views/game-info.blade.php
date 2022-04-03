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
                <div>
                    <div class='relative m-0 flex p-6'>
                        <div class='flex-no-shrink w-img py-2'>
                            <img alt='{{$game->description}}' class='block mx-auto' src='{{$game->img_url}}'>
                        </div>
                        <div class='flex-1 card-block relative'>
                            <div class="px-4 text-lg">
                                <p class='leading-normal py-2'><b> <span> Name: </span> </b> {{ $game->title}}</p>

                                @php $countWishlist = 0 @endphp
                                @if(Auth::check())
                                    @php
                                    $countWishlist = App\Models\Wishlist::countWishlist($game->id)
                                    @endphp
                                    @if ($countWishlist > 0)
                                    <i class="heart-like fa fa-heart fa-2x text-red-500" data-status="liked" data-id="{{$game->id}}" /></i>
                                    @else
                                    <i class="heart-like far fa-heart fa-2x text-red-500" data-status="unliked" data-id="{{$game->id}}" /></i>
                                    @endif
                                @endif

                                <p class='leading-normal py-2'><b> <span> Publisher: </span> </b> {{ $game->publisher->name}} </p>
                                <p class='leading-normal py-2'><b> <span> Description: </span> </b> {{ $game->description}}</p>
                                <p class='leading-normal py-2'><b> <span> Release Year: </span> </b> {{ $game->release_year}}</p>
                                <p class='leading-normal py-2'><b> <span> Category: </span> </b> {{ $game->categoryList()}}</p>
                                <p class='leading-normal py-2'><b> <span> Complexity rating: </span> </b> {{ $game->complexity_rating}}</p>
                                <p class='leading-normal py-2'><b> <span> Estimated playing time: </span> </b> {{ $game->playing_time_minutes}} min</p>
                                <p class='leading-normal py-2'><b> <span> Players number: </span> </b> {{ $game->min_number_players}} to {{ $game->max_number_players}} </p>
                                <p class='leading-normal py-2'><b> <span> Price: </span> </b> ${{ $game->cost}}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 py-4 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div>
                    <h1 class="py-6 font-semibold text-xl text-gray-900 leading-tight text-center border-b border-gray-200">Reviews</h1>
                    @foreach($reviews as $review)
                    <div class="flex p-6 border-b border-gray-200 justify-between items-center">
                        <div class="text-xl">{{$review->title}}</div>
                        <div class="px-6">{{$review->body}}{{$review->recommended}}</div>
                        <div>
                            @if (($review->recommended) == true)
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 32 32" width="100" height="100">
                                <path d="M25.334,17.932c0,1.291-1.193,2.104-2.486,2.104h-0.01c0.965,0.166,2.111,1.331,2.111,2.462   c0,1.243-1.184,2.019-2.43,2.019h-1.072c0.844,0.243,1.977,1.375,1.977,2.462c0,1.27-1.191,2.067-2.459,2.067H10.156   c-3.56,0-6.443-2.887-6.443-6.447c0,0,0-6.872,0-6.88c0-2.522,1.395-5.189,3.59-6.042c1.711-1.126,5.15-3.133,5.883-6.85   c0-1.449,0-2.809,0-2.809s4.807-0.52,4.807,3.999c0,5.322-3.348,6.186-0.686,6.314h3.98c1.406,0,2.621,1.37,2.621,2.779   c0,1.217-1.154,2.006-2.119,2.254h1.059C24.141,15.365,25.334,16.642,25.334,17.932z" />
                            </svg>
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 500 500" width="100" height="100">
                                <path style="fill:#010002;" d="M394.854,205.444c9.218-15.461,19.102-30.181,14.258-49.527    c-2.951-11.632-10.965-21.126-23.882-28.255c3.26-7.982,7.421-22.76,2.008-37.27c-4.893-13.054-16.298-21.663-28.881-26.686    c-2.78-16.826-10.323-33.823-23.613-44.935C292.987-16.133,183.129,5.367,138.43,21.437C96.934,36.369,69.053,41.198,24.89,41.198    c0,63.444,0,127.334,0,190.761l61.525,0.122c29.336,18.175,52.641,43.992,81.286,63.354    c16.981,11.518,51.218,33.62,63.045,119.238c1.439,10.461,5.154,17.55,11.9,21.02c8.714,4.511,19.143,1.211,27.011-3.219    c57.615-32.327,1.975-88.536,21.947-132.569c17.168-37.822,53.25-15.054,84.789-22.476c30.425-7.169,36.684-23.459,36.562-35.855    C412.843,226.163,402.511,211.451,394.854,205.444z" />
                            </svg>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-app-layout>

<script>
    $(document).ready(function() {
        $(".heart-like").click(function() {
            let heartIcon = $(this);
            let user_id = "{{ Auth::id()}}";
            let game_id = heartIcon.attr('data-id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            if ($(this).attr('data-status') == "unliked") {
                $.ajax({
                    type: "POST",
                    url: "{{ route('like-unlike-game') }}",
                    data: {
                        liked: true,
                        game_id: game_id,
                        user_id: user_id
                    },

                    success: function(response) {
                        heartIcon.removeClass('far');
                        heartIcon.addClass('fa')
                        heartIcon.attr('data-status', 'liked');
                        console.log(response.message)
                    },
                    error: function(response) {
                        console.log(response)
                    }
                });
            } else {
                $.ajax({
                    type: "POST",
                    url: "{{ route('like-unlike-game') }}",
                    data: {
                        liked: false,
                        game_id: game_id,
                        user_id: user_id
                    },
                    success: function(response) {
                        heartIcon.removeClass('fa')
                        heartIcon.addClass('far');
                        heartIcon.attr('data-status', 'unliked')
                        console.log(response.message)
                    },
                    error: function(response) {
                        console.log(response)
                    }
                });
            }
        });
    });
</script>
