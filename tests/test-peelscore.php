<?php

class WPD_Peelscore_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'WPD_Peelscore') );
	}

	function test_class_access() {
		$this->assertTrue( wp_dermatology()->peelscore instanceof WPD_Peelscore );
	}
}
