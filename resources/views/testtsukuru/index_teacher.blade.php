@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index_teacher</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body class='body'>
    
    <div class='wrap'>
        <div class='box index_teacher'>
            <a style="text-decoration:none;" href="{{ route ('test_edit') }}">テスト新規作成</a>
            <a style="text-decoration:none;" href="{{ route ('test_result') }}">テスト結果一覧</a>
            <a style="text-decoration:none;" href="{{ route ('student_list') }}">生徒一覧</a>
        </div>
    </div>
    
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>
@endsection