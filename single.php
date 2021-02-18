<?php
get_header(); ?>

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
  </section>
  <section>
    <div id="single-entrys">
      <?php
      if ( have_posts() ):
      while ( have_posts() ) :the_post();
      $pattern = SCF::get( 'pattern' );
      // $name = SCF::get( 'name' );
      $intro = SCF::get( 'intro' );
      ?>
      <div class="single-thum">
        <?php the_post_thumbnail('full'); ?>
      </div>
      <!-- single-thum -->
      <div class="single-content box01">
        <div class="single-intro">

          <h1 class="single-ttl"><?php the_title(); ?><p class="single-pattern"><?php echo esc_html( $pattern ) ?></p></h1>
          <p class="single-day"><?php the_time('Y.m.d'); ?></p>
          <div class="single-intro-txt">
            <?php echo nl2br(esc_html($intro)); ?>
          </div>
        </div>
        <!-- single-intro -->

        <div class="single-entry">
          <?php the_content(); ?>
        </div>


        <a href="<?php echo esc_url(home_url('/')); ?>" class="btn-single">戻る</a>


        <ul class="single-social flex_between">
          <li><a href="http://twitter.com/intent/tweet?text=<?php echo urlencode(the_title("","",0)); ?>&amp;<?php echo urlencode(get_permalink()); ?>&amp;url=<?php echo urlencode(get_permalink()); ?>" target="_blank" title="Twitterで共有"><i class="fab fa-twitter fa-2x"></i></a></li>
          <li><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink()); ?>&amp;t=<?php echo urlencode(the_title("","",0)); ?>" target="_blank" title="facebookで共有"><i class="fab fa-facebook-f fa-2x"></i></a></li>
          <li><a href="http://line.naver.jp/R/msg/text/?<?php the_title(); ?>%0D%0A<?php the_permalink(); ?>" target="_blank" title="LINEで送る"><img src="<?php echo esc_url( get_template_directory_uri()); ?>/lib/img/common/icon-line.png" alt="LINE"></i></a></li>
        </ul>
        <?php
        endwhile;
        else:
        echo'記事はありません。';
        endif;?>
      </div>
      <!-- single-content -->


    </div>
    <!-- news-section -->
  </section>
</div>
<!-- content -->

<?php
get_footer();
?>
