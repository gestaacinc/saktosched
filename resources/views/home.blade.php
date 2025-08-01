{{-- In the qualifications grid section --}}
@foreach($qualifications as $qualification)
    <div class="bg-white rounded-lg shadow-lg ...">
        <h3>{{ $qualification->title }}</h3>
        <p>{{ $qualification->description }}</p>
        <a href="{{ route('qualifications.show', $qualification) }}">View Schedules</a>
    </div>
@endforeach