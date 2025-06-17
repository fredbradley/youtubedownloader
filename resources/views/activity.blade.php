<x-layout>
    <h2>Recent Activity</h2>

    <div class="overflow-x-auto rounded-xl shadow-md border border-gray-200 bg-white">
        <table class="min-w-full divide-y divide-gray-200 text-sm text-left">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500 tracking-wider">
            <tr>
                <th class="px-4 py-3">Action</th>
                <th class="px-4 py-3">User</th>
                <th class="px-4 py-3">Details</th>
                <th class="px-4 py-3">Date</th>
            </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
            @foreach ($activities as $activity)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-2 text-gray-800">
                        {{ $activity->description }}
                    </td>
                    <td class="px-4 py-2 text-gray-800">
                        {{ $activity->causer->name ?? 'System' }}
                    </td>
                    <td class="px-4 py-2 text-gray-700">
                        @if ($activity->description === 'Downloaded to device')
                            Video: {{ $activity->properties['file'] ?? 'N/A' }}
                        @else
                            {{-- Show nothing or other details if needed --}}
                        @endif
                    </td>
                    <td class="px-4 py-2 text-gray-500">
                        {{ $activity->created_at->diffForHumans() }}
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
<div class="py-6">
    <a href="{{ route('form') }}"
       class="w-full block bg-cranleigh hover:bg-cranleigh text-white font-bold p-3 rounded-lg transition text-center">
        Carry On... just download a video
    </a>
</div>
    {{ dump($activities) }}
</x-layout>
