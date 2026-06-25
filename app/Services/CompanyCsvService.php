<?php

namespace App\Services;

class CompanyCsvService
{
    public function writingCsv(iterable $records, array $columns): void
    {
        // CSVの書き込み先を開く処理。
        // 'w'=write 書き込みモードのこと
        $handle = fopen('php://output', 'w');

        // Excelで文字化けしないようにUTF-8 BOMを付ける
        fwrite($handle, "\xEF\xBB\xBF");

        // CSVの1行目。見出し名だけを書き込む。
        fputcsv($handle, array_values($columns));

        foreach ($records as $record) {
            $row = [];

            foreach (array_keys($columns) as $column) {
                $row[] = $record->{$column};
            }
            
            fputcsv($handle, $row);
        }

        // fopenに対応する、出力先を閉じる処理
        fclose($handle);
    }
}
