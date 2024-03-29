<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6 relative">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 relative">
                    {{ __("You're logged in!") }}

                    @if (session('status') === 'post-created')
                        <div class="absolute top-0 right-0 py-4 pr-4 mt-1 mr-1">
                            <div x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2500)"
                                class="bg-green-500 text-white font-semibold py-1 px-2 rounded-lg shadow-md">
                                {{ __('Post Created') }}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

    </div>

</x-app-layout>
