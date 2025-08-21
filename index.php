<?php
/** Fallback template */
get_header();
?>
<main id="main" class="main">
  <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
    <article <?php post_class(); ?>>
      <?php the_title('<h1>','</h1>'); ?>
      <?php the_content(); ?>
    </article>
  <?php endwhile; else : ?>
    <p><?php esc_html_e('Aucun contenu trouvé.', 'ateca'); ?></p>
  <?php endif; ?>
</main>
<?php get_footer(); ?>
