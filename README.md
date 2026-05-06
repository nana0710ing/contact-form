# お問い合わせフォームアプリ

お問い合わせ内容を登録・管理できるWebアプリです。

## 環境構築

### Dockerビルド

```bash
git clone https://github.com/nana0710ing/contact-form.git
cd contact-form
docker-compose up -d --build

# コンテナに入る
docker-compose exec php bash

# ここからコンテナ内
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate:fresh --seed
```

## 使用技術（実行環境）

- PHP 8.x
- Laravel 10.x
- MySQL 8.0
- nginx 1.21
- Docker
- phpMyAdmin

## ER図

![ER図](images/ER.png)

## URL

- お問い合わせフォーム
  http://localhost:8084/

- 管理画面
  http://localhost:8084/admin

- 会員登録
  http://localhost:8084/register

- ログイン
  http://localhost:8084/login

- phpMyAdmin
  http://localhost:8083
