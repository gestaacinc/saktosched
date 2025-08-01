<?php

namespace App\Http\Controllers;

use App\Models\AssessmentSchedule;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'schedule_id' => 'required|exists:assessment_schedules,id',
                'slots_reserved' => 'required|integer|min:1',
                'booker_name' => 'required|string|max:255',
                'booker_email' => 'required|email|max:255',
                'booker_phone' => 'required|string|max:20',
            ]);

            $schedule = AssessmentSchedule::withSum('bookings', 'slots_reserved')->findOrFail($validatedData['schedule_id']);
            $slots_booked = $schedule->bookings_sum_slots_reserved ?? 0;
            $slots_available = $schedule->max_slots - $slots_booked;

            if ($validatedData['slots_reserved'] > $slots_available) {
                throw ValidationException::withMessages(['slots_reserved' => "Sorry, only {$slots_available} slots are available."]);
            }
            
            $existingBooking = Booking::where('assessment_schedule_id', $schedule->id)->where('booker_email', $validatedData['booker_email'])->exists();
            if ($existingBooking) {
                throw ValidationException::withMessages(['booker_email' => "This email has already booked a slot for this schedule."]);
            }

            DB::beginTransaction();

            $user = User::firstOrCreate(
                ['email' => $validatedData['booker_email']],
                ['name' => $validatedData['booker_name'], 'password' => Hash::make(Str::random(12))]
            );

            $booking = Booking::create([
                'user_id' => $user->id,
                'assessment_schedule_id' => $schedule->id,
                'slots_reserved' => $validatedData['slots_reserved'],
                'reservation_fee_paid' => 35.00 * $validatedData['slots_reserved'],
                'payment_status' => 'pending_payment', // <-- NEW STATUS
                'booker_name' => $validatedData['booker_name'],
                'booker_email' => $validatedData['booker_email'],
                'booker_phone' => $validatedData['booker_phone'],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'booking_id' => $booking->id,
                'amount' => $booking->reservation_fee_paid,
            ]);

        } catch (ValidationException $e) {
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'An unexpected error occurred. Please try again.'], 500);
        }
    }

    public function uploadProof(Request $request, Booking $booking)
    {
        $request->validate([
            'payment_proof' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('payment_proof')->store('payment_proofs', 'public');

        $booking->update([
            'payment_proof_path' => $path,
            'payment_status' => 'pending_verification',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Payment proof uploaded! We are now verifying your payment. You will receive a confirmation email shortly.'
        ]);
    }
}