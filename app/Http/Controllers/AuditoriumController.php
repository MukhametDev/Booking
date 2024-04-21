<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Auditorium;
class AuditoriumController extends Controller
{
    public function index(){
        $auditoriums = Auditorium::all();

        return response()->json($auditoriums);
    }

    
}
