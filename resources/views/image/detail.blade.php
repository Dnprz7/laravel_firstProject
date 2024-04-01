<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instagram') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'comment-created')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-green-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Comment Send') }}
                    </div>
                </div>
            @endif

            <div class="sm:rounded-lg bg-white shadow ">

                {{-- USER --}}
                <div id="user" class="pl-2 py-2 max-auto flex items-center bg-gray-200 ">

                    <a href="{{ route('image.detail', ['id' => $image->id]) }}" class="flex items-center">

                        @if ($image->user->image)
                            <div class="mr-1">
                                <img src="{{ route('profile.avatar', ['filename' => $image->user->image]) }}"
                                    alt="Profile Photo" class="h-8 w-8 rounded-full">
                            </div>
                        @endif

                        <div>
                            {{ $image->user->name . ' ' . $image->user->surname }}
                        </div>
                        <p class="pl-2 text-sm text-gray-600">
                            {{ __('@' . $image->user->nick) }}
                        </p>
                    </a>

                </div>

                {{-- IMAGE --}}
                <div id="image" class="">
                    <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" alt="Post"
                        class="w-full" style="box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1)">
                </div>

                {{-- LIKES --}}
                <div id="likes" class="pl-2 pt-2 ">
                    <img src="{{ asset('img/favorite-3-64.png') }}" alt="Likes" class="img-fluid"
                        style="width: 25px">
                    {{-- <span>{{ count() }} Likes</span> --}}
                </div>

                {{-- DESCRIPTION --}}
                <div id="description" class="pl-2 pt-2">
                    <strong>{{ __('@' . $image->user->nick) }} </strong> {{ $image->description }}
                </div>

                {{-- COMMENT --}}
                <div id="comments" class="pl-2 py-2">
                    <span class="pb-1">
                        Comments ({{ count($image->comments) }})
                    </span>

                    @foreach ($image->comments as $comment)
                        <div id="comment" class="flex items-center">
                            <strong>{{ __('@' . $comment->user->nick) }}</strong>
                            <span class="pl-1">{{ $comment->content }}</span>
                            <div class="pl-3 text-sm text-gray-600">
                                {{ $image->created_at->diffForHumans(null, false, false, 1) }}</div>
                        </div>
                    @endforeach
                </div>

                {{-- MAKE A COMMENT --}}
                <div id="makeComment" class="pl-2 pb-2">
                    <form action="{{ route('comment.save') }}" method="post">
                        @csrf
                        <input type="hidden" name="image_id" value="{{ $image->id }}">

                        <div class="pr-2">
                            <textarea name="content" id="content" required
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full h-10 shadow-sm sm:text-sm border-gray-300 rounded-md"></textarea>

                            @if ($errors->has('content'))
                                <span class="invalid-feedback" role"alert">
                                    <strong>{{ $errors->first('content') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="py-2">
                            <x-primary-button>{{ __('Send') }}</x-primary-button>
                        </div>
                    </form>
                </div>

                {{-- DATE --}}
                <div id="date" class="pl-2 pb-2  text-sm text-gray-600">
                    <span>
                        {{-- DOCUMENTATION https://carbon.nesbot.com/docs/#api-humandiff --}}
                        Posted {{ $image->created_at->diffForHumans(null, false, false, 1) }}
                    </span>
                </div>
            </div>
        </div>
    </div>


</x-app-layout>
