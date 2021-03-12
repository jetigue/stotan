<div class="flex w-full">
    <ul class="space-y-4 px-4 w-2/3">
        @foreach($trainingDays as $trainingDay)
            <li wire:key="{{ $loop->index }}" class="bg-white p-4 shadow rounded">
                <div class="flex flex-col h-full w-full">
                    <div class="flex justify-between">
                        <div class="flex">
                            <div class="text-gray-400 font-medium text-sm">{{ $trainingDay->calendar_date->format('F') }} {{ $trainingDay->calendar_date->format('d') }}</div>
                        </div>

                        <div class="flex">
                            @include('partials.training.days.add-run-dropdown')
                        </div>
                    </div>

                    <div class="flex w-full p-3">
                        @php
                            $primarySteadyRunCount = \DB::table('calendar')
                                ->where('calendar.calendar_date', $trainingDay->calendar_date)
                                ->join('steady_runs', 'calendar_date', '=', 'steady_runs.training_date')
                                ->where('steady_runs.training_session', 'primary')
                                ->count();

                            $secondarySteadyRunCount = \DB::table('calendar')
                                ->where('calendar.calendar_date', $trainingDay->calendar_date)
                                ->join('steady_runs', 'calendar_date', '=', 'steady_runs.training_date')
                                ->where('steady_runs.training_session', 'secondary')
                                ->count();

                            $primaryIntermittentRunCount = \DB::table('calendar')
                                ->where('calendar.calendar_date', $trainingDay->calendar_date)
                                ->join('intermittent_runs', 'calendar_date', '=', 'intermittent_runs.training_date')
                                ->where('intermittent_runs.training_session', 'primary')
                                ->count();

                            $secondaryIntermittentRunCount = \DB::table('calendar')
                                ->where('calendar.calendar_date', $trainingDay->calendar_date)
                                ->join('intermittent_runs', 'calendar_date', '=', 'intermittent_runs.training_date')
                                ->where('intermittent_runs.training_session', 'secondary')
                                ->count();

                            $primaryProgressiveRunCount = \DB::table('calendar')
                                ->where('calendar.calendar_date', $trainingDay->calendar_date)
                                ->join('progressive_runs', 'calendar_date', '=', 'progressive_runs.training_date')
                                ->where('progressive_runs.training_session', 'primary')
                                ->count();

                            $secondaryProgressiveRunCount = \DB::table('calendar')
                                ->where('calendar.calendar_date', $trainingDay->calendar_date)
                                ->join('progressive_runs', 'calendar_date', '=', 'progressive_runs.training_date')
                                ->where('progressive_runs.training_session', 'secondary')
                                ->count();

                            $primaryRunCount = $primarySteadyRunCount + $primaryIntermittentRunCount + $primaryProgressiveRunCount;
                            $secondaryRunCount = $secondarySteadyRunCount + $secondaryIntermittentRunCount + $secondaryProgressiveRunCount;
                        @endphp

                        <div class="flex flex-col w-full text-sm">
                            @if($primaryRunCount > 0 and $secondaryRunCount > 0)
                                <p class="text-gray-300 font-medium">Primary Session</p>
                            @endif

                            @foreach($primaryWarmUps as $warmUp)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $warmUp->training_date)
                                    @include('partials.training.runs.warm-ups')
                                @endif
                            @endforeach

                            @foreach($primaryIntermittentRuns as $intermittentRun)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $intermittentRun->training_date)
                                    @include('partials.training.runs.intermittent-runs')
                                @endif
                            @endforeach

                            @foreach($primaryProgressiveRuns as $progressiveRun)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $progressiveRun->training_date)
                                    @include('partials.training.runs.progressive-runs')
                                @endif
                            @endforeach

                            @foreach($primarySteadyRuns as $steadyRun)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $steadyRun->training_date)
                                    @include('partials.training.runs.steady-runs')
                                @endif
                            @endforeach

                            @foreach($primaryCoolDowns as $coolDown)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $coolDown->training_date)
                                    @include('partials.training.runs.cool-downs')
                                @endif
                            @endforeach

                            @if($primaryRunCount > 0 and $secondaryRunCount > 0)
                                <p class="mt-2 text-gray-300 font-medium">Secondary Session</p>
                            @endif

                            @foreach($secondaryWarmUps as $warmUp)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $warmUp->training_date)
                                    @include('partials.training.runs.warm-ups')
                                @endif
                            @endforeach

                            @foreach($secondaryIntermittentRuns as $intermittentRun)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $intermittentRun->training_date)
                                    @include('partials.training.runs.intermittent-runs')
                                @endif
                            @endforeach

                            @foreach($secondaryProgressiveRuns as $progressiveRun)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $progressiveRun->training_date)
                                    @include('partials.training.runs.progressive-runs')
                                @endif
                            @endforeach

                            @foreach($secondarySteadyRuns as $steadyRun)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $steadyRun->training_date)
                                    @include('partials.training.runs.steady-runs')
                                @endif
                            @endforeach

                            @foreach($secondaryCoolDowns as $coolDown)
                                @if($trainingDay->calendar_date->format('Y-m-d') === $coolDown->training_date)
                                    @include('partials.training.runs.cool-downs')
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </li>
        @endforeach

    </ul>

    <div class="w-1/3 pl-2">
         <x-card.card-with-header>
             <x-slot name="header">
                 {{ $trainingDays->links() }}
             </x-slot>
         </x-card.card-with-header>

    </div>

    <x-modal.form wire:model.defer="showWarmUpFormModal" name="Warm-up">
        <livewire:training.runs.warm-up-form :mesocycle="$mesocycle"/>
    </x-modal.form>

    <x-modal.form wire:model.defer="showSteadyRunFormModal" name="Steady Run">
        <livewire:training.runs.steady-run-form :mesocycle="$mesocycle"/>
    </x-modal.form>

    <x-modal.form wire:model.defer="showIntermittentRunFormModal" name="Intermittent Run">
        <livewire:training.runs.intermittent-run-form :mesocycle="$mesocycle"/>
    </x-modal.form>

    <x-modal.form wire:model.defer="showProgressiveRunFormModal" name="Progressive Run">
        <livewire:training.runs.progressive-run-form :mesocycle="$mesocycle"/>
    </x-modal.form>

    <x-modal.form wire:model.defer="showCoolDownFormModal" name="Cool-down">
        <livewire:training.runs.cool-down-form :mesocycle="$mesocycle"/>
    </x-modal.form>


</div>

