@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index_student</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrap">
        <div class="title_h1">
            <h1>受講可能テスト一覧</h1>
        </div>
        <table border="1" class="list">
            <tr>
                <th>テスト名</th>
                <th>科目</th>
                <th></th>
            </tr>
            @foreach ($exams as $exam)
            <tr>
                <td>{{$exam->test_title}}</td>
                <td>{{$exam->subject}}</td>
                <td>
                    <form method="POST" action="{{ route ('exam') }}">
                        @csrf
                        <button type="submit" name="test_title" value="{{ $exam->test_title }}">テストを受ける</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>
@endsection