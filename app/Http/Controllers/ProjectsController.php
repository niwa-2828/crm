<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ProjectsController extends Controller
{
  public function index()
  {
    $projects = Project::with('company')->get();

    return Inertia::render('Projects/Index', [
      'projects' => $projects,
    ]);
  }

  public function create()
  {
    return Inertia::render('Projects/Create',[
      'companies' => Company::all(),
    ]);
  }


  public function store(Request $request)
  {
    $validated = $request->validate([
      'title' => 'required',
      'company_id' => 'required',
      'detail' => 'nullable'
    ]);

    Project::create($validated);

    return to_route('projects.index')
      ->with([
        'message' => '作成しました。',
        'status' => 'success'
      ]);
  }

  public function edit(int $id)
  {
    try {
      $project = Project::findOrFail($id);

      return Inertia::render('Projects/Edit', [
        'project' => $project,
        'companies' => Company::all(),
      ]);
    } catch (ModelNotFoundException $e) {
      return to_route('projects.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger'
        ]);
    }
  }

  public function update(Request $request, int $id)
  {
    $project = Project::findOrFail($id);

    $validated = $request->validate([
      'title' => 'required',
      'company_id' => 'required',
      'detail' => 'nullable'
    ]);

    $project->update($validated);

    return to_route('projects.index')
      ->with([
        'message' => '更新しました。',
        'status' => 'success'
      ]);
  }

  public function destroy(int $id)
  {
    $project = Project::findOrFail($id);

    $project->delete();

    return to_route('projects.index')
      ->with([
        'message' => '削除しました。',
        'status' => 'danger'
      ]);
  }
}
