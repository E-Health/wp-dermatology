<?php
/**
 * WP Dermatology Tascderm
 *
 * @since 0.1.1
 * @package WP Dermatology
 */

/**
 * WP Dermatology Tascderm.
 *
 * @since 0.1.1
 */
class WPD_Tascderm
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
        add_shortcode('tascderm', array($this, 'render_tascderm'));
        add_shortcode('tascderm-i', array($this, 'render_tascderm_interpretation'));
        add_action('admin_post_nopriv_submit-form', array($this, '_handle_form_action'));
        add_action('admin_post_submit-form', array($this, '_handle_form_action'));
    }

    function _handle_form_action()
    {


        if (isset($_POST['tascderm'])) {
            $tascderm_entered = $_POST['tascderm'];
            $tascderm = get_post_meta($_POST['postId'],
                '_wp_dermatology_tascderm', true);
            if ($tascderm_entered) {
                $tascderm = ($tascderm_entered + $tascderm) / 2;
            }

            update_post_meta($_POST['postId'],
                '_wp_dermatology_tascderm',
                $tascderm
            );
        }


        wp_redirect($_SERVER['HTTP_REFERER']);
        exit();


    }

    public function render_tascderm()
    {
        if (!is_single())
            return;

        global $post;
        $tascderm = get_post_meta($post->ID,
            '_wp_dermatology_tascderm', true);

        //Options
        $options = get_option('wp_dermatology_basic_options');
        if (array_key_exists('txt_tascderm_title', $options))
            $tascderm_title = $options['txt_tascderm_title'];
        else
            $tascderm_title = 'TASCDerm Scoring Table';

        if (array_key_exists('txt_tascderm_score', $options))
            $tascderm_score_title = $options['txt_tascderm_score'];
        else
            $tascderm_score_title = 'Mean TASCDerm Score';

        $content = "
<script>
function wp_dermatology_findTotal(){
    var arr = document.getElementsByName('wp_dermatology_tascderm');
    var tot=0;
    for(var i=0;i<arr.length;i++){
        if(parseInt(arr[i].value))
            tot += parseInt(arr[i].value);
    }
    document.getElementById('tascderm_total').value = tot;
}
</script>
<div id='tascderm'>
    <h3>" . $tascderm_title . "</h3>
    <form action='" . get_admin_url() . "admin-post.php' method='post'>
        <input type='hidden' name='action' value='submit-form' />
        <input type='hidden' name='postId' value='" . $post->ID . "' />
        <table class='tascderm-table'>
        <caption>" . $tascderm_score_title . ": " . $tascderm . " / 15</caption>
            <thead>
                <tr>
                    <th>Criteria</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if no randomization performed or randomization not mentioned.' data-animation='true' data-placement='top' data-html='false'>Randomization</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[0]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if no placebo, 1 if inert placebo, 2 if compared to gold standard.' data-animation='true' data-placement='top' data-html='false'>Placebo</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[1]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 No blinding, 1 Single blinded, 2 Double blinded' data-animation='true' data-placement='top' data-html='false'>Blinding</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[2]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                            <option value='2'>2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='Example: 1 if Colorimeter is used for melasma and 0 if MASI is used.' data-animation='true' data-placement='top' data-html='false'>Objective measurement</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[3]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='Effect size of 0.5, alpha 0.05 and power 80' data-animation='true' data-placement='top' data-html='false'>Sample size more than 21</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[4]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if study is done on clinic staff or if person knows allocated group. 1 if appropriate.' data-animation='true' data-placement='top' data-html='false'>Sample selection and allocation concealment</span></td>
                    <td class='score' onchange='wp_dermatology_findTotal();'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[5]'
                            class='postbox'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='1 if intervention cheaper than gold standard' data-animation='true' data-placement='top' data-html='false'>Economical</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[6]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if present, 1 if absent' data-animation='true' data-placement='top' data-html='false'>Conflict of interest</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[7]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if more than 1 in 5 (20%) or not mentioned, 1 if not' data-animation='true' data-placement='top' data-html='false'>Withdrawal / Dropouts</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[8]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if not mentioned or inappropriate, 1 if appropriate' data-animation='true' data-placement='top' data-html='false'>Coherent endpoints </span></td>
                    <td class='score'>
                    <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[9]'
                        class='postbox' onchange='wp_dermatology_findTotal();'>
                        <option value='0' selected>0</option>
                        <option value='1'>1</option>
                    </select></td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if multiple active ingredients tested, 1 if single' data-animation='true' data-placement='top' data-html='false'>Co-Interventions</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[10]'
                            class='postbox' onchange='wp_dermatology_findTotal();'>
                            <option value='0' selected>0</option>
                            <option value='1'>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if no rational theoretical basis, 1 if sound' data-animation='true' data-placement='top' data-html='false'>Acceptable theory</span></td>
                    <td class='score'>
                    <select name='wp_dermatology_tascderm' id='wp_dermatology_tascderm[11]'
                        class='postbox' onchange='wp_dermatology_findTotal();'>
                        <option value='0' selected>0</option>
                        <option value='1'>1</option>
                    </select></td>
                </tr>
                <tr>
                    <td class='total'>Total</td>
                    <td class='total'><input type='text' name='tascderm' id='tascderm_total' value = '0' /></td>
                </tr>
            </tbody>
        </table>
        <input type='submit' name='save_data' value='Score'/>
    </form>
    <small><a href='http://dermatologist.co.in/2015/03/tascderm.html' target='_blank'>More about TASCDerm.</a></small>
</div>
        ";
        return $content;
    }

    public function render_tascderm_interpretation()
    {

        if (!is_single())
            return;

        $content = "
<div id='tascderm-interpretation'>
    <table class='tascderm-table'>
        <tbody>
            <tr>
                <td class='result'><strong>13-15</strong></td>
                <td class='description'>Excellent study with substantial evidence</td>
            </tr>
            <tr>
                <td class='result'><strong>10-12</strong></td>
                <td class='description'>Good study. Evidence sufficient for practice</td>
            </tr>
            <tr>
                <td class='result'><strong>7-9</strong></td>
                <td class='description'>Average Study. Use the evidence with caution</td>
            </tr>
            <tr>
                <td class='result'><strong>4-6</strong></td>
                <td class='description'>Weak Study. Evidence not suitable for practice</td>
            </tr>
            <tr>
                <td class='result'><strong>0-3</strong></td>
                <td class='description'>Just an anecdotal claim</td>
            </tr>
        </tbody>
    </table>
</div>
            ";


        return $content;

    }
}
