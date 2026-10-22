<?php
/* Template Name: Garibalde — Localização e Rotas */
get_header();
$address = 'Rua Senador Alfredo Nasser, nº 214, esquina com Av. Goiás, Vila Santana, Anápolis, GO, CEP 75113-640';
$address_query = rawurlencode($address);
$google_maps = 'https://www.google.com/maps/dir/?api=1&destination=' . $address_query;
$waze = 'https://waze.com/ul?q=' . $address_query . '&navigate=yes';
$map_embed = 'https://www.google.com/maps?q=' . $address_query . '&output=embed';
?>
<section class="ga-hero ga-hero--text-only">
 <div class="ga-container ga-hero-content">
  <span class="ga-eyebrow">Localização</span>
  <h1>Encontre o escritório.</h1>
  <p>Consulte o endereço institucional e escolha o aplicativo de navegação para traçar sua rota.</p>
  <div class="ga-hero-actions">
   <a class="ga-button" href="<?php echo esc_url($google_maps); ?>" target="_blank" rel="noopener noreferrer">Abrir no Google Maps</a>
   <a class="ga-button ga-button--glass" href="<?php echo esc_url($waze); ?>" target="_blank" rel="noopener noreferrer">Traçar rota no Waze</a>
  </div>
 </div>
</section>
<section class="ga-section">
 <div class="ga-container ga-location-grid">
  <div class="ga-location-map">
   <iframe
    src="<?php echo esc_url($map_embed); ?>"
    title="Mapa do endereço do escritório Garibalde Amaral Advogados Associados"
    width="100%" height="430"
    style="border:0"
    loading="lazy"
    referrerpolicy="no-referrer-when-downgrade"
    allowfullscreen></iframe>
   <p class="ga-meta">O mapa é carregado do serviço cartográfico externo; a rota é calculada no aplicativo escolhido.</p>
  </div>
  <aside class="ga-location-card">
   <span class="ga-eyebrow">Endereço institucional</span>
   <h2 class="ga-heading">Garibalde Amaral Advogados Associados</h2>
   <address><?php echo esc_html($address); ?></address>
   <p><a href="mailto:contato@garibaldeadvogados.com.br">contato@garibaldeadvogados.com.br</a></p>
   <p><a href="tel:+5562991340228">(62) 99134-0228</a></p>
   <a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Falar com a equipe</a>
   <p class="ga-meta">Para atendimento geral, use a Central Digital do Cliente. A Consulta Processual permanece exclusiva para consulta de processos.</p>
  </aside>
 </div>
</section>
<?php get_footer(); ?>
