<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $table = 'booking';
    protected $fillable = [
        "applicant_name",
        "contact_phone",
        "technical_support",
        "leader_name",
        "date",
        "time",
        "auditorium_name",
        "verified",
        "email"
    ];
}
