<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'name', 'address', 'phone', 'car_license', 'car_engine', 'appointment_date', 'mechanic_id'
    ];

    public function mechanic()
    {
        return $this->belongsTo(Mechanic::class);
    }
}
