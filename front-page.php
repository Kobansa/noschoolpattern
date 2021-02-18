<?php
/*
Template Name: front
*/
?>
<?php get_header(top); ?>

<div id="content">
  <section>
    <style>
    .menu {
  list-style-type: none;
  margin: 0;
  padding: 30;
  overflow: hidden;

  background: url(lib/img/common/clear.png);
}
.menu li {
  float: right;
  border-right: 1px ;
  /**solid #f5f5f5**/

}
.menu li:last-child {
  border-right: none;
}
 .menu li a {
  display: block;
  /**color: black;**/
  text-align: center;
  padding: 14px 26px;
  text-decoration: none;
}
.menu li a:hover:not(.active) {
background-color: #f5f5f5;
}
</style>
    <ul class="menu">
      <li><a href="/2019/01/30/who-we-are/">Who we are</a></li>
      <li><a href="/contact">Contact</a></li>
      <li><a href="/2019/01/30/about/">About</a></li>
      <li><a href="/2019/01/31/event/">Event</a></li>
    </ul>
    <?php echo do_shortcode( '[metaslider id="208"]'); ?>
  </section>
  <section>
    <div id="top-entry">
      <ul class="flex_wrap">
        <?php
        $args = array(
          'post_type' => 'post',
          'post_status' => 'publish',
          'posts_per_page' => 12,
          'orderby' => 'date',
          'order' => 'DESC',
        );
        $newsposts = get_posts($args);
          if ($newsposts) : foreach ( $newsposts as $post ) : setup_postdata( $post );
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
        endforeach;
        wp_reset_postdata();
        //else:
        //echo '記事はありません' ;
        endif; ?>
      </ul>
    </div>
    <!-- top-entry -->
    
  </section>
  
</div>
<!-- content -->

<?php
get_footer();
?>
