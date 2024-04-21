<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\BookingController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use Inertia\Response;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): Response
    {
        return Inertia::render('Auth/Login', [
            'canResetPassword' => Route::has('password.request'),
            'status' => session('status'),
        ]);
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {

        $credentials = $request->only('email', 'password', 'role');
        // dd($credentials);
        // Проверяем, что введена роль
        if (!isset($credentials['role'])) {
            return back()->withErrors(['role' => 'Укажите вашу роль']);
        }

        // Выбор guard'а в зависимости от указанной роли
        switch ($credentials['role']) {
            case 'auditManager':
                $guard = 'audit_manager';
                $redirectUrl = 'auditPanel'; // URL для аудиторов
                break;
            case 'supportManager':
                $guard = 'support_manager';
                $redirectUrl = 'supportPanel'; // URL для техподдержки
                break;
            default:
                $guard = 'web';
                $redirectUrl = 'booking'; // URL по умолчанию для обычных пользователей
                break;
        }

        // Пытаемся выполнить аутентификацию
        if (Auth::guard($guard)->attempt($request->only('email', 'password'))) {
            // dd(Auth::guard('support_manager')->check());
            // Аутентификация успешна, перенаправляем пользователя на соответствующий URL
            return redirect()->intended($redirectUrl);
        }

        // Аутентификация не удалась
        return back()->withErrors(['email' => 'Ошибка аутентификации']);
        // $request->authenticate();
        // $request->session()->regenerate();

        // // dd(Auth::user()->role);
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }
        // if (Auth::user()->role == "auditManager") {
        //     // dd(Auth::user()->role);
        //     return redirect()->route('auditPanel');
        // }

        // if (Auth::user()->role == "supportManager") {
        //     // dd(Auth::user()->role);
        //     return redirect()->route('supportPanel');
        // }


        // if (Auth::user()->role == 'user') {
        //     return redirect(route('booking'));
        // } else {
        //     return redirect(route('login')); // Redirecting same dashboard when user try to access another dashboard by typing in the URL
        // }
          // Валидация входных данных
        //   return redirect(route('login'));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
