# 起動～停止手順
## 前提
・「Docker Desktop」をダウンロード済みであること。
・「DBever Community」をダウンロード済みであること。
・GitからプロジェクトフォルダをClone済みであること。
・.envファイルを受領済みであること。
・city_in_prefecture.jsonを受領済みであること。

## Docker初回起動時
1. /docker/nginx/ 配下に[logs]ディレクトリを作成。
2. .envファイルをプロジェクトフォルダ配下に配置。
3. city_in_prefecture.jsonを"\storage\app\public"配下に配置。
4. Docker Desktopを起動。
5. エディターのターミナルを開きプロジェクトフォルダ（DailySmart）へ移動。
    1. "docker compose up -d --build"
    2. "docker compose exec ds-app bash"
    3. "php artisan migrate"
6. CMDやPowerShellなどを開きプロジェクトフォルダへ移動。
    1. "npm install"
    2. "npm run dev"
7. http://localhost にアクセス。

## Docker起動時（2回目以降）
1. Docker Desktopを起動。
2. エディターのターミナルを開きプロジェクトフォルダ（DailySmart）へ移動。
    1. "docker compose up -d"
    ※設定ファイル（Dockerfileなど）を修正した場合は"--build"オプションを末尾に付ける。
3. CMDやPowerShellなどを開きプロジェクトフォルダへ移動。
    1. "npm run dev"
6. http://localhost にアクセス。

## Docker終了時
1. Ctrl + C（CMDのnpmを抜ける）
2. "exit"（エディターのターミナルでコンテナから抜ける）
3. "docker compose down"（エディターのターミナルでコンテナを停止する）

## DBツール設定
1. DBever画面左上の接続ボタンから「MySQL」を選択。
2. 以下の情報を入力。
　・Connect by：Host
　・Server Host：localhost
　・Database：.envの「DB_DATABASE」参照
　・ユーザー名：.envの「DB_USERNAME」参照
　・パスワード：.envの「DB_PASSWORD」参照
3. テスト接続してドライバをダウンロード。
4. 再度テスト接続。
5. 問題なければ終了。
6. usersテーブルの各カラムにデータを挿入。
　・user_id：Uから始まる33桁の英数字
　・otk：12桁の大文字小文字混合英数字 + 記号
　・created_at：デフォルト値（現在日時）
　・updated_at：デフォルト値（現在日時）


# 補足
## 環境構築参考
・Docker構築：https://qiita.com/hitotch/items/869070c3a9f474a358ea

## コマンド
・artisan関連コマンドはコンテナ内で実行。
### キャッシュ削除
・php artisan config:clear
・php artisan cache:clear
・php artisan route:clear
・php artisan view:clear

## mysqlコンテナが起動しない場合
1. MySQLコンテナとボリュームを完全削除
docker compose down -v
2. 壊れたローカルデータを削除（※重要）
Get-ChildItem .\docker\mysql\ | Remove-Item -Recurse -Force
3. 再ビルドして起動
docker compose up -d --build
4. ds-app に入って migrate 実行
docker compose exec ds-app bash
php artisan migrate