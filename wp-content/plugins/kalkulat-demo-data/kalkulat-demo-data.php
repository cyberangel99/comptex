<?php
if (!defined('ABSPATH'))
    exit;

/*
  Plugin Name: Kalkulat demo importer
  Plugin URI: http://themelayer.net
  Description: Import demo data Plugin for kalkulat theme only
  Version: 1.0
  Author: themelayer
  Author URI: http://themelayer.net
  Text Domain: kalkulat

 * @category WordPress_Plugin
 * @since kalkulat 1.0
 * @package kalkulat
 */

define('KALKULAT_OCDI_ACTIVATED', in_array('one-click-demo-import/one-click-demo-import.php', apply_filters('active_plugins', get_option('active_plugins'))));
// Demo Importer
if (KALKULAT_OCDI_ACTIVATED) {
    function kalkulat_demo_import_files()
    {
        return array(
            array(
                'import_file_name' => esc_html__('kalkulat Demo', 'kalkulat'),
                'local_import_file' => trailingslashit(plugin_dir_path(__FILE__)) . 'demo_data/kalkulat-demo.xml',
                'local_import_widget_file' => trailingslashit(plugin_dir_path(__FILE__)) . '/demo_data/kalkulat-widgets.json',
                'local_import_customizer_file' => trailingslashit(plugin_dir_path(__FILE__)) . '/demo_data/kalkulat-export.dat',
                'import_preview_image_url' => trailingslashit(plugin_dir_url(__FILE__)) . '/demo_data/01.png',
            )
        );
    }

    add_filter('pt-ocdi/import_files', 'kalkulat_demo_import_files');

    // Demo Homepage Set
    function kalkulat_demo_page_setting()
    {
         // Assign menus to their locations.
        $main_menu      = get_term_by('name', 'Main Menu', 'nav_menu');
        $footer_menu      = get_term_by('name', 'Footer Menu', 'nav_menu');

        set_theme_mod('nav_menu_locations', array(
                'main_menu'     => $main_menu->term_id,
                'footer_menu'     => $footer_menu->term_id,
            )
        );

        // Assign front page and posts page (blog page).
        $front_page_id  = get_page_by_title('Home One');
        $blog_page_id   = get_page_by_title('blog');

        update_option('show_on_front', 'page');
        update_option('page_on_front', $front_page_id->ID);
        update_option('page_for_posts', $blog_page_id->ID);

        if ( class_exists( 'RevSlider' ) ) {
               $slider_array = array(
                  trailingslashit(plugin_dir_path(__FILE__)) . '/demo_data/revslider/main-slider-4.zip',
                  trailingslashit(plugin_dir_path(__FILE__)) . '/demo_data/revslider/main-slider-5.zip',
                  trailingslashit(plugin_dir_path(__FILE__)) . '/demo_data/revslider/main_slider.zip',
                  trailingslashit(plugin_dir_path(__FILE__)) . '/demo_data/revslider/main_slider_3.zip',
                  trailingslashit(plugin_dir_path(__FILE__)) . '/demo_data/revslider/main_slider_two.zip',
                  );

               $slider = new RevSlider();
           
               foreach($slider_array as $filepath){
                 $slider->importSliderFromPost(true,true,$filepath);  
               }
           
               echo ' Slider processed';
        }
    }
    add_action('pt-ocdi/after_import', 'kalkulat_demo_page_setting');
}

// Check If One Click Demo Import is activate
function kalkulat_ocdi_required_plugin()
{
    if (is_admin() && current_user_can('activate_plugins') && !is_plugin_active('one-click-demo-import/one-click-demo-import.php')) {
        add_action('admin_notices', 'kalkulat_ocdi_required_notice');
        deactivate_plugins(plugin_basename(__FILE__));
        if (isset($_GET['activate'])) {
            unset($_GET['activate']);
        }
    }
}

add_action('admin_init', 'kalkulat_ocdi_required_plugin');

function kalkulat_ocdi_required_notice()
{
    ?>
    <div class="error">
        <p><?php esc_html_e('Error! you need to install or activate the', 'kalkulat'); ?> <a
                    href="<?php echo esc_url('https://wordpress.org/plugins/one-click-demo-import/'); ?>"><?php esc_html_e('Download One Click Demo Import', 'kalkulat'); ?></a> <?php esc_html_e('plugin to run this plugin.', 'kalkulat'); ?>
        </p>
    </div>
    <?php
}