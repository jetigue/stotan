@php
    $totalSteadyRunMinutes = \DB::table('calendar')
        ->join('steady_runs', 'calendar_date', '=', 'steady_runs.training_date')
        ->where('calendar.calendar_date', $trainingDay->calendar_date)
        ->where('steady_runs.duration_unit', 'minutes')
        ->sum('steady_runs.duration');

    $hours = floor($totalSteadyRunMinutes / 60);
    $minutes = $totalSteadyRunMinutes % 60;
@endphp

<div class="flex flex-col text-xs w-1/5">
    <span>Total time:</span>
    @if ($hours < 1)
        <span>{{ $minutes }} min</span>
    @elseif ($hours === 1)
        <span>{{ $hours }} hr {{ $minutes }} minutes</span>
    @else
        <span>{{ $hours }} hrs {{ $minutes }} minutes</span>
    @endif
</div>
