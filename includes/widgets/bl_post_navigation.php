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

class Bl_Post_Navigation_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-post-navigation';
    }

    public function get_title() {
        return __( 'BL: Post Navigation', 'ht-builder' );
    }

    public function get_icon() {
        return 'htbuilder-icon eicon-post-navigation';
    }

    public function get_categories() {
        return ['ht_builder'];
    }

    protected function _register_controls() {

        // Content
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Post Navigation', 'ht-builder' ),
            ]
        );
            
            $this->add_control(
                'show_custom_label',
                [
                    'label' => __( 'Show label', 'ht-builder' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'ht-builder' ),
                    'label_off' => __( 'Hide', 'ht-builder' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'previous_label',
                [
                    'label' => __( 'Previous', 'ht-builder' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Previous', 'ht-builder' ),
                    'placeholder' => __( 'Type your title here', 'ht-builder' ),
                    'condition' => [
                        'show_custom_label' => 'yes'
                    ]
                ]
            );
            
            $this->add_control(
                'next_label',
                [
                    'label' => __( 'Next', 'ht-builder' ),
                    'type' => Controls_Manager::TEXT,
                    'default' => __( 'Next', 'ht-builder' ),
                    'placeholder' => __( 'Type your title here', 'ht-builder' ),
                    'condition' => [
                        'show_custom_label' => 'yes'
                    ]

                ]
            );

            $this->add_control(
                'show_arrow',
                [
                    'label' => __( 'Show Arrow', 'ht-builder' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'ht-builder' ),
                    'label_off' => __( 'Hide', 'ht-builder' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'previous_arrow',
                [
                    'label' => __( 'Previous Arrow', 'ht-builder' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-angle-left',
                    'condition' => [
                        'show_arrow' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'next_arrow',
                [
                    'label' => __( 'Next Arrow', 'ht-builder' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-angle-right',
                    'condition' => [
                        'show_arrow' => 'yes'
                    ]
                ]
            );

            $this->add_control(
                'show_title',
                [
                    'label' => __( 'Show Title', 'ht-builder' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'ht-builder' ),
                    'label_off' => __( 'Hide', 'ht-builder' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'separator'=>'before',
                ]
            );

        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'area_style_section',
            array(
                'label' => __( 'Style', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->add_control(
                'area_margin',
                [
                    'label' => __( 'Margin', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-postnavigation' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'area_padding',
                [
                    'label' => __( 'Padding', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-postnavigation' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'area_border',
                    'label' => __( 'Border', 'ht-builder' ),
                    'selector' => '{{WRAPPER}} .htbuilder-postnavigation',
                ]
            );

        $this->end_controls_section();

        // Label Style
        $this->start_controls_section(
            'label_style_section',
            array(
                'label' => __( 'Label', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->start_controls_tabs( 'label_style_tabs' );
                
                $this->start_controls_tab(
                    'label_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-builder' ),
                    ]
                );
                    $this->add_control(
                        'label_color',
                        [
                            'label' => __( 'Color', 'ht-builder' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#444444',
                            'selectors' => [
                                '{{WRAPPER}} .htcustom-lavel' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'label_typography',
                            'label' => __( 'Typography', 'ht-builder' ),
                            'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                            'selector' => '{{WRAPPER}} .htcustom-lavel',
                        ]
                    );

                $this->end_controls_tab();
                
                // Hover
                $this->start_controls_tab(
                    'label_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ht-builder' ),
                    ]
                );
                    
                    $this->add_control(
                        'label_hover_color',
                        [
                            'label' => __( 'Color', 'ht-builder' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#444444',
                            'selectors' => [
                                '{{WRAPPER}} .htnavigation a:hover .htcustom-lavel' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'title_style_section',
            array(
                'label' => __( 'Title', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->start_controls_tabs( 'title_style_tabs' );
                
                $this->start_controls_tab(
                    'title_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-builder' ),
                    ]
                );
                    $this->add_control(
                        'title_color',
                        [
                            'label' => __( 'Color', 'ht-builder' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#444444',
                            'selectors' => [
                                '{{WRAPPER}} .htnavigation_title' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography',
                            'label' => __( 'Typography', 'ht-builder' ),
                            'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                            'selector' => '{{WRAPPER}} .htnavigation_title',
                        ]
                    );

                $this->end_controls_tab();
                
                // Hover
                $this->start_controls_tab(
                    'title_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ht-builder' ),
                    ]
                );
                    
                    $this->add_control(
                        'title_hover_color',
                        [
                            'label' => __( 'Color', 'ht-builder' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#444444',
                            'selectors' => [
                                '{{WRAPPER}} .htnavigation a:hover .htnavigation_title' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Arrow Style
        $this->start_controls_section(
            'arrow_style_section',
            array(
                'label' => __( 'Arrow', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );
            
            $this->start_controls_tabs( 'arrow_style_tabs' );
                
                $this->start_controls_tab(
                    'arrow_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-builder' ),
                    ]
                );
                    
                    $this->add_control(
                        'arrow_color',
                        [
                            'label' => __( 'Color', 'ht-builder' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#444444',
                            'selectors' => [
                                '{{WRAPPER}} .htnavigation_arrow' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_control(
                        'arrow_size',
                        [
                            'label' => __( 'Font Size', 'plugin-domain' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
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
                                '{{WRAPPER}} .htnavigation_arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'arrow_space',
                        [
                            'label' => __( 'Space', 'plugin-domain' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 12,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htnavigation_arrow' => 'padding-right: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .htnext .htnavigation_arrow' => 'padding-right: 0;padding-left: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                $this->end_controls_tab();
                
                // Hover
                $this->start_controls_tab(
                    'arrow_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ht-builder' ),
                    ]
                );
                    
                    $this->add_control(
                        'arrow_hover_color',
                        [
                            'label' => __( 'Color', 'ht-builder' ),
                            'type' => Controls_Manager::COLOR,
                            'scheme' => [
                                'type' => Scheme_Color::get_type(),
                                'value' => Scheme_Color::COLOR_1,
                            ],
                            'default' => '#444444',
                            'selectors' => [
                                '{{WRAPPER}} .htnavigation a:hover .htnavigation_arrow' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();

        //Custom Label
        $prev_custom_lavel = $next_custom_lavel = '';
        if( $settings['show_custom_label'] == 'yes' ){
            $prev_custom_lavel = '<span class="htcustom-lavel">'.$settings['previous_label'].'</span>';
            $next_custom_lavel = '<span class="htcustom-lavel">'.$settings['next_label'].'</span>';
        }

        // Title
        $prev_title = $next_title = '';
        if( $settings['show_title'] == 'yes' ){
            $prev_title = '<span class="htnavigation_title">%title</span>';
            $next_title = '<span class="htnavigation_title">%title</span>';
        }

        // arrow
        $prev_arrow = $next_arrow = '';
        if( $settings['show_arrow'] == 'yes' ){
            $prev_arrow = '<span class="htnavigation_arrow"><i class="'.$settings['previous_arrow'].'"></i></span>';
            $next_arrow = '<span class="htnavigation_arrow"><i class="'.$settings['next_arrow'].'"></i></span>';
        }

        ?>
            <div class="htbuilder-postnavigation">
                <div class="htnavigation htprev">
                    <?php previous_post_link( '%link', $prev_arrow. '<span class="htnavigation-info">' . $prev_custom_lavel . $prev_title . '</span>' ); ?>
                </div>
                <div class="htnavigation htnext">
                    <?php next_post_link( '%link', '<span class="htnavigation-info">' . $next_custom_lavel . $next_title . '</span>' . $next_arrow ); ?>
                </div>
            </div>
        <?php

    }

}
