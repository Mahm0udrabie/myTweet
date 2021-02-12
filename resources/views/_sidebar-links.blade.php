<ul>
    <li class="flex">
        <i class="fas fa-home mt-1" style="font-size: 20px"></i>
        <a href="{{ route('home') }}" class="font-bold text-lg mb-4 block">
            <span class="m-2">Home</span>
        </a>
    </li>
    <li class="flex">
        <i class="fas fa-hashtag mt-1" style="font-size: 20px"></i>
        <a href="/explore" class="font-bold text-lg mb-3 block">
            <span class="m-2">Explore</span>
        </a>
    </li>
    <x-dropdown></x-dropdown>
    <li class="flex">
        <i class="fas fa-envelope mt-1" style="font-size: 20px"></i>
        <a href="{{ route("chatting") }}" class="font-bold text-lg mb-3 block ">
            <span class="m-2">Messages</span>
        </a>
    </li>
    <li class="flex">
        <i class="fas fa-user-alt mt-1" style="font-size: 20px"></i>
        <a href="{{ route('profile', auth()->user()) }}" class="font-bold text-lg mb-3 block">
            <span class="m-2">Profile</span>
        </a>
    </li>
    <li class="flex">
        <i class="fas fa-sign-out-alt mt-1" style="font-size: 20px"></i>
        <form method="POST" action="/logout">
            @csrf
            <span class="m-2">
                <button class="font-bold text-lg">Logout</button>
            </span>
        </form>
    </li>
</ul>


