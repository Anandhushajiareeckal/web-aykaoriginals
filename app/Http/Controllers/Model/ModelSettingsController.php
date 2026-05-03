<?php
namespace App\Http\Controllers\Model;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ModelSettingsController extends Controller
{
    public function index()
    {
        $user   = Auth::user();
        $talent = $user->talent;
        return view('model.settings.index', compact('user', 'talent'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        $data = $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update($data);
        return back()->with('success', 'Account settings updated.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = Auth::user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        $user->update(['password' => Hash::make($request->password)]);
        return back()->with('success', 'Password updated successfully.');
    }

    public function updateVisibility(Request $request)
    {
        $talent = Auth::user()->talent;
        if ($talent) {
            $talent->update(['is_active' => $request->boolean('is_active')]);
        }
        return back()->with('success', 'Profile visibility updated.');
    }
}
