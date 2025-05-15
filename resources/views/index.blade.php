<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>記事の一覧</title>
    <style>
        .header {
            background-color: #222222;
            color: aliceblue;
            padding: 5px 30px;

        }

        .diary {
            padding: 0.5em 1em;
            margin: 2em 10%;
            color: #5d627b;
            background: white;
            border-top: solid 5px #5d627b;
            box-shadow: 0 3px 5px rgba(0, 0, 0, 0.22);
        }

        .diary p {
            margin: 0;
            padding: 0;
        }

        .button {
            float: right;
        }
    </style>
</head>

<body>
    <header>
        <div class="header">
            <h1>日記一覧</h1>
        </div>
    </header>

    @forelse($diaries as $diary)
        <div class="diary">

            <p class="left-P">タイトル：{{ $diary->title }} </p>
            <p>本文：{{ $diary->contents }}</p>
            <p>{{ $diary->created_at}}</p>
            <div class="button">
                <a href="{{ url('/diaries/' . $diary->id . '/edit') }}">編集</a>
                <form action="{{ url('/diaries/' . $diary->id) }}" method="post"></form>
            </div>

            @csrf
            @method('DELETE')
            <input type="submit" value="削除">
            </form>
        </div>

    @empty

        <p>日記がありません。</p>

    @endforelse

</body>

</html>