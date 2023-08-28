@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テスト編集画面</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrap">
        <div class="title_h1">
            <h1>テスト確認</h1>
        </div>
        <div class="test_edit">
            <div class="test_edit_c">
                <form action="{{ route ('test_create')}}" method="post">
                    <div class="test_confirm">
                        <p>テスト名</p>
                        {{ $request->test_title }}
                    </div>
                    <div class="test_confirm">
                        <p>科目</p>
                        {{ $request->subject }}
                    </div>
                    <table border="1">
                        <tr>
                            <th class="question">テスト問題</th>
                            <th class="model_answer">模範解答</th>
                            <th class="allocation_of_point">配点</th>
                        </tr>
                        <tr>
                            <td>{{ $request->question1 }}</td>
                            <td>{{ $request->model_answer1 }}</td>
                            <td>{{ $request->allocation_of_point1 }}</td>
                        </tr>
                        <tr>
                            <td>{{ $request->question2 }}</td>
                            <td>{{ $request->model_answer2 }}</td>
                            <td>{{ $request->allocation_of_point2 }}</td>
                        </tr>
                        <tr>
                            <td>{{ $request->question3 }}</td>
                            <td>{{ $request->model_answer3 }}</td>
                            <td>{{ $request->allocation_of_point3 }}</td>
                        </tr>
                    </table>
                    {{-- csrf対策 --}}
                    @csrf
                    <input type='hidden' name='test_title' value="{{ $request->test_title }}">
                    <input type='hidden' name='subject' value="{{ $request->subject }}">
                    <textarea style='display:none' name='question1'>{{ $request->question1 }}</textarea>
                    <textarea style='display:none' name='model_answer1'>{{ $request->model_answer1 }}</textarea>
                    <textarea style='display:none' name='allocation_of_point1'>{{ $request->allocation_of_point1 }}</textarea>

                    <textarea style='display:none' name='question2'>{{ $request->question2 }}</textarea>
                    <textarea style='display:none' name='model_answer2'>{{ $request->model_answer2 }}</textarea>
                    <textarea style='display:none' name='allocation_of_point2'>{{ $request->allocation_of_point2 }}</textarea>

                    <textarea style='display:none' name='question3'>{{ $request->question3 }}</textarea>
                    <textarea style='display:none' name='model_answer3'>{{ $request->model_answer3 }}</textarea>
                    <textarea style='display:none' name='allocation_of_point3'>{{ $request->allocation_of_point3 }}</textarea>
                    
                    <button type="submit" name="register"  id="submit" onclick="checkMail()">保存</button>
                </form>
            </div>
            <div class="back_top">
                <a href="{{ route ('test_edit') }}">編集画面へ戻る</a>
            </div>
        </div>
    </div>
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>
@endsection