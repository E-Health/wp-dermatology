<?php
/**
 * WP Dermatology Peelscore
 *
 * @since 0.1.1
 * @package WP Dermatology
 */

/**
 * WP Dermatology Peelscore.
 *
 * @since 0.1.1
 */
class WPD_Peelscore
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
        add_action('add_meta_boxes', array($this, 'add_meta_box'));
        add_action('save_post', array($this, 'save'));

        $options = get_option('wp_dermatology_basic_options');
        if (!array_key_exists('chkbox_peelscore', $options) || $options['chkbox_peelscore'] != 'on')
            add_filter('the_content', array($this, 'render_peelscore'));

    }

    public function add_meta_box($post_type)
    {
        add_meta_box(
            'wp-dermatology-peelscore',            // Unique ID
            'Peel Score',      // Box title
            array($this, 'render_form'), // Content callback
            'post'
        );
    }

    public function save($post_id)
    {
        if (array_key_exists('wp_dermatology_peelscore', $_POST)) {
            update_post_meta($post_id,
                '_wp_dermatology_peelscore',
                $_POST['wp_dermatology_peelscore']
            );
        }
    }

    public function render_peelscore($content)
    {
        global $post;
        $peelscore = get_post_meta($post->ID,
            '_wp_dermatology_peelscore', true);
        if ($peelscore && is_single()) {

            $content .= "            <!-- GulfDoctor.net peel score code begin -->
            <p><a href='http://gulfdoctor.net/peelscore' target='_blank'>
                    <img src='http://gulfdoctor.net/peelscore/$peelscore.jpg'
                         alt='GulfDoctor.net peel rating' style='width: 64px; height: 64px;'/><br/>
                    <span style='font-style: italic; font-size: 10pt'>My Rating: <span
                            class='rating'>$peelscore</span> peel(s)</span>
                    <br/><span style='font-style: italic; font-size: 10pt'>What is peel score?</span><br/></a></p>
            <!-- GulfDoctor.net peel score code end -->";

        }
        return $content;
    }

    public function render_form($post)
    {
        ?>
        <label for="wp_dermatology_peelscore"> Peelscore </label>
        <?php $value = get_post_meta($post->ID,
        '_wp_dermatology_peelscore', true); ?>
        <select name="wp_dermatology_peelscore" id="wp_dermatology_peelscore"
                class="postbox">
            <option value="">Select Peelscore…</option>
            <option value="1"
                <?php if ('1' == $value) echo 'selected';
                ?>>1
            </option>
            <option value="2"
                <?php if ('2' == $value) echo 'selected';
                ?>>2
            </option>
            <option value="3"
                <?php if ('3' == $value) echo 'selected';
                ?>>3
            </option>
            <option value="4"
                <?php if ('4' == $value) echo 'selected';
                ?>>4
            </option>
            <option value="5"
                <?php if ('5' == $value) echo 'selected';
                ?>>5
            </option>
        </select>
        <?php
    }
}
