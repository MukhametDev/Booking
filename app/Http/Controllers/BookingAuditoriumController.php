<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\User;
use Inertia\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Illuminate\Support\Facades\Log;
class BookingAuditoriumController extends Controller
{
    public function create(Request $request){
        $booking = Booking::all();
        $user_email = Auth::user();

         return Inertia::render('BookingAuditorium',[
            'auditoriumName'=>$request->auditoriumName,
            'booking'=> $booking,
            'user_email' =>$user_email,
         ]);
    }
}
