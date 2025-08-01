<x-app-layout>
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-24">
        <div class="max-w-md mx-auto bg-white p-8 rounded-lg shadow-lg text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-[#00575A] mb-6">
                <svg class="h-8 w-8 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 18.375a6.375 6.375 0 100-12.75 6.375 6.375 0 000 12.75zM12 12v.007A4.875 4.875 0 0012 2.625a4.875 4.875 0 00-4.875 4.875c0 1.14.36 2.18.96 3.032l-1.125 1.125a.375.375 0 000 .53l2.625 2.625a.375.375 0 00.53 0l1.125-1.125A4.832 4.832 0 0012 12z" />
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-[#00575A] mb-4">Proposal Submitted!</h2>
            <p class="text-gray-600 mb-6">Your request has been sent for admin review. You will receive an email notification once it has been processed. Please save your tracking number.</p>
            <div class="bg-gray-100 p-4 rounded-lg mb-8">
                <p class="text-sm text-gray-600">Your Proposal Tracking Number is:</p>
                <p class="text-2xl font-bold text-[#00575A] tracking-widest">{{ $proposal->tracking_number }}</p>
            </div>
            <a href="{{ route('home') }}" class="w-full bg-[#00575A] text-white font-bold py-3 px-8 rounded-lg shadow-sm hover:bg-opacity-90 transition-all text-lg">Back to Home</a>
        </div>
    </div>
</x-app-layout>