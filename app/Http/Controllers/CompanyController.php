<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Inertia\Inertia;

use App\Http\Requests\StoreCompanyRequest;
use App\Http\Requests\UpdateCompanyRequest;

use App\Services\CsvService;
use App\Services\PdfService;

// use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CompanyController extends Controller
{
  public function __construct(
    private CsvService $csvService,
    private PdfService $pdfService
  ) {}

  public function index()
  {
    $companies = Company::all();

    return Inertia::render('Companies/Index', [
      'companies' => $companies,
    ]);
  }

  public function create()
  {
    return Inertia::render('Companies/Create');
  }


  public function store(StoreCompanyRequest $request)
  {
    $validated = $request->validated();

    Company::create($validated);

    return to_route('companies.index')
      ->with([
        'message' => '作成しました。',
        'status' => 'success'
      ]);
  }

  public function edit(int $id)
  {
    try {
      $company = Company::findOrFail($id);

      return Inertia::render('Companies/Edit', [
        'company' => $company
      ]);
    } catch (ModelNotFoundException $e) {
      return to_route('companies.index')
        ->with([
          'message' => '指定のデータが見つかりません。',
          'status' => 'danger'
        ]);
    }
  }

  public function update(UpdateCompanyRequest $request, int $id)
  {
    $company = Company::findOrFail($id);

    $validated = $request->validated();

    $company->update($validated);

    return to_route('companies.index')
      ->with([
        'message' => '更新しました。',
        'status' => 'success'
      ]);
  }

  public function destroy(int $id)
  {
    $company = Company::findOrFail($id);

    $company->delete();

    return to_route('companies.index')
      ->with([
        'message' => '削除しました。',
        'status' => 'danger'
      ]);
  }

  // 会社一覧CSV出力
  public function exportCsv()
  {
    // カラム明示
    $columns = [
      'id' => 'ID',
      'name' => '会社名',
      'mail' => 'メールアドレス',
      'created_at' => '作成日時',
      'updated_at' => '更新日時',
    ];

    // 全件取得。ただし、カラムはkeyで。
    $companies = Company::select(array_keys($columns))->get();

    $fileName = 'companyAll.csv';


    // 処理結果を、CSVダウンロードとしてブラウザに返す
    return response()->streamDownload(function () use ($companies, $columns) {
      $this->csvService->writingCsv($companies, $columns);
    }, $fileName, [
      'Content-Type' => 'text/csv',
    ]);
  }

  public function exportPdf()
  {
    // 会社一覧PDFに出力する会社データを取得する
    $companies = Company::select([
      'id',
      'name',
      'mail',
    ])
      ->orderBy('id', 'asc')
      ->get();

    // Controller側ではmPDFの細かい処理を書かない
    $pdf = $this->pdfService->createCompanyListPdf($companies);

    // PDFをブラウザに返すときのヘッダー情報
    $headers = [
      // Content-Type：PDFファイルであることを示す
      'Content-Type' => 'application/pdf',
      // Content-Disposition：ダウンロード時のファイル名を指定する
      'Content-Disposition' => 'attachment; filename="companies.pdf"',
    ];

    return response($pdf)->withHeaders($headers);
  }
}
