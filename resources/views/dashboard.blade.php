<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Instagram') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if (session('status') === 'post-created')
                <div class="max-w-xl flex items-center">
                    <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                        class="bg-green-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                        {{ __('Post Created') }}
                    </div>
                </div>
            @endif

            @foreach ($images as $image)
                <div id="timeLine" class="sm:rounded-lg bg-white shadow ">

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

                    {{-- INTERACTON --}}
                    <div id="interaction" class="pl-2 pt-2 flex items-center">
                        <div id="like">
                            <img src="{{ asset('img/favorite-3-64.png') }}" alt="Likes" class="img-fluid"
                                style="width: 25px">
                        </div>
                        <div id="comment" class="pl-4">
                            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                <img src="{{ asset('img/comments-64.png') }}" alt="Likes" class="img-fluid"
                                    style="width: 25px">
                            </a>
                        </div>
                    </div>

                    {{-- LIKES --}}
                    <div id="likes" class="pl-2 pt-2 ">
                        ()
                        Likes
                        {{-- <span>{{ count() }} Likes</span> --}}
                    </div>

                    {{-- DESCRIPTION --}}
                    <div id="description" class="pl-2 pt-2">
                        <strong>{{ __('@' . $image->user->nick) }} </strong> {{ $image->description }}
                    </div>

                    {{-- COMMENT --}}
                    <div id="comments" class="pl-2 py-2">
                        <span class="pb-1">
                            <a href="{{ route('image.detail', ['id' => $image->id]) }}">
                                @if (count($image->comments) == 0)
                                    Be the first comment
                                @else
                                    View all {{ count($image->comments) }} comments
                                @endif
                            </a>
                        </span>

                    </div>

                    {{-- DATE --}}
                    <div id="date" class="pl-2 pb-2  text-sm text-gray-600">
                        <span>
                            {{-- DOCUMENTATION https://carbon.nesbot.com/docs/#api-humandiff --}}
                            Posted {{ $image->created_at->diffForHumans(null, false, false, 1) }}
                        </span>
                    </div>
                </div>
            @endforeach

            {{-- PAGINATION --}}
            <div class="clearfix"></div>

            <div class="pt-2 flex justify-center">
                {{ $images->links('pagination::tailwind') }}
            </div>
        </div>
    </div>

</x-app-layout>
