tomk79/request
=======

A request management utilitiy for PHP.

## Usage

Execute `composer require` command.

```bash
$ composer require tomk79/request;
```


### PHP

#### Basic

```php
<?php
require_once('./vendor/autoload.php');
$req = new tomk79\request();
```

#### Optional

```php
<?php
require_once('./vendor/autoload.php');
$req = new tomk79\request(array(
  'session_name' => 'SESSID',
  'session_expire' => (24 * 60 * 60),
  'directory_index_primary' => 'index.html',
  'cookie_default_path' => '/',
  'cookie_default_expire' => (7 * 24 * 60 * 60),
));
```

#### API Document

see: docs/index.html


## Test

```bash
$ cd (project directory)
$ php ./vendor/phpunit/phpunit/phpunit
```

## phpDocumentor

```
$ composer run-script documentation
```


## Change log

### tomk79/request v1.4.1 (2023/5/1)

- `set_cookie()`、 `delete_cookie()` で `null` が渡されて発生するエラーを修正。

### tomk79/request v1.4.0 (2023/2/5)

- `set_cookie()` で、第7引数 `$httponly` を指定できるようになった。
- `set_cookie()` で、第3引数以降を、まとめて連想配列で指定できるようになった。
- `cookie_default_expire` オプションを追加した。
- `cookie_default_domain` オプションを追加した。
- `session_expire` が省略された場合、 `cookie_default_expire` の値を参照するようになった。
- セッションを2重に開始しようとしたときにPHPエラーが起きる不具合を修正。
- `session_update()` を追加した。
- セッションの予約後に、 `SESSION_LAST_MODIFIED` を廃止し、 `SESSION_STARTED_AT`, `SESSION_DESTROYED_AT` を追加した。
- その他、内部コードの細かい修正。

### tomk79/request v1.3.1 (2022/12/28)

- `.gitattributes` を追加。

### tomk79/request v1.3.0 (2022/4/24)

- `get_method()` を追加。
- `get_headers()` を追加。
- `get_header()` を追加。
- 内部コードの細かい修正。

### tomk79/request v1.2.0 (2022/1/4)

- サポートするPHPのバージョンを `>=7.3.0` に変更。

### tomk79/request v1.1.1 (2021/4/23)

- 内部コードの細かい修正。

### tomk79/request v1.1.0 (2020/6/21)

- `$req->set_cookie()` の `$secure` フラグは、デフォルトが `true` に変更されました。

### tomk79/request v1.0.2 (2018/8/22)

- 細かい不具合の修正。

### tomk79/request v1.0.1 (2018/2/9)

- PHP 7.2 で、CLIで `session_start()` を実行した際に Warning が発生する問題を修正。

### tomk79/request v1.0.0 (2017/04/11)

- 初期化オプションに `cookie_default_path` を追加。

### tomk79/request v0.1.4 (2015/03/19)

- Noticeレベルのエラー修正

### tomk79/request v0.1.3 (2014/12/09)

- `$req->get_request_file_path()` の戻り値をスラッシュで正規化するようになった。

### tomk79/request v0.1.2 (2014/11/24)

- `$req->get_request_file_path()` でのディレクトリトラバーサル対策処理を追加。

### tomk79/request v0.1.1 (2014/10/21)

- Bug fix on Windows

### tomk79/request v0.1.0 (2014/09/22)

- Initial Release.


## License

MIT License


## Author

- (C)Tomoya Koyanagi <tomk79@gmail.com>
- website: <https://www.pxt.jp/>
- Twitter: @tomk79 <https://twitter.com/tomk79/>
