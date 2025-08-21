<?php
/**
 * ATECA Formation — Theme functions
 */
if ( ! defined('ABSPATH') ) exit;

/*----------------------------------*
 * Theme setup
 *----------------------------------*/
function ateca_setup() {
  // i18n
  load_theme_textdomain('ateca', get_template_directory() . '/languages');

  // Core supports
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_theme_support('html5', ['search-form','comment-form','comment-list','gallery','caption','style','script']);

  // Menus
  register_nav_menus([
    'primary' => __('Menu principal', 'ateca'),
    'footer'  => __('Menu pied de page', 'ateca'),
  ]);

  // Image sizes
  add_image_size('card', 800, 600, true);        // cards
  add_image_size('hero-wide', 1600, 900, true);  // heroes
}
add_action('after_setup_theme', 'ateca_setup');


/*----------------------------------*
 * Enqueue styles & scripts (your map)
 *----------------------------------*/
function ateca_assets() {
  $ver = wp_get_theme()->get('Version');

  // Register styles
  wp_register_style('ateca-reset',    get_theme_file_uri('/assets/css/reset.css'), [], $ver);
  wp_register_style('ateca-base',     get_theme_file_uri('/assets/css/styles.css'), ['ateca-reset'], $ver);
  wp_register_style('ateca-archives', get_theme_file_uri('/assets/css/styles-archives.css'), ['ateca-base'], $ver);
  wp_register_style('ateca-singles',  get_theme_file_uri('/assets/css/styles-singles.css'),  ['ateca-base'], $ver);

  // Always load base (front page needs only reset + base)
  wp_enqueue_style('ateca-base');

  // Font Awesome (global)
  wp_enqueue_style('ateca-fa', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css', [], '6.5.0');

  // ---- PAGE TYPE MAP ----
  if ( is_front_page() ) {
    // Front page => reset.css + styles.css (already enqueued)
  }
  // Singles for Services & Formations => + styles-singles.css
  elseif ( is_singular(['service','formation']) ) {
    wp_enqueue_style('ateca-singles');
  }
  // Archives: /formations/, /services/, taxonomy /formations/{term}/, search, 404 => + styles-archives.css
  elseif (
    is_post_type_archive(['service','formation']) ||
    is_tax('formation_type') ||
    is_search() ||
    is_404()
  ) {
    wp_enqueue_style('ateca-archives');
  }
  // Specific pages: À propos & Atelier des Familles => + styles-archives.css
  elseif ( is_page(['a-propos', 'atelier-des-familles']) ) {
    wp_enqueue_style('ateca-archives');
  }

  // Global JS
  wp_enqueue_script('ateca-script', get_theme_file_uri('/assets/js/script.js'), [], $ver, true);
}
add_action('wp_enqueue_scripts', 'ateca_assets', 20); // 20 = after most plugins


/*----------------------------------*
 * CPTs & Taxonomies
 *----------------------------------*/
function ateca_register_types() {

  // Service CPT
  register_post_type('service', [
    'labels' => [
      'name'          => __('Services', 'ateca'),
      'singular_name' => __('Service', 'ateca'),
      'add_new_item'  => __('Ajouter un service', 'ateca'),
      'edit_item'     => __('Modifier le service', 'ateca'),
    ],
    'public'       => true,
    'has_archive'  => 'services', // /services/
    'rewrite'      => ['slug' => 'services', 'with_front' => false],
    'menu_icon'    => 'dashicons-admin-tools',
    'supports'     => ['title','editor','excerpt','thumbnail','revisions','custom-fields'],
    'show_in_rest' => true,
    'show_in_nav_menus' => true,   // <- add
  ]);

// Formation CPT
  register_post_type('formation', [
    'labels' => [
      'name'          => __('Formations', 'ateca'),
      'singular_name' => __('Formation', 'ateca'),
      'add_new_item'  => __('Ajouter une formation', 'ateca'),
      'edit_item'     => __('Modifier la formation', 'ateca'),
    ],
    'public'             => true,
    'has_archive'        => 'formations',                 // Archive: /formations/
    'rewrite'            => ['slug' => 'formation', 'with_front' => false], 
    // ^ Singles default to /formation/%postname% (won’t clash with taxonomy)
    'menu_icon'          => 'dashicons-welcome-learn-more',
    'supports'           => ['title','editor','excerpt','thumbnail','revisions','custom-fields'],
    'show_in_rest'       => true,
    'show_in_nav_menus'  => true,
  ]);


  // Taxonomy: formation_type (Apprentissage, Pro, Salariés, VAE)
  register_taxonomy('formation_type', 'formation', [
    'labels' => [
      'name'          => __('Types de formation', 'ateca'),
      'singular_name' => __('Type de formation', 'ateca'),
      'add_new_item'  => __('Ajouter un type', 'ateca'),
      'edit_item'     => __('Modifier le type', 'ateca'),
    ],
    'public'       => true,
    'hierarchical' => true,
    // Gives /formations/{term}/
    'rewrite'      => ['slug' => 'formations', 'with_front' => false],
    'show_in_rest' => true,
  ]);

}
add_action('init', 'ateca_register_types');


/*----------------------------------*
 * Pretty permalinks for Formation singles
 * /formations/{term}/formation-{postname}/
 *----------------------------------*/
function ateca_formation_permalink( $permalink, $post, $leavename ) {
  if ( $post->post_type !== 'formation' ) return $permalink;

  $terms = wp_get_post_terms( $post->ID, 'formation_type' );
  $first_term = (!is_wp_error($terms) && !empty($terms)) ? $terms[0]->slug : 'general';

  $slug = $post->post_name;
  return home_url( user_trailingslashit( "formations/{$first_term}/formation-{$slug}" ) );
}
add_filter('post_type_link', 'ateca_formation_permalink', 10, 3);

// Matching rewrite rule
function ateca_add_rewrite_rules() {
  add_rewrite_rule(
    '^formations/([^/]+)/formation-([^/]+)/?$',
    'index.php?post_type=formation&name=$matches[2]',
    'top'
  );
}
add_action('init', 'ateca_add_rewrite_rules');

// Flush on theme switch
function ateca_flush_rewrite_on_switch() {
  ateca_register_types();
  ateca_add_rewrite_rules();
  flush_rewrite_rules();
}
add_action('after_switch_theme', 'ateca_flush_rewrite_on_switch');

/*----------------------------------*
 * (Optional) SVG uploads
 *----------------------------------*/
// add_filter('upload_mimes', function($m){ $m['svg'] = 'image/svg+xml'; return $m; });



//menu
// Add our custom classes to <li> based on location
add_filter('nav_menu_css_class', function($classes, $item, $args, $depth){
  if (!isset($args->theme_location)) return $classes;

  if ($args->theme_location === 'primary') {
    $classes[] = 'nav__item';              // your old LI class
  } elseif ($args->theme_location === 'footer') {
    $classes[] = 'footer__link-item';
  }
  return $classes;
}, 10, 4);

// Add our custom class to <a> based on location
add_filter('nav_menu_link_attributes', function($atts, $item, $args, $depth){
  if (!isset($args->theme_location)) return $atts;

  if ($args->theme_location === 'primary') {
    $atts['class'] = trim( ($atts['class'] ?? '') . ' nav__link' );
  } elseif ($args->theme_location === 'footer') {
    $atts['class'] = trim( ($atts['class'] ?? '') . ' footer__link' );
  }
  return $atts;
}, 10, 4);


// Prefix root-relative menu links with home_url() so /foo => http://site/subdir/foo
add_filter('nav_menu_link_attributes', function ($atts) {
  if (!empty($atts['href'])) {
    $href = $atts['href'];
    // starts with single slash (not //) and not absolute
    if (strpos($href, '/') === 0 && strpos($href, '//') !== 0) {
      $atts['href'] = home_url($href);
    }
  }
  return $atts;
});


// Make sure formation_type archives always query 'formation' (defensive).
add_action('pre_get_posts', function ($q) {
  if ( !is_admin() && $q->is_main_query() && $q->is_tax('formation_type') ) {
    $q->set('post_type', ['formation']);
  }
});

// Badge text meta box for Services
add_action('add_meta_boxes', function () {
  add_meta_box(
    'svc_badge',
    __('Badge carte', 'ateca'),
    function ($post) {
      $val = get_post_meta($post->ID, 'badge_text', true);
      wp_nonce_field('svc_badge_save', 'svc_badge_nonce');
      echo '<p><label for="svc_badge_text">'.esc_html__('Texte du badge', 'ateca').'</label></p>';
      echo '<input type="text" id="svc_badge_text" name="badge_text" class="widefat" placeholder="ex: à partir de 24€" value="'.esc_attr($val).'" />';
    },
    'service',
    'side'
  );
});

add_action('save_post_service', function ($post_id) {
  if (!isset($_POST['svc_badge_nonce']) || !wp_verify_nonce($_POST['svc_badge_nonce'], 'svc_badge_save')) return;
  if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return;
  if (!current_user_can('edit_post', $post_id)) return;
  $val = isset($_POST['badge_text']) ? sanitize_text_field($_POST['badge_text']) : '';
  $val === '' ? delete_post_meta($post_id, 'badge_text') : update_post_meta($post_id, 'badge_text', $val);
});

/*----------------------------------*
 * (Optional) Default editor content for new "Formation" posts
 *----------------------------------*/
add_filter('default_content', function($content, $post) {
  if ( isset($post->post_type) && $post->post_type === 'formation' ) {
    // Only the inner <article> blocks (no outer <section class="formation-details">)
    $content = <<<HTML
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
HTML;
  }
  return $content;
}, 10, 2);


/*----------------------------------*
 * (Optional) SVG uploads
 *----------------------------------*/
// add_filter('upload_mimes', function($m){ $m['svg'] = 'image/svg+xml'; return $m; });

add_action('init', function () {
  $args_text = [
    'type'         => 'string',
    'single'       => true,
    'show_in_rest' => true,
    'auth_callback'=> '__return_true',
    'sanitize_callback' => 'wp_kses_post',
  ];
  register_post_meta('formation', 'short_intro', $args_text);

  $args_line = [
    'type'         => 'string',
    'single'       => true,
    'show_in_rest' => true,
    'auth_callback'=> '__return_true',
    'sanitize_callback' => 'sanitize_text_field',
  ];
  register_post_meta('formation', 'next_session', $args_line);
  register_post_meta('formation', 'current_session', $args_line);
});
