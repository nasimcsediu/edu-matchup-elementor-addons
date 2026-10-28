<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Arrival_Widget extends Base_Widget {
	public function get_name() { return 'emea-arrival-support'; }
	public function get_title() { return __( 'EduMatchup Arrival Support', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-call-to-action'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'AFTER YOU LAND' ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "A new country.\nA helping hand." ) );
		$this->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Airport pickup in selected destinations. In Europe, support with enrolment, finding a place to live and your job search.' ) );
		$this->add_control( 'button_text', array( 'label' => __( 'Button Text', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Explore arrival support ↗' ) );
		$this->add_control( 'button_link', array( 'label' => __( 'Button Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/arrival-support/' ) ) );
		$this->add_control( 'note', array( 'label' => __( 'Small Note', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Availability and service scope vary by destination.' ) );
		$this->end_controls_section();
		$this->start_controls_section( 'style', array( 'label' => __( 'Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'layout', array( 'label' => __( 'Layout', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SELECT, 'options' => array( 'row' => __( 'Side by side', 'edumatchup-elementor-addons' ), 'column' => __( 'Stacked', 'edumatchup-elementor-addons' ) ), 'default' => 'row', 'selectors' => array( '{{WRAPPER}} .emea-arrival' => 'flex-direction: {{VALUE}};' ) ) );
		$this->register_heading_style( '.emea-arrival__heading', 'Heading' );
		$this->register_text_style( '.emea-arrival__description', 'Description' );
		$this->register_text_style( '.emea-arrival__note', 'Note' );
		$this->register_button_style( '.emea-button--primary' );
		$this->add_control( 'card_background', array( 'label' => __( 'Background', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-arrival' => 'background-color: {{VALUE}};' ) ) );
		$this->add_control( 'border_color', array( 'label' => __( 'Border Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-arrival' => 'border-color: {{VALUE}};' ) ) );
		$this->add_responsive_control( 'card_padding', array( 'label' => __( 'Padding', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .emea-arrival' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();
		$this->register_common_section_style_controls( false );
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<section class="emea-section emea-arrival"><div class="emea-arrival__copy"><?php if ( ! empty( $s['eyebrow'] ) ) : ?><p class="emea-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></p><?php endif; ?><h2 class="emea-arrival__heading"><?php echo wp_kses( nl2br( esc_html( $s['heading'] ) ), array( 'br' => array() ) ); ?></h2><p class="emea-arrival__description"><?php echo esc_html( $s['description'] ); ?></p></div><div class="emea-arrival__action"><?php $this->render_link( $s['button_link'], $s['button_text'], 'emea-button emea-button--primary' ); ?><p class="emea-arrival__note"><?php echo esc_html( $s['note'] ); ?></p></div></section>
		<?php
	}
}
