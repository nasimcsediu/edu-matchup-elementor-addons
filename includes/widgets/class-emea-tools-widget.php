<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Tools_Widget extends Base_Widget {
	public function get_name() { return 'emea-study-tools'; }
	public function get_title() { return __( 'EduMatchup Study Tools', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-tools'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'A GOOD PLACE TO START' ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "Make space for\nyour next move." ) );
		$this->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "You don’t need all the answers yet.\nThese tools can help you get started." ) );
		$r = new Repeater();
		$r->add_control( 'text', array( 'label' => __( 'Link Text', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Explore study pathways' ) );
		$r->add_control( 'link', array( 'label' => __( 'Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/programmes/' ) ) );
		$this->add_control( 'items', array( 'label' => __( 'Tool Links (add as many as needed)', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::REPEATER, 'fields' => $r->get_controls(), 'title_field' => '{{{ text }}}', 'default' => array(
			array( 'text' => 'Explore study pathways', 'link' => array( 'url' => '/programmes/' ) ),
			array( 'text' => 'Build your study budget', 'link' => array( 'url' => '/budget-planner/' ) ),
			array( 'text' => 'Prepare your checklist', 'link' => array( 'url' => '/application-checklist/' ) ),
		) ) );
		$this->end_controls_section();
		$this->start_controls_section( 'style', array( 'label' => __( 'Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'columns', array( 'label' => __( 'Columns', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SELECT, 'options' => array( 1 => '1', 2 => '2' ), 'desktop_default' => 2, 'mobile_default' => 1, 'selectors' => array( '{{WRAPPER}} .emea-tools' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));' ) ) );
		$this->add_responsive_control( 'column_gap', array( 'label' => __( 'Column Gap', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SLIDER, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .emea-tools' => 'column-gap: {{SIZE}}{{UNIT}};' ) ) );
		$this->register_heading_style( '.emea-section-heading', 'Heading' );
		$this->register_text_style( '.emea-tools__description', 'Description' );
		$this->register_text_style( '.emea-eyebrow', 'Eyebrow' );
		$this->register_text_style( '.emea-tool-link', 'Link' );
		$this->add_control( 'link_border_color', array( 'label' => __( 'Link Divider Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-tool-link' => 'border-color: {{VALUE}};' ) ) );
		$this->end_controls_section();
		$this->register_common_section_style_controls( false );
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = isset( $s['items'] ) && is_array( $s['items'] ) ? $s['items'] : array();
		?>
		<section class="emea-section emea-tools"><div class="emea-tools__intro"><?php if ( ! empty( $s['eyebrow'] ) ) : ?><p class="emea-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></p><?php endif; ?><h2 class="emea-section-heading"><?php echo wp_kses( nl2br( esc_html( $s['heading'] ) ), array( 'br' => array() ) ); ?></h2><p class="emea-tools__description"><?php echo wp_kses( nl2br( esc_html( $s['description'] ) ), array( 'br' => array() ) ); ?></p></div><div class="emea-tools__links"><?php foreach ( $items as $item ) : ?><a class="emea-tool-link" href="<?php echo esc_url( ! empty( $item['link']['url'] ) ? $item['link']['url'] : '#' ); ?>"<?php echo ! empty( $item['link']['is_external'] ) ? ' target="_blank"' : ''; ?>><?php echo esc_html( $item['text'] ); ?><span>↗</span></a><?php endforeach; ?></div></section>
		<?php
	}
}
