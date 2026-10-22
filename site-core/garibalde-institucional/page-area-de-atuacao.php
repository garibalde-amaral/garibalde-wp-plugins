<?php
/* Template Name: Garibalde — Hub de Áreas de Atuação */
get_header();
$catalog = function_exists('ga_core_areas_catalog') ? ga_core_areas_catalog() : array();
$hub_assets = array(
 array('id'=>'AA-01','file'=>'AA-01.webp','title'=>'Atuação jurídica com visão de conjunto'),
 array('id'=>'AA-02','file'=>'AA-02.webp','title'=>'Análise, método e responsabilidade'),
 array('id'=>'AA-03','file'=>'AA-03.webp','title'=>'Acesso claro a cada especialidade'),
 array('id'=>'AA-04','file'=>'AA-04.webp','title'=>'Tecnologia a serviço da informação'),
);
$slides = array();
foreach($hub_assets as $asset){$url=function_exists('ga_core_primary_page_asset_url')?ga_core_primary_page_asset_url($asset['file']):'';if($url){$slides[]=array_merge($asset,array('url'=>$url));}}
?>
<?php if(!empty($slides)): ?>
<section class="ga-hero ga-hero--image" data-ga-carousel data-ga-interval="7000">
 <div class="ga-hero-media" aria-hidden="true"><?php foreach($slides as $i=>$slide): ?><img class="ga-hero-media-slide<?php echo $i===0?' is-active':''; ?>" src="<?php echo esc_url($slide['url']); ?>" alt="" loading="<?php echo $i===0?'eager':'lazy'; ?>" data-ga-slide="<?php echo (int)$i; ?>"><?php endforeach; ?></div>
 <div class="ga-container ga-hero-content"><span class="ga-eyebrow">Áreas de atuação</span><h1>Conhecimento jurídico, organizado por especialidade.</h1><p>Explore as áreas de atuação do escritório e encontre informação geral sobre cada tema.</p><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Central Digital do Cliente</a></div>
 <div class="ga-hero-controls" aria-label="Controles do destaque"><button type="button" data-ga-prev aria-label="Slide anterior">‹</button><button type="button" data-ga-pause aria-pressed="false" aria-label="Pausar transição">Ⅱ</button><span data-ga-count aria-live="polite">1 / <?php echo count($slides); ?></span><button type="button" data-ga-next aria-label="Próximo slide">›</button></div>
</section>
<?php endif; ?>
<section class="ga-section"><div class="ga-container"><span class="ga-eyebrow">Especialidades</span><h2 class="ga-heading">Encontre a área relacionada à sua necessidade</h2><p class="ga-intro">Cada página foi organizada para apresentar o escopo geral da especialidade, os temas mais comuns e o caminho correto para o atendimento. A avaliação de uma situação concreta depende de documentos, fatos, prazos e regras aplicáveis.</p>
<div class="ga-grid ga-area-grid">
<?php foreach($catalog as $area):
 $post=get_page_by_path($area['slug'],OBJECT,'ga_area_atuacao');
 $url=$post instanceof WP_Post?get_permalink($post):home_url('/area-de-atuacao/'.$area['slug'].'/');
 $image=ga_core_area_asset_url($area['image1']);
?>
<article class="ga-card ga-area-card">
<?php if($image): ?><a class="ga-area-card-image" href="<?php echo esc_url($url); ?>"><img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($area['title']); ?>" loading="lazy" decoding="async"></a><?php endif; ?>
<span class="ga-area-index"><?php echo esc_html(sprintf('%02d',array_search($area,$catalog,true)+1)); ?></span>
<h2><?php echo esc_html($area['title']); ?></h2><p><?php echo esc_html($area['lead']); ?></p><a class="ga-text-link" href="<?php echo esc_url($url); ?>">Explorar especialidade <span aria-hidden="true">→</span></a>
</article>
<?php endforeach; ?>
</div></div></section>
<section class="ga-section ga-section--white"><div class="ga-container"><div class="ga-banner"><div><span class="ga-eyebrow">Atendimento geral</span><h2 class="ga-heading">Comece pelo canal certo</h2><p>Para falar com a equipe, acessar orientações de atendimento ou encaminhar sua solicitação, utilize a Central Digital do Cliente. A Consulta Processual é exclusiva para consulta de processos.</p></div><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Abrir Central Digital</a></div></div></section>
<?php get_footer(); ?>
