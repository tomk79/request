tomk79/request
=======

A request management utilitiy for PHP.

## Usage

Define `tomk79/request` in your `composer.json`.

```json
{
    "require": {
        "php": ">=5.3.0",
        "tomk79/request": "0.*"
    }
}
```

Execute `composer install` command.

```bash
$ composer install
```

Or update command.

```bash
$ composer update
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
  'session_name'=>'SESSID',
  'session_expire'=>1800,
  'directory_index_primary'=>'index.html',
  'cookie_default_path'=>'/'
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

### tomk79/request@1.0.2 (2018/8/22)

- 細かい不具合の修正。

### tomk79/request@1.0.1 (2018/2/9)

- PHP 7.2 で、CLIで `session_start()` を実行した際に Warning が発生する問題を修正。

### tomk79/request@1.0.0 (2017/04/11)

- 初期化オプションに `cookie_default_path` を追加。

### tomk79/request@0.1.4 (2015/03/19)

- Noticeレベルのエラー修正

### tomk79/request@0.1.3 (2014/12/09)

- `$req->get_request_file_path()` の戻り値をスラッシュで正規化するようになった。

### tomk79/request@0.1.2 (2014/11/24)

- `$req->get_request_file_path()` でのディレクトリトラバーサル対策処理を追加。

### tomk79/request@0.1.1 (2014/10/21)

- Bug fix on Windows

### tomk79/request@0.1.0 (2014/09/22)

- Initial Release.


## License

MIT License


## Author

- (C)Tomoya Koyanagi <tomk79@gmail.com>
- website: <http://www.pxt.jp/>
- Twitter: @tomk79 <http://twitter.com/tomk79/>
