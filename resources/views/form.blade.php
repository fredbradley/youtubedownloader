<x-layout>
    @auth
    <form action="{{ route('show') }}" method="POST" class="space-y-4">
        @csrf
        <input type="url" name="url" required placeholder="Enter YouTube URL"
               class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 outline-none dark:text-black">

        <button type="submit"
                class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition">
            Download Video
        </button>
    </form>
        @endauth
    @guest
        <p class="text-center">Please <a href="{{ route('login') }}" class="text-blue-500">login</a> to download videos.</p>
    @endguest
</x-layout>
