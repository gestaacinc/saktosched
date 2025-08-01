<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <!-- Left Column: Branding & Info -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 bg-white rounded-lg shadow-lg p-8">
                    <div class="flex items-center justify-center space-x-4 mb-6">
                        <img src="{{ asset('images/tesda-logo.png') }}" alt="TESDA Logo" class="h-20">
                        <img src="{{ asset('images/logo.png') }}" alt="GEST AAC Inc. Logo" class="h-20">
                    </div>
                    <h1 class="text-2xl font-bold text-center text-[#00575A]">Great Enthusiasts of Skills Training Academy and Assessment Center Inc.</h1>
                    <p class="text-center text-gray-500 mt-2">"Your TESDA Assessment, Scheduled."</p>
                    <hr class="my-6">
                    <p class="text-sm text-gray-600">
                        An accredited assessment center of the <span class="font-semibold">Technical Education and Skills Development Authority (TESDA)</span>. We provide a clear and trusted way to get your National Certificate.
                    </p>
                    <a href="{{ route('inquiry.create') }}" class="block w-full text-center mt-8 bg-[#00575A] text-white font-bold py-3 px-4 rounded-lg shadow-sm hover:bg-opacity-90 transition-all">
                        Book for a Group/School
                    </a>
                </div>
            </div>

            <!-- Right Column: Qualifications List -->
            <div class="lg:col-span-2">
                <h2 class="text-3xl font-bold text-[#00575A] mb-6">Find Your Qualification</h2>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-100 text-green-800 border border-green-200 rounded-md">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- ENHANCEMENT: Live Search Input -->
                <div class="mb-6">
                    <input type="text" id="qualificationSearch" placeholder="Type to search for a qualification..." class="w-full px-4 py-3 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-[#00575A]">
                </div>

                <div id="qualificationsList" class="space-y-4">
                    @forelse($qualifications as $qualification)
                        <!-- ENHANCEMENT: Added group class for hover effect -->
                        <div class="qualification-card" data-title="{{ strtolower($qualification->title) }}">
                            <a href="{{ route('qualifications.show', $qualification) }}" class="group block bg-white rounded-lg shadow-md hover:shadow-xl hover:border-[#00575A] border-2 border-transparent transition-all duration-300 p-6">
                                <div class="flex justify-between items-center">
                                    <div>
                                        <h3 class="text-xl font-bold text-[#00575A]">{{ $qualification->title }}</h3>
                                        <p class="text-gray-600 mt-1">{{ $qualification->description }}</p>
                                    </div>
                                    <!-- ENHANCEMENT: Sliding arrow icon on hover -->
                                    <div class="ml-4 shrink-0 text-[#00575A] transform transition-transform duration-300 group-hover:translate-x-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                          <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                        </svg>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @empty
                        <!-- ENHANCEMENT: Improved Empty State -->
                        <div class="bg-white rounded-lg shadow-md p-12 text-center">
                            <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                            </svg>
                            <h3 class="mt-2 text-sm font-medium text-gray-900">No qualifications available</h3>
                            <p class="mt-1 text-sm text-gray-500">Please check back later.</p>
                        </div>
                    @endforelse
                </div>
                <!-- ENHANCEMENT: Message for when search yields no results -->
                <div id="noResultsMessage" class="hidden bg-white rounded-lg shadow-md p-12 text-center">
                    <p class="text-xl text-gray-500">No qualifications match your search.</p>
                </div>
            </div>

        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('qualificationSearch');
            const qualificationsList = document.getElementById('qualificationsList');
            const qualificationCards = qualificationsList.getElementsByClassName('qualification-card');
            const noResultsMessage = document.getElementById('noResultsMessage');

            searchInput.addEventListener('keyup', function() {
                const searchTerm = searchInput.value.toLowerCase();
                let resultsFound = false;

                for (let i = 0; i < qualificationCards.length; i++) {
                    const card = qualificationCards[i];
                    const title = card.getAttribute('data-title');
                    
                    if (title.includes(searchTerm)) {
                        card.style.display = '';
                        resultsFound = true;
                    } else {
                        card.style.display = 'none';
                    }
                }
                
                noResultsMessage.style.display = resultsFound ? 'none' : 'block';
            });
        });
    </script>
</x-app-layout>