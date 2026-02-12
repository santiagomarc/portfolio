<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * display login form
     */
    public function showLogin()
    {
        if (Session::get('logged_in')) {
            return redirect()->route('dashboard');
        }        
        return view('auth.login');
    }

    /**
     * Handle login authentication
     * Now checks PostgreSQL database instead of hardcoded values
     */
    public function authenticate(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $email = trim($request->email);
        $password = trim($request->password);
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            Session::put('logged_in', true);
            Session::put('user_id', $user->id);
            Session::put('username', $user->name);
            Session::put('user_email', $user->email);
            
            return redirect()->route('dashboard')
                ->with('success', 'Welcome back, ' . $user->name . '!');
        }

        return back()->withErrors([
            'email' => 'Invalid email or password.'
        ])->withInput($request->only('email'));
    }

    /**
     * Handle logout
     */
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logged out successfully!');
    }
}