<?php

namespace App\Http\Controllers;

use App\Models\Auditorium;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminAuditoriumsController extends Controller
{
    public function showAuditoriums(){
        $auditoriums = Auditorium::all();
        return Inertia::render('AdminPanel',[
            'auditoriums'=>$auditoriums,
        ]);
    }

    public function store(Request $request){
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string|max:255',
            'floor'=>'required|numeric',
            'phone'=>'required|string',
            'capacity'=>'required|numeric',
        ]);

        Auditorium::create([
            'name' => $request->name,
            'description' => $request->description,
            'floor' => $request->floor,
            'phone' => $request->phone,
            'capacity' => $request->capacity
        ]);

        return redirect()->route('admin/dashboard');
    }
}
