<x-admin-layout>
    <h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>
    
    <!-- Stats Cards -->
    <div class="mt-4">
        <div class="grid gap-6 mb-8 md:grid-cols-2 xl:grid-cols-4">
            <!-- New Proposal Card -->
            <a href="{{ route('admin.proposals.index') }}" class="flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-gray-50 transition">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Pending Schedule Proposals</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $stats['pending_proposals'] }}</p>
                </div>
            </a>
            <!-- Institutional Inquiry Card -->
            <a href="#" class="flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-gray-50 transition">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Pending Institutional Inquiries</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $stats['pending_inquiries'] }}</p>
                </div>
            </a>
            <!-- Pending Schedules Card -->
            <a href="#" class="flex items-center p-4 bg-white rounded-lg shadow-xs hover:bg-gray-50 transition">
                <div>
                    <p class="mb-2 text-sm font-medium text-gray-600">Active Pending Schedules</p>
                    <p class="text-lg font-semibold text-gray-700">{{ $stats['pending_schedules'] }}</p>
                </div>
            </a>
        </div>
    </div>

    <!-- Recent Inquiries Table (optional, can be removed if not needed) -->
    <div class="mt-8">
        <h4 class="text-gray-600">Recent Institutional Inquiries</h4>
        <!-- ... table code ... -->
    </div>
</x-admin-layout>