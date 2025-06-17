# Dockerコマンド
* コンテナ起動
  <br>
docker-compose up -d
<br>

* コンテナとネットワークのみ削除
<br>
docker-compose down
stop は停止

* 起動中の docker コンテナの一覧を表示する
<br>
docker ps -a
<br>
docker ps
<br>

* 最初にコンテナとイメージを作成し起動する
<br>
docker-compose up --build
<br>

* Dockerコンテナに入りターミナルを使う, root@コンテナID:/var/www/html# がルートディレクトリに入っている時
<br>
docker-compose exec konntenaID /bin/bash
<br>
Containersをクリックすると全て確認出来る<br>
docker exec -it phpmail2-php8.3mail-1 /bin/bash
<br>

* hostのターミナルに戻る
<br>
exit
<br>

* Dockerコマンド・Docker Composeコマンド集
<br>
https://zenn.dev/code_journey_ys/articles/fb068e23ea1c57