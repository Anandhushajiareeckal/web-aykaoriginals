<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ModelAuth {
    public function handle(Request $request, Closure $next) {
        $isTalentPortal = $request->is('talent-portal*');
        $loginRoute = $isTalentPortal ? 'talent.portal.login' : 'model.login';

        if (!Auth::check()) {
            return redirect()->route($loginRoute)->with('error', 'Please log in to access your portal.');
        }
        
        // Ensure user has a linked talent profile
        $user = Auth::user();
        if (!$user->talent && !$request->routeIs('model.profile.edit','model.profile.update','model.settings.*','talent.portal.profile.edit')) {
            $editRoute = $isTalentPortal ? 'talent.portal.profile.edit' : 'model.profile.edit';
            return redirect()->route($editRoute)->with('info', 'Please complete your profile first.');
        }
        return $next($request);
    }
}
