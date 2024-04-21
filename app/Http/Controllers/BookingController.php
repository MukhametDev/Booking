<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditorium;
use Inertia\Inertia;
use Illuminate\Foundation\Application;
class BookingController extends Controller
{
    public function show(){
        $data = Auditorium::all();
        return Inertia::render('Booking',['auditoriums' => $data,
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
    }
}
