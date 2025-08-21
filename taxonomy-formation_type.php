<?php
/**
 * Template: Taxonomy archive for `formation_type`
 * URLs:
 *   /formations/apprentissage/
 *   /formations/pro/
 *   /formations/salaries/
 *   /formations/vae/
 */

get_header();

$term = get_queried_object();
$slug = sanitize_title( $term->slug );

/* Map hero images by term slug (place files in /assets/img/) */
$hero_images = [
  'apprentissage'  => '/assets/img/formationapprenti.png',
  'pro'            => '/assets/img/formationpro.png',
  'professionnels' => '/assets/img/formationpro.png',
  'salaries'       => '/assets/img/formationsalarie.png',
  'salariés'       => '/assets/img/formationsalarie.png',
  'vae'            => '/assets/img/formationvae.png',
];
$hero_src = get_theme_file_uri( $hero_images[$slug] ?? '/assets/img/formation-default.png' );

/* Fallback descriptions if the term itself has none */
$desc_map = [
  'apprentissage'  => "Découvrez nos formations en apprentissage, conçues pour vous accompagner dans votre parcours professionnel ; Que vous soyez débutant ou en reconversion, nos programmes sont adaptés à vos besoins et vous offrent une expérience d'apprentissage enrichissante.",
  'pro'            => "Découvrez nos formations pour les professionnels, conçues pour vous aider à développer vos compétences et à réussir dans votre parcours professionnel.",
  'professionnels' => "Découvrez nos formations pour les professionnels, conçues pour vous aider à développer vos compétences et à réussir dans votre parcours professionnel.",
  'salaries'       => "Découvrez nos formations pour les salariés, conçues pour vous aider à développer vos compétences et à réussir dans votre parcours professionnel. Notre équipe est là pour vous accompagner dans votre développement.",
  'salariés'       => "Découvrez nos formations pour les salariés, conçues pour vous aider à développer vos compétences et à réussir dans votre parcours professionnel. Notre équipe est là pour vous accompagner dans votre développement.",
  'vae'            => "La VAE permet de faire reconnaître officiellement vos compétences acquises par l’expérience. Préparez votre dossier et obtenez une certification reconnue.",
];
$description = term_description( $term ) ?: ( $desc_map[$slug] ?? '' );
?>

<main class="main">
  <!-- TYPE 2 HERO -->
  <div class="services-header">
    <div class="services-header__content">
      <div class="services-header__photo">
        <img src="<?php echo esc_url($hero_src); ?>" alt="<?php echo esc_attr($term->name); ?>" class="services-header__image">
      </div>
      <div class="services-header__logos">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-1">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-2">
      </div>
      <h1 class="services-header__title"><?php echo esc_html( $term->name ); ?></h1>
    </div>
    <?php if ($description): ?>
      <p class="services-header__description"><?php echo wp_kses_post( $description ); ?></p>
    <?php endif; ?>
  </div>

  <?php
  // Build a reliable query for formations in the current term
  $paged = max( 1, get_query_var('paged'), get_query_var('page') );
  $q = new WP_Query([
    'post_type'      => 'formation',
    'posts_per_page' => 12,
    'paged'          => $paged,
    'tax_query'      => [
      [
        'taxonomy' => 'formation_type',
        'field'    => 'slug',
        'terms'    => $term->slug,
      ],
    ],
  ]);
  ?>

  <section class="archive-formations__cards-content">
    <div class="archive-formations__cards">
      <?php if ( $q->have_posts() ) : ?>
        <?php while ( $q->have_posts() ) : $q->the_post(); ?>
<article class="archive-formations__card">
  <!-- was: class="archive-formations__card-link" -->
  <a class="formation-card__link archive-formations__card-link"
     href="<?php the_permalink(); ?>"
    aria-label="<?php echo esc_attr( the_title_attribute( ['echo' => false] ) ); ?>"></a>

            <div class="formation-card__header">
              <h3 class="formation-card__title"><?php the_title(); ?> ➜</h3>
            </div>

            <div class="formation-card__image-container">
              <?php if ( has_post_thumbnail() ) : ?>
                <?php the_post_thumbnail( 'card', ['class' => 'formation-card__image', 'alt' => esc_attr( get_the_title() )] ); ?>
              <?php else : ?>
                <img class="formation-card__image" src="<?php echo esc_url( get_theme_file_uri('/assets/img/placeholder-formation.jpg') ); ?>" alt="<?php the_title_attribute(); ?>">
              <?php endif; ?>
            </div>

            <ul class="formation-card__badges">
              <li class="badge badge--red"><?php esc_html_e('Voir le détail', 'ateca'); ?></li>
            </ul>
          </article>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php else : ?>
        <p><?php esc_html_e('Aucune formation pour le moment dans cette catégorie.', 'ateca'); ?></p>
      <?php endif; ?>
    </div>

    <?php if ( $q->max_num_pages > 1 ) : ?>
      <nav class="pagination" aria-label="<?php esc_attr_e('Pagination', 'ateca'); ?>">
        <?php
          echo paginate_links([
            'total'     => $q->max_num_pages,
            'current'   => $paged,
            'prev_text' => '«',
            'next_text' => '»',
          ]);
        ?>
      </nav>
    <?php endif; ?>
  </section>
</main>

<?php get_footer(); ?>
