<div class="bg-gray-200 border border-gray rounded-lg py-4 px-6">
    <h3 class="font-bold text-xl mb-4">Following</h3>
    <ul>
        @forelse(auth() -> user() ->follows as $user)
            <li class="{{ $loop->last ? "" : 'mb-4' }}">
                <div>
                    <a 
                    class="flex items-center text-sm"
                    href="{{ route('profile', $user->username) }}">

                            <img src="{{ $user -> avatar }}" 
                            width="40"
                            height="40"
                            alt=""
                            class="rounded-full mr-2">
                            {{ $user -> name }}
                    </a>
                </div>
            </li>
            @empty
                <li>No followers yet.</li>
        @endforelse
    </ul>
</div>