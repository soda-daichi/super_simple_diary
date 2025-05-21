# 1.前提条件
### -PHP7.2以上
### -Laravel6
### -MySQL
### -Webサーバー
### -composer

# 2. リポジトリのクローン
 git clone https://github.com/soda-daichi/super_simple_diary.git

# 3.Webサーバーのdocumentroot設定について

Laravelプロジェクトを本番運用・公開サーバーで利用する場合は、
必ずWebサーバーのdocumentroot（公開ディレクトリ）をプロジェクトの `public` ディレクトリに設定してください。
Webサーバーを起動する。
## Laragonを使用している場合は、以下の手順をする。
laragon\etc\nginx\sites-enabledのファイルのlocationを以下の文に変更する。

 location / {
        try_files $uri $uri/ /index.php?$query_string;
    }


その後Webサーバーを再起動する。

【理由】
- `public` より上層のディレクトリを公開すると、環境ファイル（.env）やアプリの内部コードが外部から見えてしまう危険性があります。

# 4. 依存パッケージのインストール
  cd {プロジェクトディレクトリ}
  composer install

# 5. 環境ファイルの用意
  cp .env.example .env
  ### 必要に応じて内容修正
  ## アプリケーションキーの生成
  php artisan key:generate

# 6. データベースの準備・マイグレーション
  ## .envでDBのパスワードを設定
  DB_PASSWORD=｛自分のパスワード｝；
  ## DBの作成
  DB名：laravel（.envで設定したDB名を設定する）
　例：DB_DATABASE=larave
  ## DB作成後…
  php artisan migrate

# 7.自分の使っているサーバーを立ち上げ
   http://localhost:{立ち上げたサーバーのポート番号｝/ 日記一覧ページにアクセス
