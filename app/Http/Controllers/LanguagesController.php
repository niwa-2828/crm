<?php

namespace App\Http\Controllers;

use App\Models\Language;
use Inertia\Inertia;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LanguagesController extends Controller
{
  public function index()
  {
    $languages = Language::all();

    return Inertia::render('Languages/Index', [
      'languages' => $languages,
    ]);
  }

  public function create()
  {
    return Inertia::render('Languages/Create',[
      'languages' => Language::all(),
    ]);
  }


  public function store(Request $request)
  {
    $validated = $request->validate([
      'language' => 'required',
    ]);

    Language::create($validated);

    return to_route('languages.index')
      ->with([
        'message' => '作成しました。',
        'status' => 'success'
      ]);
  }

  public function edit(int $id)
  {
    try {
      $language = Language::findOrFail($id);

      return Inertia::render('Languages/Edit', [
        'language' => $language,
      ]);
    } catch (ModelNotFoundException $e) {
      return to_route('languages.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger'
        ]);
    }
  }

  public function update(Request $request, int $id)
  {
    $language = Language::findOrFail($id);

    $validated = $request->validate([
      'language' => $language,
    ]);

    $language->update($validated);

    return to_route('languages.index')
      ->with([
        'message' => '更新しました。',
        'status' => 'success'
      ]);
  }

  public function destroy(int $id)
  {
    $language = Language::findOrFail($id);

    $language->delete();

    return to_route('languages.index')
      ->with([
        'message' => '削除しました。',
        'status' => 'danger'
      ]);
  }
}
