# 起動～停止手順
## 前提
・「Docker Desktop」をダウンロード済みであること。
・GitからプロジェクトフォルダをClone済みであること。

## Docker起動
1. Docker Desktopを起動。
2. CMDやPowerShellなどでプロジェクトフォルダ（DailySmart）へ移動。
3. "docker compose up -d"
※設定ファイル（Dockerfileなど）を修正した場合は"--build"オプションを末尾に付ける。
4. "docker compose exec ds-app bash"
5. "npm run dev"
6. [http://localhost]にアクセス。

## 終了時
7. Ctrl + C
8. "exit"
9. "docker compose down"


# 補足
## 環境構築参考
・Docker構築：https://qiita.com/hitotch/items/869070c3a9f474a358ea