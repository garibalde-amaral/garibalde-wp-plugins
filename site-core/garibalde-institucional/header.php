<!doctype html>
<html <?php language_attributes(); ?>>
<head><meta charset="<?php bloginfo('charset'); ?>"><meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"><?php wp_head(); ?></head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<a class="ga-skip" href="#ga-main">Pular para o conteúdo</a>
<div class="ga-topline"><div class="ga-container"><span>Garibalde Amaral Advogados Associados</span><span>Anápolis · Goiás</span></div></div>
<header class="ga-header"><div class="ga-container ga-brand-row">
<a class="ga-brand" href="<?php echo esc_url(home_url('/')); ?>" aria-label="Garibalde Amaral Advogados Associados">
 <img class="ga-brand-emblem" src="<?php echo esc_url(get_template_directory_uri().'/assets/images/logo-oficial.jpg'); ?>" alt="Símbolo oficial Garibalde Amaral">
 <span class="ga-brand-text">GARIBALDE AMARAL<small>ADVOGADOS ASSOCIADOS</small></span>
</a>
<div class="ga-header-actions"><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Central Digital do Cliente</a><a class="ga-button ga-button--light" href="<?php echo esc_url(home_url('/consulta-processual/')); ?>">Consulta Processual</a><a class="ga-button ga-button--light ga-whatsapp-cta" href="https://wa.me/5562991340228" rel="noopener noreferrer">WhatsApp</a></div>
</div><nav class="ga-primary-nav" id="ga-primary-nav" aria-label="Navegação principal"><div class="ga-container"><button class="ga-menu-toggle" type="button" aria-expanded="false" aria-controls="ga-primary-menu">Menu ☰</button><?php ga_core_menu_fallback(); ?></div></nav></header>
<main id="ga-main">
