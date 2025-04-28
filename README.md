# 起動～停止手順
## 前提
・「Docker Desktop」をダウンロード済みであること。
・GitからプロジェクトフォルダをClone済みであること。

## Docker初回起動時
1. /docker/nginx/ 配下に[logs]ディレクトリを作成。
2. .envファイルをプロジェクトフォルダ配下に配置。
3. Docker Desktopを起動。
4. CMDやPowerShellなどでプロジェクトフォルダ（DailySmart）へ移動。
5. "docker compose up -d --build"
6. "docker compose exec ds-app bash"
7. "php artisan migrate"
8. "npm run dev"
9. [http://localhost]にアクセス。

## Docker起動時（2回目以降）
1. Docker Desktopを起動。
2. CMDやPowerShellなどでプロジェクトフォルダ（DailySmart）へ移動。
3. "docker compose up -d"
※設定ファイル（Dockerfileなど）を修正した場合は"--build"オプションを末尾に付ける。
4. "docker compose exec ds-app bash"
6. "npm run dev"
7. [http://localhost]にアクセス。

## 終了時
8. Ctrl + C
9. "exit"
10. "docker compose down"


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