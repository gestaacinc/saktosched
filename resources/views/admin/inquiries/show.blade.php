<x-admin-layout>
    <h3 class="text-gray-700 text-3xl font-medium">Process Inquiry</h3>

    <div class="mt-8">
        <div class="p-6 bg-white rounded-md shadow-md">
            <h4 class="text-xl font-bold mb-4">Inquiry Details</h4>
            <p><strong>Organization:</strong> {{ $inquiry->organization_name }}</p>
            <p><strong>Representative:</strong> {{ $inquiry->representative_name }}</p>
            <p><strong>Email:</strong> {{ $inquiry->email }}</p>
            <p><strong>Phone:</strong> {{ $inquiry->phone }}</p>
            <p><strong>Qualification:</strong> {{ $inquiry->qualification->title }}</p>
            <p><strong>Applicants:</strong> {{ $inquiry->num_applicants }}</p>
            <p><strong>Current Status:</strong> {{ ucfirst($inquiry->status) }}</p>

            <hr class="my-6">

            <h4 class="text-xl font-bold mb-4">Update Status</h4>
            <form action="{{ route('admin.inquiries.update', $inquiry) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="flex items-center space-x-4">
                    <select name="status" class="block w-1/2 rounded-md border-gray-300 shadow-sm">
                        <option value="pending" @if($inquiry->status == 'pending') selected @endif>Pending</option>
                        <option value="verified" @if($inquiry->status == 'verified') selected @endif>Verified</option>
                        <option value="proposal_sent" @if($inquiry->status == 'proposal_sent') selected @endif>Proposal Sent</option>
                        <option value="confirmed" @if($inquiry->status == 'confirmed') selected @endif>Confirmed</option>
                        <option value="rejected" @if($inquiry->status == 'rejected') selected @endif>Rejected</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-md">Update Status</button>
                </div>
            </form>
        </div>
    </div>
</x-admin-layout>