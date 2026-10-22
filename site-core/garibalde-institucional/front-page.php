<?php
get_header();
$ga_home_slides = array(
 array('id'=>'HOME-01','title'=>'Advocacia com visão estratégica.','description'=>'Experiência jurídica, método e clareza para decisões importantes.','image'=>get_template_directory_uri().'/assets/images/home/HOME-01.webp'),
 array('id'=>'HOME-02','title'=>'Conhecimento jurídico que aproxima.','description'=>'Informação responsável para compreender cenários, direitos e caminhos possíveis.','image'=>get_template_directory_uri().'/assets/images/home/HOME-02.webp'),
 array('id'=>'HOME-03','title'=>'Atendimento digital pelo canal certo.','description'=>'Inicie seu contato pela Central Digital do Cliente, de forma organizada e segura.','image'=>get_template_directory_uri().'/assets/images/home/HOME-03.webp'),
);
$ga_home_json = wp_json_encode($ga_home_slides, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
$ga_areas = function_exists('ga_core_areas_catalog') ? ga_core_areas_catalog() : array();
?>
<section class="ga-hero ga-hero--carousel" id="ga-hero" data-ga-carousel data-ga-home data-ga-slides="<?php echo esc_attr($ga_home_json); ?>" data-ga-interval="7000">
 <div class="ga-hero-media" aria-hidden="true">
  <?php foreach($ga_home_slides as $i=>$slide): $file=get_template_directory().'/assets/images/home/'.basename($slide['image']); $has_image=is_file($file); ?>
   <?php if($has_image): ?><img class="ga-hero-media-slide<?php echo $i===0?' is-active':''; ?>" src="<?php echo esc_url($slide['image']); ?>" alt="" loading="<?php echo $i===0?'eager':'lazy'; ?>" decoding="async" data-ga-slide="<?php echo (int)$i; ?>"><?php endif; ?>
  <?php endforeach; ?>
 </div>
 <div class="ga-container ga-hero-content">
  <span class="ga-eyebrow">Garibalde Amaral Advogados Associados</span>
  <h1 data-ga-title><?php echo esc_html($ga_home_slides[0]['title']); ?></h1>
  <p data-ga-description><?php echo esc_html($ga_home_slides[0]['description']); ?></p>
  <div class="ga-hero-actions">
   <a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Acessar Central Digital</a>
   <a class="ga-button ga-button--glass" href="<?php echo esc_url(home_url('/area-de-atuacao/')); ?>">Explorar áreas de atuação</a>
  </div>
 </div>
 <div class="ga-hero-controls" aria-label="Controles do destaque principal">
  <button type="button" data-ga-prev aria-label="Slide anterior">‹</button>
  <button type="button" data-ga-pause aria-pressed="false" aria-label="Pausar transição">Ⅱ</button>
  <span data-ga-count aria-live="polite">1 / <?php echo count($ga_home_slides); ?></span>
  <button type="button" data-ga-next aria-label="Próximo slide">›</button>
 </div>
</section>

<section class="ga-section ga-intro-section">
 <div class="ga-container ga-intro-grid">
  <div><span class="ga-eyebrow">Autoridade serena · Futurismo editorial</span><h2 class="ga-heading">Estratégia jurídica com clareza, critério e visão de conjunto.</h2></div>
  <div class="ga-content"><p>Um ambiente digital para apresentar a atuação do escritório, organizar informação jurídica e facilitar o acesso aos canais institucionais. Cada conteúdo deve informar com responsabilidade, sem promessas de resultado ou generalizações sobre casos concretos.</p><a class="ga-text-link" href="<?php echo esc_url(home_url('/quem-somos/')); ?>">Conheça o escritório <span aria-hidden="true">→</span></a></div>
 </div>
</section>

<section class="ga-section ga-section--white">
 <div class="ga-container">
  <div class="ga-section-heading"><div><span class="ga-eyebrow">Especialidades</span><h2 class="ga-heading">Áreas de atuação</h2><p class="ga-intro">Encontre a área jurídica relacionada ao seu tema e consulte os conteúdos organizados por especialidade.</p></div><a class="ga-text-link" href="<?php echo esc_url(home_url('/area-de-atuacao/')); ?>">Ver todas as áreas <span aria-hidden="true">→</span></a></div>
  <div class="ga-grid ga-area-grid">
   <?php foreach(array_slice($ga_areas,0,6) as $i=>$area): $post=get_page_by_path($area['slug'],OBJECT,'ga_area_atuacao'); $url=$post instanceof WP_Post?get_permalink($post):home_url('/area-de-atuacao/'.$area['slug'].'/'); $image=function_exists('ga_core_area_asset_url')?ga_core_area_asset_url($area['image1']):''; ?>
   <article class="ga-card ga-area-card">
    <?php if($image): ?><a class="ga-area-card-image" href="<?php echo esc_url($url); ?>"><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($area['title']); ?>" loading="lazy" decoding="async"></a><?php endif; ?>
    <span class="ga-area-index"><?php echo esc_html(sprintf('%02d',$i+1)); ?></span>
    <h3><?php echo esc_html($area['title']); ?></h3>
    <p><?php echo esc_html($area['lead']); ?></p>
    <a class="ga-text-link" href="<?php echo esc_url($url); ?>">Explorar especialidade <span aria-hidden="true">→</span></a>
   </article>
   <?php endforeach; ?>
  </div>
  <p class="ga-area-all"><a class="ga-button ga-button--light" href="<?php echo esc_url(home_url('/area-de-atuacao/')); ?>">Consultar as 15 áreas</a></p>
 </div>
</section>

<section class="ga-section">
 <div class="ga-container">
  <div class="ga-section-heading"><div><span class="ga-eyebrow">Radar Jurídico</span><h2 class="ga-heading">Artigos e notícias</h2><p class="ga-intro">Conteúdo recente com data, resumo e separação clara entre notícia de fonte externa e análise do escritório.</p></div><a class="ga-text-link" href="<?php echo esc_url(home_url('/artigos/')); ?>">Ver arquivo completo <span aria-hidden="true">→</span></a></div>
  <div class="ga-posts">
   <?php $q=new WP_Query(array('post_type'=>'post','post_status'=>'publish','posts_per_page'=>3,'ignore_sticky_posts'=>true)); if($q->have_posts()): while($q->have_posts()): $q->the_post(); ?>
   <article class="ga-post-card">
    <?php if(has_post_thumbnail()): ?><a class="ga-post-image" href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium_large',array('loading'=>'lazy','decoding'=>'async')); ?></a><?php endif; ?>
    <p class="ga-meta"><?php echo esc_html(get_the_date()); ?><?php $cats=get_the_category(); if(!empty($cats)){echo ' · '.esc_html($cats[0]->name);} ?></p>
    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
    <p><?php echo esc_html(get_the_excerpt()); ?></p>
    <a class="ga-text-link" href="<?php the_permalink(); ?>">Ler conteúdo <span aria-hidden="true">→</span></a>
   </article>
   <?php endwhile; wp_reset_postdata(); else: ?><p class="ga-empty">Os conteúdos aparecerão aqui após a publicação editorial.</p><?php endif; ?>
  </div>
 </div>
</section>

<section class="ga-section ga-section--dark">
 <div class="ga-container">
  <div class="ga-media-panel">
   <div><span class="ga-eyebrow">Central de Mídia</span><h2 class="ga-heading">Ideias jurídicas em texto, áudio e vídeo.</h2><p>Artigos, notícias, vídeos e materiais informativos em um só caminho editorial.</p><a class="ga-button ga-button--light" href="<?php echo esc_url(home_url('/central-de-midia/')); ?>">Acessar Central de Mídia</a></div>
   <div class="ga-media-orbit" aria-hidden="true"><span></span><span></span><span></span><strong>GA</strong></div>
  </div>
 </div>
</section>

<section class="ga-section">
 <div class="ga-container"><div class="ga-banner"><div><span class="ga-eyebrow">Atendimento digital</span><h2 class="ga-heading">Comece pelo canal certo.</h2><p>Para atendimento geral, utilize a Central Digital do Cliente. A Consulta Processual permanece exclusiva para consulta de processos.</p></div><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Abrir Central Digital</a></div></div>
</section>
<?php get_footer(); ?>
