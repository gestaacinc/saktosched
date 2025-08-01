<x-guest-layout>
    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h2 class="text-2xl font-bold mb-4">Institutional Inquiry Form</h2>
                    <form action="{{ route('inquiry.store') }}" method="POST">
                        @csrf
                        <!-- Add all form fields from the prototype here -->
                        <div class="mb-4">
                            <label for="organization_name">School/Organization Name</label>
                            <input type="text" name="organization_name" id="organization_name" class="mt-1 block w-full rounded-md" required>
                        </div>
                        <!-- ... other fields: representative_name, email, phone, etc. -->
                        <div class="mb-4">
                            <label for="qualification_id">Qualification</label>
                            <select name="qualification_id" id="qualification_id" class="mt-1 block w-full rounded-md" required>
                                @foreach($qualifications as $qualification)
                                    <option value="{{ $qualification->id }}">{{ $qualification->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <label for="num_applicants">Number of Applicants</label>
                            <input type="number" name="num_applicants" id="num_applicants" class="mt-1 block w-full rounded-md" required>
                        </div>
                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Submit Inquiry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>