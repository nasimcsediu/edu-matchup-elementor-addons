<?php
namespace EduMatchup\ElementorAddons\Widgets;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) { exit; }

class Page_Intro_Widget extends Base_Widget {
	public function get_name() { return 'emea-page-intro'; }
	public function get_title() { return __( 'EduMatchup Page Intro', 'edumatchup-elementor-addons' ); }
	public function get_icon() { return 'eicon-post-title'; }

	protected function register_controls() {
		$this->start_controls_section( 'content', array( 'label' => __( 'Page Intro Content', 'edumatchup-elementor-addons' ) ) );
		$this->add_control( 'eyebrow', array( 'label' => __( 'Eyebrow', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'FIND YOUR PLACE' ) );
		$this->add_control( 'heading', array( 'label' => __( 'Heading', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXT, 'default' => 'A world worth exploring.' ) );
		$this->add_control( 'description', array( 'label' => __( 'Description', 'edumatchup-elementor-addons' ), 'type' => Controls_Manager::TEXTAREA, 'default' => 'Start with your ambitions, then find the country and course that fit. Explore our destination guides or narrow the view below.' ) );
		$this->end_controls_section();

		$this->start_controls_section( 'style', array( 'label' => __( 'Style', 'edumatchup-elementor-addons' ), 'tab' => Controls_Manager::TAB_STYLE ) );
		$this->add_responsive_control( 'alignment', array(
			'label' => __( 'Alignment', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::CHOOSE,
			'options' => array(
				'left' => array( 'title' => __( 'Left', 'edumatchup-elementor-addons' ), 'icon' => 'eicon-text-align-left' ),
				'center' => array( 'title' => __( 'Center', 'edumatchup-elementor-addons' ), 'icon' => 'eicon-text-align-center' ),
				'right' => array( 'title' => __( 'Right', 'edumatchup-elementor-addons' ), 'icon' => 'eicon-text-align-right' ),
			),
			'default' => 'left',
			'selectors' => array( '{{WRAPPER}} .emea-page-intro' => 'text-align: {{VALUE}};' ),
		) );
		$this->register_heading_style( '.emea-page-intro__heading', 'Heading' );
		$this->register_text_style( '.emea-page-intro__eyebrow', 'Eyebrow' );
		$this->register_text_style( '.emea-page-intro__description', 'Description' );
		$this->add_control( 'background', array(
			'label' => __( 'Background Color', 'edumatchup-elementor-addons' ),
			'type' => Controls_Manager::COLOR,
			'selectors' => array( '{{WRAPPER}} .emea-page-intro' => 'background-color: {{VALUE}};' ),
		) );
		$this->end_controls_section();
		$this->register_common_section_style_controls( false );
	}

	protected function render() {
		$s = $this->get_settings_for_display();
		?>
		<section class="emea-section emea-page-intro"><div class="emea-wrap">
			<?php if ( ! empty( $s['eyebrow'] ) ) : ?><p class="emea-eyebrow emea-page-intro__eyebrow"><?php echo esc_html( $s['eyebrow'] ); ?></p><?php endif; ?>
			<h1 class="emea-page-intro__heading"><?php echo esc_html( $s['heading'] ); ?></h1>
			<?php if ( ! empty( $s['description'] ) ) : ?><p class="emea-page-intro__description"><?php echo esc_html( $s['description'] ); ?></p><?php endif; ?>
		</div></section>
		<?php
	}
}
