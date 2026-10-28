<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Base_Widget extends Widget_Base {
	public function get_categories() {
		return array( 'edumatchup' );
	}

	public function get_style_depends() {
		return array( 'emea-home-widgets' );
	}

	protected function register_common_section_style_controls( $show_background = true ) {
		$this->start_controls_section( 'section_style', array(
			'label' => __( 'Section Style', 'edumatchup-elementor-addons' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		) );
		$this->add_responsive_control( 'section_width', array(
			'label' => __( 'Content Width', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => array( 'px', '%' ),
			'range' => array( 'px' => array( 'min' => 280, 'max' => 1600 ) ),
			'selectors' => array( '{{WRAPPER}} .emea-wrap, {{WRAPPER}} .emea-arrival, {{WRAPPER}} .emea-cta' => 'max-width: {{SIZE}}{{UNIT}}; width: calc(100% - 48px); margin-left: auto; margin-right: auto;' ),
		) );
		$this->add_responsive_control( 'section_padding', array(
			'label' => __( 'Section Padding', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', '%', 'em' ),
			'selectors' => array( '{{WRAPPER}} .emea-section' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
		) );
		if ( $show_background ) {
			$this->add_control( 'section_background', array(
				'label' => __( 'Background Color', 'edumatchup-elementor-addons' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => array( '{{WRAPPER}} .emea-section' => 'background-color: {{VALUE}};' ),
			) );
		}
		$this->end_controls_section();
	}

	protected function register_heading_style( $selector, $label = 'Heading' ) {
		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), array(
			'name' => 'typography_' . sanitize_title( $label ),
			'label' => __( $label . ' Typography', 'edumatchup-elementor-addons' ),
			'selector' => '{{WRAPPER}} ' . $selector,
		) );
		$this->add_control( 'color_' . sanitize_title( $label ), array(
			'label' => __( $label . ' Color', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} ' . $selector => 'color: {{VALUE}};' ),
		) );
	}

	protected function register_text_style( $selector, $label = 'Text' ) {
		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), array(
			'name' => 'typography_' . sanitize_title( $label ),
			'label' => __( $label . ' Typography', 'edumatchup-elementor-addons' ),
			'selector' => '{{WRAPPER}} ' . $selector,
		) );
		$this->add_control( 'color_' . sanitize_title( $label ), array(
			'label' => __( $label . ' Color', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} ' . $selector => 'color: {{VALUE}};' ),
		) );
	}

	protected function register_button_style( $selector ) {
		$this->add_group_control( \Elementor\Group_Control_Typography::get_type(), array(
			'name' => 'button_typography',
			'label' => __( 'Button Typography', 'edumatchup-elementor-addons' ),
			'selector' => '{{WRAPPER}} ' . $selector,
		) );
		$this->add_control( 'button_text_color', array(
			'label' => __( 'Button Text Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} ' . $selector => 'color: {{VALUE}};' ),
		) );
		$this->add_control( 'button_background', array(
			'label' => __( 'Button Background', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} ' . $selector => 'background-color: {{VALUE}}; border-color: {{VALUE}};' ),
		) );
		$this->add_responsive_control( 'button_padding', array(
			'label' => __( 'Button Padding', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::DIMENSIONS,
			'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} ' . $selector => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ),
		) );
		$this->add_control( 'button_radius', array(
			'label' => __( 'Button Border Radius', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SLIDER,
			'size_units' => array( 'px', '%' ), 'selectors' => array( '{{WRAPPER}} ' . $selector => 'border-radius: {{SIZE}}{{UNIT}};' ),
		) );
	}

	protected function render_link( $link, $text, $class ) {
		if ( empty( $text ) ) {
			return;
		}
		$url = ! empty( $link['url'] ) ? $link['url'] : '#';
		$target = ! empty( $link['is_external'] ) ? ' target="_blank"' : '';
		$nofollow = ! empty( $link['nofollow'] ) ? ' rel="nofollow"' : '';
		echo '<a class="' . esc_attr( $class ) . '" href="' . esc_url( $url ) . '"' . $target . $nofollow . '>' . esc_html( $text ) . '</a>';
	}
}
