@php use Illuminate\Support\Facades\File; @endphp
<x-layout>
    <table class="w-full max-w-3xl mx-auto mt-6 border border-gray-200 dark:border-gray-700 rounded-lg shadow-md overflow-hidden">
        <thead class="bg-gray-100 dark:bg-gray-200">
        <tr>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-black">Filename</th>
            <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700 dark:text-black">Download</th>
        </tr>
        </thead>
        <tbody class="divide-y divide-gray-200 dark:divide-gray-300">
        @foreach ($files as $file)
            <tr class="hover:bg-gray-50">
                <td class="px-4 py-3 text-gray-800 dark:text-black">
                    {{ File::basename($file) }}
                </td>
                <td class="px-4 py-3">
                    <a href="{{ route('download', ['file' => File::basename($file)]) }}"
                       class="inline-block bg-blue-500 hover:bg-blue-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition duration-150">
                        Download
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <div class="py-6">
        Please try opening the video in different software. For example, we've seen examples of where the video has refused to open in QuickTimePlayer, but opened fine in VLC Player.
    </div>
    <div class="py-6">
    <a href="{{ route('form') }}"
       class="w-full block bg-green-500 hover:bg-green-600 text-white font-bold p-3 rounded-lg transition text-center">
        Do another one
    </a>
    </div>
</x-layout>
