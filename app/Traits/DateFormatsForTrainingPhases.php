<?php


namespace App\Traits;


use Carbon\Carbon;
use Carbon\CarbonPeriod;

trait DateFormatsForTrainingPhases
{

    public function getBeginDateForHumansAttribute()
    {
        return $this->begin_date->format('M d Y');
    }

    public function getEndDateForHumansAttribute()
    {
        return $this->end_date->format('M d Y');
    }

    public function getBeginDateForEditingAttribute()
    {
        return $this->begin_date->format('m/d/Y');
    }

    public function getEndDateForEditingAttribute()
    {
        return $this->end_date->format('m/d/Y');
    }

    public function getNumberOfWeeksAttribute(): int
    {
        $end = Carbon::parse($this->end_date);

        $begin = Carbon::parse($this->begin_date);

        return $end->diffInWeeks($begin);
    }

    public function getPeriodOfAllDaysInMonthsAttribute(): CarbonPeriod
    {
        return CarbonPeriod::create($this->begin_date->firstOfMonth(), $this->end_date->lastOfMonth());
    }

    public function getPeriodOfDaysAttribute(): CarbonPeriod
    {
        return Carbon::parse($this->begin_date)->daysUntil($this->end_date);

    }

    public function getMonthsAttribute(): CarbonPeriod
    {
        return Carbon::parse($this->begin_date)->firstOfMonth()->monthsUntil($this->end_date);
    }

    public function getWeeksAttribute(): CarbonPeriod
    {
        return Carbon::parse($this->begin_date)->weeksUntil($this->end_date);
    }

    public function getBeginningDayAttribute(): string
    {
        return Carbon::parse($this->begin_date)->firstOfMonth()->format('l');
    }
}
