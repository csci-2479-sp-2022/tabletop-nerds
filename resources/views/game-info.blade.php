<x-app-layout>
    <x-slot name="header">
        <div class="sm:text-sm">
            <a href="/games"> &#8592; Back to Games</a>
        </div>
        <div class=" md: m-4">
            <h1 class="font-semibold text-xl text-center">
                <span class="rounded bg-red-900 text-white p-3 mask mask-pentagon"> <b>{{ $averageRating }}</b></span>
                <span><b>{{ $game->title }} ({{ $game->release_year}})</b></span>
            </h1>
        </div>

    </x-slot>

    <div class="py-12 py-4 ">
        <div class="max-w-7xl mx-auto lg:px-8 sm:px-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class='relative m-0 lg:flex p-6'>
                    <div class='flex-no-shrink lg:w-1/3 h-auto py-2'>
                        <img alt='{{$game->description}}' class='block mx-auto' src='{{$game->img_url}}'>
                    </div>
                    <div class='flex-1 card-block relative'>
                        <div class="px-4 text-lg">

                            <p class='leading-normal py-2'><b> <span> Publisher: </span> </b> {{ $game->publisher->name}} </p>
                            <p class='leading-normal py-2'><b> <span> Description: </span> </b> {{ $game->description}}</p>
                            <p class='leading-normal py-2'><b> <span> Category: </span> </b> {{ $game->categoryList()}}</p>
                            <p class='leading-normal py-2'><b> <span> Complexity rating: </span> </b> {{ $game->complexity_rating}}</p>
                            <p class='leading-normal py-2'><b> <span> Estimated playing time: </span> </b> {{ $game->playing_time_minutes}} min</p>
                            <p class='leading-normal py-2'><b> <span> Players number: </span> </b> {{ $game->min_number_players}} to {{ $game->max_number_players}} </p>
                            <p class='leading-normal py-2'><b> <span> Price: </span> </b> ${{ $game->cost}}</p>

                            @if(Auth::check())
                            <div class="grid lg:grid-cols-2 gap-4  sm:grid-cols-1 sm:gap-4 ">
                                <div>
                                    <p> <b> <span> My rating: </span></b><span class="stars" data-rating="{{$userRating}}"></span> </p>
                                </div>
                                @php $countWishlist = 0;
                                $countWishlist = App\Models\Wishlist::countWishlist($game->id)
                                @endphp
                                <div>
                                    <p> <b> <span> My favorite: </span></b>
                                        @if ($countWishlist > 0)
                                        <i class="heart-like fa fa-heart fa-1x text-red-500 inline-flex" data-status="liked" data-id="{{$game->id}}" /></i>
                                        @else
                                        <i class="heart-like far fa-heart fa-1x text-red-500 inline-flex" data-status="unliked" data-id="{{$game->id}}" /></i>
                                        @endif
                                    </p>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-12 ">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg py-6 font-semibold text-xl text-center text-gray-900 leading-tight border-b border-gray-200 columns-3">
                <div>&emsp;</div>
                <div>
                    <h1 class="inline-flex">Reviews</h1>
                </div>
                <div class="text-right px-4">
                    @if($reviewed)
                    <a class="inline-flex items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" href="/game/{{$game->id}}/review">Edit review</a>
                    @else
                    <a class="inline-flex items-center px-4 py-2 bg-gray-800  border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150" href="/game/{{$game->id}}/review">Leave a review</a>
                    @endif
                </div>
            </div>
            <div class="columns-1 ">
                @foreach($reviews as $review)
                <div class="bg-white overflow-hidden shadow-sm md:rounded-lg flex-col p-6 border border-gray-200">
                    <div class="text-2xl text-center border-b border-gray-200">{{$review->title}}</div>
                    <div class="flex items-center">
                        <div class="p-4 w-5/6">{{$review->body}}</div>
                        <div class="w-1/6">
                            @if (($review->recommended) == true)
                            <svg class="fill-yellow-400" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 44 44" width="100" height="100">
                                <path d="M25.334,17.932c0,1.291-1.193,2.104-2.486,2.104h-0.01c0.965,0.166,2.111,1.331,2.111,2.462   c0,1.243-1.184,2.019-2.43,2.019h-1.072c0.844,0.243,1.977,1.375,1.977,2.462c0,1.27-1.191,2.067-2.459,2.067H10.156   c-3.56,0-6.443-2.887-6.443-6.447c0,0,0-6.872,0-6.88c0-2.522,1.395-5.189,3.59-6.042c1.711-1.126,5.15-3.133,5.883-6.85   c0-1.449,0-2.809,0-2.809s4.807-0.52,4.807,3.999c0,5.322-3.348,6.186-0.686,6.314h3.98c1.406,0,2.621,1.37,2.621,2.779   c0,1.217-1.154,2.006-2.119,2.254h1.059C24.141,15.365,25.334,16.642,25.334,17.932z" />
                            </svg>
                            @else
                            <svg class="fill-red-600" xmlns="http://www.w3.org/2000/svg" viewbox="0 0 700 700" width="100" height="100">
                                <path d="M394.854,205.444c9.218-15.461,19.102-30.181,14.258-49.527    c-2.951-11.632-10.965-21.126-23.882-28.255c3.26-7.982,7.421-22.76,2.008-37.27c-4.893-13.054-16.298-21.663-28.881-26.686    c-2.78-16.826-10.323-33.823-23.613-44.935C292.987-16.133,183.129,5.367,138.43,21.437C96.934,36.369,69.053,41.198,24.89,41.198    c0,63.444,0,127.334,0,190.761l61.525,0.122c29.336,18.175,52.641,43.992,81.286,63.354    c16.981,11.518,51.218,33.62,63.045,119.238c1.439,10.461,5.154,17.55,11.9,21.02c8.714,4.511,19.143,1.211,27.011-3.219    c57.615-32.327,1.975-88.536,21.947-132.569c17.168-37.822,53.25-15.054,84.789-22.476c30.425-7.169,36.684-23.459,36.562-35.855    C412.843,226.163,402.511,211.451,394.854,205.444z" />
                            </svg>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
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

    $.fn.stars = function(options) {
        var settings = $.extend({
            stars: 1,
            emptyIcon: 'far fa-star',
            filledIcon: 'fa fa-star',
            color: '#E4AD22',
            starClass: '',
            value: 0,
            click: function() {}
        }, options);
        let user_rating = $(this).attr('data-rating');
        console.log(user_rating);
        for (var x = 0; x < settings.stars; x++) {
            if (x < user_rating) {
                var icon = $("<i>").addClass(settings.filledIcon).addClass("star-rating").attr("star-value", x + 1);

            } else {
                var icon = $("<i>").addClass(settings.emptyIcon).addClass("star-rating").attr("star-value", x + 1);
            }
            if (settings.color !== "none") {
                icon.css("color", settings.color)
            }
            this.append(icon);
        }

        var stars = this.find("i");
        stars.on("mouseover", function() {
            var index = $(this).index() + 1;
            var starsHovered = stars.slice(0, index);
            events.removeFilledStars(stars, settings);
            events.fillStars(starsHovered, settings);
        }).on("mouseout", function() {
            events.removeFilledStars(stars, settings);
            events.fillStars(stars.filter(".selected"), settings);
            if (settings.text) block.find(".rating-text").html("");
        }).on("click", function() {
            var index = $(this).index();
            settings.value = index + 1;
            stars.removeClass("selected").attr("data-value", "unrated").slice(0, settings.value).addClass("selected").attr("data-value", "rated").attr("data-id", "{{$game->id}}");
            settings.click.call(stars.get(index), settings.value);

            let starIcon = $(this);
            let user_id = "{{ Auth::id()}}";
            let game_id = starIcon.attr('data-id');
            let rating_value = starIcon.attr('star-value');

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: "POST",
                url: "{{ route('rate-unrate-game') }}",
                data: {
                    rated: rating_value,
                    game_id: game_id,
                    user_id: user_id
                },

                success: function(response) {
                    console.log(response.message)
                },
                error: function(response) {
                    console.log(response)
                }
            });

        });

        events = {
            removeFilledStars: function(stars, s) {
                stars.removeClass(s.filledIcon).addClass(s.emptyIcon);
                return stars;
            },
            fillStars: function(stars, s) {
                stars.removeClass(s.emptyIcon).addClass(s.filledIcon);
                return stars;
            }
        };
        return this;
    };

}(jQuery));

</script>

<script>
    $(".stars").stars({
        stars: 10
    });
</script>
