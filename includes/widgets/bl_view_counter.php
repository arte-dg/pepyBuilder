<?php
namespace HT_Builder\Elementor\Widget;

use Elementor\Plugin as Elementor;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Scheme_Color;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bl_View_Counter_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-view-counter';
    }

    public function get_title() {
        return __( 'BL: View Counter', 'ht-builder' );
    }

    public function get_icon() {
        return 'htbuilder-icon eicon-document-file';
    }

    public function get_categories() {
        return ['ht_builder'];
    }

    protected function _register_controls() {

        // Content
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'View Counter', 'ht-builder' ),
            ]
        );
            
            $this->add_control(
                'counter_type',
                [
                    'label' => __( 'Counter Type', 'ht-builder' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'post',
                    'options' => [
                        'post'      => __( 'Post', 'ht-builder' ),
                        'page'      => __( 'Page', 'ht-builder' ),
                    ],
                ]
            );

            $this->add_control(
                'additional_text_type',
                [
                    'label' => __( 'Additional Text Type', 'ht-builder' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '',
                    'options' => [
                        ''      => __( 'Default', 'ht-builder' ),
                        'icon'  => __( 'Icon', 'ht-builder' ),
                        'text'  => __( 'Text', 'ht-builder' ),
                    ],
                ]
            );

            $this->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'ht-builder' ),
                    'type' => Controls_Manager::ICON,
                    'condition'=>[
                        'additional_text_type' => 'icon',
                    ]
                ]
            );

            $this->add_control(
                'additional_txt',
                [
                    'label' => __( 'Additional Text', 'ht-builder' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Additional Text', 'ht-builder' ),
                    'default' => __( 'View', 'ht-builder' ),
                    'condition'=>[
                        'additional_text_type' => 'text',
                    ]
                ]
            );


        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'button_style_section',
            array(
                'label' => __( 'Style', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'heading_text_style',
                [
                    'label' => __( 'Text', 'ht-builder' ),
                    'type' => Controls_Manager::HEADING,
                ]
            );

            $this->add_control(
                'text_color',
                [
                    'label' => __( 'Text Color', 'ht-builder' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default'=>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .htbuildercounter span' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_typography',
                    'label' => __( 'Typography', 'ht-builder' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .htbuildercounter span',
                ]
            );

            $this->add_control(
                'heading_icon_style',
                [
                    'label' => __( 'Icon', 'ht-builder' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

            $this->add_control(
                'icon_color',
                [
                    'label' => __( 'Icon Color', 'ht-builder' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default'=>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .htbuildercounter i' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_control(
                'icon_size',
                [
                    'label' => __( 'Font Size', 'ht-builder' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 16,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuildercounter i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_space',
                [
                    'label' => __( 'Space', 'ht-builder' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px', '%' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 200,
                            'step' => 1,
                        ],
                        '%' => [
                            'min' => 0,
                            'max' => 100,
                        ],
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 2,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuildercounter i' => 'margin-right: {{SIZE}}{{UNIT}};',
                        '{{WRAPPER}} .htbuildercounter span.htviewtxt' => 'margin-right: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $button_text = '';

        if( $settings['additional_text_type'] == 'icon' ){
            $button_text = '<i class="'.$settings['icon'].'"></i>';
        }elseif( $settings['additional_text_type'] == 'text' ){
            $button_text = '<span class="htviewtxt">'.$settings['additional_txt'].'</span>';
        }else{
            $button_text = '<span class="htviewtxt">'.__( 'View', 'ht-builder' ).'</span>';
        }

        if( Elementor::instance()->editor->is_edit_mode() ){
            echo '<h6 class="htviewcounter">'.__( 'View Counter', 'ht-builder' ).'</h6>';
        }else{
            echo '<div class="htbuildercounter">'.$button_text.'<span>'.htbuilder_getpostviews( get_the_ID(), $settings['counter_type'] ).'</span></div>';
        }

    }

}
