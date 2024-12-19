<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
    
        $request->session()->regenerate();
    
        $role = Auth::user()->role; // Authenticated user's role
    
        switch ($role) {
            case '0': // Admin
                return redirect()->intended(route('admin'));
                break;
            case '1': // Seller
                return redirect()->intended(route('seller.index'));
                break;
            case '2': // Customer
                return redirect()->intended(route('customer.profile'));
                break;
            default:
                return redirect()->back()->with('error', 'Invalid role assigned to the user.');
        }
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
