<?php
namespace NiftyflowCalculatorBuilder;

/**
 * Class Frontend handles the shortcode rendering
 */
class Frontend {

    public function __construct() {
        // Register the 'niftyflow' shortcode and map it to the render method
        add_shortcode('niftyflow', [$this, 'render']);
    }

    /**
     * Render the embedded calculator widget
     * This method is called when the 'niftyflow' shortcode is used
     *
     * @param array $atts The attributes passed to the shortcode
     * @return string The HTML content to be outputted
     */
    public function render($atts) {
        // Set default values for the shortcode attributes and override them with user inputs
        $atts = shortcode_atts([
            'widget-id' => '',
            'widget-source-url' => '',
            'params' => ''
        ], $atts);

        // Check if the essential attributes 'widget-id' and 'widget-source-url' are present
        if (empty($atts['widget-id']) || empty($atts['widget-source-url'])) {
            // If required attributes are missing, show an error message to administrators
            if (current_user_can('administrator')) {
                return '<div>Error: Required attributes are missing in the niftyflow shortcode. Please ensure you have copied and pasted the shortcode correctly from the niftyflow website. If the issue persists, please contact the niftyflow support team for assistance.</div>';
            }
            // Return an empty string for non-admin users, effectively showing nothing on the frontend
            return '';
        }

        // Assign attributes to variables
        $widget_id = $atts['widget-id'];
        $widget_source_url = $atts['widget-source-url'];
        $params = $atts['params'];

        // Enqueue the embed script
        wp_enqueue_script('niftyflow-script', esc_url($widget_source_url) . 'embed.min.js', array(), '1.0.0', array('strategy'  => 'async'));

        // Construct the HTML content for the shortcode
        $content = '<div ' .
                   'class="niftyflow-embed" ' .
                   'data-widget-id="' . esc_attr($widget_id) . '" ' .
                   'data-widget-source-url="' . esc_url($widget_source_url) . '" ' .
                   'data-params="' . esc_attr($params) . '"' .
                   '></div>';

        // Return the HTML content to be outputted where the shortcode is used
        return $content;
    }
}
