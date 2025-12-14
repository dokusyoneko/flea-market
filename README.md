

# coachtechフリマ

## サービス概要
- サービス名: coachtechフリマ  
- 目的: アイテムの出品・購入を可能にするフリマアプリを開発  
- 目標: 初年度でユーザー数 1000人達成  
- ターゲットユーザー: 10〜30代の社会人  
- 対応ブラウザ: Chrome / Firefox / Safari 最新版  

## 環境構築
Docker ビルド  
git clone https://github.com/dokusyoneko/flea-market.git  
docker-compose up -d --build  
(※ MySQL が起動しない場合は、各PCの環境に合わせて docker-compose.yml を編集してください。)  
docker-compose exec php bash  
composer install  
composer require stripe/stripe-php  
cp .env.example .env  
(※環境変数を編集)  
php artisan key:generate  
php artisan migrate  
php artisan db:seed  
php artisan storage:link  

### 権限設定について
クローン後は `storage` と `bootstrap/cache` に書き込み権限を設定してください。  
### Stripe の設定について
このアプリでは決済機能に Stripe を利用しています。  
`.env` ファイルに以下の環境変数を設定してください。  
STRIPE_SECRET=your_stripe_secret_here  
STRIPE_KEY=your_stripe_key_here  


## 使用技術
- 言語: PHP 8.1.33  
- フレームワーク: Laravel 8.83.29  
- データベース: MySQL 8.0.26  
- バージョン管理: GitHub  
- コンテナ環境: Docker 28.3.2  
- Webサーバー: Nginx 1.21.1
- メール送信テスト: Mailhog  
- 決済機能: Stripe (各自でテストキーを導入してください)

## ER図
<img width="1262" height="702" alt="flea-market ER図" src="https://github.com/user-attachments/assets/8bfc3287-ca43-464a-8cc0-8dbe257a16bb" />


## アクセスURL
- アプリケーション: http://localhost:80  
- phpMyAdmin: http://localhost:8080  

