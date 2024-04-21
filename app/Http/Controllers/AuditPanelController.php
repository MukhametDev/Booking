<?php

namespace App\Http\Controllers;

use App\Mail\BookingApproved;
use App\Mail\DenyMessage;
use App\Mail\SupportNotification;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class AuditPanelController extends Controller
{
    public function approveRequest($id){
        $support_managers = User::where('role','supportManager')->get();
        $booking = Booking::findOrFail($id);
        Mail::to($booking->email)->send(new BookingApproved($booking));
        foreach($support_managers as $manager){
            Mail::to($manager->email)->send(new SupportNotification($booking));
        }
        return redirect()->intended();
    }

    public function denyMessage(Request $request,$id){
        $booking = Booking::findOrFail($id);
        Mail::to($booking->email)->send(new DenyMessage($request->input('reason')));
        return redirect()->intended();
    }
}
