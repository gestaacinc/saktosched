<div x-data="bookingForm()" @open-booking-modal.window="openModal($event.detail)" x-show="isOpen" @keydown.escape.window="closeModal()" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50" style="display: none;">
    <div @click.away="closeModal()" class="bg-white rounded-lg shadow-xl p-8 w-full max-w-lg">
        <template x-if="!successMessage">
            <div>
                <h3 class="font-poppins text-2xl font-bold text-[#00575A] mb-6">Join This Batch</h3>
                <form @submit.prevent="submitForm">
                    <div class="space-y-4">
                        <div>
                            <label for="slots_reserved" class="block text-sm font-medium text-gray-700">How many slots?</label>
                            <input type="number" x-model="formData.slots_reserved" id="slots_reserved" value="1" min="1" :max="formData.slots_left" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <p x-show="errors.slots_reserved" x-text="errors.slots_reserved" class="text-sm text-red-600 mt-1"></p>
                        </div>
                        <hr>
                        <div>
                            <label for="booker_name" class="block text-sm font-medium text-gray-700">Your Full Name</label>
                            <input type="text" x-model="formData.booker_name" id="booker_name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <p x-show="errors.booker_name" x-text="errors.booker_name" class="text-sm text-red-600 mt-1"></p>
                        </div>
                        <div>
                            <label for="booker_email" class="block text-sm font-medium text-gray-700">Your Email</label>
                            <input type="email" x-model="formData.booker_email" id="booker_email" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <p x-show="errors.booker_email" x-text="errors.booker_email" class="text-sm text-red-600 mt-1"></p>
                        </div>
                        <div>
                            <label for="booker_phone" class="block text-sm font-medium text-gray-700">Your Phone Number</label>
                            <input type="tel" x-model="formData.booker_phone" id="booker_phone" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm" required>
                            <p x-show="errors.booker_phone" x-text="errors.booker_phone" class="text-sm text-red-600 mt-1"></p>
                        </div>
                    </div>
                    <div class="mt-8 flex justify-end space-x-4">
                        <button type="button" @click="closeModal()" class="text-gray-600 px-4 py-2 rounded-lg">Cancel</button>
                        <button type="submit" :disabled="isLoading" class="bg-[#00575A] text-white font-bold px-6 py-2 rounded-lg shadow-sm hover:bg-opacity-90 disabled:opacity-50">
                            <span x-show="!isLoading">Pay Reservation Fee & Join</span>
                            <span x-show="isLoading">Processing...</span>
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
                <h3 class="font-poppins text-2xl font-bold text-[#00575A] mb-4">Success!</h3>
                <p x-text="successMessage" class="text-gray-600 mb-6"></p>
                <button @click="closeAndRefresh()" class="w-full bg-[#00575A] text-white font-bold py-3 px-8 rounded-lg">Done</button>
            </div>
        </template>
    </div>
</div>
<script>
    function bookingForm() {
        return {
            isOpen: false,
            isLoading: false,
            formData: {
                schedule_id: null,
                slots_left: 1,
                slots_reserved: 1,
                booker_name: '',
                booker_email: '',
                booker_phone: '',
            },
            errors: {},
            successMessage: '',
            openModal(detail) {
                this.resetForm();
                this.formData.schedule_id = detail.scheduleId;
                this.formData.slots_left = detail.slotsLeft;
                this.isOpen = true;
            },
            closeModal() {
                this.isOpen = false;
            },
            closeAndRefresh() {
                this.closeModal();
                window.location.reload();
            },
            resetForm() {
                this.formData.slots_reserved = 1;
                this.formData.booker_name = '';
                this.formData.booker_email = '';
                this.formData.booker_phone = '';
                this.errors = {};
                this.successMessage = '';
                this.isLoading = false;
            },
            async submitForm() {
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
                    this.successMessage = data.message;
                } else if (response.status === 422) {
                    const data = await response.json();
                    // Laravel sends errors in an 'errors' object, with each key being an array.
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