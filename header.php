<?php
/** Theme header (menu only) */
?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php wp_head(); ?>
</head>
<body <?php body_class('site'); ?>>

<?php if ( function_exists('wp_body_open') ) { wp_body_open(); } ?>

<div class="headline">
  <p><?php esc_html_e('Participez au Formation Commercial en Apprentissages le 16 octobre à 14h ! 🚀', 'ateca'); ?></p>
</div>

<header class="header" role="banner">

  <!-- one toggle, two icons; we swap visibility & keep same position -->
  <div class="toggle__mobile" style="position:relative; z-index:2000;">
    <a href="#" class="js-menu-toggle">
      <img class="open-icon"  src="<?php echo esc_url( get_theme_file_uri('/assets/img/open_menu.svg') ); ?>"  alt="logo_ateca">
      <img class="close-icon" src="<?php echo esc_url( get_theme_file_uri('/assets/img/close.png') ); ?>" alt="logo_ateca" style="display:none;">
    </a>
  </div>

  <div class="header__logo">
    <a href="<?php echo esc_url( home_url('/') ); ?>">
      <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/logo-nav-ateca.svg') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>">
    </a>
  </div>
  
  <nav class="header__nav--pc">
    <?php if ( has_nav_menu('primary') ) :
      wp_nav_menu([
        'theme_location' => 'primary',
        'container'      => false,
        'menu_class'     => 'nav__list',
        'items_wrap'     => '<ul class="nav__list">%3$s</ul>',
        'depth'          => 1,
        'fallback_cb'    => false,
      ]);
    else : ?>
      <ul class="nav__list">
        <li class="nav__item"><a class="nav__link" href="<?php echo esc_url( home_url('/formations/') ); ?>"><?php esc_html_e('Formations','ateca'); ?></a></li>
        <li class="nav__item"><a class="nav__link" href="<?php echo esc_url( home_url('/services/') ); ?>"><?php esc_html_e('Services','ateca'); ?></a></li>
        <li class="nav__item"><a class="nav__link" href="<?php echo esc_url( home_url('/atelier-des-familles/') ); ?>"><?php esc_html_e('Atelier des Familles','ateca'); ?></a></li>
        <li class="nav__item"><a class="nav__link" href="<?php echo esc_url( home_url('/a-propos/') ); ?>"><?php esc_html_e('À propos','ateca'); ?></a></li>
      </ul>
    <?php endif; ?>
  </nav>

  <div class="header__icons">
    <a href="#"><img src="<?php echo esc_url( get_theme_file_uri('/assets/img/profile.svg') ); ?>" alt=""></a>
    <a href="#"><img src="<?php echo esc_url( get_theme_file_uri('/assets/img/shop.png') ); ?>" alt=""></a>
  </div>
</header>

<nav class="header__nav--mobile">
  <?php if ( has_nav_menu('primary') ) :
    wp_nav_menu([
      'theme_location' => 'primary',
      'container'      => false,
      'menu_class'     => 'nav__list',
      'items_wrap'     => '<ul class="nav__list">%3$s</ul>',
      'depth'          => 1,
      'fallback_cb'    => false,
    ]);
  else : ?>
    <ul class="nav__list">
      <li class="nav__item"><a class="nav__link" href="<?php echo esc_url( home_url('/formations/') ); ?>"><?php esc_html_e('Formations','ateca'); ?></a></li>
      <li class="nav__item"><a class="nav__link" href="<?php echo esc_url( home_url('/services/') ); ?>"><?php esc_html_e('Services','ateca'); ?></a></li>
      <li class="nav__item"><a class="nav__link" href="<?php echo esc_url( home_url('/atelier-des-familles/') ); ?>"><?php esc_html_e('Atelier des Familles','ateca'); ?></a></li>
      <li class="nav__item"><a class="nav__link" href="<?php echo esc_url( home_url('/a-propos/') ); ?>"><?php esc_html_e('À propos','ateca'); ?></a></li>
    </ul>
  <?php endif; ?>
</nav>
