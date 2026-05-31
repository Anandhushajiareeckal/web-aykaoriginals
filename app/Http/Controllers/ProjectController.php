<?php
namespace App\Http\Controllers;
use App\Models\Project;
class ProjectController extends Controller {
    public function index() {
        $projects = Project::active()->with('media')->orderByDesc('year')->paginate(12);
        $sections = \App\Models\WorkSection::all()->keyBy('section_key');
        return view('projects.index', compact('projects', 'sections'));
    }
    public function show(Project $project) {
        abort_unless($project->is_active, 404);
        $project->load('media');
        return view('projects.show', compact('project'));
    }
}
