<?php
/**
 * test for tomk79\request
 * 
 * $ cd (project dir)
 * $ ./vendor/phpunit/phpunit/phpunit php/tests/requestTest
 */
require_once( __DIR__.'/../request.php' );

class requestTest extends PHPUnit_Framework_TestCase{

	private $req;

	public function setup(){
		mb_internal_encoding('UTF-8');
	}


	/**
	 * 普通に実行
	 */
	public function testNoOptions(){
		$req = new tomk79\request();
		$this->assertTrue( $req->is_cmd() );
		$this->assertNull( $req->get_param('test1') );
		$this->assertNull( $req->get_user_agent() );
		$this->assertEquals( $req->get_request_file_path(), '/index.html' );

	}

	/**
	 * コマンドラインからオプションをつけてみるテスト
	 */
	public function testCommandLineOptions(){
		$conf = json_decode('{}');
		$conf->server = $_SERVER;
		$conf->get = array(
			'get1'=>'get_val_1',
			'get2'=>'get_val_2',
		);
		$conf->post = array(
			'post1'=>'post_val_1',
			'post2'=>'post_val_2',
		);
		$conf->server['argv'] = array(
			'php',
			'request.php',
			'-a',
			'TEST (-a)',
			'-b',
			'TEST (-b)',
			'param 1',
			'param 2',
			'param 3',
		);
		$req = new tomk79\request( $conf );
		$this->assertTrue( $req->is_cmd() );
		$this->assertEquals( $req->get_cli_param(0), 'param 1' );
		$this->assertEquals( $req->get_cli_param(1), 'param 2' );
		$this->assertEquals( $req->get_cli_param(2), 'param 3' );
		$this->assertEquals( $req->get_cli_param(-1), 'param 3' );
		$this->assertEquals( $req->get_cli_param(-2), 'param 2' );
		$this->assertEquals( $req->get_cli_param(-3), 'param 1' );
		$this->assertNull( $req->get_cli_param(3) );
		$this->assertNull( $req->get_cli_param(-4) );
		$this->assertEquals( $req->get_cli_option('-a'), 'TEST (-a)' );
		$this->assertEquals( $req->get_cli_option('-b'), 'TEST (-b)' );
		$this->assertEquals( count($req->get_cli_options()), 2 );
		$this->assertEquals( $req->get_request_file_path(), '/index.html' );

	}

	/**
	 * コマンドラインからウェブっぽいオプションをつけてみるテスト
	 */
	public function testCommandLineOptionsAsWeb(){
		$conf = json_decode('{}');
		$conf->server = $_SERVER;
		$conf->get = array(
			'get1'=>'get_val_1',
			'get2'=>'get_val_2',
		);
		$conf->post = array(
			'post1'=>'post_val_1',
			'post2'=>'post_val_2',
		);
		$conf->server['argv'] = array(
			'php',
			'request.php',
			'-a',
			'TEST AGENT 1.0',
			'/?test1=123&test2='.urlencode('あいうえお'),
		);
		$req = new tomk79\request( $conf );
		$this->assertTrue( $req->is_cmd() );
		$this->assertEquals( $req->get_param('test1'), '123' );
		$this->assertEquals( $req->get_param('test2'), 'あいうえお' );
		$this->assertEquals( $req->get_param('get2'), 'get_val_2' );
		$this->assertEquals( $req->get_param('post2'), 'post_val_2' );
		$this->assertEquals( $req->get_cli_param(), '/?test1=123&test2='.urlencode('あいうえお') );
		$this->assertEquals( $req->get_cli_option('-a'), 'TEST AGENT 1.0' );
		$this->assertNull( $req->get_user_agent() );//コマンドラインではセットされない
		$this->assertEquals( $req->get_request_file_path(), '/index.html' );

	}


	/**
	 * paramless uri param
	 */
	public function testCommandLineOptionsAsWeb_paramless_uri_param(){
		$conf = new stdClass;
		$conf->server = $_SERVER;
		$conf->server['argv'] = array(
			'php',
			'request.php',
			'/',
		);
		$req = new tomk79\request( $conf );
		$this->assertTrue( $req->is_cmd() );
		$this->assertNull( $req->get_param('test1') );
		$this->assertNull( $req->get_param('test2') );
		$this->assertNull( $req->get_param('get2') );
		$this->assertNull( $req->get_param('post2') );
		$this->assertEquals( $req->get_cli_param(-1), '/' );
		$this->assertNull( $req->get_cli_option('-a') );
		$this->assertNull( $req->get_user_agent() );//コマンドラインではセットされない
		$this->assertEquals( $req->get_request_file_path(), '/index.html' );

	}

	/**
	 * directory traversal 対策
	 */
	public function testDirectoryTraversal(){
		$conf = new stdClass;
		$conf->server = $_SERVER;
		$conf->server['argv'] = array(
			'/aaa/bbb/../',
		);
		$req = new tomk79\request( $conf );
		$this->assertTrue( $req->is_cmd() );
		$this->assertEquals( $req->get_request_file_path(), '/aaa/index.html' );

		$conf = new stdClass;
		$conf->server = $_SERVER;
		$conf->server['argv'] = array(
			'/../../',
		);
		$req = new tomk79\request( $conf );
		$this->assertEquals( $req->get_request_file_path(), '/index.html' );

		$conf = new stdClass;
		$conf->server = $_SERVER;
		$conf->server['argv'] = array(
			'/test2/../../test.html',
		);
		$req = new tomk79\request( $conf );
		$this->assertEquals( $req->get_request_file_path(), '/test.html' );

	}

}
