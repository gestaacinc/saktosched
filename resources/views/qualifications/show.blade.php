{{-- In the schedules grid section --}}
@foreach($schedules as $schedule)
    <div class="bg-white rounded-lg shadow-lg ...">
        <h3>{{ $schedule->schedule_date->format('l, F j, Y') }}</h3>
        <p>{{ $schedule->qualification->title }}</p>
        <p>{{ $schedule->bookings_count }}/{{ $schedule->max_slots }} slots filled</p>
        {{-- Add a form that submits to the BookingController --}}
        <form action="{{ route('bookings.store') }}" method="POST">
            @csrf
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            <button type="submit">Join This Batch</button>
        </form>
    </div>
@endforeach