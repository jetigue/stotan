<div class="flex w-full">
    <div class="flex flex-col w-2/3 space-y-3 px-4">
        <div class="flex w-full justify-between items-center bg-white p-4 shadow rounded">
            <div class="flex w-1/6 text-left">
                @if($this->microcycle > 1)
                    <div class="cursor-pointer p-1 text-gray-400 hover:text-indigo-500">
                        <x-icon.chevron-left wire:click="previousMicrocycle" class="w-6 h-6" />
                    </div>
                @endif
            </div>
            <div class="flex text-center">
                Microcycle {{$this->microcycle}} of {{ $mesocycle->number_of_microcycles }}
            </div>
            <div class="flex w-1/6 justify-end">
                @if($mesocycle->number_of_microcycles > $this->microcycle)
                    <div class="cursor-pointer p-1 text-gray-400 hover:text-indigo-500">
                       <x-icon.chevron-right wire:click="nextMicrocycle" class="w-6 h-6" />
                    </div>
                @endif
            </div>
        </div>

        <ul class="space-y-3">
                @foreach($trainingDays as $trainingDay)
                    <li wire:key="{{ $loop->index }}" class="bg-white p-4 shadow rounded">
                        <div class="flex flex-col h-full w-full">
                            <div class="flex justify-between">
                                <div class="flex">
                                    <div class="text-gray-400 font-medium text-sm">
                                        {{ $trainingDay->training_day->format('F') }} {{ $trainingDay->training_day->format('d') }}
                                    </div>
                                </div>

                                @if($trainingDay->totalTimeRunning > 0)
                                    <div class="flex w-1/2 text-xs text-indigo-500 space-x-4 text-center">
                                        <span>{{ $trainingDay->totalTimeRunning }}</span>
                                        <span>{{ $trainingDay->totalMiles }} mi</span>
                                        <span>{{ $trainingDay->totalPoints }} pts</span>
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
        {{--            <livewire:training.training-days.training-day :trainingDay="$trainingDay" :key="$loop->index"/>--}}
                @endforeach
            </ul>
    </div>



    <div class="w-1/3 pl-2">
         <x-card.card-with-header>
             <x-slot name="header">
                 <div class="flex justify-center">
                    Microcycle {{ $this->microcycle }}
                 </div>
             </x-slot>
             <div class="flex flex-col">
                 <div>Total Time: {{ $trainingDays->sum('total_minutes') }} min</div>
                 <div>Total Miles: {{ $trainingDays->sum('total_miles') }} mi</div>
                 <div>Total Points: {{ $trainingDays->sum('total_points') }} pts</div>
             </div>

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

