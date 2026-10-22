<?php
get_header();
while ( have_posts() ) :
 the_post();
 $page_slug = get_post_field('post_name', get_the_ID());
 $all_slides = function_exists('ga_core_primary_page_slides') ? ga_core_primary_page_slides($page_slug) : array();
 $slides = array_values(array_filter($all_slides, function($slide){ return ! empty($slide['url']); }));
 $slide_data = array_map(function($slide){ return array('id'=>$slide['id'],'title'=>$slide['title'],'description'=>$slide['description'],'image'=>$slide['url']); }, $slides);
 $is_hub = in_array($page_slug,array('area-de-atuacao','areas-de-atuacao'),true);
?>
<article <?php post_class('ga-institutional-page'); ?>>
 <?php if ( ! empty($slides) ) : ?>
 <section class="ga-hero ga-hero--carousel" data-ga-carousel data-ga-interval="7000" data-ga-slides="<?php echo esc_attr(wp_json_encode($slide_data,JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES)); ?>">
  <div class="ga-hero-media" aria-hidden="true">
   <?php foreach($slides as $i=>$slide): ?>
   <img class="ga-hero-media-slide<?php echo $i===0?' is-active':''; ?>" src="<?php echo esc_url($slide['url']); ?>" alt="" loading="<?php echo $i===0?'eager':'lazy'; ?>" decoding="async" data-ga-slide="<?php echo (int)$i; ?>">
   <?php endforeach; ?>
  </div>
  <div class="ga-container ga-hero-content">
   <span class="ga-eyebrow"><?php echo esc_html($is_hub?'Especialidades jurídicas':'Garibalde Amaral Advogados Associados'); ?></span>
   <h1 data-ga-title><?php echo esc_html($slides[0]['title']); ?></h1>
   <p data-ga-description><?php echo esc_html($slides[0]['description']); ?></p>
   <?php if(!$is_hub): ?><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Central Digital do Cliente</a><?php endif; ?>
  </div>
  <div class="ga-hero-controls" aria-label="Controles da apresentação">
   <button type="button" data-ga-prev aria-label="Slide anterior">‹</button>
   <button type="button" data-ga-pause aria-pressed="false" aria-label="Pausar transição">Ⅱ</button>
   <span data-ga-count aria-live="polite">1 / <?php echo count($slides); ?></span>
   <button type="button" data-ga-next aria-label="Próximo slide">›</button>
  </div>
 </section>
 <?php else : ?>
 <section class="ga-hero ga-hero--text-only">
  <div class="ga-container ga-hero-content">
   <span class="ga-eyebrow"><?php echo esc_html($is_hub?'Especialidades jurídicas':'Garibalde Amaral Advogados Associados'); ?></span>
   <h1><?php the_title(); ?></h1>
   <?php if(has_excerpt()): ?><p><?php echo esc_html(get_the_excerpt()); ?></p><?php endif; ?>
   <?php if(!$is_hub): ?><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Central Digital do Cliente</a><?php endif; ?>
  </div>
 </section>
 <?php if ( current_user_can('manage_options') && ! empty($all_slides) ) : ?>
 <div class="ga-container"><p class="ga-admin-note">As fotografias-mestras desta página ainda não estão disponíveis na pasta do tema nem na biblioteca de mídia com os nomes canônicos. O tema procura os arquivos automaticamente; não usa imagens genéricas no lugar.</p></div>
 <?php endif; ?>
 <?php endif; ?>

 <section class="ga-section">
  <div class="ga-container ga-content">
   <?php if ( $is_hub ) : ?>
    <div class="ga-editorial-content"><?php the_content(); ?></div>
    <?php
    if ( function_exists('ga_core_areas_catalog') ) {
      $areas = ga_core_areas_catalog();
      echo '<div class="ga-grid ga-area-grid">';
      foreach($areas as $i=>$area) {
        $area_post = get_page_by_path($area['slug'], OBJECT, 'ga_area_atuacao');
        $url = $area_post instanceof WP_Post ? get_permalink($area_post) : home_url('/area-de-atuacao/'.$area['slug'].'/');
        $image = function_exists('ga_core_area_asset_url') ? ga_core_area_asset_url($area['image1']) : '';
        echo '<article class="ga-card ga-area-card">';
        if($image){echo '<a class="ga-area-card-image" href="'.esc_url($url).'"><img src="'.esc_url($image).'" alt="'.esc_attr($area['title']).'" loading="lazy" decoding="async"></a>';}
        echo '<span class="ga-area-index">'.esc_html(sprintf('%02d',$i+1)).'</span>';
        echo '<h2>'.esc_html($area['title']).'</h2>';
        echo '<p>'.esc_html($area['lead']).'</p>';
        echo '<a class="ga-text-link" href="'.esc_url($url).'">Explorar especialidade <span aria-hidden="true">→</span></a>';
        echo '</article>';
      }
      echo '</div>';
    }
    ?>
   <?php else : ?>
    <div class="ga-editorial-content"><?php the_content(); ?></div>
   <?php endif; ?>
  </div>
 </section>
 <?php if(!$is_hub): ?>
 <section class="ga-section ga-section--white"><div class="ga-container"><div class="ga-banner"><div><span class="ga-eyebrow">Atendimento digital</span><h2 class="ga-heading">Comece pelo canal certo.</h2><p>Para atendimento geral, utilize a Central Digital do Cliente. A Consulta Processual é exclusiva para consulta de processos.</p></div><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Abrir Central Digital</a></div></div></section>
 <?php endif; ?>
</article>
<?php endwhile; get_footer(); ?>
