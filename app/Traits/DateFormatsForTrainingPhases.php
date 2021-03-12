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

    public function getNumberOfDaysAttribute(): int
    {
        return count(CarbonPeriod::create($this->begin_date, $this->end_date));
    }

    public function getNumberOfWeeksAttribute()
    {
        $days =  count(CarbonPeriod::create($this->begin_date, $this->end_date));

        return $days >= 7 ? floor($days / 7) : 0;
    }

    public function getNumberOfRemainderDaysAttribute()
    {
        $days = count(CarbonPeriod::create($this->begin_date, $this->end_date));

        $weeks = floor($days / 7);

        return $days % 7;
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
