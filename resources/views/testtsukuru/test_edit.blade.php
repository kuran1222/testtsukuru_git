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
            <h1>テスト編集</h1>
        </div>
        <div class="test_edit">
            <div class="error">
                @if ($errors->any())
                    <ul>
                        @foreach ($errors->all() as $error)
                        <p>{{ $error }}</p>
                        @endforeach
                    </ul>
                        @endif
            </div>

            <div class="test_edit_a">
                <form method="POST" action="{{ route ('test_search')}}">
                    @csrf
                    <input type="hidden" name="question1" value="{{old ('question1', $session['question1'])}}">
                    <input type="hidden" name="model_answer1" value="{{old ('model_answer1', $session['model_answer1'])}}">
                    <input type="hidden" name="question2" value="{{old ('question2', $session['question2'])}}">
                    <input type="hidden" name="model_answer2" value="{{old ('model_answer2', $session['model_answer2'])}}">
                    <input type="hidden" name="question3" value="{{old ('question3', $session['question3'])}}">
                    <input type="hidden" name="model_answer3" value="{{old ('model_answer3', $session['model_answer3'])}}">
                    <button type="submit">問題検索</button>
                </form>
            </div>
            <div class="test_edit_c">
                <form action="{{ route ('test_confirm')}}" method="post">
                <input type="hidden" id="id" name="id" value="{{old('id',$session['id'])}}">
                {{-- csrf対策 --}}
                @csrf
                <div class="test_edit_body">
                    <div class="test_title">
                        <p>テスト名：</p>
                        <input type="text" name="test_title" id="test_title" maxlength="10" cols="10" rows="5" value="{{old ('test_title', $session['test_title'])}}"></input>
                    </div>
                    <div class="subject">
                        <p>科目：</p>
                        <select name='subject' value="{{old ('subject', $session['subject'])}}">
                            <option value="国語">国語</option>
                            <option value="算数">算数</option>
                            <option value="理科">理科</option>
                            <option value="社会">社会</option>
                            <option value="英語">英語</option>
                        </select>
                    </div>
                </div>
                <table border="1">
                    <tr>
                        <th class="question">テスト問題</th>
                        <th class="model_answer">模範解答</th>
                        <th class="allocation_of_point">配点</th>
                    </tr>
                    <tr>
                        <td>
                            <textarea type="text" name="question1" id="question1" cols="20" rows="5">{{old ('question1', $session['question1'])}}</textarea>
                        </td>
                        <td>
                            <textarea type="text" name="model_answer1" id="model_answer1" cols="20" rows="5">{{old ('model_answer1', $session['model_answer1'])}}</textarea></td>
                        <td><textarea type="text" name="allocation_of_point1" id="allocation_of_point1" maxlength="3" cols="5" rows="5">{{old ('allocation_of_point1', $session['allocation_of_point1'])}}</textarea></td>
                    </tr>

                    <tr>
                        <td><textarea type="text" name="question2" id="question2" cols="20" rows="5">{{old ('question2', $session['question2'])}}</textarea></td>
                        <td><textarea type="text" name="model_answer2" id="model_answer2" cols="20" rows="5">{{old ('model_answer2', $session['model_answer2'])}}</textarea></td>
                        <td><textarea type="text" name="allocation_of_point2" id="allocation_of_point2" maxlength="3" cols="5" rows="5">{{old ('allocation_of_point2', $session['allocation_of_point2'])}}</textarea></td>
                    </tr>
                    
                    <tr>
                        <td><textarea type="text" name="question3" id="question3" cols="20" rows="5">{{old ('question3', $session['question3'])}}</textarea></td>
                        <td><textarea type="text" name="model_answer3" id="model_answer3" cols="20" rows="5">{{old ('model_answer3', $session['model_answer3'])}}</textarea></td>
                        <td><textarea type="text" name="allocation_of_point3" id="allocation_of_point3" maxlength="3" cols="5" rows="5">{{old ('allocation_of_point3', $session['allocation_of_point3'])}}</textarea></td>
                    </tr>
                </table>
                <button type="submit" name="register"  id="submit" onclick="checkMail()">確認画面へ</button>
            </form>
            </div>
            <div class="back_top">
                <a href="{{ route ('index_teacher') }}" onclick="return confirm('編集内容は破棄されますが、よろしいですか？')">トップへ戻る</a>
            </div>
        </div>
        
    </div>
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>
@endsection