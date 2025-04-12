<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mechanic extends Model
{
    protected $fillable = ['name'];

    public function appointmentsToday()
{
    return $this->hasMany(Appointment::class)
        ->whereDate('appointment_date', now()->toDateString());
}

}

