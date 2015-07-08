<?php
require_once(__DIR__.'/../../vendor/autoload.php');

$req = new tomk79\request();

print $req->get_cli_param(-2).'--'.$req->get_cli_param(-1);

exit(0);
