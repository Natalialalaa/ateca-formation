<?php
/** Service card (used in archive-service) */
$permalink = get_permalink();
$title     = get_the_title();
$badge     = get_post_meta(get_the_ID(), 'badge_text', true); // optional: e.g. "à partir de 24€" or "Sur devis"
?>

<article class="formation-card">
  <a href="<?php echo esc_url($permalink); ?>" class="formation-card__link" aria-label="<?php echo esc_attr($title); ?>"></a>

  <div class="formation-card__header">
    <p class="formation__description"><span class="fd-color--green"></span></p>
    <h3 class="formation-card__title"><?php echo esc_html($title); ?> ➜</h3>
  </div>

  <div class="formation-card__image-container">
    <?php if ( has_post_thumbnail() ) :
      echo get_the_post_thumbnail( get_the_ID(), 'card', ['class' => 'formation-card__image', 'alt' => esc_attr($title)] );
    else : ?>
      <img class="formation-card__image"
           src="<?php echo esc_url( get_theme_file_uri('/assets/img/service_default.png') ); ?>"
           alt="<?php echo esc_attr($title); ?>">
    <?php endif; ?>
  </div>

  <?php if ( $badge ) : ?>
    <ul class="formation-card__badges">
      <li class="badge badge--red"><?php echo esc_html($badge); ?></li>
    </ul>
  <?php endif; ?>
</article>
