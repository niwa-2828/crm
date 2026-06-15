<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Company;
use App\Models\Language;
use Inertia\Inertia;

use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

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
    return Inertia::render('Projects/Create', [
      'companies' => Company::all(),
      'languages' => Language::all(),
    ]);
  }


  public function store(StoreProjectRequest $request)
  {
    $validated = $request->validated();

    //  projectsテーブルに保存するデータを作成する。
    $project_data = [
      'title' => $validated['title'],
      'company_id' => $validated['company_id'],
    ];

    /**
     * detail が送られてきている場合だけ、登録データに含める。
     * detail が存在しない場合は、projectsテーブルの detail カラムを更新しない。
     */
    if (isset($validated['detail'])) {
      $project_data['detail'] = $validated['detail'];
    }

    // language_ids の初期値を空配列にする。

    $language_ids = [];

    /**
     * 画面から language_ids が送られてきている場合だけ、
     * その値を $language_ids に入れる。
     */
    if (isset($validated['language_ids'])) {
      $language_ids = $validated['language_ids'];
    }

    // DBトランザクション

    DB::transaction(function () use ($project_data, $language_ids) {
      // projectsテーブルに案件を登録する
      $project = Project::create($project_data);

      // language_projectテーブルに一括登録するための配列を作る
      $language_project_insert_data = [];

      // 同じ処理で作るデータなので、日時を1回だけ取得して使い回す
      $now = now();

      foreach ($language_ids as $language_id) {
        $language_project_insert_data[] = [
          'project_id' => $project->id,
          'language_id' => $language_id,
          'created_at' => $now,
          'updated_at' => $now,
        ];
      }

      // 選択された言語がある場合だけ、中間テーブルに一括登録する。

      if (count($language_project_insert_data) > 0) {
        DB::table('language_project')->insert($language_project_insert_data);
      }
    });

    return to_route('projects.index')
      ->with([
        'message' => '作成しました。',
        'status' => 'success',
      ]);
  }


  public function edit(int $id)
  {
    try {
      $project = Project::with('languages')->findOrFail($id);

      return Inertia::render('Projects/Edit', [
        'project' => $project,
        'companies' => Company::all(),
        'languages' => Language::all(),
      ]);
    } catch (ModelNotFoundException $e) {
      return to_route('projects.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger'
        ]);
    }
  }

  public function update(UpdateProjectRequest $request, int $id)
  {
    $validated = $request->validated();

    // projectsテーブルに更新するデータを作成する。
    $project_data = [
      'title' => $validated['title'],
      'company_id' => $validated['company_id'],
    ];

    /**
     * detail が送られてきている場合だけ、更新対象に含める。
     * detail が存在しない場合は、projectsテーブルの detail カラムを更新しない。
     */
    if (isset($validated['detail'])) {
      $project_data['detail'] = $validated['detail'];
    }

    // language_ids の初期値を空配列にする。
    $language_ids = [];

    /**
     * 画面から language_ids が送られてきている場合は、
     * その値を $language_ids に入れる。
     */
    if (isset($validated['language_ids'])) {
      $language_ids = $validated['language_ids'];
    }

    /**
     * 中間テーブル language_project に一括登録するための配列を作成する。
     * ここではまだDBには保存しない。
     */
    $language_project_insert_data = [];
    $now = now();
    
    foreach ($language_ids as $language_id) {
        $language_project_insert_data[] = [
            'project_id' => $id,
            'language_id' => $language_id,
            'created_at' => $now,
            'updated_at' => $now,
        ];
    }

    //  DBトランザクション
    DB::transaction(function () use ($id, $project_data, $language_project_insert_data) {
      $project = Project::findOrFail($id);

      // projectsテーブルの対象レコードを更新する
      $project->update($project_data);

      // 中間テーブル language_project の既存データを削除する。
      DB::table('language_project')
        ->where('project_id', $project->id)
        ->delete();

      // バルクインサートを使って、選択された言語がある場合だけ、一括登録する
      if (count($language_project_insert_data) > 0) {
        DB::table('language_project')->insert($language_project_insert_data);
      }
    });

    return to_route('projects.index')
      ->with([
        'message' => '更新しました。',
        'status' => 'success',
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
