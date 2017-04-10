tomk79/request
=======

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
  'directory_index_primary'=>'index.html'
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


## License

MIT License


## Author

- (C)Tomoya Koyanagi <tomk79@gmail.com>
- website: <http://www.pxt.jp/>
- Twitter: @tomk79 <http://twitter.com/tomk79/>
