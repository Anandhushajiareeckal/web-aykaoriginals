<?php
namespace App\Http\Controllers;
use App\Models\Talent;
use Illuminate\Http\Request;
class TalentController extends Controller {
    public function index(Request $request) {
        $talents    = Talent::talents()->active()->with('media')->filter($request->only(['gender','category','location']))->orderBy('name')->paginate(16)->withQueryString();
        $categories = Talent::talents()->active()->distinct()->pluck('category')->filter()->sort()->values();
        return view('talent.index', compact('talents','categories'));
    }

    public function modelsIndex(Request $request) {
        $models    = Talent::models()->active()->with('media')->filter($request->only(['gender','category','location']))->orderBy('name')->paginate(16)->withQueryString();
        $categories = Talent::models()->active()->distinct()->pluck('category')->filter()->sort()->values();
        return view('model.index', compact('models','categories'));
    }
    public function show(Talent $talent) {
        $user = auth()->user();
        $isOwner = $user && $user->id === $talent->user_id;
        $isAdmin = session('admin_logged_in');

        abort_unless($talent->is_active || $isOwner || $isAdmin, 404);
        
        // If it's a model, redirect to the model specific route if requested via talent URL? 
        // Or just let them be. The user wants them separate.
        if ($talent->type === 'model' && !request()->routeIs('model.show')) {
            return redirect()->route('model.show', $talent->slug);
        }

        $talent->load('media');
        $relatedTalents = Talent::talents()->active()->where('id','!=',$talent->id)->where('gender',$talent->gender)->with('media')->inRandomOrder()->limit(4)->get();
        return view('talent.show', compact('talent','relatedTalents'));
    }

    public function showModel(Talent $talent) {
        $user = auth()->user();
        $isOwner = $user && $user->id === $talent->user_id;
        $isAdmin = session('admin_logged_in');

        abort_unless($talent->is_active || $isOwner || $isAdmin, 404);
        
        $talent->load('media');
        return view('model.show', compact('talent'));
    }
}
