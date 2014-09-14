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
			'TEST AGENT 1.0',
			'/?test1=123&test2='.urlencode('あいうえお'),
		);
		$req = new tomk79\request( $conf );
		$this->assertTrue( $req->is_cmd() );
		$this->assertEquals( $req->get_param('test1'), '123' );
		$this->assertEquals( $req->get_param('test2'), 'あいうえお' );
		$this->assertEquals( $req->get_param('get2'), 'get_val_2' );
		$this->assertEquals( $req->get_param('post2'), 'post_val_2' );
		$this->assertEquals( $req->get_user_agent(), 'TEST AGENT 1.0' );
		$this->assertEquals( $req->get_request_file_path(), '/index.html' );

	}

}
