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
    }

    public function render_tascderm($content)
    {
        global $post;
        $value = get_post_meta( $post->ID,
            '_wp_dermatology_tascderm', true ); //array

        $content .= "
<div id='tascderm'>
    <form>
        <table class='tascderm-table'>
            <thead>
                <tr>
                    <th><i class='fa fa-sticky-note-o'></i>Criteria (Maximum score)</th>
                    <th>Score</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if no randomization performed or randomization not mentioned.' data-animation='true' data-placement='top' data-html='false'>Randomization</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[0]' id='wp_dermatology_tascderm[0]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='2'
                                <?php if ( '2' == $value ) echo 'selected';
                            ?>>2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if no placebo, 1 if inert placebo, 2 if compared to gold standard.' data-animation='true' data-placement='top' data-html='false'>Placebo</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[1]' id='wp_dermatology_tascderm[1]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='2'
                                <?php if ( '2' == $value ) echo 'selected';
                            ?>>2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 No blinding, 1 Single blinded, 2 Double blinded' data-animation='true' data-placement='top' data-html='false'>Blinding</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[2]' id='wp_dermatology_tascderm[2]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='2'
                                <?php if ( '2' == $value ) echo 'selected';
                            ?>>2</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='Example: 1 if Colorimeter is used for melasma and 0 if MASI is used.' data-animation='true' data-placement='top' data-html='false'>Objective measurement</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[3]' id='wp_dermatology_tascderm[3]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='Effect size of 0.5, alpha 0.05 and power 80' data-animation='true' data-placement='top' data-html='false'>Sample size more than 21</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[4]' id='wp_dermatology_tascderm[4]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if study is done on clinic staff or if person knows allocated group. 1 if appropriate.' data-animation='true' data-placement='top' data-html='false'>Sample selection and allocation concealment</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[5]' id='wp_dermatology_tascderm[5]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='1 if intervention cheaper than gold standard' data-animation='true' data-placement='top' data-html='false'>Economical</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[6]' id='wp_dermatology_tascderm[6]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if present, 1 if absent' data-animation='true' data-placement='top' data-html='false'>Conflict of interest</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[7]' id='wp_dermatology_tascderm[7]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if more than 1 in 5 (20%) or not mentioned, 1 if not' data-animation='true' data-placement='top' data-html='false'>Withdrawal / Dropouts</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[8]' id='wp_dermatology_tascderm[8]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if not mentioned or inappropriate, 1 if appropriate' data-animation='true' data-placement='top' data-html='false'>Coherent endpoints </span></td>
                    <td class='score'>            	            <select name='wp_dermatology_tascderm[9]' id='wp_dermatology_tascderm[9]'
                        class='postbox'>
                        <option value='0'
                            <?php if ( '0' == $value ) echo 'selected';
                        ?>>1</option>
                        <option value='1'
                            <?php if ( '1' == $value ) echo 'selected';
                        ?>>1</option>
                    </select></td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if multiple active ingredients tested, 1 if single' data-animation='true' data-placement='top' data-html='false'>Co-Interventions</span></td>
                    <td class='score'>
                        <select name='wp_dermatology_tascderm[10]' id='wp_dermatology_tascderm[10]'
                            class='postbox'>
                            <option value='0'
                                <?php if ( '0' == $value ) echo 'selected';
                            ?>>1</option>
                            <option value='1'
                                <?php if ( '1' == $value ) echo 'selected';
                            ?>>1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class='criteria'><span class=' bs-tooltip' title='0 if no rational theoretical basis, 1 if sound' data-animation='true' data-placement='top' data-html='false'>Acceptable theory</span></td>
                    <td class='score'>            	            <select name='wp_dermatology_tascderm[11]' id='wp_dermatology_tascderm[11]'
                        class='postbox'>
                        <option value='0'
                            <?php if ( '0' == $value ) echo 'selected';
                        ?>>1</option>
                        <option value='1'
                            <?php if ( '1' == $value ) echo 'selected';
                        ?>>1</option>
                    </select></td>
                </tr>
                <tr>
                    <td class='total'>Total</td>
                    <td class='total'><span class='digit'></span>/15</td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
        ";
    }

    public function render_tascderm_interpretation($content)
    {

        if (is_single()) {

            $content .= "
<div id='tascderm-interpretation'>
    <table class='tascderm-table'>
        <caption><i class='fa fa-star'></i>Interpretation is as follows:</caption>
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

        }
        return $content;

    }
}
