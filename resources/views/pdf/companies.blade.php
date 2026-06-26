<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">

    <style>
        body {
            font-family: sans-serif;
            font-size: 12px;
        }

        h1 {
            font-size: 20px;
            margin-bottom: 16px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 6px;
        }

        th {
            background-color: #eee;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>会社一覧</h1>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>会社名</th>
                <th>メールアドレス</th>
            </tr>
        </thead>

        <tbody>
            {{-- ControllerまたはServiceから渡された会社一覧データを1件ずつ表示する --}}
            @foreach ($companies as $company)
                <tr>
                    <td>{{ $company->id }}</td>
                    <td>{{ $company->name }}</td>
                    <td>{{ $company->mail }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
