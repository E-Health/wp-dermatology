<?php
/**
 * WP Dermatology Basic Options
 *
 * @since 0.1.1
 * @package WP Dermatology
 */


/**
 * WP Dermatology Basic Options class.
 *
 * @since 0.1.1
 */
class WPD_Basic_Options
{
    /**
     * Parent plugin class
     *
     * @var    class
     * @since  0.1.1
     */
    protected $plugin = null;

    /**
     * Option key, and option page slug
     *
     * @var    string
     * @since  0.1.1
     */
    protected $key = 'wp_dermatology_basic_options';

    /**
     * Options page metabox id
     *
     * @var    string
     * @since  0.1.1
     */
    protected $metabox_id = 'wp_dermatology_basic_options_metabox';

    /**
     * Options Page title
     *
     * @var    string
     * @since  0.1.1
     */
    protected $title = '';

    /**
     * Options Page hook
     * @var string
     */
    protected $options_page = '';

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

        $this->title = __('WP Dermatology Basic Options', 'wp-dermatology');
    }

    /**
     * Initiate our hooks
     *
     * @since  0.1.1
     * @return void
     */
    public function hooks()
    {
        add_action('admin_init', array($this, 'admin_init'));
        add_action('admin_menu', array($this, 'add_options_page'));
        add_action('cmb2_admin_init', array($this, 'add_options_page_metabox'));
    }

    /**
     * Register our setting to WP
     *
     * @since  0.1.1
     * @return void
     */
    public function admin_init()
    {
        register_setting($this->key, $this->key);
    }

    /**
     * Add menu options page
     *
     * @since  0.1.1
     * @return void
     */
    public function add_options_page()
    {
        $this->options_page = add_menu_page(
            $this->title,
            $this->title,
            'manage_options',
            $this->key,
            array($this, 'admin_page_display')
        );

        // Include CMB CSS in the head to avoid FOUC.
        add_action("admin_print_styles-{$this->options_page}", array('CMB2_hookup', 'enqueue_cmb_css'));
    }

    /**
     * Admin page markup. Mostly handled by CMB2
     *
     * @since  0.1.1
     * @return void
     */
    public function admin_page_display()
    {
        ?>
        <div class="wrap cmb2-options-page <?php echo esc_attr($this->key); ?>">
            <h2><?php echo esc_html(get_admin_page_title()); ?></h2>
            <?php cmb2_metabox_form($this->metabox_id, $this->key); ?>
        </div>
        <?php
    }

    /**
     * Add custom fields to the options page.
     *
     * @since  0.1.1
     * @return void
     */
    public function add_options_page_metabox()
    {

        $cmb = new_cmb2_box(array(
            'id' => $this->metabox_id,
            'hookup' => false,
            'cmb_styles' => false,
            'show_on' => array(
                // These are important, don't remove.
                'key' => 'options-page',
                'value' => array($this->key),
            ),
        ));


        $cmb->add_field(array(
            'name' => 'Dermbase',
            'desc' => 'Disable?',
            'id' => 'chkbox_dermbase',
            'type' => 'checkbox',
        ));

        $cmb->add_field(array(
            'name' => 'Peelscore',
            'desc' => 'Disable?',
            'id' => 'chkbox_peelscore',
            'type' => 'checkbox',
        ));

        $cmb->add_field(array(
            'name' => 'TASCDerm Table Title:',
            'desc' => '',
            'default' => 'TASCDerm Scoring Table',
            'id' => 'txt_tascderm_title',
            'type' => 'text',
        ));

        $cmb->add_field(array(
            'name' => 'TASCDerm Score Title:',
            'desc' => '',
            'default' => 'Mean TASCDerm Score',
            'id' => 'txt_tascderm_score',
            'type' => 'text',
        ));
    }
}
