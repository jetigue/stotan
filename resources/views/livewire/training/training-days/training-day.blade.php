<li class="bg-white p-4 shadow rounded">
    <div class="flex flex-col h-full w-full">
        <div class="flex justify-between">
            <div class="flex">
                <div class="text-gray-400 font-medium text-sm">
                    {{ $trainingDay->training_day->format('F') }} {{ $trainingDay->training_day->format('d') }}
                </div>
            </div>

            @if($this->totalTimeRunning > 0)
                <div class="flex w-1/2 text-xs text-indigo-500 space-x-4 text-center">
                    <span>{{ $this->totalTimeRunning }}</span>
                    <span>{{ $this->totalMiles }}</span>
                    <span>{{ $this->totalPoints }}</span>
                </div>
            @endif

            <div class="flex">
                @include('partials.training.days.add-run-dropdown')
            </div>
        </div>

        <div class="flex flex-col w-full text-sm">

            @if($trainingDay->number_of_primary_runs > 0 and $trainingDay->number_of_secondary_runs > 0)
                <p class="mt-2 text-gray-300 font-medium">Primary Session</p>
            @endif

            @foreach($trainingDay->steadyRuns as $warmUp)
                @if ($warmUp->steady_run_type_id == 1 and $warmUp->training_session === 'primary')
                    @include('partials.training.runs.warm-ups')
                @endif
            @endforeach

            @foreach($trainingDay->intermittentRuns as $intermittentRun)
                @if ($intermittentRun->training_session === 'primary')
                    @include('partials.training.runs.intermittent-runs')
                @endif
            @endforeach

            @foreach($trainingDay->SteadyRuns as $steadyRun)
                @if ($steadyRun->steady_run_type_id > 2 and $steadyRun->training_session === 'primary')
                    @include('partials.training.runs.steady-runs')
                @endif
            @endforeach

            @foreach($trainingDay->progressiveRuns as $progressiveRun)
                @if ($progressiveRun->training_session = 'primary')
                    @include('partials.training.runs.progressive-runs')
                @endif
            @endforeach

            @foreach($trainingDay->steadyRuns as $coolDown)
                @if ($coolDown->steady_run_type_id == 2 and $coolDown->training_session === 'primary')
                    @include('partials.training.runs.cool-downs')
                @endif
            @endforeach

            @if($trainingDay->number_of_primary_runs > 0 and $trainingDay->number_of_secondary_runs > 0)
                <div class="text-gray-300 font-medium">Secondary Session</div>
            @endif

            @foreach($trainingDay->steadyRuns as $warmUp)
                @if ($warmUp->steady_run_type_id == 1 and $warmUp->training_session === 'secondary')
                    @include('partials.training.runs.warm-ups')
                @endif
            @endforeach

            @foreach($trainingDay->intermittentRuns as $intermittentRun)
                @if ($intermittentRun->training_session === 'secondary')
                    @include('partials.training.runs.intermittent-runs')
                @endif
            @endforeach

            @foreach($trainingDay->SteadyRuns as $steadyRun)
                @if ($steadyRun->steady_run_type_id > 2 and $steadyRun->training_session === 'secondary')
                    @include('partials.training.runs.steady-runs')
                @endif
            @endforeach

            @foreach($trainingDay->progressiveRuns as $progressiveRun)
                @if ($progressiveRun->training_session === 'secondary')
                    @include('partials.training.runs.progressive-runs')
                @endif
            @endforeach

            @foreach($trainingDay->steadyRuns as $coolDown)
                @if ($coolDown->steady_run_type_id == 2 and $coolDown->training_session === 'secondary')
                    @include('partials.training.runs.cool-downs')
                @endif
            @endforeach
        </div>
    </div>
</li>
