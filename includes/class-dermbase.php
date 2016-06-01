<?php
/**
 * WP Dermatology Dermbase
 *
 * @since NEXT
 * @package WP Dermatology
 */

/**
 * WP Dermatology Dermbase.
 *
 * @since NEXT
 */
class WPD_Dermbase {
	/**
	 * Parent plugin class
	 *
	 * @var   class
	 * @since NEXT
	 */
	protected $plugin = null;

	/**
	 * Constructor
	 *
	 * @since  NEXT
	 * @param  object $plugin Main plugin object.
	 * @return void
	 */
	public function __construct( $plugin ) {
		$this->plugin = $plugin;
		$this->hooks();
	}

	/**
	 * Initiate our hooks
	 *
	 * @since  NEXT
	 * @return void
	 */
	public function hooks() {
        add_filter( 'the_content', array( __CLASS__, 'get_dermbase' ) );
	}

	public static function get_dermbase($content)
	{
		$client = new SoapClient("http://gulfdoctor.net/dermbase/wsannotation.php?wsdl");
        $results = $client->getAnnotation($content);
        $to_return = "";
        foreach($results as $result){

            $to_return .= $result->text;

        }

        return $to_return;
	}
}
