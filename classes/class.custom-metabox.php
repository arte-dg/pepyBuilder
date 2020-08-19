<?php

namespace HT_Builder\Elementor;
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
* Custom Field in category and tag page
*/
class HTBuilder_Custom_Fileds{

    private static $_instance = null;
    public static function instance(){
        if( is_null( self::$_instance ) ){
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    function __construct() {
        $this->init();
    }

    function init(){

        // Category Custom Field
        add_action('category_add_form_fields', [ $this, 'htbuilder_taxonomy_add_new_meta_field' ], 15, 1 );
        add_action('category_edit_form_fields', [ $this, 'htbuilder_taxonomy_edit_meta_field' ], 15, 1 );
        add_action('edited_category', [ $this, 'htbuilder_save_taxonomy_custom_meta' ], 15, 1 );
        add_action('create_category', [ $this, 'htbuilder_save_taxonomy_custom_meta' ], 15, 1 );

        // Tag Custom Field
        add_action('post_tag_add_form_fields', [ $this, 'htbuilder_taxonomy_add_new_meta_field' ], 15, 1 );
        add_action('post_tag_edit_form_fields', [ $this, 'htbuilder_taxonomy_edit_meta_field' ], 15, 1 );
        add_action('edited_post_tag', [ $this, 'htbuilder_save_taxonomy_custom_meta' ], 15, 1 );
        add_action('create_post_tag', [ $this, 'htbuilder_save_taxonomy_custom_meta' ], 15, 1 );
    }

    function htbuilder_taxonomy_add_new_meta_field(){
        ?>
        <div class="form-field term-group">
            <label for="htbuilder_selectterm_layout"><?php esc_html_e('Page Layout', 'ht-builder-pro'); ?></label>
            <select class="postform" id="equipment-group" name="htbuilder_selectterm_layout">
                <?php if( function_exists('htbuilder_elementor_template') ) foreach ( htbuilder_elementor_template() as $catlayout_key => $catlayout ) : ?>
                   <option value="<?php echo esc_attr( $catlayout_key ); ?>" class=""><?php echo esc_html__( $catlayout, 'ht-builder-pro' ); ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <?php
    }

    // Field Edit page
    function htbuilder_taxonomy_edit_meta_field( $term ) {
        
        //getting term ID
        $term_id = $term->term_id;

        // retrieve the existing value(s) for this meta field.
        $category_layout = get_term_meta( $term_id, 'htbuilder_selectterm_layout', true );

        ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label for="htbuilder_selectterm_layout"><?php esc_html_e( 'Page Layout', 'ht-builder-pro' ); ?></label></th>
                <td><select class="postform" id="htbuilder_selectterm_layout" name="htbuilder_selectterm_layout">
                    <?php if( function_exists('htbuilder_elementor_template') ) foreach ( htbuilder_elementor_template() as $catlayout_key => $catlayout ) : ?>
                        <option value="<?php echo esc_attr( $catlayout_key ); ?>" <?php selected( $category_layout, $catlayout_key ); ?>><?php echo esc_html__( $catlayout, 'ht-builder-pro' ); ?></option>
                    <?php endforeach; ?>
                </select></td>
            </tr>
        <?php
    }

    // Save extra taxonomy fields callback function.
    function htbuilder_save_taxonomy_custom_meta( $term_id ) {
        $htbuilder_categorylayout = filter_input( INPUT_POST, 'htbuilder_selectterm_layout' );
        update_term_meta( $term_id, 'htbuilder_selectterm_layout', $htbuilder_categorylayout );
    }


}

HTBuilder_Custom_Fileds::instance();