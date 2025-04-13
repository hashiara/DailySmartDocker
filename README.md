# 起動～停止手順
## Docker起動
1. CMDやPowerShellなどでプロジェクトフォルダ（DailySmart）へ移動。
2. "docker compose up -d"
※設定ファイル（Dockerfileなど）を修正した場合は"--build"オプションを末尾に付ける。
3. "docker compose exec ds-app bash"
4. "npm run dev"
5. [http://localhost]にアクセス。

## 終了時
6. Ctrl + C
7. "exit"
8. "docker compose down"


# 補足
## 環境構築参考
・Docker構築：https://qiita.com/hitotch/items/869070c3a9f474a358ea