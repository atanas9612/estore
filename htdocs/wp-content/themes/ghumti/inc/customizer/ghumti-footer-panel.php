<?php
/**
 * Ghumti Footer Settings panel at Theme Customizer
 *
 * @package AquariusThemes
 * @subpackage Ghumti
 * @since 1.0.0
 */

add_action( 'customize_register', 'ghumti_footer_settings_register' );

function ghumti_footer_settings_register( $wp_customize ) {

	/**
     * Add Additional Settings Panel
     *
     * @since 1.0.0
     */
    $wp_customize->add_panel(
	    'ghumti_footer_settings_panel',
	    array(
	        'priority'       => 30,
	        'capability'     => 'edit_theme_options',
	        'theme_supports' => '',
	        'title'          => __( 'Footer Settings', 'ghumti' ),
	    )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Widget Area Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'ghumti_footer_widget_section',
        array(
            'title'		=> esc_html__( 'Widget Area', 'ghumti' ),
            'panel'     => 'ghumti_footer_settings_panel',
            'priority'  => 5,
        )
    );

    /**
     * Switch option for Top Header
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_footer_widget_option',
        array(
            'default' => 'show',
            'sanitize_callback' => 'ghumti_sanitize_switch_option',
            )
    );
    $wp_customize->add_control( new ghumti_Customize_Switch_Control(
        $wp_customize,
            'ghumti_footer_widget_option',
            array(
                'type'      => 'switch',
                'label'     => esc_html__( 'Footer Widget Section', 'ghumti' ),
                'description'   => esc_html__( 'Show/Hide option for footer widget area section.', 'ghumti' ),
                'section'   => 'ghumti_footer_widget_section',
                'choices'   => array(
                    'show'  => esc_html__( 'Show', 'ghumti' ),
                    'hide'  => esc_html__( 'Hide', 'ghumti' )
                    ),
                'priority'  => 5,
            )
        )
    );

    /**
     * Field for Image Radio
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'footer_widget_layout',
        array(
            'default'           => 'column_three',
            'sanitize_callback' => 'sanitize_key',
        )
    );
    $wp_customize->add_control( new ghumti_Customize_Control_Radio_Image(
        $wp_customize,
        'footer_widget_layout',
            array(
                'label'    => esc_html__( 'Footer Widget Layout', 'ghumti' ),
                'description' => esc_html__( 'Choose layout from available layouts', 'ghumti' ),
                'section'  => 'ghumti_footer_widget_section',
                'choices'  => array(
	                    'column_four' => array(
	                        'label' => esc_html__( 'Columns Four', 'ghumti' ),
	                        'url'   => '%s/assets/images/footer-4.png'
	                    ),
	                    'column_three' => array(
	                        'label' => esc_html__( 'Columns Three', 'ghumti' ),
	                        'url'   => '%s/assets/images/footer-3.png'
	                    ),
	                    'column_two' => array(
	                        'label' => esc_html__( 'Columns Two', 'ghumti' ),
	                        'url'   => '%s/assets/images/footer-2.png'
	                    ),
	                    'column_one' => array(
	                        'label' => esc_html__( 'Column One', 'ghumti' ),
	                        'url'   => '%s/assets/images/footer-1.png'
	                    )
	            ),
	            'priority' => 10
            )
        )
    );

/*-----------------------------------------------------------------------------------------------------------------------*/
    /**
	 * Bottom Section
	 *
	 * @since 1.0.0
	 */
	$wp_customize->add_section(
        'ghumti_footer_bottom_section',
        array(
            'title'		=> esc_html__( 'Bottom Section', 'ghumti' ),
            'panel'     => 'ghumti_footer_settings_panel',
            'priority'  => 10,
        )
    );

    /**
     * Text field for copyright
     *
     * @since 1.0.0
     */
    $wp_customize->add_setting(
        'ghumti_copyright_text',
        array(
            'default'    => __( 'ghumti', 'ghumti' ),
            'transport'  => 'postMessage',
            'sanitize_callback' => 'sanitize_text_field'
            )
    );
    $wp_customize->add_control(
        'ghumti_copyright_text',
        array(
            'type'      => 'text',
            'label'     => esc_html__( 'Copyright Text', 'ghumti' ),
            'section'   => 'ghumti_footer_bottom_section',
            'priority'  => 5
        )
    );
    $wp_customize->selective_refresh->add_partial( 
        'ghumti_copyright_text', 
            array(
                'selector' => 'span.ghumti-copyright-text',
                'render_callback' => 'ghumti_customize_partial_copyright',
            )
    );
}