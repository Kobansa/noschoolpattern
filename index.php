<?php get_header(); ?>

  <div id="contents" class="ta_c" style="padding: 120px 0 120px 0">
    <?php
      if ( have_posts() ):
      while ( have_posts() ) :the_post();
      ?>
      <?php the_content(); ?>
      <?php
      endwhile;
      else:
      echo'記事はありません。';
      endif;?>
  </div>
  <!-- contents -->
<?php
get_footer(); ?>
