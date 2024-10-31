<?php
/**
 * Plugin Name: Niftyflow - Form & Calculator Builder
 * Description: Create multilingual price quote, ROI, and finance calculators with drag & drop. Easy to embed on any website. No developer or coding skills required.
 * Author: niftyflowrocks
 * Author URI: https://niftyflow.rocks
 * Version: 1.0.0
 * License: GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 */

namespace NiftyflowCalculatorBuilder;

// Prevent direct file access
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Main class for the Niftyflow plugin
 * This class initializes the plugin by loading necessary dependencies
 */
class Plugin {

    /**
     * Constructor for the Niftyflow class
     * Hooks into 'plugins_loaded' to initialize the plugin
     */
    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    /**
     * Initializes the plugin by loading the required dependencies
     */
    public function init() {
        $this->load_dependencies();
    }

    /**
     * Load the required dependencies for this plugin
     * Currently, this includes the Frontend class which handles the shortcode rendering
     */
    private function load_dependencies() {
        require_once plugin_dir_path(__FILE__) . 'includes/Frontend.php';
        new Frontend();
    }
}

// Initialize the plugin
new Plugin();
