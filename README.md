# フリマサービス「メロカリ」
日本工学院八王子専門学校 ゲーム科用、PHP＋データベースの実習用リポジトリです。

## 初期設定
### 0. 環境準備
PHPとMySQLが動作する環境を用意します。
* PHP 7.4〜
* MySQL 5.7〜

DBにアカウントが存在しない場合は作成します。


### 1. ソースコードの取得
```shellsession
$ git clone https://github.com/katsube/neec-merocari-2022.git
```

### 2. DBの準備
データベースとテーブルを作成します。必要なSQLは`sql/initialize`に保存されているので、以下のコマンドで一気に実行することが可能です。
```shellsession
$ cd (プロジェクトの一番上の階層)
$ cat sql/initialize/*.sql | mysql -u (ユーザー名) -p
```

実行後にMySQLクライアントからログインし作成状況を必ず確認してください。

### 3. 設定ファイルの準備
`config/database.php.sample`をコピーし、名前を`config/database.php`に変更します。

`config/database.php`内の情報を正しい物に編集します。
```php
// 接続先
define('CONFIG_DB_DSN',  'mysql:dbname=xxxxxxxx;host=xxxxxxxx');

// アカウント
define('CONFIG_DB_USER', 'xxxxxxxx');		// ユーザー名
define('CONFIG_DB_PASS', 'xxxxxxxx');		// パスワード
```

アカウント情報を記載した`config/database.php`をGitなどへ登録しては**いけません**。例えばGitHubなどで設定ミスをすると全世界にアカウント情報が公開されてしまう恐れがあります。


## 実行方法
PHPの[開発用サーバ](https://www.php.net/manual/ja/features.commandline.webserver.php)を利用します。開発用サーバが起動したらWebブラウザから`http://localhost:3000/`へアクセスします。
```shellsession
$ cd (プロジェクトの一番上の階層)
$ php -S localhost:3000 -t public
```

開発用サーバを停止するには「Ctrl+c」を押します。

## 実装メモ
### 出品者（seller）
* 旧来からあるPHPの実行方法を取ります
    1. HTMLとプログラムが混在している状態
    1. 購入者と分けているのは学習目的です

### 購入者（buyer）
* クライアント・サーバ方式を取ります
    1. サーバ側はRESTfulAPIを準備
    1. クライアント側は完全なHTMLのみ
    1. クライアント側からRESTful APIを呼び出す
