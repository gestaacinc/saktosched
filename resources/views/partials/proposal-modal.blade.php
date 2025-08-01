<div x-data="proposalForm()" @open-proposal-modal.window="openModal()" >
    <!-- Terms and Agreement Modal -->
    <div x-show="isTermsModalOpen" @keydown.escape.window="closeModal()" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div @click.away="closeModal()" class="bg-white rounded-lg shadow-xl p-8 w-full max-w-2xl">
            <h3 class="font-poppins text-2xl font-bold text-[#00575A] mb-4">Terms of Proposal</h3>
            <div class="prose max-w-none h-64 overflow-y-auto text-sm text-gray-600 border p-4 rounded-md">
                <p>By proposing a new schedule, you are submitting a request for review. This does **not** create a live schedule immediately. An administrator will review your proposed date. If approved, a new pending schedule will be created, and your slot will be reserved upon payment of the ₱35.00 reservation fee. You will be notified of the outcome via email.</p>
                <h4>Data Privacy Notice</h4>
                <p>We collect your personal information (name, email, phone number) for the purpose of managing your assessment booking and for communication related to your schedule. Your data will be handled in accordance with the Data Privacy Act of 2012. We will not share your information with third parties without your consent, except as required by law or for official reporting to TESDA.</p>
            </div>
            <div class="mt-6">
                <label class="flex items-center">
                    <input type="checkbox" x-model="termsAgreed" class="rounded border-gray-300 text-[#00575A] shadow-sm">
                    <span class="ml-2 text-sm text-gray-700">I have read and agree to the terms and data privacy notice.</span>
                </label>
            </div>
            <div class="mt-6 flex justify-end space-x-4">
                <button @click="closeModal()" class="text-gray-600 px-4 py-2 rounded-lg">Cancel</button>
                <button @click="isTermsModalOpen = false; isProposalModalOpen = true" :disabled="!termsAgreed" class="bg-[#FFC107] text-gray-800 font-bold px-6 py-2 rounded-lg shadow-sm disabled:opacity-50">
                    Continue
                </button>
            </div>
        </div>
    </div>

    <!-- Proposal Form Modal -->
    <div x-show="isProposalModalOpen" @keydown.escape.window="closeModal()" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
        <div @click.away="closeModal()" class="bg-white rounded-lg shadow-xl p-8 w-full max-w-lg">
            <template x-if="!successMessage">
                <div>
                    <h3 class="font-poppins text-2xl font-bold text-[#00575A] mb-6">Propose a New Schedule</h3>
                    <form @submit.prevent="submitForm">
                        <div class="space-y-4">
                            <div>
                                <label for="proposer_name" class="block text-sm font-medium text-gray-700">Your Full Name</label>
                                <input type="text" x-model="formData.proposer_name" id="proposer_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <p x-show="errors.proposer_name" x-text="errors.proposer_name" class="text-sm text-red-600 mt-1"></p>
                            </div>
                            <div>
                                <label for="proposer_email" class="block text-sm font-medium text-gray-700">Your Email</label>
                                <input type="email" x-model="formData.proposer_email" id="proposer_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <p x-show="errors.proposer_email" x-text="errors.proposer_email" class="text-sm text-red-600 mt-1"></p>
                            </div>
                            <div>
                                <label for="proposer_phone" class="block text-sm font-medium text-gray-700">Your Phone Number</label>
                                <input type="tel" x-model="formData.proposer_phone" id="proposer_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <p x-show="errors.proposer_phone" x-text="errors.proposer_phone" class="text-sm text-red-600 mt-1"></p>
                            </div>
                            <hr>
                            <div>
                                <label for="qualification_id" class="block text-sm font-medium text-gray-700">Qualification</label>
                                <select x-model="formData.qualification_id" id="qualification_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                                    @foreach($allQualifications as $q)
                                        <option value="{{ $q->id }}">{{ $q->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label for="schedule_date" class="block text-sm font-medium text-gray-700">Preferred Date</label>
                                <input type="date" x-model="formData.schedule_date" id="schedule_date" min="{{ now()->addDay()->format('Y-m-d') }}" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                                <p x-show="errors.schedule_date" x-text="errors.schedule_date" class="text-sm text-red-600 mt-1"></p>
                            </div>
                        </div>
                        <div class="mt-8 flex justify-end space-x-4">
                            <button type="button" @click="isProposalModalOpen = false; isTermsModalOpen = true" class="text-gray-600 px-4 py-2 rounded-lg">Back</button>
                            <button type="submit" :disabled="isLoading" class="bg-[#00575A] text-white font-bold px-6 py-2 rounded-lg shadow-sm hover:bg-opacity-90 disabled:opacity-50">
                                <span x-show="!isLoading">Submit Proposal for Review</span>
                                <span x-show="isLoading">Submitting...</span>
                            </button>
                        </div>
                    </form>
                </div>
            </template>
            <template x-if="successMessage">
                <div class="text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                        <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
                    </div>
                    <h3 class="font-poppins text-2xl font-bold text-[#00575A] mb-4">Proposal Submitted!</h3>
                    <p x-text="successMessage" class="text-gray-600 mb-6"></p>
                    <div class="bg-gray-100 p-4 rounded-lg mb-8">
                        <p class="text-sm text-gray-600">Your Tracking Number:</p>
                        <p x-text="trackingNumber" class="text-2xl font-bold text-[#00575A] tracking-widest"></p>
                    </div>
                    <button @click="closeModal()" class="w-full bg-[#00575A] text-white font-bold py-3 px-8 rounded-lg">Done</button>
                </div>
            </template>
        </div>
    </div>
</div>
<script>
    function proposalForm() {
        return {
            isTermsModalOpen: false,
            isProposalModalOpen: false,
            termsAgreed: false,
            isLoading: false,
            formData: {
                qualification_id: '{{ $qualification->id }}',
                schedule_date: '',
                proposer_name: '{{ auth()->user()->name ?? '' }}',
                proposer_email: '{{ auth()->user()->email ?? '' }}',
                proposer_phone: '',
            },
            errors: {},
            successMessage: '',
            trackingNumber: '',
            openModal() {
                this.resetForm();
                this.isTermsModalOpen = true;
            },
            closeModal() {
                this.isTermsModalOpen = false;
                this.isProposalModalOpen = false;
                this.termsAgreed = false;
            },
            resetForm() {
                this.errors = {};
                this.successMessage = '';
                this.trackingNumber = '';
                this.isLoading = false;
            },
            async submitForm() {
                this.isLoading = true;
                this.errors = {};
                
                const response = await fetch('{{ route("schedules.propose") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(this.formData)
                });

                this.isLoading = false;

                if (response.ok) {
                    const data = await response.json();
                    this.successMessage = data.message;
                    this.trackingNumber = data.tracking_number;
                } else if (response.status === 422) {
                    const data = await response.json();
                    for (const key in data.errors) {
                        this.errors[key] = data.errors[key][0];
                    }
                } else {
                    alert('An unexpected error occurred. Please try again.');
                }
            }
        }
    }
</script>
