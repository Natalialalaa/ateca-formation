<?php
/** Theme footer (global footer with contact block) */
?>

<footer class="footer">

  <!-- CONTACT -->
  <section id="contact" class="contact">
    <form class="contact__form" method="post" action="#">
      <h2 class="contact__title"><?php esc_html_e('Nous contacter','ateca'); ?></h2>

      <label class="form__label form__label--prenom"><?php esc_html_e('Prénom','ateca'); ?>
        <input type="text" class="form__input" name="prenom">
      </label>

      <label class="form__label form__label--nom"><?php esc_html_e('Nom','ateca'); ?>
        <input type="text" class="form__input" name="nom">
      </label>

      <label class="form__label form__label--telephone"><?php esc_html_e('N° téléphone','ateca'); ?>
        <input type="tel" class="form__input" name="telephone">
      </label>

      <label class="form__label form__label--email">Mail
        <input type="email" class="form__input" name="email">
      </label>

      <label class="form__label form__label--message"><?php esc_html_e('Message','ateca'); ?>
        <textarea class="form__textarea" name="message"></textarea>
      </label>

      <button type="submit" class="button button--submit"><?php esc_html_e('Envoyer','ateca'); ?></button>
      <p class="contact__signal">
        <strong><?php esc_html_e('* Pour une réponse rapide :','ateca'); ?></strong>
        (+33) 06 95 16 77 91 — <a href="mailto:atecaformation@gmail.com">atecaformation@gmail.com</a>
      </p>
    </form>
  </section>

  <div class="footer__main">
    <?php
    // If you assign a "Footer" menu in WP, show it; else show your static groups.
    if ( has_nav_menu('footer') ) {
      wp_nav_menu([
        'theme_location' => 'footer',
        'container'      => 'nav',
        'container_class'=> 'footer__nav',
        'menu_class'     => 'footer__links',
      ]);
    } else {
      ?>
      <nav class="footer__nav" aria-label="<?php esc_attr_e('Liens principaux','ateca'); ?>">
        <ul class="footer__nav-list">
          <li class="footer__nav-group">
            <h2 class="footer__nav-title"><?php esc_html_e('Formations','ateca'); ?></h2>
            <ul class="footer__nav-sublist">
              <li><a href="<?php echo esc_url( home_url('/formations/apprentissage/') ); ?>" class="footer__nav-link"><?php esc_html_e('Apprentissage','ateca'); ?></a></li>
              <li><a href="<?php echo esc_url( home_url('/formations/vae/') ); ?>" class="footer__nav-link">VAE</a></li>
              <li><a href="<?php echo esc_url( home_url('/formations/pro/') ); ?>" class="footer__nav-link"><?php esc_html_e('Professionnels','ateca'); ?></a></li>
            </ul>
          </li>
          <li class="footer__nav-group">
            <h2 class="footer__nav-title"><?php esc_html_e('Services','ateca'); ?></h2>
            <ul class="footer__nav-sublist">
              <li><a href="<?php echo esc_url( home_url('/services/') ); ?>" class="footer__nav-link"><?php esc_html_e('Correction et relecture','ateca'); ?></a></li>
              <li><a href="<?php echo esc_url( home_url('/services/') ); ?>" class="footer__nav-link"><?php esc_html_e('Mise à disposition atelier de travail','ateca'); ?></a></li>
            </ul>
          </li>
          <li class="footer__nav-group">
            <h2 class="footer__nav-title"><?php esc_html_e('Atelier des Familles','ateca'); ?></h2>
            <ul class="footer__nav-sublist">
              <li><a href="<?php echo esc_url( home_url('/atelier-des-familles/') ); ?>" class="footer__nav-link"><?php esc_html_e('Découvrir','ateca'); ?></a></li>
            </ul>
          </li>
          <li class="footer__nav-group">
            <h2 class="footer__nav-title"><?php esc_html_e('À propos','ateca'); ?></h2>
            <ul class="footer__nav-sublist">
              <li><a href="<?php echo esc_url( home_url('/a-propos/') ); ?>" class="footer__nav-link"><?php esc_html_e('Notre histoire','ateca'); ?></a></li>
            </ul>
          </li>
        </ul>
      </nav>
      <?php
    }
    ?>
  </div>

  <div class="footer__content">
    <div class="footer__socials">
      <ul class="footer__socials-list">
        <li>
          <a href="https://www.facebook.com/" class="footer__social-link" aria-label="Facebook" target="_blank" rel="noopener">
            <i class="fab fa-facebook-f" aria-hidden="true"></i>
          </a>
        </li>
        <li>
          <a href="https://www.linkedin.com/" class="footer__social-link" aria-label="LinkedIn" target="_blank" rel="noopener">
            <i class="fab fa-linkedin-in" aria-hidden="true"></i>
          </a>
        </li>
      </ul>
    </div>

    <nav class="footer__legal-nav" aria-label="<?php esc_attr_e('Liens légaux','ateca'); ?>">
      <ul class="footer__links">
        <li><a href="#" class="footer__link"><?php esc_html_e('Nos documents','ateca'); ?></a></li>
        <li><a href="#" class="footer__link"><?php esc_html_e('CGV – Conditions générales de vente','ateca'); ?></a></li>
        <li><a href="#" class="footer__link"><?php esc_html_e('Mentions légales','ateca'); ?></a></li>
      </ul>
    </nav>

    <p class="footer__text">© <?php echo date_i18n('Y'); ?> ATECA Formations | <?php esc_html_e('Tous droits réservés.','ateca'); ?></p>
    <p class="footer__credit"><?php esc_html_e('Site créé par','ateca'); ?> <span lang="en">✱ Maison Pixel</span></p>
  </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
