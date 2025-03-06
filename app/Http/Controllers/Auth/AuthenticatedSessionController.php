<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\AdminModel;
use App\Models\FinancialYearModel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
      
        return view('admin_panel.auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
    
            if ($user->status === 'no') {
                Auth::logout();
                return redirect()->route('login')->withErrors(['blocked' => 'Your account is blocked. You cannot log in.']);
            }
            
                 Session::put('user_palinpassword', Auth::user()->plain_password);
            
            // if ($user->ip_address && $user->ip_address != $request->getClientIp()) {
            //     Auth::logout();
            //     return redirect()->route('login')->withErrors(['ip_address' => 'IP address does not match.']);
            // }
            $request->session()->regenerate();
    setActiveFinancialSession();
            return redirect()->route('dashboard');
        }
        return back()->withErrors(['email' => 'Invalid credentials.']);
    }
    

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['success'=>'Your Loged Out Successfully']);
    }
}
