<div class="flex ">
    {{-- <img 
                src="{{ auth()->user()->avatar }}" 
                width="40" 
                height="40"
                class="rounded-full"

        > --}}

    <form method="POST" action="{{ route("comment.store") }}" class="flex">
        @csrf
        <input type="text" name="tweetId" value="{{ $tweet->id }}" name="tweetId">

        <textarea 
        name="comment"
        class="w-full border-b border-b gray-400" 
        placeholder="replay to tweet"  
        required
        ></textarea>
        <x-button-reply></x-button-reply>
    </form>
    
    
    @error('body')
        <p class="text-red-500 text-sm mt-2"> {{ $message }} </p>
    @enderror
</div> 
@if(session()->has('success'))
        <div class="alert alert-success">
            <p class="placeholder-green-900">{{  session()->get('success') }}</p>
        </div>
@endif
@forelse($tweet->comments as $comment)
        <p class=placeholder-green-900" style="background-color: rgba(79, 124, 122, 0.37)">
            {{ $comment->comment }}</p>
        <br>
    @empty
    No Comments 
@endforelse