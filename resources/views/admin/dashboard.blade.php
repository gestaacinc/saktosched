<x-admin-layout>
    <h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>

    <!-- Stats Cards -->
    <div class="mt-4">
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <div class="flex items-center p-4 bg-white rounded-lg shadow-xs">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Pending Inquiries</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $stats['pending_inquiries'] }}</p>
                </div>
            </div>
            <!-- Add other stat cards as needed -->
        </div>
    </div>

    <!-- Recent Inquiries Table -->
    <div class="mt-8">
        <h4 class="text-gray-600">Recent Inquiries</h4>
        <div class="mt-4">
            <div class="p-6 bg-white rounded-md shadow-md">
                <table class="min-w-full">
                    <thead>
                        <tr>
                            <th class="text-left">Organization</th>
                            <th class="text-left">Qualification</th>
                            <th class="text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentInquiries as $inquiry)
                        <tr>
                            <td>{{ $inquiry->organization_name }}</td>
                            <td>{{ $inquiry->qualification->title }}</td>
                            <td>{{ $inquiry->status }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-admin-layout>