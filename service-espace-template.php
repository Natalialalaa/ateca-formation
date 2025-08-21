<?php
/**
 * Template Name: Service – Espace de travail
 * Template Post Type: service
 */
get_header();
?>
<main id="main" class="main">

  <div class="service-section">
    <div class="services-header">
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('hero-wide', ['class'=>'services-header__image', 'alt'=>esc_attr(get_the_title())]); ?>
      <?php else: ?>
        <img class="services-header__image"
             src="<?php echo esc_url( get_theme_file_uri('/assets/img/service_2.png') ); ?>"
             alt="<?php the_title_attribute(); ?>">
      <?php endif; ?>
      <h1 class="services-header__title"><?php the_title(); ?></h1>
    </div>

    <p class="services-header__description">
      Profitez d’un espace de travail confortable, équipé et modulable, idéal pour vous concentrer, organiser vos projets ou accueillir vos réunions.
      Un lieu pensé pour favoriser la productivité dans une ambiance sereine et conviviale.
    </p>
  </div>

  <div class="service-content">
    <!-- GALLERY -->
    <section class="image-grid">
      <div class="grid-item large">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/image-66.png') ); ?>" alt="Office wide view">
      </div>
      <div class="grid-item small">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/image-67.png') ); ?>" alt="Meeting">
      </div>
      <div class="grid-item small">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/image-68.png') ); ?>" alt="Hands writing">
      </div>
      <div class="grid-item portrait">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/image-69.png') ); ?>" alt="Coworking space portrait">
      </div>
      <div class="grid-item landscape">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/image-70.png') ); ?>" alt="Top-down meeting">
      </div>
    </section>

    <!-- HOURS -->
    <section class="horaire">
      <h3 class="horaire__title">Horaires d'ouverture</h3>
      <p class="horaire__description">Nous sommes ouverts du lundi au vendredi, avec des horaires adaptés pour vous accueillir au mieux. *</p>

      <div class="horaire__content">
        <div class="horaire__item"><h2 class="horaire__title">Lundi</h2><p class="horaire__time">12H - 14H30</p></div>
        <div class="horaire__item"><h2 class="horaire__title">Mardi</h2><p class="horaire__time">12H - 14H30  |  19H - 22H</p></div>
        <div class="horaire__item"><h2 class="horaire__title">Mercredi</h2><p class="horaire__time">12H - 14H30  |  19H - 22H</p></div>
        <div class="horaire__item"><h2 class="horaire__title">Jeudi</h2><p class="horaire__time">12H - 14H30  |  19H - 22H</p></div>
        <div class="horaire__item"><h2 class="horaire__title">Vendredi</h2><p class="horaire__time">12H - 14H30</p></div>
        <div class="horaire__item"><h2 class="horaire__title">Samedi</h2><p class="horaire__time">Fermé</p></div>
        <div class="horaire__item"><h2 class="horaire__title">Dimanche</h2><p class="horaire__time">Fermé</p></div>
      </div>

      <p class="horaire__note">*Les horaires peuvent varier en fonction des disponibilités et des réservations. Réservation J-7 recommandée.</p>
    </section>

    <!-- MAP -->
    <section class="map">
      <h3 class="map__title">Où nous trouver ?</h3>
      <p class="map__description">Nous sommes situés à Rinxent, dans la Zone de la Maie, un espace facilement accessible et propice à la concentration.</p>

      <div class="map__container">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2521.1775229094!2d1.731275471141285!3d50.80934952618261!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47dc30f30a35b581%3A0xf94ec4060bfa19a5!2sZone%20de%20la%20Maie%2C%202%20Rue%20de%20Bruxelles%2C%2062720%20Rinxent!5e0!3m2!1sen!2sfr!4v1751908825930!5m2!1sen!2sfr"
          width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
          referrerpolicy="no-referrer-when-downgrade"></iframe>

        <div class="direction">
          <h3 class="adresse__title">Direction</h3>
          <p class="direction__text">Accessible en voiture, à 10 minutes de Boulogne-sur-Mer. Parking disponible sur place.</p>

          <div class="direction__transport">
            <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/bus.svg') ); ?>" alt="Bus" width="32" height="32">
            <p id="TER-vert">TER</p>
            <p>Depuis Marquise - Rinxent Gare : 10 minutes en vélo ou 5 minutes en voiture.</p>
          </div>

          <div class="direction__transport">
            <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/manwalk.svg') ); ?>" alt="À pied" width="32" height="32">
            <p>Depuis Stade Louis Guerlet : 10 minutes à pied.</p>
          </div>

          <a class="go-button"
             href="https://www.google.com/maps/dir/?api=1&destination=1+Rue+Jules+Ferry,+62250+Marquise"
             target="_blank" rel="noopener">J’y vais !</a>

          <h3 class="adresse__title">Adresse</h3>
          <p class="adresse__text">ATECA FORMATION, 1 rue Jules Ferry, 62250 Marquise</p>
        </div>
      </div>
    </section>
  </div>

</main>
<?php get_footer(); ?>
