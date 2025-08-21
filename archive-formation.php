<?php
/* Archive: Formations (HUB) — /formations/ */
get_header();
?>

<main class="main">

  <!-- TYPE 2 HERO -->
  <div class="services-header">
    <div class="services-header__content">
      <div class="services-header__photo">
        <img
          src="<?php echo esc_url( get_theme_file_uri('/assets/img/formations-hero.png') ); ?>"
          alt="ATECA Formations"
          class="services-header__image">
      </div>
      <div class="services-header__logos">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-1">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-2">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-3">
      </div>
      <h1 class="services-header__title">Formations</h1>
    </div>
    <p class="services-header__description">
      Explorez notre catalogue complet de formations accessibles à tous les profils : jeunes en apprentissage, salariés,
      professionnels en reconversion ou en évolution. Chaque parcours est conçu pour favoriser l’autonomie, l’apprentissage
      actif et l’épanouissement professionnel.
    </p>
  </div>

  <div class="formations__content">
    <section id="formations-archive" class="formations">

      <div class="formations-intro__subtitle">
        <h3>Découvrez les 4 types de formations pour accélérer votre parcours !</h3>

        <section class="formations-logos" aria-label="Partenaires et certifications">
          <div class="formations-logos__list">
            <img class="formations-logos__item" src="<?php echo esc_url( get_theme_file_uri('/assets/img/logo-republique-francaise.png') ); ?>" alt="République Française">
            <img class="formations-logos__item" src="<?php echo esc_url( get_theme_file_uri('/assets/img/qualiopi.png') ); ?>" alt="Qualiopi">
            <img class="formations-logos__item" src="<?php echo esc_url( get_theme_file_uri('/assets/img/france-vae.png') ); ?>" alt="France VAE">
            <img class="formations-logos__item" src="<?php echo esc_url( get_theme_file_uri('/assets/img/france-competences.png') ); ?>" alt="France Compétences">
          </div>
        </section>

        <section class="formations-intro">
          <div class="formations-intro__types">
            <div class="formations-intro__type">
              <h4 class="formations-intro__title">Formation / Apprentissage</h4>
              <p class="formations-intro__desc">Apprendre un métier, acquérir de l’expérience : une formation en alternance pour préparer l’avenir concrètement.</p>
            </div>
            <div class="formations-intro__type">
              <h4 class="formations-intro__title">Formation / Professionnels</h4>
              <p class="formations-intro__desc">Développez vos compétences ou explorez de nouveaux domaines avec des formations conçues pour les actifs.</p>
            </div>
            <div class="formations-intro__type">
              <h4 class="formations-intro__title">Formation / VAE</h4>
              <p class="formations-intro__desc">Valorisez votre expérience professionnelle et obtenez un diplôme reconnu grâce à la VAE.</p>
            </div>
            <div class="formations-intro__type">
              <h4 class="formations-intro__title">Formation / Salariés</h4>
              <p class="formations-intro__desc">Des parcours de formation adaptés aux besoins des salariés pour accompagner leur montée en compétences.</p>
            </div>
          </div>
        </section>
      </div>

      <!-- TYPE CARDS (dynamic from taxonomy 'formation_type') -->
      <div class="formations__cards">
        <?php
        $terms = get_terms([
          'taxonomy'   => 'formation_type',
          'hide_empty' => false,
        ]);

        // Optional image mapping by slug (place files in /assets/img/)
        $term_images = [
          'apprentissage' => '/assets/img/formationapprenti.png',
          'pro'           => '/assets/img/formationpro.png',
          'vae'           => '/assets/img/formationvae.png',
          'salaries'      => '/assets/img/formationsalarie.png',
        ];

        if (!is_wp_error($terms) && $terms):
          foreach ($terms as $t):
            $img_rel = $term_images[$t->slug] ?? '/assets/img/formation-default.png';
            $img_url = get_theme_file_uri($img_rel);
            $count   = intval($t->count);
            ?>
            <article class="formation-card">
              <a class="formation-card__link" href="<?php echo esc_url( get_term_link($t) ); ?>"
                 aria-label="<?php echo esc_attr( sprintf(__('Voir %s','ateca'), $t->name) ); ?>"></a>

              <div class="formation-card__header">
                <h3 class="formation-card__title"><?php echo esc_html( $t->name ); ?> ➜</h3>
                <?php if ($t->description): ?>
                  <p class="formation__description"><?php echo esc_html( wp_trim_words($t->description, 18) ); ?></p>
                <?php endif; ?>
              </div>

              <div class="formation-card__image-container">
                <img class="formation-card__image" src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($t->name); ?>">
              </div>

              <ul class="formation-card__badges">
                <li class="badge badge--red">
                  <?php
                  echo $count ? sprintf(_n('%d formation', '%d formations', $count, 'ateca'), $count)
                              : __('Voir les formations','ateca');
                  ?>
                </li>
              </ul>
            </article>
          <?php
          endforeach;
        else:
          // Fallback if no terms yet
          ?>
          <p><?php esc_html_e('Aucun type de formation n’est disponible pour le moment.','ateca'); ?></p>
        <?php endif; ?>
      </div>
    </section>
  </div>

</main>

<?php get_footer(); ?>
