<?php /* debug */ echo '<!-- using archive-service.php -->'; ?>

<?php
/** Archive: Services — /services/ */
get_header();
?>

<main id="main" class="main">

  <!-- HERO (matches your design) -->
  <div class="services-header">
    <div class="services-header__content">
      <div class="services-header__photo">
        <img
          src="<?php echo esc_url( get_theme_file_uri('/assets/img/woman-typing-laptop-keyboard-1.png') ); ?>"
          alt="ATECA Services"
          class="services-header__image"
        >
      </div>

      <div class="services-header__logos">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-1">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-2">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-3">
      </div>

      <h1 class="services-header__title"><?php post_type_archive_title(); ?></h1>
    </div>

    <p class="services-header__description">
      Un document clé ? Un séminaire à organiser ? Gagnez en impact — Essayez notre service dès aujourd’hui.
    </p>
  </div>

  <!-- CARDS -->
  <section id="formations" class="formations">
    <div class="formations__cards">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <?php get_template_part('template-parts/card', 'service'); ?>
      <?php endwhile; else: ?>
        <p><?php esc_html_e('Aucun service pour le moment.','ateca'); ?></p>
      <?php endif; ?>
    </div>
  </section>

</main>

<?php get_footer(); ?>
