<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Inertia\Inertia;

class auditPanel extends Controller
{
    public function index(Request $request){
        $data = Booking::all();
        // dd($data);
        return Inertia::render('AuditPanel',[
            "data"=>$data
        ]);
    }

    public function store(Request $request){
        // dd($request->all());
    try{
        Booking::create([
            'applicant_name' => $request->applicant_name,
            'contact_phone'=> $request->contact_phone,
            'technical_support' => $request->technical_support,
            'leader_name' => $request->leader_name,
            'date' => $request->date,
            'time' => $request->time,
            'auditorium_name'=>$request->auditoriumName,
            'email'=>$request->email
        ]);
        return redirect(route('booking'));
    }
    catch(ValidationException $e){
        return Inertia::render('auditoriums',[
            'errors' => $e->validator->getMessageBag(),
        ])->toResponse($request)->setStatusCode(422);
    }
    }

    public function approve(Request $request,$id){
        $booking = Booking::find($id);
        if(!$booking){
            return redirect()->intended();
        }
        $booking->update(['verified' => true]);
        return redirect()->intended(route('auditPanel'));
    }
}
