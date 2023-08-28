<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>テスト受験画面</title>
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <div class="wrap">
        <div class="title_h1">
            <h1>{{old ('test_title', $session['test_title'])}}</h1>
        </div>
        <div class="exam">
                <form action="{{ route ('exam_result')}}" method="post">
                        {{-- csrf対策 --}}
                        @csrf
                        <input type="hidden" name="test_title" value="{{old ('test_title', $session['test_title'])}}">
                        <table border="1" class="exam_list">
                            <tr>
                                <th class="exam_question">テスト問題</th>
                                <th class="exam_answer">解答</th>
                            </tr>
                            @foreach ($exams as $exam)
                            <tr>
                                <td><p>{{$exam->question}}</p></td>
                                <td style="width: 300px; height: 100px"><textarea type="text" name="user_answer[{{$exam}}]" >{{old ('user_answer.$exam')}}</textarea></td>
                            </tr>
                            @endforeach
                        </table>
                        <button type="submit" name="register" id="submit" onclick="return confirm('テストを提出しますか？')">提出</button>
                    </form>
            
        </div>
    </div>
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>