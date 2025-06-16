# Dockerコマンド
* コンテナ起動
  <br>

docker-compose up -d
* コンテナを提出する
<br>

docker-compose down
* Dockerfile の変更を反映(再ビルド)してコンテナを再起動
<br>

docker-compose build && docker-compose up -d
* 起動中の docker コンテナの一覧を表示する
<br>
docker ps -a