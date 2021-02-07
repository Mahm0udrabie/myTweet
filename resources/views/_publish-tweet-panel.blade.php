<div class="border border-blue-400 rounded-lg px-8 py-6 mb-8">
    <form method="POST" action="{{ route("tweets.store") }}" enctype="multipart/form-data">
        @csrf
        <textarea 
        name="body"
        class="w-full" 
        placeholder="What's up doc?"  
        required
        ></textarea>
        <i class="far fa-image fa-2x text-gray-500" style="cursor: pointer;"  onclick="document.getElementById('upload-file').click()"></i>
        <input type="file" name="media" style="display: none" id="upload-file">
        <hr class="my-4">
        <footer class="flex justify-between items-center">
            <img 
                src="{{ auth()->user()->avatar }}" 
                width="40" 
                height="40"
                alt="" 
                class="rounded-full mr-2"
            >
            <x-button></x-button>
        </footer>
    </form>
    @error('body')
        <p class="text-red-500 text-sm mt-2"> {{ $message }} </p>
    @enderror
</div> 