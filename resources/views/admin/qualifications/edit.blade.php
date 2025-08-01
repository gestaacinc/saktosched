<x-admin-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Edit Qualification</h2>
                    <form action="{{ route('admin.qualifications.update', $qualification) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $qualification->title }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>{{ $qualification->description }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label for="assessment_fee" class="block text-sm font-medium text-gray-700">Assessment Fee (₱)</label>
                            <input type="number" step="0.01" name="assessment_fee" id="assessment_fee" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" value="{{ $qualification->assessment_fee }}" required>
                        </div>
                        <div class="mb-4">
                            <label for="is_active" class="block text-sm font-medium text-gray-700">Status</label>
                            <select name="is_active" id="is_active" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                <option value="1" @if($qualification->is_active) selected @endif>Active</option>
                                <option value="0" @if(!$qualification->is_active) selected @endif>Inactive</option>
                            </select>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update Qualification</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>