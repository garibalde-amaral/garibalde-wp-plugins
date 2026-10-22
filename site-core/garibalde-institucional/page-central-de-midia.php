<?php
get_header();
$ga_media_all = function_exists('ga_core_primary_page_slides') ? ga_core_primary_page_slides('central-de-midia') : array();
$ga_media_slides = array_values(array_filter($ga_media_all,function($slide){return !empty($slide['url']);}));
$ga_media_json = wp_json_encode(array_map(function($slide){return array('id'=>$slide['id'],'title'=>$slide['title'],'description'=>$slide['description'],'image'=>$slide['url']);},$ga_media_slides),JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
?>
<?php if(!empty($ga_media_slides)): ?>
<section class="ga-hero ga-hero--carousel" data-ga-carousel data-ga-interval="7000" data-ga-slides="<?php echo esc_attr($ga_media_json); ?>">
 <div class="ga-hero-media" aria-hidden="true">
 <?php foreach($ga_media_slides as $i=>$slide): ?><img class="ga-hero-media-slide<?php echo $i===0?' is-active':''; ?>" src="<?php echo esc_url($slide['url']); ?>" alt="" loading="<?php echo $i===0?'eager':'lazy'; ?>" decoding="async" data-ga-slide="<?php echo (int)$i; ?>"><?php endforeach; ?>
 </div>
 <div class="ga-container ga-hero-content"><span class="ga-eyebrow">Central de Mídia</span><h1 data-ga-title><?php echo esc_html($ga_media_slides[0]['title']); ?></h1><p data-ga-description><?php echo esc_html($ga_media_slides[0]['description']); ?></p><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Falar com a equipe</a></div>
 <div class="ga-hero-controls" aria-label="Controles do destaque da mídia"><button type="button" data-ga-prev aria-label="Slide anterior">‹</button><button type="button" data-ga-pause aria-pressed="false" aria-label="Pausar transição">Ⅱ</button><span data-ga-count aria-live="polite">1 / <?php echo count($ga_media_slides); ?></span><button type="button" data-ga-next aria-label="Próximo slide">›</button></div>
</section>
<?php else: ?>
<section class="ga-hero ga-hero--text-only"><div class="ga-container ga-hero-content"><span class="ga-eyebrow">Central de Mídia</span><h1>Conteúdo jurídico em diferentes formatos.</h1><p>Artigos, notícias e vídeos institucionais, com fontes identificadas e conteúdo sujeito à revisão editorial.</p><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Falar com a equipe</a></div></section>
<?php endif; ?>
<section class="ga-section"><div class="ga-container">
 <span class="ga-eyebrow">Vídeos e entrevistas</span><h2 class="ga-heading">Vídeos</h2>
 <div class="ga-posts">
 <?php
 $videos = new WP_Query(array('post_type'=>'post','post_status'=>'publish','category_name'=>'videos','posts_per_page'=>6,'ignore_sticky_posts'=>true));
 if($videos->have_posts()): while($videos->have_posts()): $videos->the_post(); ?>
 <article class="ga-post-card">
 <?php if(has_post_thumbnail()){echo '<a href="'.esc_url(get_permalink()).'">';the_post_thumbnail('medium');echo '</a>';} ?>
 <p class="ga-meta"><?php echo esc_html(get_the_date()); ?></p><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
 <p><?php echo esc_html(get_the_excerpt()); ?></p><a href="<?php the_permalink(); ?>">Assistir / ler conteúdo</a>
 </article>
 <?php endwhile; wp_reset_postdata(); else: ?>
 <p class="ga-empty">Ainda não há vídeos publicados na categoria “videos”. Adicione vídeos incorporados com título, descrição, fonte e transcrição quando disponível.</p>
 <?php endif; ?>
 </div>
</div></section>
<section class="ga-section ga-section--white"><div class="ga-container">
 <span class="ga-eyebrow">Atualização institucional</span><h2 class="ga-heading">Notícias</h2><div class="ga-posts">
 <?php $news = new WP_Query(array('post_type'=>'post','post_status'=>'publish','category_name'=>'noticias','posts_per_page'=>6,'ignore_sticky_posts'=>true));
 if($news->have_posts()): while($news->have_posts()): $news->the_post(); ?>
 <article class="ga-post-card"><p class="ga-meta"><?php echo esc_html(get_the_date()); ?></p><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo esc_html(get_the_excerpt()); ?></p><a href="<?php the_permalink(); ?>">Ler notícia</a></article>
 <?php endwhile; wp_reset_postdata(); else: ?><p class="ga-empty">Ainda não há notícias publicadas na categoria “noticias”. Identifique a fonte e a data e prefira resumos com link para o original.</p><?php endif; ?>
 </div>
</div></section>
<section class="ga-section"><div class="ga-container">
 <span class="ga-eyebrow">Conteúdo permanente</span><h2 class="ga-heading">Artigos jurídicos</h2><div class="ga-posts">
 <?php $articles = new WP_Query(array('post_type'=>'post','post_status'=>'publish','category_name'=>'artigos','posts_per_page'=>6,'ignore_sticky_posts'=>true));
 if($articles->have_posts()): while($articles->have_posts()): $articles->the_post(); ?>
 <article class="ga-post-card"><p class="ga-meta"><?php echo esc_html(get_the_date()); ?></p><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3><p><?php echo esc_html(get_the_excerpt()); ?></p><a href="<?php the_permalink(); ?>">Ler artigo</a></article>
 <?php endwhile; wp_reset_postdata(); else: ?><p class="ga-empty">Ainda não há artigos publicados na categoria “artigos”. Os textos devem ser revisados antes da publicação.</p><?php endif; ?>
 </div>
</div></section>
<?php get_footer(); ?>
