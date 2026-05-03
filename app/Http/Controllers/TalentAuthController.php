<?php
namespace App\Http\Controllers;
use App\Models\Talent;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TalentAuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) return redirect()->route('talent.dashboard');
        return view('talent.auth.login');
    }

    public function login(Request $request)
    {
        $creds = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($creds, $request->boolean('remember'))) {
            $request->session()->regenerate();
            Auth::user()->talent?->update(['last_active_at' => now()]);
            return redirect()->intended(route('talent.dashboard'));
        }

        return back()->withErrors(['email' => 'Invalid credentials.'])->withInput();
    }

    public function showRegister()
    {
        if (Auth::check()) return redirect()->route('talent.dashboard');
        return view('talent.auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'name'                  => 'required|string|max:255',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Create a draft talent profile linked to this user
        $talent = Talent::create([
            'user_id'   => $user->id,
            'type'      => 'talent',
            'name'      => $data['name'],
            'slug'      => Str::slug($data['name']) . '-' . $user->id,
            'status'    => 'draft',
            'is_active' => false,
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('talent.profile.edit')
                         ->with('success', 'Welcome! Please complete your talent profile.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('talent.login')->with('success', 'You have been logged out.');
    }
}
