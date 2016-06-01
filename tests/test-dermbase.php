<?php

class WPD_Dermbase_Test extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	function test_class_exists() {
		$this->assertTrue( class_exists( 'WPD_Dermbase') );
	}

	function test_class_access() {
		$this->assertTrue( wp_dermatology()->dermbase instanceof WPD_Dermbase );
	}
}
