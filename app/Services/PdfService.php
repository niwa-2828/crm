<?php

namespace App\Services;

use Mpdf\Mpdf;

class PdfService
{
    public function createCompanyListPdf(iterable $companies)
    {
        // PDF用のBladeテンプレートに会社データを渡し、HTML文字列に変換する
        $html = view('pdf.companies', [
            'companies' => $companies,
        ])->render();

        // mPDFのインスタンスを作成する
        $mpdf = new Mpdf([
            'mode' => 'ja',
            'format' => 'A4',
        ]);

        // HTMLをPDF本文として流し込む
        $mpdf->WriteHTML($html);

        // 完成したPDFを文字列として返す
        // 'S' はPDFを直接表示・保存せず、文字列として取得する指定
        return $mpdf->Output('companies.pdf', 'S');
    }
}
