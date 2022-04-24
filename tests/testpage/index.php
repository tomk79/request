<?php
require_once(__DIR__.'/../../vendor/autoload.php');

$req = new tomk79\request();
?>
<!DOCTYPE html>
<html>
<body>
<h1>request</h1>
<h2>method</h2>
<pre><?php var_export( $req->get_method() ) ?></pre>
<h2>headers</h2>
<pre><?php var_export( $req->get_headers() ) ?></pre>
<h2>header <code>user-agent</code></h2>
<pre><?php var_export( $req->get_header('user-agent') ) ?></pre>

<script>
function postRequestTest(){
    // 既定のオプションには * が付いています
    response = fetch('?', {
        method: 'POST',
        headers: {
            "Content-Type": 'text/plain',
            'X-Custom-Headers': [
                'header 1',
                'header 2',
                'header 3',
            ]
        },
        body: JSON.stringify('test data')
    })
    .then(response => response.text())
    .then(text => {
        alert(text);
    })
}
</script>
<button type="button" onclick="postRequestTest()">post test</button>
</body>
</html>
