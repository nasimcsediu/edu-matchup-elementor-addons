<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Hero_Widget extends Base_Widget {
	public function get_name() { return 'emea-hero'; }
	public function get_title() { return __( 'EduMatchup Hero', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-heading'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Hero Content', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'label', array( 'label' => __( 'Label', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Study abroad, with a clear plan' ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "Your next chapter.\nA world of possibilities." ) );
		$this->add_control( 'accent_text', array( 'label' => __( 'Accent line', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'A world of possibilities.' ) );
		$this->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Find the right course, choose your destination and take the next step with guidance built around you.' ) );
		$this->add_control( 'primary_text', array( 'label' => __( 'Primary Button', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Let’s find your fit ↗' ) );
		$this->add_control( 'primary_link', array( 'label' => __( 'Primary Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/contact/' ) ) );
		$this->add_control( 'secondary_text', array( 'label' => __( 'Secondary Button', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Explore destinations' ) );
		$this->add_control( 'secondary_link', array( 'label' => __( 'Secondary Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/destinations/' ) ) );
		$this->add_control( 'footnote', array( 'label' => __( 'Footnote', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'From Bangladesh to Europe, the US, Canada and Australia.' ) );
		$this->end_controls_section();
		$this->start_controls_section( 'style', array( 'label' => __( 'Hero Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'hero_padding', array( 'label' => __( 'Padding', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .emea-hero' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->add_control( 'alignment', array( 'label' => __( 'Alignment', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::CHOOSE, 'options' => array( 'left' => array( 'title' => __( 'Left', 'edumatchup-elementor-addons' ), 'icon' => 'eicon-text-align-left' ), 'center' => array( 'title' => __( 'Center', 'edumatchup-elementor-addons' ), 'icon' => 'eicon-text-align-center' ), 'right' => array( 'title' => __( 'Right', 'edumatchup-elementor-addons' ), 'icon' => 'eicon-text-align-right' ) ), 'default' => 'center', 'selectors' => array( '{{WRAPPER}} .emea-hero' => 'text-align: {{VALUE}};' ) ) );
		$this->register_heading_style( '.emea-hero__title', 'Heading' );
		$this->register_text_style( '.emea-hero__label', 'Label' );
		$this->register_text_style( '.emea-hero__description', 'Description' );
		$this->register_text_style( '.emea-hero__footnote', 'Footnote' );
		$this->register_button_style( '.emea-button--primary' );
		$this->end_controls_section();
		$this->register_common_section_style_controls( true );
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$heading = isset( $s['heading'] ) ? $s['heading'] : '';
		$accent = isset( $s['accent_text'] ) ? $s['accent_text'] : '';
		if ( $accent && false !== strpos( $heading, $accent ) ) {
			$heading = str_replace( $accent, '<span>' . esc_html( $accent ) . '</span>', esc_html( $heading ) );
			$heading = nl2br( $heading );
		} else {
			$heading = nl2br( esc_html( $heading ) );
		}
		?>
		<section class="emea-section emea-hero"><div class="emea-wrap">
			<?php if ( ! empty( $s['label'] ) ) : ?><p class="emea-hero__label"><span class="emea-dot"></span><?php echo esc_html( $s['label'] ); ?></p><?php endif; ?>
			<h1 class="emea-hero__title"><?php echo wp_kses( $heading, array( 'span' => array(), 'br' => array() ) ); ?></h1>
			<?php if ( ! empty( $s['description'] ) ) : ?><p class="emea-hero__description"><?php echo esc_html( $s['description'] ); ?></p><?php endif; ?>
			<div class="emea-hero__actions"><?php $this->render_link( $s['primary_link'], $s['primary_text'], 'emea-button emea-button--primary' ); ?><?php $this->render_link( $s['secondary_link'], $s['secondary_text'], 'emea-button emea-button--secondary' ); ?></div>
			<?php if ( ! empty( $s['footnote'] ) ) : ?><p class="emea-hero__footnote"><?php echo esc_html( $s['footnote'] ); ?></p><?php endif; ?>
		</div></section>
		<?php
	}
}
