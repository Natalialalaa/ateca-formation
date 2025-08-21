<?php
/* Single: Formation — /formations/{term}/formation-{slug}/ */
get_header();

$rncp_url   = get_post_meta(get_the_ID(), 'rncp_url', true);   // e.g. https://www.francecompetences.fr/recherche/rncp/37098/
$rncp_code  = get_post_meta(get_the_ID(), 'rncp_code', true);  // e.g. 37098 (optional)
$next_sess  = get_post_meta(get_the_ID(), 'next_session', true);
$curr_sess  = get_post_meta(get_the_ID(), 'current_session', true);

// Description fallback: excerpt or first ~60 words of content
$desc = has_excerpt() ? get_the_excerpt() : wp_trim_words( wp_strip_all_tags(get_the_content()), 60 );
?>

<main class="main">

  <!-- HEADER (Type 3) -->
  <div class="formation-section">
    <section class="formation-header">
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('large', ['class' => 'formation-header__image', 'alt' => esc_attr(get_the_title())]); ?>
      <?php else: ?>
        <img class="formation-header__image" src="<?php echo esc_url( get_theme_file_uri('/assets/img/placeholder-formation-hero.jpg') ); ?>" alt="<?php the_title_attribute(); ?>">
      <?php endif; ?>

      <div class="formation-header__title">
        <h1><?php the_title(); ?></h1>

        <?php if ($rncp_url || $rncp_code): ?>
          <p class="formation-header__subtitle">
            <a class="formation-header__link" href="<?php echo esc_url( $rncp_url ?: '#' ); ?>" target="_blank" rel="noopener">
              <?php echo esc_html( $rncp_code ? "RNCP {$rncp_code}" : 'RNCP' ); ?>
            </a>
          </p>
        <?php endif; ?>
      </div>
    </section>
  </div>
  <!-- DESCRIPTION (labels, dates, intro) -->
  <section class="formation-description">
    <div class="formation-header__content">

      <?php
      // Build labels from taxonomy terms with your original phrasing
      $labels = [];
      $terms  = get_the_terms( get_the_ID(), 'formation_type' );

      // Map slugs -> the exact labels you used in your HTML comps
      $map = [
        'apprentissage'  => '✔ En apprentissage',
        'pro'            => '✔ Formation professionnel',
        'professionnels' => '✔ Formation professionnel',
        'salaries'       => '✔ Salariés',
        'salariés'       => '✔ Salariés',
        'vae'            => '✔ VAE',
      ];

      if ( $terms && ! is_wp_error( $terms ) ) {
        foreach ( $terms as $t ) {
          $slug = sanitize_title( $t->slug );
          $labels[] = $map[$slug] ?? ('✔ ' . $t->name);
        }
        // unique + keep order
        $labels = array_values( array_unique( $labels ) );
      }

      // Fallback to your original two chips if no terms set
      if ( empty( $labels ) ) {
        $labels = ['✔ En apprentissage', '✔ Formation professionnel'];
      }
      ?>

      <div class="formation-header-label">
        <?php foreach ( $labels as $label ) : ?>
          <span class="formation-header__label"><?php echo esc_html( $label ); ?></span>
        <?php endforeach; ?>
      </div>

      <?php
      // Dates via Custom Fields (editable): next_session, current_session
      $next_session    = get_post_meta( get_the_ID(), 'next_session', true );
      $current_session = get_post_meta( get_the_ID(), 'current_session', true );
      ?>

      <div>
        <p class="formation-header__date">
          <bold><?php esc_html_e('Prochaine session :', 'ateca'); ?></bold>
          <?php echo $next_session ? esc_html( $next_session ) : esc_html__( 'Contactez-nous', 'ateca' ); ?>
        </p>

        <?php if ( ! empty( $current_session ) ) : ?>
          <p class="formation-header__date">
            <bold><?php esc_html_e('Session en cours  :', 'ateca'); ?></bold>
            <?php echo esc_html( $current_session ); ?>
          </p>
        <?php endif; ?>
      </div>

      <?php
      // Short intro (editable): custom field 'short_intro' -> fallback to excerpt
      $intro = get_post_meta( get_the_ID(), 'short_intro', true );
      if ( ! $intro ) {
        $intro = get_the_excerpt(); // falls back to auto-generated excerpt if none set
      }
      ?>

      <?php if ( $intro ) : ?>
        <p class="formation-header__description">
          <?php echo wp_kses_post( $intro ); ?>
        </p>
      <?php endif; ?>

      <div class="formation-header__break-line"></div>
    </div>
  </section>

<!-- DETAILS -->
  <section class="formation-details">
    <?php
    if ( have_posts() ) :
      while ( have_posts() ) : the_post();

        // Detect if editor content is really empty (ignores whitespace & tags)
        $raw_content   = get_post_field( 'post_content', get_the_ID() );
        $has_content   = strlen( trim( wp_strip_all_tags( $raw_content ) ) ) > 0;

        if ( $has_content ) : ?>
          <div class="formation-details__from-editor">
            <?php the_content(); ?>
          </div>
        <?php else : ?>

          <!-- Default structured sections (fallback) -->
          <article class="formation-details__article">
            <h2 class="formation-details__title">OBJECTIFS</h2>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Objectif de la formation</h3>
              <ul class="formation-details__list">
                <li class="formation-details__item">Contribuer à la mise en œuvre de la politique commerciale de l’unité marchande dans un environnement omnicanal.</li>
                <li class="formation-details__item">Contribuer à l’efficacité commerciale d’une unité marchande dans un environnement omnicanal.</li>
                <li class="formation-details__item">Améliorer l’expérience client dans un environnement omnicanal.</li>
              </ul>
            </div>
          </article>

          <article class="formation-details__article">
            <h2 class="formation-details__title">PROGRAMME</h2>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Durée de la formation et délai d'accès</h3>
              <ul class="formation-details__list">
                <li class="formation-details__item">Formation sur 10 jours (7h par jour) répartis sur 3 mois environ.</li>
                <li class="formation-details__item">280 heures en entreprise complètent la formation.</li>
                <li class="formation-details__item">Réunion d’information collective, test de positionnement et entretien individuel pour accéder à la formation.</li>
              </ul>
            </div>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Méthode d’évaluation</h3>
              <ul class="formation-details__list">
                <li class="formation-details__item">Évaluation en début et fin de parcours.</li>
                <li class="formation-details__item">Validation des compétences par un examen final.</li>
                <li class="formation-details__item">Évaluation en cours de formation.</li>
              </ul>
            </div>
          </article>

          <article class="formation-details__article">
            <h2 class="formation-details__title">ET APRÈS ?</h2>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Secteur d’activité et type d’emploi</h3>
              <ul class="formation-details__list">
                <li class="formation-details__item">Commerce, grande distribution, conseil en vente</li>
                <li class="formation-details__item">Conseiller de vente, vendeur, hôte/hôtesse de caisse, chef de rayon, manager de rayon</li>
              </ul>
            </div>
          </article>

          <article class="formation-details__article">
            <h2 class="formation-details__title">ACCÈS ET FINANCEMENT</h2>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Pré-requis, diplômes accessibles</h3>
              <ul class="formation-details__list">
                <li class="formation-details__item">Être majeur</li>
                <li class="formation-details__item">Savoir lire, écrire, compter</li>
                <li class="formation-details__item">Maîtriser les outils informatiques</li>
                <li class="formation-details__item">Avoir un projet professionnel validé</li>
                <li class="formation-details__item">Avoir développé des expériences commerciales</li>
                <li class="formation-details__item">Diplômes accessibles : Diplôme de niveau 4</li>
              </ul>
            </div>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Financement</h3>
              <ul class="formation-details__list">
                <li class="formation-details__item">OPCO</li>
                <li class="formation-details__item">CPF</li>
                <li class="formation-details__item">France Travail</li>
                <li class="formation-details__item">(Pour les tarifs, nous consulter)</li>
              </ul>
            </div>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Accessibilité</h3>
              <ul class="formation-details__list">
                <li class="formation-details__item">Les personnes en situation de handicap peuvent suivre cette formation. Contactez-nous pour étudier ensemble les possibilités d’adaptation.</li>
              </ul>
            </div>
          </article>

          <article class="formation-details__article">
            <h2 class="formation-details__title">SE RENSEIGNER</h2>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Documents et/ou Lien utiles</h3>
              <ul class="formation-details__list">
                <li class="formation-details__item">Être majeur</li>
                <li class="formation-details__item">Savoir lire, écrire, compter</li>
                <li class="formation-details__item">Maîtriser les outils informatiques</li>
                <li class="formation-details__item">Avoir un projet professionnel validé</li>
                <li class="formation-details__item">Avoir développé des expériences commerciales</li>
                <li class="formation-details__item">Diplômes accessibles : Diplôme de niveau 4</li>
              </ul>
            </div>
            <div class="formation-details__text">
              <h3 class="formation-details__subtitle"><span class="formation-details__toggle">+</span> Contact</h3>
              <address class="formation-details__contact">
                Frédérique Le Bon<br>
                Directrice &amp; Formatrice – Référente Handicap<br>
                <span class="formation-details__contact-icon" aria-label="Téléphone">📞</span> 06 95 16 77 91<br>
                <span class="formation-details__contact-icon" aria-label="Email">📧</span> <a href="mailto:atecaformation@gmail.com" class="formation-details__contact-link">atecaformation@gmail.com</a><br>
                <span class="formation-details__contact-icon" aria-label="Adresse">📍</span> Rinxent (62)<br>
                <span class="formation-details__contact-icon" aria-label="Site web">🌐</span> <a href="https://atecaformation.fr/" target="_blank" rel="noopener" class="formation-details__contact-link">atecaformation.fr</a>
              </address>
            </div>
          </article>

        <?php endif;

      endwhile;
    endif;
    ?>
  </section>


</main>

<?php get_footer(); ?>
