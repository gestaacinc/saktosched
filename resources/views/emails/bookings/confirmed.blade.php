<x-mail::message>
# Booking Confirmation

Hello {{ $booking->booker_name }},

Thank you for your reservation! Your slot(s) for the following assessment schedule have been successfully booked:

**Qualification:** {{ $booking->assessmentSchedule->qualification->title }}
**Date:** {{ $booking->assessmentSchedule->schedule_date->format('F j, Y') }}
**Slots Reserved:** {{ $booking->slots_reserved }}

You will receive another notification once the batch is full and the schedule is officially confirmed.

Regards,<br>
{{ config('app.name') }}
</x-mail::message>