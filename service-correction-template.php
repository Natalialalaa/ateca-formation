<?php
/**
 * Template Name: Service – Correction & Relecture
 * Template Post Type: service
 */
get_header();
?>
<main id="main" class="main">

  <!-- HERO -->
  <section class="services-header">
    <?php if (has_post_thumbnail()): ?>
      <?php the_post_thumbnail('hero-wide', ['class'=>'services-header__image', 'alt'=>esc_attr(get_the_title())]); ?>
    <?php else: ?>
      <img class="services-header__image"
           src="<?php echo esc_url( get_theme_file_uri('/assets/img/service_1.png') ); ?>"
           alt="<?php the_title_attribute(); ?>">
    <?php endif; ?>

    <h1 class="services-header__title"><?php the_title(); ?></h1>
  </section>

  <p class="services-header__description">
    Des textes sans fautes. Une image irréprochable. Vous en avez assez des erreurs qui échappent à votre relecture ?<br>
    Gagnez en crédibilité grâce à notre service de correction rapide, précise et 100 % humaine.
  </p>

  <!-- PRICING -->
  <section class="pricing-section">
    <div class="pricing-section__top">
      <article class="pricing-card pricing-card--highlighted">
        <h2 class="pricing-card__title">STANDARD</h2>
        <p class="pricing-card__subtitle">FORFAIT RELECTURE</p>
        <p class="pricing-card__details">16 PAGES = 8000 MOTS<br>Document imprimé et relié</p>
        <ul class="pricing-card__list">
          <li>✔ Orthographe/Grammaire</li>
          <li>✔ Ponctuation/Expression</li>
          <li>✔ Style/Cohérence</li>
          <li>✔ Répétition/Construction de phrases</li>
        </ul>
        <div class="pricing-card__price">129€</div>
      </article>
    </div>

    <div class="pricing-section__bottom">
      <article class="pricing-card-wrapper">
        <div class="pricing-card__badge green">✔ bon plan !</div>
        <div class="pricing-card">
          <h2 class="pricing-card__title">ESSENTIEL</h2>
          <p class="pricing-card__subtitle">FORFAIT COURRIER</p>
          <ul class="pricing-card__list">
            <li>✔ Orthographe/Grammaire</li>
            <li>✔ Présentation</li>
            <li>✔ Construction de CV</li>
            <li>✔ Répétition/Construction de phrases</li>
            <li>✔ Lettre de motivations</li>
            <li class="pricing-card__doc">Document imprimé et relié</li>
          </ul>
          <div class="pricing-card__price">24€</div>
        </div>
      </article>

      <article class="pricing-card-wrapper">
        <div class="pricing-card__badge blue">● le plus complet</div>
        <div class="pricing-card">
          <h2 class="pricing-card__title">PREMIUM</h2>
          <p class="pricing-card__subtitle">FORFAIT SAUVEGARDE</p>
          <p class="pricing-card__details">50 PAGES = 25000 MOTS</p>
          <ul class="pricing-card__list">
            <li>✔ Orthographe/Grammaire</li>
            <li>✔ Ponctuation/Expression</li>
            <li>✔ Style/Cohérence</li>
            <li>✔ Répétition/Construction de phrases</li>
            <li>✔ Sauvegarde sur clé USB</li>
            <li class="pricing-card__doc">Document imprimé, relié, et sauvegardé sur clé USB</li>
          </ul>
          <div class="pricing-card__price">159€</div>
        </div>
      </article>
    </div>
  </section>

</main>
<?php get_footer(); ?>
