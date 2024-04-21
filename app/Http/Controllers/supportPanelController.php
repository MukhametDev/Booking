<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class supportPanelController extends Controller
{
    public function index(){
        $userName = Auth::user();
        $booking = Booking::all();
        return Inertia::render('SupportPanel',[
            'booking'=>$booking,
            'userName'=>$userName
        ]);
    }
}
