<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.6.1 for parent theme Amply for publication on ThemeForest
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 *
 * Depending on your implementation, you may want to change the include call:
 *
 * Parent Theme:
 * require_once get_template_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Child Theme:
 * require_once get_stylesheet_directory() . '/path/to/class-tgm-plugin-activation.php';
 *
 * Plugin:
 * require_once dirname( __FILE__ ) . '/path/to/class-tgm-plugin-activation.php';
 */
require_once get_parent_theme_file_path( 'tgm/class-tgm-plugin-activation.php' );
// phpcs:disable
add_action( 'tgmpa_register', 'amly_register_required_plugins' );
add_filter( 'amply_plugin_list', 'amply_plugin_list');

function amply_plugin_group()
{
    $groups = array(
        'require' => array(
            'type' => 'required',
            'title'  => esc_html__('Required Plugin', 'amply'),
            'notice' => esc_html__('Please install all required plugin', 'amply'),
            'items' => array(

                array(
                    'name'                  => esc_html__('Vafpress Post Formats UI', 'amply'),
                    'slug'                  => 'vafpress-post-formats-ui-develop',
                    'version'               => '1.5',
                    'source'                => 'vafpress-post-formats-ui-develop.zip',
                    'required'              => true,
                    'force_activation'      => false,
                    'force_deactivation'    => false,
                    'group'                 => 'require',
                    'description'           => esc_html__('Custom post format admin UI', 'amply'),
                    'detail' 				=> array(
                        'image' => AMPLY_THEME_URI . 'assets/images/plugin/vafpress.png',
                    )
								)

            )
        ),
    );

    return $groups;
}


add_action( 'admin_bar_menu', 'amply_plugin_update_notice', 99);

/**
 * @param WP_Admin_Bar $admin_bar
 */
function amply_plugin_update_notice($admin_bar)
{
    do_action('tgmpa_register');

    $tgm_instance = call_user_func( array( get_class( $GLOBALS['tgmpa'] ), 'get_instance' ) );

    foreach($tgm_instance->plugins as $id => $detail) {
        if($tgm_instance->is_plugin_active($id) && $tgm_instance->does_plugin_require_update($id)) {

            $admin_bar->add_menu(array(
                'id'        => 'amply',
                'title'     => '<span class="ab-icon"></span>Amply - Notification',
                'href'      => '#',
                'meta'   => array(
                    'class'     => 'amply-notice',
                ),
            ));

            $admin_bar->add_menu(
                array(
                    'parent' => 'amply',
                    'id' => 'update-plugin',
                    'title' => 'Some Plugin Need Update',
                    'href' => admin_url( 'admin.php?page=amply_plugin'),
                    'meta'   => array(
	                    'class'     => 'amply-notice',
                    ),
                )
            );
        }
    }
}


function amply_plugin_list()
{
	$plugins = array();
	$groups = amply_plugin_group();

	foreach ($groups as $key => $group) {
        $plugins = array_merge($plugins, $group['items']);
    }

	return $plugins;
}

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function amly_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = amply_plugin_list();

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'amply',                              // Unique ID for hashing notices for multiple instances of TGMPA.
    'default_path' => AMPLY_THEME_DIR . 'plugins/',         // Default absolute path to bundled plugins.
		'menu'         => 'amply-install-plugins',              // Menu slug.
		'has_notices'  => true,                                 // Show admin notices or not.
		'dismissable'  => true,                                 // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                                   // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                                // Automatically activate plugins after installation or not.
		'message'      => '',                                   // Message to output right before the plugins table.amply_plugin_group
	);

	tgmpa( $plugins, $config );
}
