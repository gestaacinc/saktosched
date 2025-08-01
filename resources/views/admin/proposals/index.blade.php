<x-admin-layout>
    <h3 class="text-gray-700 text-3xl font-medium">Schedule Proposals</h3>
    <div class="mt-8 bg-white p-6 rounded-md shadow-md">
        <table class="min-w-full">
            <thead>
                <tr>
                    <th class="text-left">Proposer Name</th>
                    <th class="text-left">Qualification</th>
                    <th class="text-left">Proposed Date</th>
                    <th class="text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($proposals as $proposal)
                <tr>
                    <td>
                        <div>{{ $proposal->proposer_name }}</div>
                        <div class="text-xs text-gray-500">{{ $proposal->proposer_email }}</div>
                    </td>
                    <td>{{ $proposal->qualification->title }}</td>
                    <td>{{ $proposal->proposed_date->format('F j, Y') }}</td>
                    <td class="flex space-x-2">
                        <form action="{{ route('admin.proposals.approve', $proposal) }}" method="POST">
                            @csrf
                            <button type="submit" class="px-3 py-1 bg-green-500 text-white text-xs rounded">Approve</button>
                        </form>
                        <form action="{{ route('admin.proposals.reject', $proposal) }}" method="POST" onsubmit="return confirm('Are you sure you want to reject this? You will be asked for a reason.');">
                            @csrf
                            <input type="text" name="rejection_reason" placeholder="Rejection reason..." class="text-xs" required>
                            <button type="submit" class="px-3 py-1 bg-red-500 text-white text-xs rounded">Reject</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center py-4">No pending proposals found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-admin-layout>
