<div class="col-md-4">
  <article class="home-trip">
    <a href="<?php the_permalink(); ?>" class="trip-block" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id() ); ?>');">
      <h1 class="trip-title"><?php the_title(); ?></h1>
    </a>
    <p class="trip-summary"><?php the_excerpt(); ?></p>
  </article>
</div>