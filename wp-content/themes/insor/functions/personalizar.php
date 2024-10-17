<?php

add_action("widgets_init", "insorWidgetsInit");

function insorWidgetsInit()
{

    register_sidebar(array(
        'name' => __('Footer', 'insor'),
        'id' => 'sidebar-footer',
        'description' => __('Widgets for footer', 'insor'),
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4>',
        'after_title'   => '</h4>',
    ));
}

/**
 * Add support to Theme Customizer
 */
function insor_customize_register($wp_customize)
{
    // Add new section to Customizer
    $wp_customize->add_section('theme_options', array(
        'title'    => __('Logos', 'insor'),
        'priority' => 130, // Before Additional CSS.
    ));

    // Display the form for change the logo on header
    $wp_customize->add_setting('logo', array(
        'transport'   => 'refresh',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo',
            array(
                'label'      => __('Subir imagen del logo ', 'insor'),
                'section'    => 'theme_options'
            )
        )
    );
    // Display the form for change the logo on header
    $wp_customize->add_setting('logo-movil', array(
        'transport'   => 'refresh',
    ));

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'logo-movil',
            array(
                'label'      => __('Subir imagen del logo para movil', 'insor'),
                'section'    => 'theme_options'
            )
        )
    );
}

add_action('customize_register', 'insor_customize_register');
