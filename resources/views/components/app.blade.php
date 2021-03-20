<x-master>
    <section class="px-8">
        <main class="container mx-auto">
            <div class="lg:flex lg:justify-between">
                @if(auth()->check())
                    <div class="lg:w-1/8 p-4 border border-gray-300 rounded-lg mb-4 px-6" style="height:auto">
                        @include('_sidebar-links')
                    </div>
                @endif
                <div class="lg:flex-1 lg:mx-10 lg:mb-10" style="max-width:700px">
                    {{ $slot }}
                </div>
                @if(auth()->check())
                    <div class="lg: w-1/8  rounded-lg p-4">
                        @include('_friends-list')
                    </div>
                @endif
            </div>                
        </main>
    </section>
</x-master>