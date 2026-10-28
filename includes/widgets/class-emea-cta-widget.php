<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Cta_Widget extends Base_Widget {
	public function get_name() { return 'emea-cta'; }
	public function get_title() { return __( 'EduMatchup Call to Action', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-call-to-action'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'LET’S MAKE A PLAN' ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "Your next chapter\nstarts with a conversation." ) );
		$this->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Tell us where you are now. We’ll help you work out what comes next.' ) );
		$this->add_control( 'button_text', array( 'label' => __( 'Button Text', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Plan my next step ↗' ) );
		$this->add_control( 'button_link', array( 'label' => __( 'Button Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/contact/' ) ) );
		$this->end_controls_section();
		$this->start_controls_section( 'style', array( 'label' => __( 'Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->register_heading_style( '.emea-cta__heading', 'Heading' );
		$this->register_text_style( '.emea-cta__description', 'Description' );
		$this->register_text_style( '.emea-eyebrow', 'Eyebrow' );
		$this->register_button_style( '.emea-button--light' );
		$this->add_control( 'card_background', array( 'label' => __( 'Background Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-cta' => 'background-color: {{VALUE}};' ) ) );
		$this->add_control( 'card_border', array( 'label' => __( 'Border Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-cta' => 'border-color: {{VALUE}};' ) ) );
		$this->add_responsive_control( 'card_padding', array( 'label' => __( 'Padding', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .emea-cta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();
		$this->register_common_section_style_controls( false );
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<section class="emea-section emea-cta"><div class="emea-cta__copy"><?php if ( ! empty( $s['eyebrow'] ) ) : ?><p class="emea-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></p><?php endif; ?><h2 class="emea-cta__heading"><?php echo wp_kses( nl2br( esc_html( $s['heading'] ) ), array( 'br' => array() ) ); ?></h2><p class="emea-cta__description"><?php echo esc_html( $s['description'] ); ?></p></div><?php $this->render_link( $s['button_link'], $s['button_text'], 'emea-button emea-button--light' ); ?></section>
		<?php
	}
}
