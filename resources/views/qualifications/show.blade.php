<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2">
                <h2 class="text-3xl font-bold text-[#00575A] mb-6">Available Schedules for: {{ $qualification->title }}</h2>
                <div class="space-y-6">
                    @forelse($schedules as $schedule)
                        @php
                            $slots_left = $schedule->max_slots - $schedule->bookings_count;
                            $is_full = $slots_left <= 0;
                        @endphp
                        <div x-data="{ scheduleId: {{ $schedule->id }}, slotsLeft: {{ $slots_left }} }" class="bg-white rounded-lg shadow-lg p-6 flex flex-col md:flex-row md:items-center md:justify-between">
                            <div class="flex-grow">
                                <h3 class="text-xl font-bold text-[#00575A]">{{ $schedule->schedule_date->format('l, F j, Y') }}</h3>
                                <p class="text-sm text-gray-600 mb-4 font-semibold">{{ $schedule->bookings_count }}/{{ $schedule->max_slots }} slots filled ({{ $slots_left }} available)</p>
                                <div class="w-full bg-gray-200 rounded-full h-4">
                                    <div class="bg-[#00575A] h-4 rounded-full" style="width: {{ ($schedule->bookings_count / $schedule->max_slots) * 100 }}%"></div>
                                </div>
                            </div>
                            <div class="mt-4 md:mt-0 md:ml-6 shrink-0">
                                @if($is_full)
                                    <button disabled class="w-full md:w-auto bg-gray-300 text-gray-500 font-bold py-3 px-6 rounded-lg cursor-not-allowed">Batch Full</button>
                                @else
                                    <button @click="$dispatch('open-booking-modal', { scheduleId: scheduleId, slotsLeft: slotsLeft })" class="w-full md:w-auto bg-[#FFC107] text-gray-800 font-bold py-3 px-6 rounded-lg shadow-sm hover:bg-yellow-500 transition-all">
                                        Join This Batch
                                    </button>
                                @endif
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full text-center bg-white p-12 rounded-lg shadow-md">
                            <p class="text-xl text-gray-500">There are currently no pending schedules for this qualification.</p>
                        </div>
                    @endforelse
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center text-center hover:border-[#00575A] hover:bg-white transition-all">
                        <h3 class="text-xl font-bold text-[#00575A]">Can't find a suitable date?</h3>
                        <p class="text-gray-600 my-4">Submit a proposal for admin review.</p>
                        <button @click="$dispatch('open-proposal-modal')" class="w-full md:w-auto mt-auto text-[#00575A] border-2 border-[#00575A] font-bold py-3 px-6 rounded-lg hover:bg-[#00575A] hover:text-white transition-all">
                            Propose a New Schedule
                        </button>
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
                        <p class="text-xs text-gray-600">
                            Accredited by: <br>
                            <span class="font-semibold">Technical Education and Skills Development Authority (TESDA)</span>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">Accreditation No: AC-NTR-123456</p>
                    </div>
                 </div>
            </div>
        
            @include('partials.booking-modal')
            @include('partials.proposal-modal', ['allQualifications' => $allQualifications, 'qualification' => $qualification])

    </div>
</x-app-layout>