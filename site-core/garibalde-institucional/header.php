<!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<a class="ga-skip" href="#ga-main">Pular para o conteúdo</a>
<div class="ga-topline"><div class="ga-container"><span>Garibalde Amaral Advogados Associados</span><span>Anápolis · Goiás</span></div></div>
<header class="ga-header"><div class="ga-container ga-brand-row">
<a class="ga-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="<?php echo esc_attr(get_bloginfo('name')); ?>"><?php if(has_custom_logo()){the_custom_logo();}else{?><span class="ga-brand-text"><?php bloginfo('name'); ?><small>ADVOGADOS ASSOCIADOS</small></span><?php } ?></a>
<div class="ga-header-actions"><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Central Digital do Cliente</a><a class="ga-button ga-button--light" href="https://wa.me/5562991340228" rel="noopener noreferrer">WhatsApp</a></div>
</div><nav class="ga-primary-nav" id="ga-primary-nav" aria-label="Navegação principal"><div class="ga-container"><button class="ga-menu-toggle" type="button" aria-expanded="false" aria-controls="ga-primary-menu">Menu ☰</button><?php if(has_nav_menu('primary')){wp_nav_menu(array('theme_location'=>'primary','container'=>false,'menu_id'=>'ga-primary-menu','fallback_cb'=>false));}else{ga_core_menu_fallback();} ?></div></nav></header>
<main id="ga-main">
