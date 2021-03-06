<?php
/**
 * WP Dermatology Dermbase
 *
 * @since 0.1.1
 * @package WP Dermatology
 */

/**
 * WP Dermatology Dermbase.
 *
 * @since 0.1.1
 */
class WPD_Dermbase
{
    /**
     * Parent plugin class
     *
     * @var   class
     * @since 0.1.1
     */
    protected $plugin = null;

    /**
     * Constructor
     *
     * @since  0.1.1
     * @param  object $plugin Main plugin object.
     * @return void
     */
    public function __construct($plugin)
    {
        $this->plugin = $plugin;
        $this->hooks();
    }

    /**
     * Initiate our hooks
     *
     * @since  0.1.1
     * @return void
     */
    public function hooks()
    {
        $options = array();
        if(get_option('wp_dermatology_basic_options'))
            $options = get_option('wp_dermatology_basic_options');
        if (!array_key_exists('chkbox_dermbase', $options) || $options['chkbox_dermbase'] != 'on')
            add_filter('the_content', array(__CLASS__, 'get_dermbase'));
    }

    public static function get_dermbase($content)
    {

        global $post;
        $to_return = get_transient( $post->ID );

        if( false === $to_return ) {
            // Transient expired, refresh the data
            $client = new SoapClient("http://gulfdoctor.net/dermbase/wsannotation.php?wsdl");
            $results = $client->getAnnotation($content);
            $to_return = "";
            foreach ($results as $result) {

                $to_return .= $result->text;

            }
            set_transient( $post->ID, $to_return, 60 ); // 1 min cache
        }

        return $to_return;

    }
}
