<?php
if ( ! defined( 'ABSPATH' ) ) { exit; }
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
 $items=array('Início'=>home_url('/'),'Institucional'=>home_url('/quem-somos/'),'Áreas de Atuação'=>home_url('/areas-de-atuacao/'),'Equipe'=>home_url('/equipe/'),'Artigos e Notícias'=>home_url('/artigos/'),'Central de Mídia'=>home_url('/central-de-midia/'),'Central Digital do Cliente'=>home_url('/central-digital-do-cliente/'),'Consulta Processual'=>home_url('/consulta-processual/'),'Contato'=>home_url('/contato/'));
 echo '<ul id="ga-primary-menu">'; foreach($items as $label=>$url){printf('<li><a href="%s">%s</a></li>',esc_url($url),esc_html($label));} echo '</ul>';
}
function ga_core_body_class($classes){$classes[]='ga-core-site';return $classes;} add_filter('body_class','ga_core_body_class');


function ga_core_customize_register( $wp_customize ) {
    $wp_customize->add_section( 'ga_core_identity', array(
        'title' => __( 'Garibalde — Identidade e Destaques', 'ga-core' ),
        'priority' => 30,
    ) );
    $fields = array(
        'ga_slide_1_title' => array( 'Título do destaque 1', 'text', 'Advocacia e Consultoria Empresarial e Tributária' ),
        'ga_slide_1_description' => array( 'Descrição do destaque 1', 'textarea', 'Estratégia jurídica, visão empresarial e informação responsável.' ),
        'ga_slide_1_image' => array( 'Imagem do destaque 1 (URL da biblioteca)', 'url', '' ),
        'ga_slide_2_title' => array( 'Título do destaque 2', 'text', 'Experiência, técnica e atuação institucional' ),
        'ga_slide_2_description' => array( 'Descrição do destaque 2', 'textarea', 'Conteúdo jurídico organizado e canais digitais claros.' ),
        'ga_slide_2_image' => array( 'Imagem do destaque 2 (URL da biblioteca)', 'url', '' ),
        'ga_slide_3_title' => array( 'Título do destaque 3', 'text', 'Atendimento digital com o canal correto' ),
        'ga_slide_3_description' => array( 'Descrição do destaque 3', 'textarea', 'Acesse a Central Digital do Cliente para o atendimento geral.' ),
        'ga_slide_3_image' => array( 'Imagem do destaque 3 (URL da biblioteca)', 'url', '' ),
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
