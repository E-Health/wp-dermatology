<?php
/**
 * Created by PhpStorm.
 * User: beapen
 * REF: https://paulund.co.uk/uninstall-file-wordpress-plugin
 * Date: 04/06/16
 * Time: 2:09 PM
 */

if( ! defined( 'WP_UNINSTALL_PLUGIN' ) )
    exit();

if (is_multisite())
{
    global $wpdb;
    $blogs = $wpdb->get_results("SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A);

    if(!empty($blogs))
    {
        foreach($blogs as $blog)
        {
            switch_to_blog($blog['blog_id']);
            delete_option('wp_dermatology_basic_options');
            delete_post_meta_by_key('_wp_dermatology_peelscore');
            delete_post_meta_by_key('_wp_dermatology_tascderm');
            delete_post_meta_by_key('_wp_dermatology_tascderm_count');
            unregister_widget( 'WPD_Skinhelpdesk_Widget' );
        }
    }
} else {
    delete_option('wp_dermatology_basic_options');
    delete_post_meta_by_key('_wp_dermatology_peelscore');
    delete_post_meta_by_key('_wp_dermatology_tascderm');
    delete_post_meta_by_key('_wp_dermatology_tascderm_count');
    unregister_widget( 'WPD_Skinhelpdesk_Widget' );

}