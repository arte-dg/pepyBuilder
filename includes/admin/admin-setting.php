<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

require( __DIR__ . '/classes/class.settings-api.php' );

class HTBuilder_Admin_Settings {

    private $settings_api;

    function __construct() {

        $this->settings_api = new HTBuilder_Settings_API();

        //add_action('init', array(  $this, 'set_pro_api' ));

        add_action( 'admin_init', array( $this, 'admin_init' ) );
        add_action( 'admin_menu', array( $this, 'admin_menu' ), 220 );
        add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );
        add_action( 'wsa_form_bottom_htbuilder_general_tabs', array( $this, 'html_general_tabs' ) );
        //add_action( 'wsa_form_top_htbuilder_element_tabs', array( $this, 'html_element_toogle_button' ) );
        //add_action( 'wsa_form_top_htbuilder_element_tabs', array( $this, 'html_popup_box' ) );
        add_action( 'wsa_form_bottom_htbuilder_plugins_tabs', [ $this, 'html_our_plugins_library_tabs' ] );
    }

     //Admin Initialize
    function admin_init() {

        //set the settings
        $this->settings_api->set_sections( $this->admin_get_settings_sections() );
        $this->settings_api->set_fields( $this->admin_fields_settings() );

        //initialize settings
        $this->settings_api->admin_init();
    }

    // Plugins menu Register
    function admin_menu() {
        add_menu_page( 
            __( 'pepy Builder', 'ht-builder' ),
            __( 'pepy Builder', 'ht-builder' ),
            'manage_options',
            'htbuilder',
            array ( $this, 'plugin_page' ),
            'dashicons-text-page',
            50
        );
    }

    // Admin Scripts
    public function enqueue_admin_scripts(){

        // wp core styles
        wp_enqueue_style( 'wp-jquery-ui-dialog' );
        // wp core scripts
        wp_enqueue_script( 'jquery-ui-dialog' );

        wp_enqueue_style( 'htbuilder-admin', HTBUILDER_PL_URL . 'includes/admin/assets/css/admin_optionspanel.css', FALSE, HTBUILDER_VERSION );
        
        wp_enqueue_script( 'htbuilder-admin', HTBUILDER_PL_URL . 'includes/admin/assets/js/admin_scripts.js', array('jquery'), HTBUILDER_VERSION, TRUE );
    }

    // Options page Section register
    function admin_get_settings_sections() {
        $sections = array(
            
            array(
                'id'    => 'htbuilder_general_tabs',
                'title' => esc_html__( 'General', 'ht-builder' )
            ),

            array(
                'id'    => 'htbuilder_templatebuilder_tabs',
                'title' => esc_html__( 'Template Builder', 'ht-builder' )
            ),

            array(
                'id'    => 'htbuilder_element_tabs',
                'title' => esc_html__( 'Elements', 'ht-builder' )
            ),
            /*
            array(
                'id'    => 'htbuilder_plugins_tabs',
                'title' => esc_html__( 'Our Plugins', 'ht-builder' )
            ),*/

        );
        return $sections;
    }

    protected function admin_fields_settings() {

        $settings_fields = array(

            'htbuilder_general_tabs' => array(),
            
            'htbuilder_templatebuilder_tabs' => array(

                array(
                    'name'  => 'enablecustomtemplate',
                    'label'  => __( 'Enable Custom template Layout', 'ht-builder' ),
                    'desc'  => __( 'Enable', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),

                
                array(
                    'name'    => 'single_blog_page',
                    'label'   => __( 'Single Blog Template.', 'ht-builder' ),
                    'desc'    => __( 'You can select Single blog page from here.', 'ht-builder' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => htbuilder_elementor_template()
                ),

                array(
                    'name'    => 'archive_blog_page',
                    'label'   => __( 'Blog Template.', 'ht-builder' ),
                    'desc'    => __( 'You can select blog page from here.', 'ht-builder' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => htbuilder_elementor_template()
                ),

                
                array(
                    'name'    => 'search_page',
                    'label'   => __( 'Search Page Template.', 'ht-builder' ),
                    'desc'    => __( 'You can select search page from here.', 'ht-builder' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => htbuilder_elementor_template(),
                    //'class'   =>'htproelement',
                ),

                array(
                    'name'    => 'error_page',
                    'label'   => __( '404 Page Template.', 'ht-builder' ),
                    'desc'    => __( 'You can select 404 page from here.', 'ht-builder' ),
                    'type'    => 'select',
                    'default' => '0',
                    'options' => htbuilder_elementor_template(),
                    //'class'   =>'htproelement',
                ),

             ),

            'htbuilder_element_tabs'=>array(

                array(
                    'name'  => 'bl_post_content',
                    'label'  => __( 'Post Content', 'ht-builder' ),
                    'desc'  => __( 'Post Content', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),

                array(
                    'name'  => 'bl_post_featured_image',
                    'label'  => __( 'Post Featured Image', 'ht-builder' ),
                    'desc'  => __( 'Post Featured Image', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),

                /*array(
                    'name'  => 'bl_post_meta_info',
                    'label'  => __( 'Post Meta Info BETA', 'ht-builder' ),
                    'desc'  => __( 'Post Meta Info', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'htproelement',
                ),*/

                array(
                    'name'  => 'bl_post_excerpt',
                    'label'  => __( 'Post Excerpt', 'ht-builder' ),
                    'desc'  => __( 'Post Excerpt', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'htbuilder_table_row',
                ),

                array(
                    'name'  => 'bl_post_comments',
                    'label'  => __( 'Post Comments', 'ht-builder' ),
                    'desc'  => __( 'Post Comments', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),
                array(
                    'name'  => 'bl_post_title',
                    'label'  => __( 'Post Title', 'ht-builder' ),
                    'desc'  => __( 'Post Title', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'of',
                    'class'=>'htbuilder_table_row',
                ),
                /*array(
                    'name'  => 'bl_post_search_form',
                    'label'  => __( 'Post Search Form', 'ht-builder' ),
                    'desc'  => __( 'Post Search Form', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'of',
                    'class'=>'htbuilder_table_row',
                ),*/
                array(
                    'name'  => 'bl_site_title',
                    'label'  => __( 'Site Title', 'ht-builder' ),
                    'desc'  => __( 'Site Title', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'of',
                    'class'=>'htbuilder_table_row',
                ),
                array(
                    'name'  => 'bl_post_archive',
                    'label'  => __( 'Archive Posts', 'ht-builder' ),
                    'desc'  => __( 'Archive Posts', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),

                array(
                    'name'  => 'bl_post_archive_title',
                    'label'  => __( 'Archive Title', 'ht-builder' ),
                    'desc'  => __( 'Archive Title', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),
                
                array(
                    'name'  => 'bl_post_author_info',
                    'label'  => __( 'Author Info', 'ht-builder' ),
                    'desc'  => __( 'Author Info', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),
                /*
                array(
                    'name'  => 'bl_social_share',
                    'label'  => __( 'Social Share BETA', 'ht-builder' ),
                    'desc'  => __( 'Social share', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'off',
                    'class'=>'htbuilder_table_row',
                ),*/
    
                array(
                    'name'  => 'bl_post_navigation',
                    'label'  => __( 'Post Navigation', 'ht-builder' ),
                    'desc'  => __( 'Post Navigation', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),

                array(
                    'name'  => 'bl_related_post',
                    'label'  => __( 'Related Post', 'ht-builder' ),
                    'desc'  => __( 'Related Post', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),

                array(
                    'name'  => 'bl_popular_post',
                    'label'  => __( 'Popular Post', 'ht-builder' ),
                    'desc'  => __( 'Popular Post', 'ht-builder' ),
                    'type'  => 'checkbox',
                    'default' => 'on',
                    'class'=>'htbuilder_table_row',
                ),
            ),

         );
        
        return array_merge( $settings_fields );
    }

    // Admin Menu Page Render
    function plugin_page() {

        echo '<div class="wrap">';
            echo '<h2>'.esc_html__( 'pepyBuilder Settings','ht-builder' ).'</h2>';
            $this->save_message();
            $this->settings_api->show_navigation();
            $this->settings_api->show_forms();
        echo '</div>';

    }

    // Save Options Message
    function save_message() {
        if( isset($_GET['settings-updated']) ) { ?>
            <div class="updated notice is-dismissible"> 
                <p><strong><?php esc_html_e('Successfully Settings Saved.', 'ht-builder') ?></strong></p>
            </div>
            <?php
        }
    }

    //Pop up Box
    function html_popup_box(){
        ob_start();
        ?>
            <script type="text/javascript">
                ( function( $ ) {
                    $(function() {
                        $(".htbuilder_table_row input[type='checkbox'],.htproelement select").removeAttr("disabled");
                    });
                } )( jQuery );
            </script>
        <?php
        echo ob_get_clean();
    }

    // General tab
    function html_general_tabs(){
        ob_start();
        ?>
            <div class="htbuilder-general-tabs">

                <div class="htbuilder-document-section">
                    <div class="htbuilder-column">
                        <a href="https://pepy.link/go/pepybuilder-youtube/" target="_blank">
                            <img src="<?php echo HTBUILDER_PL_URL; ?>/includes/admin/assets/images/01.png" alt="<?php esc_attr_e( 'Video Tutorial', 'ht-builder' ); ?>">
                        </a>
                    </div>
                    <div class="htbuilder-column">
                        <a href="https://pepy.link/go/pepy-builder-escola-elementor/" target="_blank">
                            <img src="<?php echo HTBUILDER_PL_URL; ?>/includes/admin/assets/images/02.png" alt="<?php esc_attr_e( 'Online Documentation', 'ht-builder' ); ?>">
                        </a>
                    </div>
                    <!--<div class="htbuilder-column">
                        <a href="https://hasthemes.com/contact-us/" target="_blank">
                            <img src="<?php echo HTBUILDER_PL_URL; ?>/includes/admin/assets/images/genral-contact-us.jpg" alt="<?php esc_attr_e( 'Contact Us', 'ht-builder' ); ?>">
                        </a>
                    </div>-->
                </div>

            </div>
        <?php
        echo ob_get_clean();
    }

    // Plugins Library
    function html_our_plugins_library_tabs() {
        ob_start();
        ?>
        <div class="htoptions-plugins-laibrary">
            <p><?php echo esc_html__( 'Use Our plugins.', 'ht-builder' ); ?></p>
            <div class="htoptions-plugins-area">
                <h3><?php esc_html_e( 'Premium Plugins', 'ht-builder' ); ?></h3>
                <div class="htoptions-plugins-row">
                    
                    <div class="htoptions-single-plugins"><img src="<?php echo HTBUILDER_PL_URL; ?>/includes/admin/assets/images/preview_woolentor-pro.jpg" alt="">
                        <div class="htoptions-plugins-content">
                            <a href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/" target="_blank">
                                <h3><?php echo esc_html__( 'WooLentor - WooCommerce Page Builder and WooCommerce Elementor Addon', 'ht-builder' ); ?></h3>
                            </a>
                            <a href="https://hasthemes.com/plugins/woolentor-pro-woocommerce-page-builder/" class="htoptions-button" target="_blank"><?php echo esc_html__( 'More Details', 'ht-builder' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="htoptions-single-plugins"><img src="<?php echo HTBUILDER_PL_URL; ?>/includes/admin/assets/images/htmega_preview.jpg" alt="">
                        <div class="htoptions-plugins-content">
                            <a href="https://hasthemes.com/plugins/ht-mega-pro/" target="_blank">
                                <h3><?php echo esc_html__( 'HT Mega – Absolute Addons for Elementor Page Builder', 'ht-builder' ); ?></h3>
                            </a>
                            <a href="https://hasthemes.com/plugins/ht-mega-pro/" class="htoptions-button" target="_blank"><?php echo esc_html__( 'More Details', 'ht-builder' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="htoptions-single-plugins"><img src="<?php echo HTBUILDER_PL_URL; ?>/includes/admin/assets/images/hasbarpro-preview.jpg" alt="">
                        <div class="htoptions-plugins-content">
                            <a href="https://hasthemes.com/wordpress-notification-bar-plugin/" target="_blank">
                                <h3><?php echo esc_html__( 'HashBar Pro - WordPress Notification Bar plugin', 'ht-builder' ); ?></h3>
                            </a>
                            <a href="https://hasthemes.com/wordpress-notification-bar-plugin/" class="htoptions-button" target="_blank"><?php echo esc_html__( 'More Details', 'ht-builder' ); ?></a>
                        </div>
                    </div>
                    
                    <div class="htoptions-single-plugins"><img src="<?php echo HTBUILDER_PL_URL; ?>/includes/admin/assets/images/htscript-preview.png" alt="">
                        <div class="htoptions-plugins-content">
                            <a href="https://hasthemes.com/plugins/insert-headers-and-footers-code-ht-script/" target="_blank">
                                <h3><?php echo esc_html__( 'HT Script Pro - Insert Header & Footer Code', 'ht-builder' ); ?></h3>
                            </a>
                            <a href="https://hasthemes.com/plugins/insert-headers-and-footers-code-ht-script/" class="htoptions-button" target="_blank"><?php echo esc_html__( 'More Details', 'ht-builder' ); ?></a>
                        </div>
                    </div>

                    <div class="htoptions-single-plugins"><img src="<?php echo HTBUILDER_PL_URL; ?>/includes/admin/assets/images/wc-builder_pro.jpg" alt="">
                        <div class="htoptions-plugins-content">
                            <a href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/" target="_blank">
                                <h3><?php echo esc_html__( 'WC Builder - WooCommerce Page Builder for WP Bakery', 'wc-sales-notification-pro' ); ?></h3>
                            </a>
                            <a href="https://hasthemes.com/plugins/wc-builder-woocoomerce-page-builder-for-wpbakery/" class="htoptions-button" target="_blank"><?php echo esc_html__( 'More Details', 'wc-sales-notification-pro' ); ?></a>
                        </div>
                    </div>

                </div>

                <h3><?php esc_html_e( 'Free Plugins', 'ht-builder' ); ?></h3>
                <div class="htoptions-plugins-row">

                	<?php htbuilder_get_org_plugins(); ?>

                </div>

            </div>
        </div>
        <?php
        echo ob_get_clean();
    }

}

new HTBuilder_Admin_Settings();