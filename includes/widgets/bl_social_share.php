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
use Elementor\Repeater;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bl_Social_Share_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-social-share';
    }

    public function get_title() {
        return __( 'BL: Social Share', 'ht-builder' );
    }

    public function get_icon() {
        return 'htbuilder-icon eicon-social-icons';
    }

    public function get_categories() {
        return ['ht_builder'];
    }

    public function get_script_depends() {
        return [
            'goodshare',
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'social_media_sheres',
            [
                'label' => __( 'Social Shere', 'ht-builder' ),
            ]
        );
        
            $repeater = new Repeater();

            $repeater->start_controls_tabs('social_content_area_tabs');

                $repeater->start_controls_tab(
                    'social_content_tab',
                    [
                        'label' => __( 'Content', 'ht-builder' ),
                    ]
                );

                    $repeater->add_control(
                        'htbuilder_social_media',
                        [
                            'label' => __( 'Social Media', 'ht-builder' ),
                            'type' => Controls_Manager::SELECT,
                            'default' => 'facebook',
                            'options' => [
                                'vkontakte'       => __( 'Vkontakte', 'ht-builder' ),
                                'facebook'        => __( 'Facebook', 'ht-builder' ),
                                'odnoklassniki'   => __( 'Odnoklassniki', 'ht-builder' ),
                                'moimir'          => __( 'MoiMir', 'ht-builder' ),
                                'linkedin'        => __( 'LinkedIn', 'ht-builder' ),
                                'tumblr'          => __( 'Tumblr', 'ht-builder' ),
                                'pinterest'       => __( 'Pinterest', 'ht-builder' ),
                                'reddit'          => __( 'Reddit', 'ht-builder' ),
                                'buffer'          => __( 'Buffer', 'ht-builder' ),
                                'twitter'         => __( 'Twitter', 'ht-builder' ),
                                'livejournal'     => __( 'LiveJournal', 'ht-builder' ),
                                'evernote'        => __( 'Evernote', 'ht-builder' ),
                                'delicious'       => __( 'Delicious', 'ht-builder' ),
                                'flipboard'       => __( 'Flipboard', 'ht-builder' ),
                                'pocket'          => __( 'Pocket', 'ht-builder' ),
                                'mix'             => __( 'Mix', 'ht-builder' ),
                                'meneame'         => __( 'Meneame', 'ht-builder' ),
                                'blogger'         => __( 'Blogger', 'ht-builder' ),
                                'instapaper'      => __( 'Instapaper', 'ht-builder' ),
                                'digg'            => __( 'Digg', 'ht-builder' ),
                                'liveinternet'    => __( 'LiveInternet', 'ht-builder' ),
                                'surfingbird'     => __( 'Surfingbird', 'ht-builder' ),
                                'xing'            => __( 'Xing', 'ht-builder' ),
                                'wordpress'       => __( 'WordPress', 'ht-builder' ),
                                'baidu'           => __( 'Baidu', 'ht-builder' ),
                                'renren'          => __( 'RenRen', 'ht-builder' ),
                                'weibo'           => __( 'Weibo', 'ht-builder' ),
                                'sms'             => __( 'SMS', 'ht-builder' ),
                                'skype'           => __( 'Skype', 'ht-builder' ),
                                'telegram'        => __( 'Telegram', 'ht-builder' ),
                                'viber'           => __( 'Viber', 'ht-builder' ),
                                'whatsapp'        => __( 'WhatsApp', 'ht-builder' ),
                                'wechat'          => __( 'WhatsApp', 'ht-builder' ),
                                'line'            => __( 'Line', 'ht-builder' ),
                            ],
                        ]
                    );

                    $repeater->add_control(
                        'htbuilder_social_title',
                        [
                            'label'   => esc_html__( 'Title', 'ht-builder' ),
                            'type'    => Controls_Manager::TEXT,
                            'default' => esc_html__( 'Facebook', 'ht-builder' ),
                        ]
                    );

                    $repeater->add_control(
                        'htbuilder_social_icon',
                        [
                            'label'   => esc_html__( 'Icon', 'ht-builder' ),
                            'type'    => Controls_Manager::ICON,
                            'default' => 'fa fa-facebook',
                        ]
                    );

                $repeater->end_controls_tab(); // Content tab end

                $repeater->start_controls_tab(
                    'social_rep_style',
                    [
                        'label' => __( 'Style', 'ht-builder' ),
                    ]
                );

                    $repeater->add_control(
                        'normal_style_heading',
                        [
                            'label' => __( 'Normal Style', 'ht-builder' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );

                    $repeater->add_control(
                        'social_text_color',
                        [
                            'label'     => __( 'Color', 'ht-builder' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_background',
                            'label' => __( 'Background', 'ht-builder' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_border',
                            'label' => __( 'Border', 'ht-builder' ),
                            'selector' => '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}',
                        ]
                    );

                    $repeater->add_control(
                        'hover_style_heading',
                        [
                            'label' => __( 'Hover Style', 'ht-builder' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );


                    $repeater->add_control(
                        'social_text_hover_color',
                        [
                            'label'     => __( 'Hover color', 'ht-builder' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_hover_background',
                            'label' => __( 'Background', 'ht-builder' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}:hover',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_hover_border',
                            'label' => __( 'Border', 'ht-builder' ),
                            'selector' => '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}:hover',
                        ]
                    );

                $repeater->end_controls_tab();// End Style tab

                // Start Icon tab
                $repeater->start_controls_tab(
                    'social_rep_icon_style',
                    [
                        'label' => __( 'Icon Style', 'ht-builder' ),
                    ]
                );
                    
                    $repeater->add_control(
                        'normal_style_icon_heading',
                        [
                            'label' => __( 'Normal Style', 'ht-builder' ),
                            'type' => Controls_Manager::HEADING,
                            'separator' => 'before',
                        ]
                    );

                    $repeater->add_control(
                        'social_icon_color',
                        [
                            'label'     => __( 'Color', 'ht-builder' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_icon_background',
                            'label' => __( 'Background', 'ht-builder' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}} i',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_icon_border',
                            'label' => __( 'Border', 'ht-builder' ),
                            'selector' => '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}} i',
                        ]
                    );

                    $repeater->add_responsive_control(
                        'social_rep_icon_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'ht-builder' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}} i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                            'separator'=>'after',
                        ]
                    );

                    $repeater->add_control(
                        'hover_style_icon_heading',
                        [
                            'label' => __( 'Hover Style', 'ht-builder' ),
                            'type' => Controls_Manager::HEADING,
                        ]
                    );


                    $repeater->add_control(
                        'social_icon_hover_color',
                        [
                            'label'     => __( 'Hover color', 'ht-builder' ),
                            'type'      => Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}:hover i' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'social_rep_icon_hover_background',
                            'label' => __( 'Background', 'ht-builder' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}:hover i',
                        ]
                    );

                    $repeater->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'social_rep_icon_hover_border',
                            'label' => __( 'Border', 'ht-builder' ),
                            'selector' => '{{WRAPPER}} .htbuilder-social-share {{CURRENT_ITEM}}:hover i',
                        ]
                    );

                $repeater->end_controls_tab();// End icon Style tab

            $repeater->end_controls_tabs();// Repeater Tabs end

            $this->add_control(
                'htbuilder_socialmedia_list',
                [
                    'type'    => Controls_Manager::REPEATER,
                    'fields'  => array_values( $repeater->get_controls() ),
                    'default' => [
                        [
                            'htbuilder_social_media' => 'facebook',
                            'htbuilder_social_title' => __( 'Facebook', 'ht-builder' ),
                            'htbuilder_social_icon' => 'fa fa-facebook',
                        ],
                        [
                            'htbuilder_social_media' => 'twitter',
                            'htbuilder_social_title' => __( 'Twitter', 'ht-builder' ),
                            'htbuilder_social_icon' => 'fa fa-twitter',
                        ],
                        [
                            'htbuilder_social_media' => 'linkedin',
                            'htbuilder_social_title' => __( 'Linkedin', 'ht-builder' ),
                            'htbuilder_social_icon' => 'fa fa-linkedin',
                        ],
                    ],
                    'title_field' => '{{{ htbuilder_social_title }}}',
                ]
            );

        $this->end_controls_section();

        // Advance Options
        $this->start_controls_section(
            'social_media_sheres_advance_opt',
            [
                'label' => __( 'Advance Options', 'ht-builder' ),
            ]
        );
            
            $this->add_control(
                'social_view',
                [
                    'label' => esc_html__( 'View', 'ht-builder' ),
                    'type' => Controls_Manager::SELECT,
                    'label_block' => false,
                    'options' => [
                        'icon'       => 'Icon',
                        'title'      => 'Title',
                        'icon-title' => 'Icon & Title',
                    ],
                    'default'      => 'icon',
                ]
            );

            $this->add_control(
                'show_label',
                [
                    'label'        => esc_html__( 'Title', 'ht-builder' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'ht-builder' ),
                    'label_off'    => esc_html__( 'Hide', 'ht-builder' ),
                    'return_value' => 'yes',
                    'default'      => 'yes',
                    'condition'    => [
                        'social_view' => 'icon-text',
                    ],
                ]
            );

            $this->add_control(
                'show_counter',
                [
                    'label'        => esc_html__( 'Count', 'ht-builder' ),
                    'type'         => Controls_Manager::SWITCHER,
                    'label_on'     => esc_html__( 'Show', 'ht-builder' ),
                    'label_off'    => esc_html__( 'Hide', 'ht-builder' ),
                    'return_value' => 'yes',
                    'condition'    => [
                        'social_view!' => 'icon',
                    ],
                ]
            );

        $this->end_controls_section();// End Advance Options

        // Style tab section
        $this->start_controls_section(
            'htbuilder_socialshere_style_section',
            [
                'label' => __( 'Style', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'social_shere_color',
                [
                    'label'     => __( 'color', 'ht-builder' ),
                    'type'      => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-social-share ul li' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'scheme' => Scheme_Typography::TYPOGRAPHY_1,
                    'selector' => '{{WRAPPER}} .htbuilder-social-share ul li span',
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'social_shere_background',
                    'label' => __( 'Background', 'ht-builder' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htbuilder-social-share li',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'social_shere_border',
                    'label' => __( 'Border', 'ht-builder' ),
                    'selector' => '{{WRAPPER}} .htbuilder-social-share li',
                ]
            );

            $this->add_responsive_control(
                'social_shere_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-social-share li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_responsive_control(
                'social_shere_padding',
                [
                    'label' => __( 'Padding', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-social-share ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'social_shere_margin',
                [
                    'label' => __( 'Margin', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-social-share ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section();

        $this->start_controls_section(
            'socialshere_icon_style_section',
            [
                'label' => __( 'Icon', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'social_view' => array( 'icon-title','icon'),
                ]
            ]
        );
            $this->add_control(
                'icon_fontsize',
                [
                    'label' => __( 'Icon Font Size', 'ht-builder' ),
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
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-social-share ul li i' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'social_icon_background',
                    'label' => __( 'Background', 'ht-builder' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .htbuilder-social-share li i',
                ]
            );

            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name' => 'social_icon_border',
                    'label' => __( 'Border', 'ht-builder' ),
                    'selector' => '{{WRAPPER}} .htbuilder-social-share li i',
                ]
            );

            $this->add_responsive_control(
                'social_icon_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-social-share li i' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                    ],
                ]
            );

            $this->add_control(
                'icon_height',
                [
                    'label' => __( 'Icon Height', 'ht-builder' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 42,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-social-share ul li i' => 'height: {{SIZE}}{{UNIT}};line-height: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'icon_width',
                [
                    'label' => __( 'Icon Width', 'ht-builder' ),
                    'type' => Controls_Manager::SLIDER,
                    'size_units' => [ 'px' ],
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 100,
                            'step' => 1,
                        ]
                    ],
                    'default' => [
                        'unit' => 'px',
                        'size' => 42,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .htbuilder-social-share ul li i' => 'width: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();
    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();

        $this->add_render_attribute( 'htbuilder_socialshere', 'class', 'htbuilder-social-share' );
        if( $settings['social_view'] == 'icon-title' || $settings['social_view'] == 'title' ){
            $this->add_render_attribute( 'htbuilder_socialshere', 'class', 'htbuilder-social-view-'.$settings['social_view'] );
        }
             
        ?>
            <div <?php echo $this->get_render_attribute_string( 'htbuilder_socialshere' ); ?> >
                <ul>
                    <?php foreach ( $settings['htbuilder_socialmedia_list'] as $socialmedia ) :?>
                        <li class="elementor-repeater-item-<?php echo $socialmedia['_id']; ?>" data-social="<?php echo esc_attr( $socialmedia['htbuilder_social_media'] ); ?>" > 
                            <?php
                                if( $settings['social_view'] == 'icon' ){
                                    echo sprintf('<i class="%1$s"></i>', $socialmedia['htbuilder_social_icon'] );
                                }elseif( $settings['social_view'] == 'title' ){
                                    echo sprintf('<span>%1$s</span>', $socialmedia['htbuilder_social_title'] );
                                }else{
                                    echo sprintf('<i class="%1$s"></i><span>%2$s</span>', $socialmedia['htbuilder_social_icon'], $socialmedia['htbuilder_social_title'] );
                                }
                                if( $settings['show_counter'] == 'yes' ){
                                    echo '<span class="htbuilder-share-counter" data-counter="'.$socialmedia['htbuilder_social_media'].'"></span>';
                                }
                            ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php

    }

    

}