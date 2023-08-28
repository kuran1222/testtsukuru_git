@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テスト結果画面</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrap">
        <div class="title_h1">
            <h1>テスト結果一覧</h1>
        </div>
        <div class="back_top">
            <a href="{{ route ('index_teacher') }}">トップへ戻る</a>
        </div>
        <div>
            <table border="1" class="list">
                <tr>
                    <th>テスト名</th>
                    <th>生徒氏名</th>
                    <th>点数</th>
                    <th>実施日</th>
                </tr>
                @foreach ($results as $result)
                <tr>
                    <td>{{ $result->test_title }}</td>
                    <td>{{ $result->name }}</td>
                    <td>{{ $result->score }}</td>
                    <td>{{ $result->created_at }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>
@endsection