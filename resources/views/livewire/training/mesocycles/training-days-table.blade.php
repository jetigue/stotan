<div class="flex w-full">
    <ul class="space-y-4 px-4 w-2/3">
        @foreach($trainingDays as $trainingDay)
            <li wire:key="{{ $loop->index }}" class="bg-white p-4 shadow rounded">
                <div class="flex flex-col h-full w-full">
                    <div class="flex justify-between">
                        <div class="flex">
                            <div class="text-gray-400 font-medium text-sm">
                                {{ $trainingDay->training_day->format('F') }} {{ $trainingDay->training_day->format('d') }}
                            </div>
                        </div>

                        <div>
                            {{ $trainingDay->primary_session_minutes }}
                        </div>

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

{{--                        @foreach($trainingDay->primaryIntermittentRuns as $intermittentRun)--}}
{{--                            @include('partials.training.runs.intermittent-runs')--}}
{{--                        @endforeach--}}

{{--                        @foreach($trainingDay->primaryProgressiveRuns as $progressiveRun)--}}
{{--                            @include('partials.training.runs.progressive-runs')--}}
{{--                        @endforeach--}}

{{--                        @foreach($trainingDay->primaryCoolDowns as $coolDown)--}}
{{--                            @include('partials.training.runs.cool-downs')--}}
{{--                        @endforeach--}}

{{--                        @if($trainingDay->number_of_primary_runs > 0 and $trainingDay->number_of_secondary_runs > 0)--}}
{{--                            <p class="mt-2 text-gray-300 font-medium">Secondary Session</p>--}}
{{--                        @endif--}}

{{--                        @foreach($trainingDay->secondaryWarmUps as $warmUp)--}}
{{--                            @include('partials.training.runs.warm-ups')--}}
{{--                        @endforeach--}}

{{--                        @foreach($trainingDay->secondarySteadyRuns as $steadyRun)--}}
{{--                            @include('partials.training.runs.steady-runs')--}}
{{--                        @endforeach--}}

{{--                        @foreach($trainingDay->secondaryIntermittentRuns as $intermittentRun)--}}
{{--                            @include('partials.training.runs.intermittent-runs')--}}
{{--                        @endforeach--}}

{{--                        @foreach($trainingDay->secondaryProgressiveRuns as $progressiveRun)--}}
{{--                            @include('partials.training.runs.progressive-runs')--}}
{{--                        @endforeach--}}

{{--                        @foreach($trainingDay->secondaryCoolDowns as $coolDown)--}}
{{--                            @include('partials.training.runs.cool-downs')--}}
{{--                        @endforeach--}}

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

