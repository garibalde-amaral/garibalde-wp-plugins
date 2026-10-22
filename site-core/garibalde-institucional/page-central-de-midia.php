<?php get_header(); ?>
<section class="ga-hero"><div class="ga-container"><span class="ga-eyebrow">Central de Mídia</span><h1>Conteúdo jurídico em diferentes formatos.</h1><p>Artigos, notícias e vídeos institucionais, com fontes identificadas e conteúdo sujeito à revisão editorial.</p><p><a class="ga-button" href="<?php echo esc_url(home_url('/central-digital-do-cliente/')); ?>">Falar com a equipe</a></p></div></section>
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
