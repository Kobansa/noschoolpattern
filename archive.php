<?php
get_header(); ?>

<div id="content">
  <section>
    <div id="top-entry">
      <ul class="flex_wrap">
        <?php
        if ( have_posts() ):
        while ( have_posts() ) :the_post();
        $pattern = SCF::get( 'pattern' );
        $name = SCF::get( 'name' );
        ?>
        <li>
          <a href="<?php the_permalink(); ?>">
            <p class="t-entry-day"><?php the_time('Y.m.d'); ?></p>
            <p class="t-entry-pt"><?php echo esc_html( $pattern ) ?></p>
            <?php the_post_thumbnail('full'); ?>
            <p class="t-entry-ttl"><?php the_title(); ?><br><span><?php echo esc_html( $name ) ?></span></p>
          </a>
        </li>
        <?php
        endwhile;
        else:
        echo'記事はありません。';
        endif;?>
      </ul>
    </div>
    <!-- top-entry -->
    
  </section>
  
</div>
<!-- content -->

<?php
get_footer();
?>
