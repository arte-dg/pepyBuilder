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
use Elementor\Group_Control_Image_Size;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bl_Related_Post_ELement extends Widget_Base {

    public function get_name() {
        return 'bl-related-post';
    }

    public function get_title() {
        return __( 'BL: Related Post', 'ht-builder' );
    }

    public function get_icon() {
        return 'htbuilder-icon eicon-posts-grid';
    }

    public function get_categories() {
        return ['ht_builder'];
    }

    protected function _register_controls() {

        // Content
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Related Post', 'ht-builder' ),
            ]
        );
            
            $this->add_control(
                'number_of_column',
                [
                    'label' => __( 'Column', 'ht-builder' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '2',
                    'options' => [
                        '1'  => __( 'One Column', 'ht-builder' ),
                        '2' => __( 'Two Column', 'ht-builder' ),
                        '3' => __( 'Three Column', 'ht-builder' ),
                        '4' => __( 'Four Column', 'ht-builder' ),
                    ],
                ]
            );

            $this->add_control(
                'numberposts',
                [
                    'label' => __( 'Number Of Post', 'ht-builder' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 50,
                    'step' => 1,
                    'default' => 4,
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

            $this->add_control(
                'show_content',
                [
                    'label' => __( 'Show Content', 'ht-builder' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'ht-builder' ),
                    'label_off' => __( 'Hide', 'ht-builder' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label' => __( 'Show Date', 'ht-builder' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'ht-builder' ),
                    'label_off' => __( 'Hide', 'ht-builder' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_image',
                [
                    'label' => __( 'Show Image', 'ht-builder' ),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __( 'Show', 'ht-builder' ),
                    'label_off' => __( 'Hide', 'ht-builder' ),
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'title_length',
                [
                    'label' => __( 'Title length', 'ht-builder' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 2,
                    'max' => 500,
                    'step' => 1,
                    'default' => 3,
                    'condition'=>[
                        'show_title' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'content_length',
                [
                    'label' => __( 'Content length', 'ht-builder' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 2,
                    'max' => 1000,
                    'step' => 1,
                    'default' => 10,
                    'condition'=>[
                        'show_content' => 'yes',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'imagesize',
                    'default' => 'thumbnail',
                    'separator' => 'none',
                    'condition'=>[
                        'show_image' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section();

        // Title Style
        $this->start_controls_section(
            'title_style_section',
            array(
                'label' => __( 'Title', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'heading_title_style',
                [
                    'label' => __( 'Normal', 'ht-builder' ),
                    'type' => Controls_Manager::HEADING,
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
                    'default'=>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .htrelated-title a' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'title_typography',
                    'label' => __( 'Typography', 'ht-builder' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .htrelated-title a',
                ]
            );

            $this->add_control(
                'title_margin',
                [
                    'label' => __( 'Margin', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htrelated-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'heading_title_hover_style',
                [
                    'label' => __( 'Hover', 'ht-builder' ),
                    'type' => Controls_Manager::HEADING,
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
                    'default'=>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .htrelated-title a:hover' => 'color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

        // Date Style
        $this->start_controls_section(
            'date_style_section',
            array(
                'label' => __( 'Date', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'date_color',
                [
                    'label' => __( 'Color', 'ht-builder' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default'=>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .htrelated-date' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'date_typography',
                    'label' => __( 'Typography', 'ht-builder' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .htrelated-date',
                ]
            );

            $this->add_control(
                'date_margin',
                [
                    'label' => __( 'Margin', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htrelated-date' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

        // Content Style
        $this->start_controls_section(
            'content_style_section',
            array(
                'label' => __( 'Content', 'ht-builder' ),
                'tab' => Controls_Manager::TAB_STYLE,
            )
        );

            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'ht-builder' ),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                        'type' => Scheme_Color::get_type(),
                        'value' => Scheme_Color::COLOR_1,
                    ],
                    'default'=>'#444444',
                    'selectors' => [
                        '{{WRAPPER}} .htcontent' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => __( 'Typography', 'ht-builder' ),
                    'scheme' => Scheme_Typography::TYPOGRAPHY_4,
                    'selector' => '{{WRAPPER}} .htcontent',
                ]
            );

            $this->add_control(
                'content_margin',
                [
                    'label' => __( 'Margin', 'ht-builder' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .htcontent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

        $this->end_controls_section();

    }

    protected function render( $instance = [] ) {
        $settings   = $this->get_settings_for_display();
        global $post;

        $related = get_posts( array( 
            'category__in' => wp_get_post_categories( get_the_ID() ),
            'numberposts' => $settings['numberposts'],
            'post_type' => 'post', 
            'post__not_in' => array( get_the_ID() ) 
        ) );

        if( Elementor::instance()->editor->is_edit_mode() ){
            echo '<h6 class="htrelatedpost">'.__( 'Related Post', 'ht-builder' ).'</h6>';
        }else{
            if( $related ):
                ?>
                <div class="htbuilder-related-post-area htrelated-col-<?php echo $settings['number_of_column']; ?>">
                    <?php
                        foreach( $related as $post ): 
                            setup_postdata( $post );
                            ?>
                            <div class="htbuilder-related-post">
                                <?php if( has_post_thumbnail() && $settings['show_image'] == 'yes' ): ?>
                                    <div class="htbuilder-related-thumb">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php
                                                if( $settings['imagesize_size'] == 'custom' ){
                                                    the_post_thumbnail( array( $settings['imagesize_custom_dimension']['width'], $settings['imagesize_custom_dimension']['height'] ) );
                                                }else{
                                                    the_post_thumbnail( $settings['imagesize_size'] ); 
                                                }
                                            ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <div class="htbuilder-related-content">
                                    <?php if( $settings['show_title'] == 'yes' ): ?>
                                        <h3 class="htrelated-title">
                                            <a href="<?php the_permalink(); ?>"><?php echo wp_trim_words( get_the_title(), $settings['title_length'] ); ?></a>
                                        </h3>
                                    <?php endif; if( $settings['show_date'] == 'yes' ): ?>
                                    <span class="htrelated-date">
                                        <?php echo get_the_time( get_option('date_format') ); ?>
                                    </span>
                                    <?php endif; if( $settings['show_content'] == 'yes' ): ?>
                                        <p class="htcontent">
                                            <?php echo wp_trim_words( get_the_content(), $settings['content_length'] );?>
                                        </p>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                        endforeach;
                    ?>
                </div>
                <?php
            endif;
            wp_reset_postdata();
        }

    }

}
