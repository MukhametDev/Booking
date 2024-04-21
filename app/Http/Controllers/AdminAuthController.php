<?php

namespace App\Http\Controllers;


use App\Http\Requests\AdminLoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\ServiceProvider;

class AdminAuthController extends Controller
{
    public function getLogin(){
        return Inertia::render('AdminLogin');
    }

    public function postLogin(AdminLoginRequest $request):RedirectResponse
    {
       $request->authenticate();
       $request->session()->regenerate();
       return redirect()->intended('admin/dashboard');
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        return redirect('/admin/login');
    }
}
