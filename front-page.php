<?php
/* Front Page — basic version, single global header (menu only) */
get_header();
?>

<main class="main">

  <!-- HERO -->
  <section class="hero">
    <div class="hero__background">
      <div class="hero__image-container">
        <img class="hero__image" src="<?php echo esc_url( get_theme_file_uri('/assets/img/hero2.jpg') ); ?>" alt="Ateca Formations">
        <div class="hero__overlay_1"></div>
      </div>

      <div class="hero__overlay_2">
        <div class="hero__overlay_3">
          <img class="dots--1" src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="">
          <div class="hero__overlay-text">
            <h1 class="hero__title">Un centre de formation proche de vous.</h1>
            <p class="hero__subtitle">Formez vous aux métiers de la petite enfance et de l'accompagnement à domicile.</p>
          </div>
        </div>
      </div>

      <div class="hero__actions">
        <a href="<?php echo esc_url( get_post_type_archive_link('formation') ); ?>" class="button button--primary">Découvrir les formations</a>
        <a href="#contact" class="button button--secondary">Nous contacter</a>
        <img class="dots--2" src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="">
        <img class="dots--3" src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="">
      </div>
    </div>
  </section>

  <!-- STATS (static) -->
  <section class="stats">
    <div class="stat">
      <svg class="progress" viewBox="0 0 100 50">
        <path class="bg" d="M10,50 A40,40 0 0,1 90,50" />
        <path class="progress-circle" d="M10,50 A40,40 0 0,1 90,50" data-percent="92" />
        <text x="50" y="45" class="percentage">92%</text>
      </svg>
      <div class="stat__content">
        <h3 class="stat__title">Taux de satisfaction</h3>
        <p class="stat__description">La majorité des participants se disent satisfaits, preuve de la qualité de nos formations.</p>
      </div>
    </div>

    <div class="stat">
      <svg class="progress" viewBox="0 0 100 50">
        <path class="bg" d="M10,50 A40,40 0 0,1 90,50" />
        <path class="progress-circle" d="M10,50 A40,40 0 0,1 90,50" data-percent="77" />
        <text x="50" y="45" class="percentage">77%</text>
      </svg>
      <div class="stat__content">
        <h3 class="stat__title">Taux de réussite</h3>
        <p class="stat__description">Sur toutes les formations confondues, 7 apprenants sur 9 ont décroché leurs diplômes.</p>
      </div>
    </div>

    <div class="stat">
      <svg class="progress" viewBox="0 0 100 50">
        <path class="bg" d="M10,50 A40,40 0 0,1 90,50" />
        <path class="progress-circle" d="M10,50 A40,40 0 0,1 90,50" data-percent="100" />
        <text x="50" y="45" class="percentage">100%</text>
      </svg>
      <div class="stat__content">
        <h3 class="stat__title">Taux de présence</h3>
        <p class="stat__description">Sur toutes formations confondues, aucun abandon n’est à déplorer !</p>
      </div>
    </div>
  </section>

  <!-- FORMATIONS (basic loop: latest 4 formations) -->
  <section id="formations" class="formations">
    <h2 class="formations__title">Les Formations</h2>

    <div class="formations__cards">
      <?php
      $q = new WP_Query([
        'post_type'      => 'formation',
        'posts_per_page' => 4,
        'orderby'        => 'date',
        'order'          => 'DESC',
      ]);
      if ($q->have_posts()):
        while ($q->have_posts()): $q->the_post(); ?>
          <article class="formation-card">
            <div class="formation-card__header">
              <h3 class="formation-card__title">
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?> ➜</a>
              </h3>
            </div>

            <div class="formation-card__image-container">
              <?php if (has_post_thumbnail()): ?>
                <?php the_post_thumbnail('large', ['class' => 'formation-card__image', 'alt' => esc_attr(get_the_title())]); ?>
              <?php else: ?>
                <img class="formation-card__image" src="<?php echo esc_url( get_theme_file_uri('/assets/img/placeholder-formation.jpg') ); ?>" alt="<?php the_title_attribute(); ?>">
              <?php endif; ?>
            </div>

            <!-- Keep badges markup simple for now (no ACF) -->
            <ul class="formation-card__badges">
              <!-- Optional: output first term name as a badge if exists -->
              <?php
              $terms = wp_get_post_terms(get_the_ID(), 'formation_type');
              if (!is_wp_error($terms) && !empty($terms)) {
                echo '<li class="badge badge--blue">'.esc_html($terms[0]->name).'</li>';
              }
              ?>
            </ul>
          </article>
        <?php
        endwhile; wp_reset_postdata();
      else:
        // Minimal static card fallback
        ?>
        <article class="formation-card">
          <div class="formation-card__header">
            <h3 class="formation-card__title">Une formation exemple ➜</h3>
          </div>
          <div class="formation-card__image-container">
            <img class="formation-card__image" src="<?php echo esc_url( get_theme_file_uri('/assets/img/placeholder-formation.jpg') ); ?>" alt="">
          </div>
          <ul class="formation-card__badges">
            <li class="badge badge--blue">Exemple</li>
          </ul>
        </article>
      <?php endif; ?>

      <div class="formations__cards-bg"></div>
    </div>

    <div class="formations__footer">
      <?php $formations_url = get_post_type_archive_link('formation'); ?>

      <p class="formations__intro">
        Découvrez
        <a href="<?php echo esc_url($formations_url); ?>" class="formation-intro-link--underline">
          toutes nos formations
        </a>
        accessibles à tous les âges, en présentiel ou à distance, que vous soyez en
        reconversion professionnelle ou en quête d’évolution.
      </p>
      <div class="formations__icons">
        <img class="formations__icon" src="<?php echo esc_url( get_theme_file_uri('/assets/img/mcf.png') ); ?>" alt="MCF">
        <img class="formations__icon" src="<?php echo esc_url( get_theme_file_uri('/assets/img/qualopi.png') ); ?>" alt="Qualiopi">
      </div>
    </div>
  </section>

  <!-- ABOUT (static) -->
  <section class="about">
    <blockquote class="about__quote">
      « Suivre une formation permet d’approfondir ses compétences et en développer de nouvelles.
      <b>ATECA</b> est à <b>vos côtés</b> pour actualiser vos compétences et en acquérir de nouvelles.
      Le monde du travail évolue, vos priorités changent. Alors pourquoi ne pas se donner un nouveau challenge
      qui vous permette de donner un nouvel élan à votre <b>carrière professionnelle.</b> »
    </blockquote>
    <div class="about__profile">
      <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/fledbon.png') ); ?>" alt="Frédérique Le Bon" class="about__profile-image">
      <div class="about__profile-info">
        <p class="about__profile-name">Frédérique Le Bon</p>
        <p class="about__profile-role">– Directrice d’ATECA Formation</p>
        <img class="dots--4" src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="">
        <img class="dots--5" src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="">
      </div>
    </div>
  </section>

  <!-- ALUMNIS (static for now) -->
  <section class="alumnis">
    <div class="alumnis__title">
      <h2>Les Alumnis</h2>
    </div>
    <div class="alumnis__description">
      <p>Rejoignez le réseau de celles et ceux qui partagent un passé commun et construisent l’avenir ensemble.</p>
      <a href="https://www.linkedin.com/" target="_blank" class="linkedin" rel="noopener">
        <i class="fab fa-linkedin-in" aria-hidden="true"></i>
      </a>
    </div>

    <div class="alumnis__testimonials">
      <article class="alumnis__testimonial">
        <blockquote class="alumnis__quote"><p>« Merci pour tous vos échanges d'expériences qui vont m'aider à développer mon activité. »</p></blockquote>
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/alumni-1.jpg') ); ?>" alt="Photo de Mme S.S.">
        <div class="alumnis__star" aria-label="5 étoiles">★ ★ ★ ★ ★</div>
        <p class="alumni__profile"><span class="alumnis__author">Mme S.S.</span>, TP FPA, Novembre 2022</p>
      </article>

      <article class="alumnis__testimonial">
        <blockquote class="alumnis__quote"><p>« Mme LE BON est disponible, patiente et très professionnelle. »</p></blockquote>
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/alumni-2.jpg') ); ?>" alt="Photo du groupe d'assistantes maternelles">
        <div class="alumnis__star" aria-label="5 étoiles">★ ★ ★ ★ ★</div>
        <p class="alumni__profile"><span class="alumnis__author">Groupe d'assistantes maternelles</span>, Juillet 2023</p>
      </article>

      <article class="alumnis__testimonial">
        <blockquote class="alumnis__quote"><p>« Merci pour tous vos échanges d'expériences qui vont m'aider à développer mon activité. »</p></blockquote>
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/alumni-1.jpg') ); ?>" alt="Photo de Mme S.S.">
        <div class="alumnis__star" aria-label="5 étoiles">★ ★ ★ ★ ★</div>
        <p class="alumni__profile"><span class="alumnis__author">Mme S.S.</span>, TP FPA, Novembre 2022</p>
      </article>

      <article class="alumnis__testimonial">
        <blockquote class="alumnis__quote"><p>« Mme LE BON est disponible, patiente et très professionnelle. »</p></blockquote>
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/alumni-2.jpg') ); ?>" alt="Photo du groupe d'assistantes maternelles">
        <div class="alumnis__star" aria-label="5 étoiles">★ ★ ★ ★ ★</div>
        <p class="alumni__profile"><span class="alumnis__author">Groupe d'assistantes maternelles</span>, Juillet 2023</p>
      </article>
    </div>
  </section>

  <!-- NEWS (basic: latest 3 posts if you ever enable blog) -->
  <section class="news">
    <div class="news__posts">
      <?php
      $posts = get_posts(['numberposts'=>3,'post_type'=>'post']);
      foreach ($posts as $p):
        $img = get_the_post_thumbnail_url($p->ID, 'medium');
      ?>
      <iframe src="https://www.facebook.com/plugins/post.php?href=https%3A%2F%2Fwww.facebook.com%2FAtecaLeBon%2Fposts%2Fpfbid02g283P5ZpnrcNcRTvzHdDngPQqSFpSMimWdWHhYTQYpNfBm76VkES77hotMrghvbKl&show_text=true&width=500" width="500" height="202" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
      <?php endforeach; ?>
      <div class="news__posts-bg"></div>
    </div>

    <a href="https://www.facebook.com/" target="_blank" class="facebook" rel="noopener">
      <i class="fab fa-facebook-f" aria-hidden="true"></i>
    </a>
  </section>

</main>

<?php get_footer(); ?>
