# NOTES

## Sync
rsync -avz -e "ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null" --progress /home/beapen/wordpress-plugin/wp-dermatology beapen@192.168.0.250:/var/www/html/wordpress/wp-content/plugins/

## Adding action/filter in another class
* add_filter( 'the_content', array( __CLASS__, 'get_dermbase' ) );
* declare class as public static. When to declare as private static?

## Include other plugin classes
require_once plugin_dir_path( __FILE__ ) . 'includes/class-dermbase.php';