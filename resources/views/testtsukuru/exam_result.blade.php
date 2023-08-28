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
            <h1>テスト結果</h1>
        </div>
        <div class="back_top">
            <a href="{{ route ('index_student') }}">トップへ戻る</a>
        </div>
        <div class="score">
            <p>得点{{$final_score}}点</p>
        </div>
    </div>
</body>
<script src="{{ asset('js/main.js') }}" defer></script>
</html>