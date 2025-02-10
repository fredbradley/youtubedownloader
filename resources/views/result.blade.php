@php use Illuminate\Support\Facades\File; @endphp
<x-layout>
    <table class="table">
        <thead>
        <th>Filename</th>
        <th>Download</th>
        </thead>
        <tbody>
        @foreach ($files as $file)
            <tr>
                <td>{{ File::basename($file) }}</td>
                <td>
                    <a href="{{ route('download', ['file' => File::basename($file)]) }}"
                       class="w-full bg-blue-500 hover:bg-blue-600 text-white font-bold p-3 rounded-lg transition">
                        Download
                    </a>
            </tr>
        @endforeach
        </tbody>
    </table>
    <hr />
    <div class="py-6">
    <a href="{{ route('form') }}"
       class="w-full block bg-green-500 hover:bg-green-600 text-white font-bold p-3 rounded-lg transition text-center">
        Do another one
    </a>
    </div>
</x-layout>
