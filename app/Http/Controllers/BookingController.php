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

            $schedule = AssessmentSchedule::withCount('bookings')->findOrFail($validatedData['schedule_id']);
            $slots_available = $schedule->max_slots - $schedule->bookings_count;

            if ($validatedData['slots_reserved'] > $slots_available) {
                // Throw a validation exception for the frontend to catch
                throw ValidationException::withMessages([
                    'slots_reserved' => "Sorry, there are only {$slots_available} slots available for this schedule.",
                ]);
            }

            DB::beginTransaction();

            $user = User::firstOrCreate(
                ['email' => $validatedData['booker_email']],
                [
                    'name' => $validatedData['booker_name'],
                    'password' => Hash::make(Str::random(12)),
                ]
            );

            Booking::create([
                'user_id' => $user->id,
                'assessment_schedule_id' => $schedule->id,
                'slots_reserved' => $validatedData['slots_reserved'],
                'reservation_fee_paid' => 35.00 * $validatedData['slots_reserved'],
                'payment_status' => 'reservation_paid',
                'booker_name' => $validatedData['booker_name'],
                'booker_email' => $validatedData['booker_email'],
                'booker_phone' => $validatedData['booker_phone'],
            ]);

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Your slot(s) have been successfully reserved! A confirmation email has been sent.',
            ]);

        } catch (ValidationException $e) {
            // Laravel's default exception handler will format this as a 422 JSON response
            throw $e;
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'An unexpected error occurred. Please try again.',
            ], 500);
        }
    }
}
