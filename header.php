<!DOCTYPE html>
<html lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<title><?php wp_title('|', true, 'right'); ?></title>

<meta property="og:title" content="<?php wp_title('|', true, 'right'); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class("drawer drawer--top");?>>

  <div class="wrap flex_box">
    <header>
      <div id="header">
        <div class="h-box">
          <div class="h-weatherbox">

            <p class="h-day"><?php echo date_i18n("Y.m.d");?></p>
            <?php echo do_shortcode('[ryus_weather]'); ?>
          </div>
          <!-- h-weatherbox -->

          <h1><a href="<?php echo esc_url(home_url('/')); ?>"><img src="<?php echo esc_url( get_template_directory_uri()); ?>/lib/img/common/logo-h1.png" alt="学校に行かないパターン"></a></h1>
        </div>
        <!-- h-box -->
       <!--  <p class="h-copy pc">学校に行かないときってどうしてる？</p>
        <p class="h-caution pc">「# 学校に行かないパターン」は学外活動によるわかもののキャリア形成をわかものと共に考えていくプロジェクト。</p> -->

        <?php if(!is_mobile()) { ?>
        <div id="h-pc" class="pc">
          <div id="twiiter-box">
            <a class="twitter-timeline" width="260px" height="400px" href="https://twitter.com/noschoolpattern?ref_src=twsrc%5Etfw">Tweets by 学校に行かないパターン</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
          </div>
          <!-- twiiter-box -->
          <p class="h-copyright">Copyright©<br>パラソル All Rights Reserved.</p>
        </div>
        <?php } ?>
      </div>
      <!-- header -->
    </header>
