<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Destinations_Widget extends Base_Widget {
	public function get_name() { return 'emea-destinations'; }
	public function get_title() { return __( 'EduMatchup Destinations', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-posts-grid'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Section Content', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'DESTINATIONS' ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Where do you see yourself?' ) );
		$this->add_control( 'top_link_text', array( 'label' => __( 'Top Link Text', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'View all destinations ↗' ) );
		$this->add_control( 'top_link', array( 'label' => __( 'Top Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/destinations/' ) ) );
		$r = new Repeater();
		$r->add_control( 'code', array( 'label' => __( 'Country Code', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'HU' ) );
		$r->add_control( 'name', array( 'label' => __( 'Country Name', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Hungary' ) );
		$r->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Explore English-taught study options and build a clear application plan around your academic background.' ) );
		$r->add_control( 'link_text', array( 'label' => __( 'Link Text', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Explore destination' ) );
		$r->add_control( 'link', array( 'label' => __( 'Destination Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/study-hungary/' ) ) );
		$this->add_control( 'items', array( 'label' => __( 'Destinations (add as many as needed)', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::REPEATER, 'fields' => $r->get_controls(), 'title_field' => '{{{ name }}}', 'default' => $this->default_items() ) );
		$this->end_controls_section();
		$this->start_controls_section( 'style', array( 'label' => __( 'Grid & Card Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'columns', array( 'label' => __( 'Columns', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SELECT, 'options' => array( 1 => '1', 2 => '2', 3 => '3', 4 => '4' ), 'desktop_default' => 3, 'tablet_default' => 2, 'mobile_default' => 1, 'selectors' => array( '{{WRAPPER}} .emea-destinations__grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));' ) ) );
		$this->add_responsive_control( 'gap', array( 'label' => __( 'Card Gap', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SLIDER, 'size_units' => array( 'px', 'em' ), 'range' => array( 'px' => array( 'min' => 0, 'max' => 80 ) ), 'selectors' => array( '{{WRAPPER}} .emea-destinations__grid' => 'gap: {{SIZE}}{{UNIT}};' ) ) );
		$this->register_heading_style( '.emea-section-heading', 'Heading' );
		$this->register_heading_style( '.emea-destination__name', 'Card Title' );
		$this->register_text_style( '.emea-destination__description', 'Card Description' );
		$this->add_control( 'card_background', array( 'label' => __( 'Card Background', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-destination' => 'background-color: {{VALUE}};' ) ) );
		$this->add_control( 'card_border_color', array( 'label' => __( 'Card Border Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-destination' => 'border-color: {{VALUE}};' ) ) );
		$this->add_control( 'card_radius', array( 'label' => __( 'Card Radius', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SLIDER, 'size_units' => array( 'px', '%' ), 'selectors' => array( '{{WRAPPER}} .emea-destination' => 'border-radius: {{SIZE}}{{UNIT}};' ) ) );
		$this->add_responsive_control( 'card_padding', array( 'label' => __( 'Card Padding', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::DIMENSIONS, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .emea-destination__copy' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};' ) ) );
		$this->end_controls_section();
		$this->register_common_section_style_controls( true );
	}

	private function default_items() {
		$items = array(
			array( 'code' => 'HU', 'name' => 'Hungary', 'description' => 'Explore English-taught study options and build a clear application plan around your academic background.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-hungary/' ) ),
			array( 'code' => 'DE', 'name' => 'Germany', 'description' => 'Explore study routes in Germany with a focus on course fit, language requirements and a realistic budget.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-germany/' ) ),
			array( 'code' => 'EU', 'name' => 'EU & Schengen', 'description' => 'Compare study destinations across the European Union and Schengen area, with country-specific planning from the start.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-europe/' ) ),
			array( 'code' => 'US', 'name' => 'United States', 'description' => 'Build a thoughtful shortlist of US universities based on your subject, academic profile and total cost.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-usa/' ) ),
			array( 'code' => 'CA', 'name' => 'Canada', 'description' => 'Explore Canadian study options with careful attention to the institution, programme and long-term goals.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-canada/' ) ),
			array( 'code' => 'AU', 'name' => 'Australia', 'description' => 'Discover study options in Australia and prepare a plan that balances academic goals with everyday costs.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-australia/' ) ),
		);
		return array_map( function( $item ) { return array_merge( $item, array( '_id' => uniqid( 'emea', true ) ) ); }, $items );
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = isset( $s['items'] ) && is_array( $s['items'] ) ? $s['items'] : array();
		?>
		<section class="emea-section emea-destinations"><div class="emea-wrap">
			<div class="emea-section-head"><div><?php if ( ! empty( $s['eyebrow'] ) ) : ?><p class="emea-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></p><?php endif; ?><h2 class="emea-section-heading"><?php echo esc_html( $s['heading'] ); ?></h2></div><?php $this->render_link( $s['top_link'], $s['top_link_text'], 'emea-text-link' ); ?></div>
			<div class="emea-destinations__grid"><?php foreach ( $items as $item ) : ?><article class="emea-destination"><div class="emea-destination__top"><span class="emea-destination__badge"><?php echo esc_html( $item['code'] ); ?></span><span class="emea-destination__arrow">↗</span></div><div class="emea-destination__copy"><h3 class="emea-destination__name"><?php echo esc_html( $item['name'] ); ?></h3><p class="emea-destination__description"><?php echo esc_html( $item['description'] ); ?></p><?php $this->render_link( $item['link'], $item['link_text'], 'emea-text-link' ); ?></div></article><?php endforeach; ?></div>
		</div></section>
		<?php
	}
}
