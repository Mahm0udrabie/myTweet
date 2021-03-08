<div class="flex p-4 {{ $loop->last ? '': 'border-b border-b gray-400' }} ">
    
    <div class="mr-2 flex-shrink-0">
        <a href="{{ $tweet->user->path() }}">
            <img 
                src="{{ $tweet -> user -> avatar }}" 
                width="50"
                height="50"
                alt="" 
                class="rounded-full mr-2"
            >
        </a>
    </div>

    <div>
        <h5 class="font-bold mb-4">
            <a href="{{ route('profile', $tweet-> user -> username) }}">
                {{ $tweet -> user -> name }}
            </a>
        </h5>
  
        <p class="text-sm pb-3">
            {{ $tweet -> body }}
        </p>
        <img src="{{ $tweet->media }}"
                  alt=""
                  class="mb-2"
            >
        @auth
            <x-like-buttons :tweet="$tweet" />
        @endauth
        {{-- <div>
            @include('publish-tweet-comment', ['tweet'=>$tweet])
            @error('comment')
            <p class="text-red-500 text-sm mt-2"> {{ $message }} </p>
            @enderror
        </div> --}}
    </div>   
</div>