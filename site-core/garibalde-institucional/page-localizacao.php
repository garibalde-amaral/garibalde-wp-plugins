<?php
/* Template Name: Garibalde — Localização e Rotas */
get_header();
$slides = function_exists('ga_core_primary_page_slides') ? ga_core_primary_page_slides('localizacao') : array();
$slides = array_values(array_filter($slides, function($slide){ return ! empty($slide['url']); }));
$slide_data = array_map(function($slide){ return array('id'=>$slide['id'],'title'=>$slide['title'],'description'=>$slide['description'],'image'=>$slide['url']); }, $slides);
$address = 'Rua Senador Alfredo Nasser, nº 214, esquina com Av. Goiás, Vila Santana, Anápolis, GO, CEP 75113-640';
$address_query = rawurlencode($address);
$google_maps = 'https://www.google.com/maps/dir/?api=1&destination=' . $address_query;
$waze = 'https://waze.com/ul?q=' . $address_query . '&navigate=yes';
$map_embed = 'https://www.google.com/maps?q=' . $address_query . '&output=embed';
?>
<?php if ( ! empty($slides) ) : ?>
<section class="ga-hero ga-hero--carousel" data-ga-carousel data-ga-interval="7000" data-ga-slides="<?php echo esc_attr(wp_json_encode($slide_data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)); ?>">
 <div class="ga-hero-media" aria-hidden="true">
  <?php foreach($slides as $i=>$slide): ?>
  <img class="ga-hero-media-slide<?php echo $i===0?' is-active':''; ?>" src="<?php echo esc_url($slide['url']); ?>" alt="" loading="<?php echo $i===0?'eager':'lazy'; ?>" decoding="async" data-ga-slide="<?php echo (int)$i; ?>">
  <?php endforeach; ?>
 </div>
 <div class="ga-container ga-hero-content">
  <span class="ga-eyebrow">Localização</span>
  <h1 data-ga-title><?php echo esc_html($slides[0]['title']); ?></h1>
  <p data-ga-description><?php echo esc_html($slides[0]['description']); ?></p>
  <div class="ga-hero-actions"><a class="ga-button" href="<?php echo esc_url($google_maps); ?>" target="_blank" rel="noopener noreferrer">Abrir no Google Maps</a><a class="ga-button ga-button--glass" href="<?php echo esc_url($waze); ?>" target="_blank" rel="noopener noreferrer">Traçar rota no Waze</a></div>
 </div>
 <?php if(count($slides)>1): ?><div class="ga-hero-controls" aria-label="Controles da apresentação"><button type="button" data-ga-prev aria-label="Slide anterior">‹</button><button type="button" data-ga-pause aria-pressed="false" aria-label="Pausar transição">Ⅱ</button><span data-ga-count aria-live="polite">1 / <?php echo count($slides); ?></span><button type="button" data-ga-next aria-label="Próximo slide">›</button></div><?php endif; ?>
</section>
<?php else: ?>
<section class="ga-hero ga-hero--text-only"><div class="ga-container ga-hero-content"><span class="ga-eyebrow">Localização</span><h1>Encontre o escritório.</h1><p>O endereço e a rota usam um serviço cartográfico real. A página não substitui a fachada ou as imagens reais do entorno por cenas inventadas.</p><div class="ga-hero-actions"><a class="ga-button" href="<?php echo esc_url($google_maps); ?>" target="_blank" rel="noopener noreferrer">Abrir no Google Maps</a><a class="ga-button ga-button--glass" href="<?php echo esc_url($waze); ?>" target="_blank" rel="noopener noreferrer">Traçar rota no Waze</a></div></div></section>
<?php endif; ?>
<section class="ga-section">
 <div class="ga-container ga-location-grid">
  <div class="ga-location-map">
   <iframe src="<?php echo esc_url($map_embed); ?>" title="Mapa do endereço do escritório Garibalde Amaral Advogados Associados" width="100%" height="430" style="border:0" loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
   <p class="ga-meta">O mapa é carregado do serviço cartográfico externo; a rota é calculada no aplicativo escolhido.</p>
  </div>
  <aside class="ga-location-card">
   <span class="ga-eyebrow">Endereço institucional</span>
   <h2 class="ga-heading">Garibalde Amaral Advogados Associados</h2>
   <address><?php echo esc_html($address); ?></address>
   <p><a href="mailto:contato@garibaldeadvogados.com.br">contato@garibaldeadvogados.com.br</a></p>
   <p><a href="tel:+5562991340228">(62) 99134-0228</a></p>
   <a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Falar com a equipe</a>
   <p class="ga-meta">Para atendimento geral, use a Central Digital do Cliente. A Consulta Processual continua exclusiva para consulta de processos.</p>
  </aside>
 </div>
</section>
<section class="ga-section ga-section--white"><div class="ga-container ga-content">
<h2 class="ga-heading">Crédito da fotografia</h2>
<p>Quando a vista aérea estiver incluída: Samuel Sousa, “Vista Aérea de Anápolis, 2023”, Wikimedia Commons, licença CC BY-SA 4.0. A versão do site é convertida para WebP. <a href="https://commons.wikimedia.org/wiki/File:Vista_A%C3%A9rea_de_An%C3%A1polis,_2023.jpg" target="_blank" rel="noopener noreferrer">Ver arquivo e autoria</a> · <a href="https://creativecommons.org/licenses/by-sa/4.0/" target="_blank" rel="noopener noreferrer">Ver licença</a>.</p>
</div></section>
<?php get_footer(); ?>
