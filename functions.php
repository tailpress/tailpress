<?php

class TailPress
{
    private static $instance = null;
    private $commands = [];

    private function __construct() {
        $this->discoverCommands();
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function addCommand($name, $command) {
        $this->commands[$name] = $command;
    }

    public function getCommands() {
        return $this->commands;
    }

    public function discoverCommands()
    {
        $installedJson = __DIR__ . '/vendor/composer/installed.json';

        if (!file_exists($installedJson)) {
            return;
        }

        $packages = json_decode(file_get_contents($installedJson), true);
        $packages = isset($packages['packages']) ? $packages['packages'] : $packages;

        ray($packages);

        foreach ($packages as $package) {
            if (isset($package['extra']['tailpress']['providers'])) {
                foreach($package['extra']['tailpress']['providers'] as $provider) {
                    $provider = new $provider($this);
                    $provider->boot();
                    $provider->register();
                }
            }
        }
    }
}


function tailpress_enqueue_assets() {
    if (class_exists('TailPress\Vite\Vite')) {
        $vite = new \TailPress\Vite\Vite('http://localhost:3000', get_template_directory());

        $vite->enqueueAssets();
    }
}

add_action('wp_enqueue_scripts', 'tailpress_enqueue_assets');

require __DIR__ . '/vendor/autoload.php';

$app = TailPress::getInstance();

ray($app);

/**
 * Theme setup.
 */
function tailpress_setup() {
	add_theme_support( 'title-tag' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tailpress' ),
		)
	);

	add_theme_support(
		'html5',
		array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		)
	);

    add_theme_support( 'custom-logo' );
	add_theme_support( 'post-thumbnails' );

	add_theme_support( 'align-wide' );
	add_theme_support( 'wp-block-styles' );

	add_theme_support( 'responsive-embeds' );

	add_theme_support( 'editor-styles' );
	add_editor_style( 'css/editor-style.css' );
}

add_action( 'after_setup_theme', 'tailpress_setup' );

/**
 * Enqueue theme assets.
 */

// function tailpress_enqueue_scripts() {
// 	$vite_server = 'http://localhost:3000';

//     $response = wp_remote_get($vite_server . '/@vite/client');

//     $dev_mode_active = !is_wp_error($response) && wp_remote_retrieve_response_code($response) === 200;

// 	$theme = wp_get_theme();

//     if($dev_mode_active) {
//         $vite_server = defined('VITE_SERVER_URL') ? VITE_SERVER_URL : 'http://localhost:3000';

//         wp_enqueue_script('vite-client', $vite_server . '/@vite/client', [], null, false);
//         wp_enqueue_script('tailpress', $vite_server . '/resources/js/app.js', [], null, false);
//         wp_enqueue_style('tailpress', $vite_server . '/resources/css/app.css', []);
//     } else {
//         $manifest_path = get_theme_file_path('dist/.vite/manifest.json');

//         if (! file_exists($manifest_path)) {
//             return;
//         }

//         $manifest = json_decode(file_get_contents($manifest_path), true);

//         if (isset($manifest['resources/js/app.js'])) {
//             $js_file = $manifest['resources/js/app.js']['file'];

//             wp_enqueue_script('tailpress', get_theme_file_uri('dist/' . $js_file), [], null, true);
//         }

//         if (isset($manifest['resources/css/app.css'])) {
//             $css_file = $manifest['resources/css/app.css']['file'];

//             wp_enqueue_style('tailpress', get_theme_file_uri('dist/' . $css_file), [],$theme->get( 'Version' ));
//         }
//     }
// }

// add_action( 'wp_enqueue_scripts', 'tailpress_enqueue_scripts' );

/**
 * Get asset path.
 *
 * @param string  $path Path to asset.
 *
 * @return string
 */
function tailpress_asset( $path ) {
	if ( wp_get_environment_type() === 'production' ) {
		return get_stylesheet_directory_uri() . '/' . $path;
	}

	return add_query_arg( 'time', time(),  get_stylesheet_directory_uri() . '/' . $path );
}

/**
 * Adds option 'li_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_li_class( $classes, $item, $args, $depth ) {
	if ( isset( $args->li_class ) ) {
		$classes[] = $args->li_class;
	}

	if ( isset( $args->{"li_class_$depth"} ) ) {
		$classes[] = $args->{"li_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_css_class', 'tailpress_nav_menu_add_li_class', 10, 4 );

/**
 * Adds option 'submenu_class' to 'wp_nav_menu'.
 *
 * @param string  $classes String of classes.
 * @param mixed   $item The current item.
 * @param WP_Term $args Holds the nav menu arguments.
 *
 * @return array
 */
function tailpress_nav_menu_add_submenu_class( $classes, $args, $depth ) {
	if ( isset( $args->submenu_class ) ) {
		$classes[] = $args->submenu_class;
	}

	if ( isset( $args->{"submenu_class_$depth"} ) ) {
		$classes[] = $args->{"submenu_class_$depth"};
	}

	return $classes;
}

add_filter( 'nav_menu_submenu_css_class', 'tailpress_nav_menu_add_submenu_class', 10, 3 );
