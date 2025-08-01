<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <h2 class="text-3xl font-bold text-[#00575A] mb-6">Available Schedules for: {{ $qualification->title }}</h2>

                @if(session('error'))
                    <div class="mb-6 p-4 bg-red-100 text-red-800 border border-red-200 rounded-md">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="space-y-6">
                    @forelse($schedules as $schedule)
                        @php
                            $slots_left = $schedule->max_slots - $schedule->bookings_count;
                            $progress = ($schedule->bookings_count / $schedule->max_slots) * 100;
                            $is_full = $slots_left <= 0;
                        @endphp
                        <div class="bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-grow">
                                <div class="flex items-center mb-2">
                                    <h3 class="text-xl font-bold text-[#00575A]">{{ $schedule->schedule_date->format('l, F j, Y') }}</h3>
                                    @if(!$is_full && $slots_left <= 2)
                                        <span class="ml-3 px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">Limited Slots!</span>
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 mb-4 font-semibold">{{ $schedule->bookings_count }}/{{ $schedule->max_slots }} slots filled ({{ $slots_left }} available)</p>
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="bg-[#00575A] h-4 rounded-full" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-6 shrink-0">
                                @if($is_full)
                                    <button disabled class="w-full md:w-auto bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded-lg cursor-not-allowed">Batch Full</button>
                                @else
                                    @auth
                                        <form action="{{ route('bookings.store') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
                                            <button type="submit" class="w-full md:w-auto bg-[#FFC107] text-gray-800 font-bold py-3 px-6 rounded-lg shadow-sm hover:bg-yellow-500 transition-all">Join This Batch</button>
                                        </form>
                                    @else
                                        <a href="{{ route('login') }}" class="w-full block text-center md:w-auto bg-gray-300 text-gray-700 font-bold py-3 px-6 rounded-lg">Log in to Join</a>
                                    @endauth
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center bg-white p-12 rounded-lg shadow-md">
                            <p class="text-xl text-gray-500">There are currently no pending schedules for this qualification.</p>
                        </div>
                    @endforelse

                    <!-- Propose New Schedule Card -->
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:border-[#00575A] hover:bg-white transition-all">
                        <h3 class="text-xl font-bold text-[#00575A]">Can't find a suitable date?</h3>
                        <p class="text-gray-600 my-4">Be the first to start a new batch.</p>
                        <a href="#" class="w-full md:w-auto mt-auto text-[#00575A] border-2 border-[#00575A] font-bold py-3 px-6 rounded-lg hover:bg-[#00575A] hover:text-white transition-all">
                            Propose a New Schedule
                        </a>
                    </div>
                </div>
            </div>

            <!-- Right Column: Sidebar -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-8">
                    <div class="bg-white rounded-lg shadow-lg p-6 text-center">
                        <img src="{{ asset('images/logo.png') }}" alt="Assessment Center Logo" class="h-20 mx-auto mb-4">
                        <h3 class="text-xl font-bold text-[#00575A]">GEST AAC Inc.</h3>
                        <p class="text-sm text-gray-500 mt-2">"Your TESDA Assessment, Scheduled."</p>
                        <hr class="my-4">
                        <p class="text-xs text-gray-600">Accredited by: <br><span class="font-semibold">TESDA</span></p>
                        <p class="text-xs text-gray-500 mt-1">Accreditation No: AC-NTR-123456</p>
                    </div>

                    <div class="bg-white rounded-lg shadow-lg p-6">
                        <h3 class="text-xl font-bold text-[#00575A] mb-4">Filter Schedules</h3>
                        <form>
                            <div class="space-y-4">
                                <div>
                                    <label for="filter_qualification" class="block text-sm font-medium text-gray-700">Qualification</label>
                                    <select id="filter_qualification" name="filter_qualification" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#00575A] focus:border-[#00575A] sm:text-sm rounded-md">
                                        @foreach($allQualifications as $q)
                                            <option value="{{ $q->id }}" {{ $q->id == $qualification->id ? 'selected' : '' }}>
                                                {{ $q->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div>
                                    <label for="filter_date" class="block text-sm font-medium text-gray-700">Date</label>
                                    <input type="date" name="filter_date" id="filter_date" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-[#00575A] focus:ring-[#00575A]">
                                </div>
                                <div>
                                    <button type="submit" class="w-full bg-[#00575A] text-white font-bold py-2 px-4 rounded-lg hover:bg-opacity-90 transition-all">Apply Filters</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
