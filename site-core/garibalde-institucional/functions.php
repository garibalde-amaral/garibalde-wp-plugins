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
