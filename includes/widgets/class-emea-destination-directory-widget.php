<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Destination_Directory_Widget extends Base_Widget {
	public function get_name() { return 'emea-destination-directory'; }
	public function get_title() { return __( 'EduMatchup Destination Directory', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-posts-grid'; }
	public function get_script_depends() { return array( 'emea-destination-filters' ); }

	protected function register_controls() {
		$this->start_controls_section( 'filters', array( 'label' => __( 'Region Filters', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'filters_help', array( 'type' => Controls_Manager::RAW_HTML, 'raw' => __( 'Each filter value must match the region value assigned to a destination card. Use “all” to include every card.', 'edumatchup-elementor-addons' ), 'content_classes' => 'elementor-panel-alert elementor-panel-alert-info' ) );
		$filter_repeater = new Repeater();
		$filter_repeater->add_control( 'label', array( 'label' => __( 'Filter Label', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Europe' ) );
		$filter_repeater->add_control( 'value', array( 'label' => __( 'Filter Value', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'europe' ) );
		$this->add_control( 'filters_list', array(
			'label' => __( 'Filters (add or remove)', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $filter_repeater->get_controls(),
			'title_field' => '{{{ label }}}',
			'default' => array(
				array( 'label' => 'All destinations', 'value' => 'all' ),
				array( 'label' => 'Europe', 'value' => 'europe' ),
				array( 'label' => 'North America', 'value' => 'north-america' ),
				array( 'label' => 'Australia', 'value' => 'australia' ),
			),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'cards', array( 'label' => __( 'Destination Cards', 'edumatchup-elementor-addons' ) ) );
		$card_repeater = new Repeater();
		$card_repeater->add_control( 'region', array( 'label' => __( 'Region Value', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'europe', 'description' => __( 'Must match one of the filter values above.', 'edumatchup-elementor-addons' ) ) );
		$card_repeater->add_control( 'code', array( 'label' => __( 'Country Code', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'HU' ) );
		$card_repeater->add_control( 'name', array( 'label' => __( 'Country Name', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Hungary' ) );
		$card_repeater->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Explore English-taught study options and build a clear application plan around your academic background.' ) );
		$card_repeater->add_control( 'link_text', array( 'label' => __( 'Link Text', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Explore destination' ) );
		$card_repeater->add_control( 'link', array( 'label' => __( 'Destination Page Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/study-hungary/' ) ) );
		$this->add_control( 'items', array(
			'label' => __( 'Cards (add as many as needed)', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::REPEATER,
			'fields' => $card_repeater->get_controls(),
			'title_field' => '{{{ name }}}',
			'default' => $this->default_cards(),
		) );
		$this->end_controls_section();

		$this->start_controls_section( 'style', array( 'label' => __( 'Directory Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'columns', array(
			'label' => __( 'Card Columns', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::SELECT,
			'options' => array( 1 => '1', 2 => '2', 3 => '3', 4 => '4' ),
			'desktop_default' => 3,
			'tablet_default' => 2,
			'mobile_default' => 1,
			'selectors' => array( '{{WRAPPER}} .emea-destination-directory__grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));' ),
		) );
		$this->add_responsive_control( 'gap', array(
			'label' => __( 'Card Gap', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::SLIDER,
			'size_units' => array( 'px', 'em' ),
			'range' => array( 'px' => array( 'min' => 0, 'max' => 80 ) ),
			'selectors' => array( '{{WRAPPER}} .emea-destination-directory__grid' => 'gap: {{SIZE}}{{UNIT}};' ),
		) );
		$this->register_heading_style( '.emea-destination__name', 'Card Title' );
		$this->register_text_style( '.emea-destination__description', 'Card Description' );
		$this->register_text_style( '.emea-destination-filter', 'Filter Typography' );
		$this->add_control( 'filter_color', array( 'label' => __( 'Filter Text Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-destination-filter' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'filter_active_background', array( 'label' => __( 'Active Filter Background', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-destination-filter[aria-pressed="true"]' => 'background-color: {{VALUE}}; border-color: {{VALUE}};' ) ) );
		$this->add_control( 'filter_active_color', array( 'label' => __( 'Active Filter Text Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-destination-filter[aria-pressed="true"]' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'card_background', array( 'label' => __( 'Card Background', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-destination' => 'background-color: {{VALUE}};' ) ) );
		$this->add_control( 'card_border_color', array( 'label' => __( 'Card Border Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-destination' => 'border-color: {{VALUE}};' ) ) );
		$this->add_control( 'card_radius', array( 'label' => __( 'Card Radius', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SLIDER, 'size_units' => array( 'px', '%' ), 'selectors' => array( '{{WRAPPER}} .emea-destination' => 'border-radius: {{SIZE}}{{UNIT}};' ) ) );
		$this->end_controls_section();
		$this->register_common_section_style_controls( false );
	}

	private function default_cards() {
		$cards = array(
			array( 'region' => 'europe', 'code' => 'HU', 'name' => 'Hungary', 'description' => 'Explore English-taught study options and build a clear application plan around your academic background.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-hungary/' ) ),
			array( 'region' => 'europe', 'code' => 'DE', 'name' => 'Germany', 'description' => 'Explore study routes in Germany with a focus on course fit, language requirements and a realistic budget.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-germany/' ) ),
			array( 'region' => 'europe', 'code' => 'EU', 'name' => 'EU & Schengen', 'description' => 'Compare study destinations across the European Union and Schengen area, with country-specific planning from the start.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-europe/' ) ),
			array( 'region' => 'north-america', 'code' => 'US', 'name' => 'United States', 'description' => 'Build a thoughtful shortlist of US universities based on your subject, academic profile and total cost.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-usa/' ) ),
			array( 'region' => 'north-america', 'code' => 'CA', 'name' => 'Canada', 'description' => 'Explore Canadian study options with careful attention to the institution, programme and long-term goals.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-canada/' ) ),
			array( 'region' => 'australia', 'code' => 'AU', 'name' => 'Australia', 'description' => 'Discover study options in Australia and prepare a plan that balances academic goals with everyday costs.', 'link_text' => 'Explore destination', 'link' => array( 'url' => '/study-australia/' ) ),
		);
		return array_map( function( $card ) { return array_merge( $card, array( '_id' => uniqid( 'emea', true ) ) ); }, $cards );
	}

	private function default_filters() {
		return array(
			array( 'label' => 'All destinations', 'value' => 'all' ),
			array( 'label' => 'Europe', 'value' => 'europe' ),
			array( 'label' => 'North America', 'value' => 'north-america' ),
			array( 'label' => 'Australia', 'value' => 'australia' ),
		);
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$filters = isset( $s['filters_list'] ) && is_array( $s['filters_list'] ) ? $s['filters_list'] : $this->default_filters();
		$items = isset( $s['items'] ) && is_array( $s['items'] ) ? $s['items'] : array();
		$widget_id = 'emea-directory-' . $this->get_id();
		?>
		<section id="<?php echo esc_attr( $widget_id ); ?>" class="emea-section emea-destination-directory"><div class="emea-wrap">
			<div class="emea-destination-directory__filters" role="group" aria-label="<?php esc_attr_e( 'Destination filters', 'edumatchup-elementor-addons' ); ?>">
				<?php foreach ( $filters as $index => $filter ) : $value = sanitize_title( $filter['value'] ); ?><button type="button" class="emea-destination-filter" data-filter="<?php echo esc_attr( $value ); ?>" aria-pressed="<?php echo 0 === $index ? 'true' : 'false'; ?>"><?php echo esc_html( $filter['label'] ); ?></button><?php endforeach; ?>
			</div>
			<div class="emea-destination-directory__grid"><?php foreach ( $items as $item ) : $region = sanitize_title( $item['region'] ); ?><div class="emea-destination-directory__item" data-region="<?php echo esc_attr( $region ); ?>"><article class="emea-destination"><div class="emea-destination__top"><span class="emea-destination__badge"><?php echo esc_html( $item['code'] ); ?></span><span class="emea-destination__arrow">↗</span></div><div class="emea-destination__copy"><h3 class="emea-destination__name"><?php echo esc_html( $item['name'] ); ?></h3><p class="emea-destination__description"><?php echo esc_html( $item['description'] ); ?></p><?php $this->render_link( $item['link'], $item['link_text'], 'emea-text-link' ); ?></div></article></div><?php endforeach; ?></div>
		</div></section>
		<?php
	}
}
