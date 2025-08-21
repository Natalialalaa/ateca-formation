<?php
/* Page: Atelier des Familles (slug: atelier-des-familles) */
get_header();
?>

<main class="main">

  <!-- TYPE 2 HERO -->
  <div class="services-header">
    <div class="services-header__content">
      <div class="services-header__photo">
        <img
          src="<?php echo esc_url( get_theme_file_uri('/assets/img/close-up-happy-family-therapy-session-1.png') ); ?>"
          alt="ATECA Services"
          class="services-header__image">
      </div>
      <div class="services-header__logos">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-1">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-2">
        <img src="<?php echo esc_url( get_theme_file_uri('/assets/img/dots.svg') ); ?>" alt="" class="services-header__logo-3">
      </div>
      <h1 class="services-header__title">Atelier des Familles</h1>
    </div>
    <p class="services-header__description">
      Un lieu d’accueil, d’échanges et d’activités pour renforcer les liens familiaux, rompre l’isolement et favoriser le dialogue intergénérationnel. L’Atelier des familles propose un accompagnement bienveillant pour soutenir les parents et les enfants au quotidien.
    </p>
  </div>

  <section id="atelier-des-familles" class="atelier-des-familles">
    <div>
      <h3>C’est quoi&nbsp;?</h3>

      <h4>Temps d’échange</h4>
      <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua…
      </p>

      <h4>Présentation</h4>
      <p>Présentation de l'atelier des familles</p>

      <div class="iframe">
        <iframe
          width="500" height="400" style="max-width:100%;"
          src="https://www.youtube.com/embed/FdNwBIxn8k8?si=c3Sn3C0poVv9MyUe"
          title="YouTube video player" frameborder="0"
          allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
          referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
      </div>

      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua…</p>

      <h4>Témoignage</h4>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua…</p>
    </div>

    <div>
      <h3>Planning</h3>
      <div class="iframe">
        <iframe
          src="https://calendar.google.com/calendar/embed?height=400&wkst=1&ctz=UTC&showPrint=0&hl=fr&mode=AGENDA&src=Ym9yaW5nY29ycG9yYXRpb25zaG9wQGdtYWlsLmNvbQ&src=OTExNTM0MDk0NjgyYzMxMWIyNjk3YjIzMGQzY2U1YTZlYzc5YjIyMmFjMTY1MDhiZWVjYTMzNWZmNzQ3ZTk3Y0Bncm91cC5jYWxlbmRhci5nb29nbGUuY29t&src=ZW4uZnJlbmNoI2hvbGlkYXlAZ3JvdXAudi5jYWxlbmRhci5nb29t"
          width="500" height="400" frameborder="0" scrolling="no" style="max-width:100%;"></iframe>
      </div>
    </div>

    <div>
      <h3>Règlement</h3>
      <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua…</p>
    </div>
  </section>

</main>

<?php get_footer(); ?>
