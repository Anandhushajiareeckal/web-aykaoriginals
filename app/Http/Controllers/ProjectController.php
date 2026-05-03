<?php
namespace App\Http\Controllers;
use App\Models\Project;
class ProjectController extends Controller {
    public function index() {
        $projects = Project::active()->with('media')->orderByDesc('year')->paginate(12);
        return view('projects.index', compact('projects'));
    }
    public function show(Project $project) {
        abort_unless($project->is_active, 404);
        $project->load('media');
        return view('projects.show', compact('project'));
    }
}
