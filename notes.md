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

## setting up updates
* Add "yahnis-elsts/plugin-update-checker": ">=1.0" to composer.json
* composer update
* require_once plugin_dir_path( __FILE__ ) . 'vendor/yahnis-elsts/plugin-update-checker/plugin-update-checker.php';
* protected $myUpdateChecker;
* Add the following under plugin_classes:
```
$this->myUpdateChecker = PucFactory::buildUpdateChecker(
    		'http://nuchange.ca/wp-update-server/?action=get_metadata&slug=wp-dermatology',
    		__FILE__
		);
```
* Gruntfile changed.


