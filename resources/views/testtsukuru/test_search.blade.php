@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テスト問題検索画面</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrap">
        <div class="title_h1">
            <h1>テスト問題検索</h1>
        </div>
        <div class="back_top">
            <a href="{{ route ('test_edit') }}">編集画面へ戻る</a>
        </div>
        <div class="search">
            <form action="{{ route ('test_search') }}" method="GET">
                @csrf
                <input type="text" name="keyword">
                <input type="submit" value="検索">
            </form>
        </div>
        <div>
            <table border="1" class="list">
                <tr>
                    <th>教科</th>
                    <th>問題</th>
                    <th>模範解答</th>
                    <th></th>
                </tr>
                @forelse ($posts as $post)
                    <tr>
                        <td>{{$post->subject}}</td>
                        <td>{{$post->question}}</td>
                        <td>{{$post->model_answer}}</td>
                        <td>
                            <form method="POST" action="{{ route ('test_edit')}}">
                                @csrf
                                <input type="hidden" name="question" value="{{ $post->question }}">
                                <input type="hidden" name="model_answer" value="{{ $post->model_answer }}">
                                <button type="submit" name="id" value="{{ $post->id }}">使う</button>
                            </form>
                        </td>
                    </tr>

                @empty
                    <tr>
                        <td>なし</td>
                        <td>なし</td>
                        <td>なし</td>
                        <td></td>
                    </tr>
                @endforelse
            </table>
        </div>
    </div>
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>
@endsection