@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>生徒一覧画面</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrap">
        <div class="title_h1">
            <h1>生徒一覧</h1>
        </div>
        <div class="back_top">
            <a href="{{ route ('index_teacher') }}">トップへ戻る</a>
        </div>
        <div>
            <table border="1" class="list">
                <tr>
                    <th class="id">生徒番号</th>
                    <th>生徒氏名</th>
                    <th class="id"></th>
                </tr>
                @foreach ($students as $student)
                <tr>
                    <td><?= $student['id'] ?></td>
                    <td><?= $student['name'] ?></td>
                    <td>
                        <form method="POST" action="{{ route ('student_detail') }}">
                            @csrf
                            <input type="hidden" name="name" value="{{ $student->name }}">
                            <input type="hidden" name="email" value="{{ $student->email }}">
                            <input type="hidden" name="created_at" value="{{ $student->created_at }}">
                            <button type="submit" name="id" value="{{ $student->id }}">詳細</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>
@endsection