<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Services_Widget extends Base_Widget {
	public function get_name() { return 'emea-services'; }
	public function get_title() { return __( 'EduMatchup Services', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-post-list'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Section Content', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'HOW WE HELP' ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => "A little guidance.\nA lot more clarity." ) );
		$this->add_control( 'intro', array( 'label' => __( 'Intro Text', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Start with your goals. We’ll help you understand the options and prepare for what comes next.' ) );
		$this->add_control( 'footer_link_text', array( 'label' => __( 'Bottom Link Text', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Explore all services ↗' ) );
		$this->add_control( 'footer_link', array( 'label' => __( 'Bottom Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/services/' ) ) );
		$r = new Repeater();
		$r->add_control( 'number', array( 'label' => __( 'Number', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => '01' ) );
		$r->add_control( 'title', array( 'label' => __( 'Service Title', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'University admissions' ) );
		$r->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'Find your fit, then build your application.' ) );
		$r->add_control( 'link', array( 'label' => __( 'Link', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::URL, 'default' => array( 'url' => '/admissions/' ) ) );
		$this->add_control( 'items', array( 'label' => __( 'Services (add as many as needed)', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::REPEATER, 'fields' => $r->get_controls(), 'title_field' => '{{{ title }}}', 'default' => array(
			array( 'number' => '01', 'title' => 'University admissions', 'description' => 'Find your fit, then build your application.', 'link' => array( 'url' => '/admissions/' ) ),
			array( 'number' => '02', 'title' => 'Student visa guidance', 'description' => 'Understand your next steps with confidence.', 'link' => array( 'url' => '/visa-support/' ) ),
			array( 'number' => '03', 'title' => 'Study budget planning', 'description' => 'See the whole cost before you commit.', 'link' => array( 'url' => '/financial-planning/' ) ),
			array( 'number' => '04', 'title' => 'Interview preparation', 'description' => 'Tell your story clearly, in your own words.', 'link' => array( 'url' => '/interview-preparation/' ) ),
		) ) );
		$this->end_controls_section();
		$this->start_controls_section( 'style', array( 'label' => __( 'List Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'columns', array( 'label' => __( 'Columns', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SELECT, 'options' => array( 1 => '1', 2 => '2' ), 'desktop_default' => 2, 'mobile_default' => 1, 'selectors' => array( '{{WRAPPER}} .emea-services__grid' => 'grid-template-columns: repeat({{VALUE}}, minmax(0, 1fr));' ) ) );
		$this->add_responsive_control( 'column_gap', array( 'label' => __( 'Column Gap', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::SLIDER, 'size_units' => array( 'px', 'em' ), 'selectors' => array( '{{WRAPPER}} .emea-services__grid' => 'column-gap: {{SIZE}}{{UNIT}};' ) ) );
		$this->register_heading_style( '.emea-section-heading', 'Heading' );
		$this->register_heading_style( '.emea-service__title', 'Service Title' );
		$this->register_text_style( '.emea-service__description', 'Service Description' );
		$this->register_text_style( '.emea-eyebrow', 'Eyebrow' );
		$this->end_controls_section();
		$this->register_common_section_style_controls( false );
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		$items = isset( $s['items'] ) && is_array( $s['items'] ) ? $s['items'] : array();
		$heading = nl2br( esc_html( $s['heading'] ) );
		?>
		<section class="emea-section emea-services"><div class="emea-wrap">
			<div class="emea-section-head"><div><?php if ( ! empty( $s['eyebrow'] ) ) : ?><p class="emea-eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></p><?php endif; ?><h2 class="emea-section-heading"><?php echo wp_kses( $heading, array( 'br' => array() ) ); ?></h2></div><?php if ( ! empty( $s['intro'] ) ) : ?><p class="emea-services__intro"><?php echo esc_html( $s['intro'] ); ?></p><?php endif; ?></div>
			<div class="emea-services__grid"><?php foreach ( $items as $item ) : ?><a class="emea-service" href="<?php echo esc_url( ! empty( $item['link']['url'] ) ? $item['link']['url'] : '#' ); ?>"<?php echo ! empty( $item['link']['is_external'] ) ? ' target="_blank"' : ''; ?>><span class="emea-service__number"><?php echo esc_html( $item['number'] ); ?></span><div><h3 class="emea-service__title"><?php echo esc_html( $item['title'] ); ?></h3><p class="emea-service__description"><?php echo esc_html( $item['description'] ); ?></p></div><span class="emea-service__arrow">↗</span></a><?php endforeach; ?></div>
			<?php $this->render_link( $s['footer_link'], $s['footer_link_text'], 'emea-text-link' ); ?>
		</div></section>
		<?php
	}
}
