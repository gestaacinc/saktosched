<div x-data="bookingForm()" @open-booking-modal.window="openModal($event.detail)" x-show="isOpen" @keydown.escape.window="closeModal()" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
    <div @click.away="closeModal()" class="bg-white rounded-lg shadow-xl p-8 w-full max-w-lg">
        <!-- Step 1: Booking Details -->
        <div x-show="step === 1">
            <h3 class="font-poppins text-2xl font-bold text-[#00575A] mb-6">Join This Batch</h3>
            <form @submit.prevent="submitDetailsForm">
                <div class="space-y-4">
                    <div>
                        <label for="slots_reserved" class="block text-sm font-medium text-gray-700">How many slots?</label>
                        <input type="number" x-model="formData.slots_reserved" id="slots_reserved" min="1" :max="formData.slots_left" class="mt-1 block w-full rounded-md" required>
                        <p x-show="errors.slots_reserved" x-text="errors.slots_reserved" class="text-sm text-red-600 mt-1"></p>
                    </div>
                    <hr>
                    <div>
                        <label for="booker_name" class="block text-sm font-medium text-gray-700">Your Full Name</label>
                        <input type="text" x-model="formData.booker_name" id="booker_name" class="mt-1 block w-full rounded-md" required>
                        <p x-show="errors.booker_name" x-text="errors.booker_name" class="text-sm text-red-600 mt-1"></p>
                    </div>
                    <div>
                        <label for="booker_email" class="block text-sm font-medium text-gray-700">Your Email</label>
                        <input type="email" x-model="formData.booker_email" id="booker_email" class="mt-1 block w-full rounded-md" required>
                        <p x-show="errors.booker_email" x-text="errors.booker_email" class="text-sm text-red-600 mt-1"></p>
                    </div>
                    <div>
                        <label for="booker_phone" class="block text-sm font-medium text-gray-700">Your Phone Number</label>
                        <input type="tel" x-model="formData.booker_phone" id="booker_phone" class="mt-1 block w-full rounded-md" required>
                        <p x-show="errors.booker_phone" x-text="errors.booker_phone" class="text-sm text-red-600 mt-1"></p>
                    </div>
                </div>
                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" @click="closeModal()" class="text-gray-600 px-4 py-2 rounded-lg">Cancel</button>
                    <button type="submit" :disabled="isLoading" class="bg-[#00575A] text-white font-bold px-6 py-2 rounded-lg disabled:opacity-50">
                        <span x-show="!isLoading">Proceed to Payment</span>
                        <span x-show="isLoading">Processing...</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Step 2: Payment Instructions & Upload -->
        <div x-show="step === 2">
            <h3 class="font-poppins text-2xl font-bold text-[#00575A] mb-4">Payment Instructions</h3>
            <p class="text-gray-600 mb-6">Please pay the total reservation fee of <strong class="text-lg" x-text="`₱${formData.amount}`"></strong> to one of the accounts below and upload a screenshot of your receipt.</p>
            <div class="bg-gray-50 p-4 rounded-lg text-sm space-y-3">
                <p><strong>GCash:</strong> Chester Allan F. Bautista - 0916-7252-2664</p>
                <p><strong>Maya:</strong> 065286545565</p>
                <p><strong>Union Bank:</strong> Chester Allan F. Bautista - 5265856585</p>
            </div>
            <form @submit.prevent="submitProofForm" class="mt-6">
                <div>
                    <label for="payment_proof" class="block text-sm font-medium text-gray-700">Upload Payment Proof</label>
                    <input type="file" @change="handleFileUpload" id="payment_proof" class="mt-1 block w-full text-sm" required>
                    <p x-show="errors.payment_proof" x-text="errors.payment_proof" class="text-sm text-red-600 mt-1"></p>
                </div>
                <div class="mt-8 flex justify-end space-x-4">
                    <button type="button" @click="step = 1" class="text-gray-600 px-4 py-2 rounded-lg">Back</button>
                    <button type="submit" :disabled="isLoading || !formData.payment_proof" class="bg-[#00575A] text-white font-bold px-6 py-2 rounded-lg disabled:opacity-50">
                        <span x-show="!isLoading">Submit Proof</span>
                        <span x-show="isLoading">Uploading...</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Step 3: Success Message -->
        <div x-show="step === 3" class="text-center">
            <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-6">
                <svg class="h-8 w-8 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" /></svg>
            </div>
            <h3 class="font-poppins text-2xl font-bold text-[#00575A] mb-4">Upload Successful!</h3>
            <p x-text="successMessage" class="text-gray-600 mb-6"></p>
            <button @click="closeAndRefresh()" class="w-full bg-[#00575A] text-white font-bold py-3 px-8 rounded-lg">Done</button>
        </div>
    </div>
</div>
<script>
    function bookingForm() {
        return {
            isOpen: false,
            isLoading: false,
            step: 1,
            formData: {
                schedule_id: null,
                slots_left: 1,
                slots_reserved: 1,
                booker_name: '',
                booker_email: '',
                booker_phone: '',
                booking_id: null,
                amount: 0,
                payment_proof: null,
            },
            errors: {},
            successMessage: '',
            openModal(detail) {
                this.resetForm();
                this.formData.schedule_id = detail.scheduleId;
                this.formData.slots_left = detail.slotsLeft;
                this.isOpen = true;
            },
            closeModal() { this.isOpen = false; },
            closeAndRefresh() { this.closeModal(); window.location.reload(); },
            resetForm() {
                this.step = 1;
                this.isLoading = false;
                this.formData.slots_reserved = 1;
                this.formData.booker_name = '';
                this.formData.booker_email = '';
                this.formData.booker_phone = '';
                this.formData.booking_id = null;
                this.formData.amount = 0;
                this.formData.payment_proof = null;
                this.errors = {};
                this.successMessage = '';
            },
            handleFileUpload(event) { this.formData.payment_proof = event.target.files[0]; },
            async submitDetailsForm() {
                this.isLoading = true;
                this.errors = {};
                
                const response = await fetch('{{ route("bookings.store") }}', {
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
                    this.formData.booking_id = data.booking_id;
                    this.formData.amount = data.amount;
                    this.step = 2; // Move to payment step
                } else if (response.status === 422) {
                    const data = await response.json();
                    for (const key in data.errors) {
                        this.errors[key] = data.errors[key][0];
                    }
                } 
                else { alert('An error occurred.'); }
            },
            async submitProofForm() {
                if (!this.formData.payment_proof) return;
                this.isLoading = true;
                this.errors = {};

                const uploadFormData = new FormData();
                uploadFormData.append('payment_proof', this.formData.payment_proof);
                
                const url = `/bookings/${this.formData.booking_id}/upload-proof`;
                const response = await fetch(url, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Accept': 'application/json',
                    },
                    body: uploadFormData
                });

                this.isLoading = false;
                if (response.ok) {
                    const data = await response.json();
                    this.successMessage = data.message;
                    this.step = 3; // Move to success step
                } else if (response.status === 422) {
                    const data = await response.json();
                    for (const key in data.errors) {
                        this.errors[key] = data.errors[key][0];
                    }
                } 
                else { alert('An error occurred during upload.'); }
            }
        }
    }
</script>
