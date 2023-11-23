<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class TimeBetween implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        //
        $pickupDate = Carbon::parse($value);
        $pickupTime = Carbon::createFromTime($pickupDate->hour, $pickupDate->minute, $pickupDate->second);

        //Cuando el negocio está abierto
        $earliestTime = Carbon::createFromTimeString('10:00:00');
        $lastTime = Carbon::createFromTimeString('21:00:00');
        return $pickupTime->between($earliestTime, $lastTime) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Seleccione una hora de 10:00AM - 9:00PM.';
    }
}
