<?php
/*
Plugin Name: Wordpress Export CSS
Description: Collects dynamic Gutenberg styles into a single CSS file for use in a headless setup.
Version: 1.0
Author: mehov
*/

add_action('rest_api_init', 'wordpress_export_css');

function wordpress_export_css() {
    register_rest_route('wordpress-export-css', '/wordpress-export-css.css', [
        'methods' => 'GET',
        'callback' => [new wordpress_export_css_class, 'render'],
        'permission_callback' => '__return_true',
    ]);
}

class wordpress_export_css_class {

    public static function get_global_stylesheet()
    {
        if (function_exists('wp_get_global_stylesheet')) {
            return wp_get_global_stylesheet(['variables', 'presets', 'styles', 'base-layout-styles']);
        }
        return;
    }

    public static function get_block_styles()
    {
        $styles = '';
        $block_styles_registry = WP_Block_Styles_Registry::get_instance()->get_all_registered();
        foreach ($block_styles_registry as $block_name => $styles_array) {
            foreach ($styles_array as $style) {
                if (!empty($style['inline_style'])) {
                    $styles .= $style['inline_style'] . "\n";
                }
            }
        }
        return $styles;
    }

    public function render()
    {
        $css = array();
        $css[] = sprintf('/* %s */', gmdate('r'));
        $css[] = '/* get_global_stylesheet */';
        $css[] = self::get_global_stylesheet();
        $css[] = '/* get_block_styles */';
        $css[] = self::get_block_styles();
        header('Content-Type: text/css');
        echo implode(PHP_EOL.PHP_EOL, $css);
        exit;
    }

}
