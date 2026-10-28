<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Process_Widget extends Base_Widget {
	public function get_name() { return 'emea-process'; }
	public function get_title() { return __( 'EduMatchup Process Steps', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-number-field'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Content', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'YOUR JOURNEY, SIMPLIFIED' ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'One step at a time.' ) );
		$r = new Repeater();
		$r->add_control( 'number', array( 'label' => __( 'Number', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => '01' ) );
		$r->add_control( 'title', array( 'label' => __( 'Step Title', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Tell us your plans' ) );
		$r->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Start with your education, interests and ambitions.' ) );
		$this->add_control( 'items', array( 'label' => __( 'Steps (add as many as needed)', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::REPEATER, 'fields' => $r->get_controls(), 'title_field' => '{{{ title }}}', 'default' => array(
			array( 'number' => '01', 'title' => 'Tell us your plans', 'description' => 'Start with your education, interests and ambitions.' ),
			array( 'number' => '02', 'title' => 'Explore your options', 'description' => 'Compare courses, destinations and your budget.' ),
			array( 'number' => '03', 'title' => 'Prepare together', 'description' => 'Organise applications and the documents you need.' ),
			array( 'number' => '04', 'title' => 'Get ready to go', 'description' => 'Plan your interview, travel and arrival.' ),
		) ) );
		$this->end_controls_section();
		$this->start_controls_section( 'style', array( 'label' => __( 'Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'columns', array( 'label' => __( 'Columns', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SELECT, 'options' => array( 1 => '1', 2 => '2', 3 => '3', 4 => '4' ), 'desktop_default' => 4, 'tablet_default' => 2, 'mobile_default' => 2, 'selectors' => array( '{{WRAPPER}} .emea-process__grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));' ) ) );
		$this->add_responsive_control( 'gap', array( 'label' => __( 'Gap', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SLIDER, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .emea-process__grid' => 'gap: {{SIZE}}{{UNIT}};' ) ) );
		$this->register_heading_style( '.emea-section-heading', 'Heading' );
		$this->register_heading_style( '.emea-process__title', 'Step Title' );
		$this->register_text_style( '.emea-process__description', 'Step Description' );
		$this->register_text_style( '.emea-eyebrow', 'Eyebrow' );
		$this->add_control( 'number_color', array( 'label' => __( 'Number Color', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-process__number' => 'color: {{VALUE}};' ) ) );
		$this->add_control( 'section_tint', array( 'label' => __( 'Section Background', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::COLOR, 'selectors' => array( '{{WRAPPER}} .emea-section' => 'background-color: {{VALUE}};' ) ) );
		$this->end_controls_section();
		$this->register_common_section_style_controls( false );
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = isset( $s['items'] ) && is_array( $s['items'] ) ? $s['items'] : array();
		?>
		<section class="emea-section emea-process"><div class="emea-wrap">
			<?php if ( ! empty( $s['eyebrow'] ) ) : ?><p class="emea-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></p><?php endif; ?><h2 class="emea-section-heading"><?php echo esc_html( $s['heading'] ); ?></h2>
			<div class="emea-process__grid"><?php foreach ( $items as $item ) : ?><article class="emea-process__item"><span class="emea-process__number"><?php echo esc_html( $item['number'] ); ?></span><h3 class="emea-process__title"><?php echo esc_html( $item['title'] ); ?></h3><p class="emea-process__description"><?php echo esc_html( $item['description'] ); ?></p></article><?php endforeach; ?></div>
		</div></section>
		<?php
	}
}
