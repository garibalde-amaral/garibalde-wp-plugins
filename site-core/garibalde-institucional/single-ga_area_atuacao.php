<?php
get_header();
while ( have_posts() ) : the_post();
$images = function_exists('ga_core_get_area_images') ? ga_core_get_area_images(get_the_ID()) : array();
$available = array_values(array_filter($images, function($item){ return ! empty($item['url']); }));
?>
<article <?php post_class('ga-practice-page'); ?>>
 <?php if ( ! empty($available) ) : ?>
 <section class="ga-hero ga-hero--carousel" data-ga-carousel data-ga-interval="7000">
  <div class="ga-hero-media" aria-hidden="true">
   <?php foreach ( $available as $i => $item ) : ?>
    <img class="ga-hero-media-slide<?php echo 0 === $i ? ' is-active' : ''; ?>"
      src="<?php echo esc_url($item['url']); ?>"
      alt=""
      loading="<?php echo 0 === $i ? 'eager' : 'lazy'; ?>"
      decoding="async"
      data-ga-slide="<?php echo (int)$i; ?>">
   <?php endforeach; ?>
  </div>
  <div class="ga-container ga-hero-content">
   <a class="ga-back-link" href="<?php echo esc_url(home_url('/area-de-atuacao/')); ?>">← Todas as áreas</a>
   <span class="ga-eyebrow">Área de atuação</span>
   <h1><?php the_title(); ?></h1>
   <?php if ( has_excerpt() ) : ?><p><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
   <a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Central Digital do Cliente</a>
  </div>
  <?php if ( count($available) > 1 ) : ?>
  <div class="ga-hero-controls" aria-label="Controles das imagens da área">
   <button type="button" data-ga-prev aria-label="Imagem anterior">‹</button>
   <button type="button" data-ga-pause aria-pressed="false" aria-label="Pausar transição">Ⅱ</button>
   <span data-ga-count aria-live="polite">1 / <?php echo count($available); ?></span>
   <button type="button" data-ga-next aria-label="Próxima imagem">›</button>
  </div>
  <?php endif; ?>
 </section>
 <?php else : ?>
 <section class="ga-hero ga-hero--text-only">
  <div class="ga-container ga-hero-content">
   <a class="ga-back-link" href="<?php echo esc_url(home_url('/area-de-atuacao/')); ?>">← Todas as áreas</a>
   <span class="ga-eyebrow">Área de atuação</span>
   <h1><?php the_title(); ?></h1>
   <?php if ( has_excerpt() ) : ?><p><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
   <a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Central Digital do Cliente</a>
  </div>
 </section>
 <?php if ( current_user_can('manage_options') ) : ?>
 <div class="ga-container"><p class="ga-admin-note">As fotografias-mestras desta especialidade ainda não estão disponíveis com os nomes canônicos do catálogo. O tema procurará automaticamente esses arquivos na pasta de mídia e na biblioteca do WordPress; não substitui imagens ausentes por imagens aleatórias.</p></div>
 <?php endif; ?>
 <?php endif; ?>

 <section class="ga-section">
  <div class="ga-container ga-content">
   <div class="ga-practice-copy"><?php the_content(); ?></div>
   <aside class="ga-practice-cta">
    <span class="ga-eyebrow">Atendimento</span>
    <h2 class="ga-heading">Precisa tratar de uma situação concreta?</h2>
    <p>O conteúdo desta página é informativo. A avaliação jurídica individual exige análise dos fatos e documentos relevantes.</p>
    <a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Iniciar atendimento digital</a>
   </aside>
  </div>
 </section>
</article>
<?php
endwhile;
get_footer();
