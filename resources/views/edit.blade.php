<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>記事の編集</title>
    <style>
        .content {
            font-family: arial;
            font-size: 24px;
            margin: 10% 30%;
            width: 350px;
            height: 200px;
        }
        .label{
            margin: 20px 0;
        }
        .header{
            background-color:rgb(18, 98, 0);
            color: aliceblue;
            padding: 5px 30px;
        }

    </style>
</head>

<body>
    <header>
        <div class="header">
            <h1>日記更新</h1>
        </div>
    </header>
    <div class="content">
        <form method="post" action="{{ url('/' . $diary->id) }}">
            {{ csrf_field() }}

            <div>
                <label  for="title">
                    <input class="label" id="title" type="text" name="title" placeholder="日記のタイトルを入力" />
                </label>
            </div>

            <div>
                <label  for="contents">
                    <textarea class="label" id="contents" type="text" name="contents" placeholder="内容を入力" rows="5" cols="80"></textarea>
                </label>
            </div>
            @if($errors->any())
              @foreach ($errors->all() as $error)
                {{ $error }}
              @endforeach
            @endif
            <input type="submit" name="submit" value="投稿する" />
        </form>
    </div>
</body>

</html>