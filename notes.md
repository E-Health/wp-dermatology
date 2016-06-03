# NOTES

## Sync
rsync -avz -e "ssh -o StrictHostKeyChecking=no -o UserKnownHostsFile=/dev/null" --progress /home/beapen/wordpress-plugin/wp-dermatology beapen@192.168.0.250:/var/www/html/wordpress/wp-content/plugins/

## Adding action/filter in another class
* add_filter( 'the_content', array( __CLASS__, 'get_dermbase' ) );
* declare class as public static. When to declare as private static?

## Include other plugin classes
require_once plugin_dir_path( __FILE__ ) . 'includes/class-dermbase.php';

## setting up test.

* wget -m -np https://develop.svn.wordpress.org/trunk/
* set up a blank database
* in the /tmp folder create /wordpress and wordpress-tests-lib
* unzip wordpress into /wordpress (latest.tar.gz with tar --strip-components=1 -zxmf /tmp/wordpress.tar.gz -C wordpress)
* https://raw.github.com/markoheijnen/wp-mysqli/master/db.php wordpress/wp-content/db.php
* change bootstrap.php in /tests if required.