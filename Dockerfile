FROM php:8.3.20-apache-bookworm

# 必要なパッケージのインストール（msmtp と msmtp-mta）
RUN apt-get update && apt-get install -y msmtp msmtp-mta

# msmtpの設定ファイルをコンテナへコピー
COPY etc/.msmtprc /etc/.msmtprc
RUN chmod 777 /etc/.msmtprc

# ログファイルの作成とパーミッションの設定
RUN mkdir -p /var/log && touch /var/log/msmtp.log && chown www-data:www-data /var/log/msmtp.log

# PHPのsendmail_pathをmsmtpに設定
# RUN echo "sendmail_path = \"/usr/bin/msmtp -t\"" > /usr/local/etc/php/conf.d/sendmail.ini