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

class Bl_Print_Page_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-print-page';
    }

    public function get_title() {
        return __( 'BL: Print Page', 'ht-builder' );
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
                'label' => __( 'Print Page', 'ht-builder' ),
            ]
        );
            
            $this->add_control(
                'button_type',
                [
                    'label' => __( 'Button Type', 'ht-builder' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'icon',
                    'options' => [
                        'icon'      => __( 'Icon', 'ht-builder' ),
                        'text'      => __( 'Text', 'ht-builder' ),
                        'icontext'  => __( 'Icon & Text', 'ht-builder' )
                    ],
                ]
            );
            /*
            $this->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'ht-builder' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-print',
                    'condition' => [
                        'button_type'=>[ 'icon','icontext' ],
                    ]
                ]
            );*/

            $this->add_control(
                'button_txt',
                [
                    'label' => __( 'Button Text', 'ht-builder' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Button Text', 'ht-builder' ),
                    'default' => __( 'Print', 'ht-builder' ),
                    'condition' => [
                        'button_type'=>[ 'text','icontext' ],
                    ]
                ]
            );
            $this->add_control(
            'new_page_title_select_icon',
            [
                'label'       => __( 'Select Icon', 'ht-builder' ),
                'type'        => Controls_Manager::ICONS,
                'render_type' => 'template',
            ]
        );

        $this->add_control(
            'page_title_icon_indent',
            [
                'label'     => __( 'Icon Spacing', 'ht-builder' ),
                'type'      => Controls_Manager::SLIDER,
                'range'     => [
                    'px' => [
                        'max' => 50,
                    ],
                ],
                'condition' => [
                    'new_page_title_select_icon[value]!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .hfe-page-title-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                ],
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
                        '{{WRAPPER}} .htbuilderprint a span' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'text_typography',
                    'label' => __( 'Typography', 'ht-builder' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .htbuilderprint a span',
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
                        '{{WRAPPER}} .htbuilderprint a i' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .htbuilderprint a i' => 'font-size: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .htbuilderprint a span' => 'margin-left: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        $button_text = '';
        if( $settings['button_type'] == 'icon' ){
            $button_text = '<i class="'.$settings['icon'].'"></i>';
        }elseif( $settings['button_type'] == 'text' ){
            $button_text = '<span>'.$settings['button_txt'].'</span>';
        }else{
            $button_text = '<i class="'.$settings['icon'].'"></i> <span>'.$settings['button_txt'].'</span>';
        }
        echo '<div class="htbuilderprint"><a href="javascript:window.print()">'.$button_text.'</a></div>';

    }

}
