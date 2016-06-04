<?php

class WPD_Basic_Options_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'WPD_Basic_Options') );
	}

	function test_class_access() {
		$this->assertTrue( wp_dermatology()->basic-options instanceof WPD_Basic_Options );
	}
}
