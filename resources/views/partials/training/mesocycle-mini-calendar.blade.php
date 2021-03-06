<div class="flex flex-wrap w-full h-auto content-start">
    @foreach ($mesocycle->macrocycle->months as $month)
        <div class="flex w-1/2 py-3 px-2">
            <div class="flex-col w-full">
                <div class="flex justify-center mb-2 text-center">
                    <p class="text-xs">
                        {{ $month->format('F') }}
                    </p>
                </div>
                <div class="flex text-center text-tiny">
                    <div class="w-1/7">S</div>
                    <div class="w-1/7">M</div>
                    <div class="w-1/7">T</div>
                    <div class="w-1/7">W</div>
                    <div class="w-1/7">T</div>
                    <div class="w-1/7">F</div>
                    <div class="w-1/7">S</div>
                </div>
                <div class="flex flex-wrap">
                    @switch($month->firstOfMonth()->format('l'))
                        @case('Monday')
                        <div class="w-1/7"></div>
                        @break

                        @case('Tuesday')
                        <div class="w-2/7"></div>
                        @break

                        @case('Wednesday')
                        <div class="w-3/7"></div>
                        @break

                        @case('Thursday')
                        <div class="w-4/7"></div>
                        @break

                        @case('Friday')
                        <div class="w-5/7"></div>
                        @break

                        @case('Saturday')
                        <div class="w-6/7"></div>
                        @break

                        @case('Sunday')
                        <div></div>
                        @break
                    @endswitch
                    @foreach ($mesocycle->macrocycle->period_of_all_days_in_months as $date)
                        @if ($date->format('F') === $month->format('F'))
                            <div class="relative flex h-4 border border-gray-100 w-1/7">
                                @if($date >= $mesocycle->begin_date && $date <= $mesocycle->end_date)
                                    <div class="absolute w-full min-h-full z-10 text-center" style="background: {{$mesocycle->color->hex_code}}">
                                        <p class="text-gray-100 text-tiny">
                                            {{ $date->format('j') }}
                                        </p>
                                    </div>
                                @elseif($date >= $mesocycle->macrocycle->begin_date && $date <= $mesocycle->macrocycle->end_date)
                                    <div class="absolute min-h-full w-full bg-gray-50 text-center">
                                        <p class="text-gray-400 text-tiny">
                                            {{ $date->format('j') }}
                                        </p>
                                    </div>
                                @else
{{--                                    @if($date >= $mesocycle->macrocycle->begin_date && $date <= $mesocycle->macrocycle->end_date)--}}
{{--                                        <div class="w-full bg-gray-50">--}}
{{--                                            <p class="text-gray-400 text-tiny">--}}
{{--                                                {{ $date->format('j') }}--}}
{{--                                            </p>--}}
{{--                                        </div>--}}
{{--                                    @endif--}}
                                @endif
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    @endforeach
</div>
