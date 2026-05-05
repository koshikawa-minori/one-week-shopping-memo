# 一週間買い物メモ

## アプリ概要
一週間分の献立と買い物メモを管理できるアプリです。

## 使用技術
- PHP 8.4.8
- Laravel 13.4.0
- SQLite 3.50.1
- HTML
- CSS

## 主な機能
- 週の開始日を登録
- 7日分の献立を入力・更新
- 買い物メモの追加
- 買い物メモのチェック切替
- 買い物メモの削除
- カテゴリ別表示
- スマホ対応

## 環境構築

```bash
git clone リポジトリURL
cd プロジェクト名
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate
php artisan serve
```

## 使い方
1. 週の開始日を選択する
2. 7日分の献立を入力する
3. 必要な買い物メモを追加する
4. 購入済みのものはチェックする
5. 不要なメモは削除する