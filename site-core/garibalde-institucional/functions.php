<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
require_once get_template_directory() . '/inc/areas.php';
define( 'GA_CORE_THEME_VERSION', '2.0.0' );
function ga_core_setup() {
 load_theme_textdomain( 'ga-core', get_template_directory() . '/languages' );
 add_theme_support( 'title-tag' ); add_theme_support( 'post-thumbnails' );
 add_theme_support( 'responsive-embeds' ); add_theme_support( 'automatic-feed-links' );
 add_theme_support( 'custom-logo', array( 'height'=>150, 'width'=>400, 'flex-height'=>true, 'flex-width'=>true ) );
 add_theme_support( 'html5', array( 'search-form','comment-form','comment-list','gallery','caption','style','script' ) );
 register_nav_menus( array( 'primary' => __( 'Navegação principal', 'ga-core' ) ) );
}
add_action( 'after_setup_theme', 'ga_core_setup' );
function ga_core_assets() { wp_enqueue_style( 'ga-core', get_stylesheet_uri(), array(), GA_CORE_THEME_VERSION ); wp_enqueue_script( 'ga-core', get_template_directory_uri() . '/assets/site.js', array(), GA_CORE_THEME_VERSION, true ); }
add_action( 'wp_enqueue_scripts', 'ga_core_assets' );
function ga_core_menu_fallback() {
 $items=array('Início'=>home_url('/'),'Quem Somos'=>home_url('/quem-somos/'),'Áreas de Atuação'=>home_url('/area-de-atuacao/'),'Equipe'=>home_url('/equipe/'),'Artigos e Notícias'=>home_url('/artigos/'),'Clientes'=>home_url('/clientes/'),'Links Úteis'=>home_url('/links-uteis/'),'Central de Mídia'=>home_url('/central-de-midia/'),'Contato'=>home_url('/contato/'),'Localização'=>home_url('/localizacao/'));
 echo '<ul id="ga-primary-menu">'; foreach($items as $label=>$url){printf('<li><a href="%s">%s</a></li>',esc_url($url),esc_html($label));} echo '</ul>';
}
function ga_core_body_class($classes){$classes[]='ga-core-site';return $classes;} add_filter('body_class','ga_core_body_class');


function ga_core_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'ga_core_identity', array(
        'title' => __( 'Garibalde — Redes institucionais', 'ga-core' ),
        'priority' => 30,
    ) );
    $fields = array(
        'ga_instagram_url' => array( 'URL Instagram institucional', 'url', '' ),
        'ga_youtube_url' => array( 'URL YouTube institucional', 'url', '' ),
        'ga_linkedin_url' => array( 'URL LinkedIn institucional', 'url', '' ),
        'ga_facebook_url' => array( 'URL Facebook institucional', 'url', '' ),
        'ga_tiktok_url' => array( 'URL TikTok institucional', 'url', '' ),
        'ga_x_url' => array( 'URL X institucional', 'url', '' ),
    );
    foreach ( $fields as $id => $item ) {
        $wp_customize->add_setting( $id, array(
            'default' => $item[2],
            'sanitize_callback' => ( 'url' === $item[1] ) ? 'esc_url_raw' : ( 'textarea' === $item[1] ? 'sanitize_textarea_field' : 'sanitize_text_field' ),
            'transport' => 'refresh',
        ) );
        $wp_customize->add_control( $id, array(
            'label' => $item[0],
            'section' => 'ga_core_identity',
            'type' => $item[1],
        ) );
    }
}
add_action( 'customize_register', 'ga_core_customize_register' );
