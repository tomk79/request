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

	public function testInit(){
		$conf = json_decode('{}');
		$conf->server = $_SERVER;
		$conf->server['argv'] = array(
			'php',
			'request.php',
			'a=b',
			'/?test=123',
		);
		$req = new tomk79\request( $conf );
		$this->assertTrue( $req->is_cmd() );
		$this->assertEquals( $req->get_param('a'), 'b' );
		$this->assertEquals( $req->get_param('test'), '123' );
		$this->assertEquals( $req->get_request_file_path(), '/index.html' );
	}

}
