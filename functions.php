<?php
//wp_header不要項目削除
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head');
remove_action('wp_head', 'feed_links_extra', 3);

//WP自動update停止
add_filter( 'automatic_updater_disabled', '__return_true' );

//本体のアップデート通知を非表示
add_filter('pre_site_transient_update_core', create_function('$a', "return  null;"));

//プラグイン更新通知を非表示
remove_action( 'load-update-core.php', 'wp_update_plugins' );
add_filter( 'pre_site_transient_update_plugins', create_function( '$a', "return null;" ) );

//テーマ更新通知を非表示
remove_action( 'load-update-core.php', 'wp_update_themes' );
add_filter( 'pre_site_transient_update_themes', create_function( '$a', "return null;" ) );

//管理バー非表示
add_filter( 'show_admin_bar', '__return_false' );

//テーマセットアップ
if ( ! function_exists( 'origin_setup' ) ) :
    function origin_setup() {
      // アイキャッチ画像を登録
        add_theme_support( 'post-thumbnails' );
        // アイキャッチ画像のサイズ
        // set_post_thumbnail_size( 247, 191, true );
    }
endif;
add_action( 'after_setup_theme', 'origin_setup' );

//スマートフォンを判別
function is_mobile(){
  $useragents = array(
    'iPhone', // iPhone
    'iPod', // iPod touch
    'Android.*Mobile', // 1.5+ Android *** Only mobile
    'Windows.*Phone', // *** Windows Phone
    'dream', // Pre 1.5 Android
    'CUPCAKE', // 1.5+ Android
    'blackberry9500', // Storm
    'blackberry9530', // Storm
    'blackberry9520', // Storm v2
    'blackberry9550', // Storm v2
    'blackberry9800', // Torch
    'webOS', // Palm Pre Experimental
    'incognito', // Other iPhone browser
   'webmate' // Other iPhone browser
    );
     $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

//固定ページでのビジュアル切替の禁止
function disable_visual_editor_in_page(){
    global $typenow;
    if( $typenow == 'page' ){
        add_filter('user_can_richedit', 'disable_visual_editor_filter');
    }
}
function disable_visual_editor_filter(){
    return false;
}
add_action( 'load-post.php', 'disable_visual_editor_in_page' );
add_action( 'load-post-new.php', 'disable_visual_editor_in_page' );

function origin_wp_title( $title, $sep ) {
  // サイト名を追加する
  $title .= get_bloginfo( 'name' );
  // サイトのキャッチフレーズがある場合、トップページではキャッチフレーズを追加する
  $site_description = get_bloginfo( 'description', 'display' );
  if ( $site_description && ( is_home() || is_front_page() ) ) {
    $title = "$title $sep $site_description";
  }
  return $title;
}
add_filter( 'wp_title', 'origin_wp_title', 10, 2 );

//画像サイズ設定
// add_image_size( 'store-slide', 956, 584, true );

//画像ショートコード
function code_img(){
  return get_template_directory_uri(). '/lib/img/';
}
add_shortcode('sc_img','code_img');

//スタイルシート、スクリプト登録
function origin_scripts() {
  wp_enqueue_style( 'normalize', get_template_directory_uri() . '/vendor/css/normalize.css', array(), '3.0.1' );
  wp_enqueue_style( 'drawer', get_template_directory_uri() . '/vendor/css/drawer.css', array(), '3.2.2' );
  wp_enqueue_style( 'fontawesome',  'https://use.fontawesome.com/releases/v5.6.1/css/all.css', array(), '0.1' );
  wp_enqueue_style( 'style', get_stylesheet_uri(), array() );
  
  wp_enqueue_script( 'jquery' );
  // wp_enqueue_script( 'iscroll', get_template_directory_uri() . '/vendor/js/iscroll.js', array(), '5.2.0', '0.1');
  // wp_enqueue_script( 'bootstrap', 'https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js', array(), '3.3.7', '0.1');
  // wp_enqueue_script( 'drawer.min', get_template_directory_uri() . '/vendor/js/drawer.min.js', array(), '5.2.0', '0.1');
  wp_enqueue_script( 'common-js', get_template_directory_uri() . '/lib/js/common.js', array(), '0.1');
  //TOPページ
  if ( is_front_page() ) {
    // wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/vendor/css/slick.css', array(), '3.2.2' );
    // wp_enqueue_script( 'slick', get_template_directory_uri() . '/vendor/js/slick.min.js', array(), '0.1');
    // wp_enqueue_script( 'top-js', get_template_directory_uri() . '/lib/js/top.js', array(), '0.1');
  }
  // wp_enqueue_style( 'page2', get_template_directory_uri() . '/lib/css/page2.css', array(), '0.1' );
  // if ( is_page("hanbai") ) {
  //   wp_enqueue_script( 'slick', get_template_directory_uri() . '/vendor/js/slick.min.js', array(), '0.1');
  //   wp_enqueue_script( 'hanbai-js', get_template_directory_uri() . '/lib/js/hanbai.js', array(), '0.1');
  // }
  // if ( is_page_template( 'page-storeformat.php' ) ) {
  //   wp_enqueue_script( 'slick', get_template_directory_uri() . '/vendor/js/slick.min.js', array(), '0.1');
  //   wp_enqueue_script( 'storeformat-js', get_template_directory_uri() . '/lib/js/storeformat.js', array(), '0.1');
  // }
  // if ( is_mobile() ) {
  //   wp_enqueue_script( 'easing', get_template_directory_uri() . '/vendor/js/jquery.easing.1.3.min.js', array(), '0.1');
  //   wp_enqueue_script( 'up-js', get_template_directory_uri() . '/lib/js/up.js', array(), '0.1');
  // }
}
add_action( 'wp_enqueue_scripts', 'origin_scripts' );

/*
 * 投稿にアーカイブ(投稿一覧)を持たせるようにします。
 * ※ 記載後にパーマリンク設定で「変更を保存」してください。
 */
// function post_has_archive( $args, $post_type ) {
//   if ( 'post' == $post_type ) {
//     $archive_slug = 'news';
//     $args['rewrite'] = true;
//     $args['has_archive'] = 'news';
//   }
//   return $args;
// }
// add_filter( 'register_post_type_args', 'post_has_archive', 10, 2 );

//  // 「投稿」ラベルを「お知らせ」に変更
// function change_post_menu_label() {
//   global $menu;
//   global $submenu;
//   $menu[5][0] = 'お知らせ';
//   $submenu['edit.php'][5][0] = 'お知らせ一覧';
//   $submenu['edit.php'][10][0] = '新規追加';
// }
//  function change_post_object_label() {
//   global $wp_post_types;
//   $labels = &$wp_post_types['post']->labels;
//   $labels->name = 'お知らせ';
//   $labels->singular_name = 'お知らせ';
//   $labels->name_admin_bar = 'お知らせ';
//   $labels->add_new = '新規追加';
//   $labels->add_new_item = 'お知らせを追加';
//   $labels->edit_item = 'お知らせの編集';
//   $labels->new_item = '新規お知らせ';
//   $labels->view_item = 'お知らせを表示';
//   $labels->search_items = 'お知らせを検索';
//   $labels->not_found = 'お知らせが見つかりませんでした';
//   $labels->not_found_in_trash = 'ゴミ箱にお知らせは見つかりませんでした';
//  }
// add_action( 'init', 'change_post_object_label' );
// add_action( 'admin_menu', 'change_post_menu_label' );

//カスタム投稿タイプ、カスタム分類登録
// function origin_post_type() {
//   register_post_type( 'item', array(
//     'labels' => array( 'name' => 'item' ),
//     'public' => true,
//     'menu_position' => 6,
//     'supports' => array( 'title', 'editor', 'thumbnail', 'revisions','custom-fields' ),
//     'has_archive' => true,
//   ) );
//   register_taxonomy( 'cat','item', array(
//     'labels' => array( 'name' => 'カテゴリー' ),
//     'hierarchical' => true,
//   ) );
// }
// add_action( 'init', 'origin_post_type', 1 );

// function add_posts_columns($columns) {
//   $columns['store_cat'] = '店舗';
//   $columns['store_entry'] = '区分け';
//   $columns['store_item'] = '品目';
//   $columns['store_area'] = '地域';
//   return $columns;
// }
// function add_posts_columns_list($column_name, $post_id) {
//   if ( 'store_cat' == $column_name ) {
//     $terms = $terms = get_the_terms( $id, 'store_cat' );
//     $cnt = 0;
//     foreach((array)$terms as $var) {
//       echo $cnt != 0 ? ", " : "";
//       echo "" . $var->name . "";
//       ++$cnt;
//     }
//   } elseif ( 'store_entry' == $column_name ) {
//     $terms = $terms = get_the_terms( $id, 'store_entry' );
//     $cnt = 0;
//     foreach((array)$terms as $var) {
//       echo $cnt != 0 ? ", " : "";
//       echo "" . $var->name . "";
//       ++$cnt;
//     }
//   }
//   elseif ( 'store_item' == $column_name ) {
//     $terms = $terms = get_the_terms( $id, 'store_item' );
//     $cnt = 0;
//     foreach((array)$terms as $var) {
//       echo $cnt != 0 ? ", " : "";
//       echo "" . $var->name . "";
//       ++$cnt;
//     }
//   }
//   elseif ( 'store_area' == $column_name ) {
//     $terms = $terms = get_the_terms( $id, 'store_area' );
//     $cnt = 0;
//     foreach((array)$terms as $var) {
//       echo $cnt != 0 ? ", " : "";
//       echo "" . $var->name . "";
//       ++$cnt;
//     }
//   }
// }
// add_filter( 'manage_edit-stores_columns', 'add_posts_columns' );
// add_action( 'manage_stores_posts_custom_column', 'add_posts_columns_list', 10, 2 );
// function my_custom_post_type_permalinks_set($termlink, $term, $taxonomy){
//     return str_replace('/'.$taxonomy.'/', '/', $termlink);
// }
// add_filter('term_link', 'my_custom_post_type_permalinks_set',11,3);

// 今の天気を表示する
function ryus_weather($atts) {
    /* 引数を展開する */
    extract(
        shortcode_atts(
            array(
                'id' => 1853909,
                'city' => 'Osaka-shi',
                'country' => 'jp',
                'appid' => 'ba8ed4b49d5b659944c79d2354738001',
            ),
            $atts
        )
    );
    // 天気の表示用html 適宜変更しましょう
    // 確認のため、都市名をdisplay:noneでコーディングしてあるので必要があれば表示してみてください
    $weatherShow = '
    <p class="h-weather">大阪市 <span>%s℃</span> %s</p>';

    $url = sprintf('http://api.openweathermap.org/data/2.5/weather?q=%s,%s&units=metric&appid=%s', $city, $country, $appid);
    $weather = json_decode(file_get_contents($url), true);

    // openweathermapで取得した全ての値を見たいときは下のコメントを外して投稿や固定ページでショートコードを表示してみてください。
    //echo "<pre>";var_dump($weather);echo "</pre>";

    // tenki は晴れ、曇、雨、雪です。現在のコードでは表示してません。表示したいときは$tenkiを使ってください
    $tenki = _ryusWheatherTranslate($weather['weather'][0]['main']);
    $kazamuki = _ryusWehatherWindDigree($weather['wind']['deg']);
    $description = _ryusWheatherDescription($weather['weather'][0]['id']);
    $temp = round($weather['main']['temp'], 1);
    $icon = str_replace('n', 'd', $weather['weather'][0]['icon']);
    // 天気の表示用html を変更したときは、この下の値設定も変える必要がある場合があります
    return sprintf($weatherShow,$temp,$tenki );
}

// 天気を日本語にする
function _ryusWheatherTranslate($main){
    $mainLower = mb_strtolower($main);
    $inEnglish = array('clear', 'clouds', 'rain', 'snow');
    $inJapanese = array('晴れ', 'くもり', '雨', '雪');
    $key = array_search($mainLower, $inEnglish);
    if ($key === false){
        return $main;
    } else {
        return $inJapanese[$key];
    }
}

// 天気詳細を日本語にする
function _ryusWheatherDescription($id){
    $description = array();
    $description[200] = '小雨と雷雨';
    $description[201] = '雨と雷雨';
    $description[202] = '大雨と雷雨';
    $description[210] = '光雷雨';
    $description[211] = '雷雨';
    $description[212] = '重い雷雨';
    $description[221] = 'ぼろぼろの雷雨';
    $description[230] = '小雨と雷雨';
    $description[231] = '霧雨と雷雨';
    $description[232] = '重い霧雨と雷雨';
    $description[300] = '光強度霧雨';
    $description[301] = '霧雨';
    $description[302] = '重い強度霧雨';
    $description[310] = '光強度霧雨の雨';
    $description[311] = '霧雨の雨';
    $description[312] = '重い強度霧雨の雨';
    $description[313] = 'にわかの雨と霧雨';
    $description[314] = '重いにわかの雨と霧雨';
    $description[321] = 'にわか霧雨';
    $description[500] = '小雨';
    $description[501] = '適度な雨';
    $description[502] = '重い強度の雨';
    $description[503] = '非常に激しい雨';
    $description[504] = '極端な雨';
    $description[511] = '雨氷';
    $description[520] = '光強度のにわかの雨';
    $description[521] = 'にわかの雨';
    $description[522] = '重い強度にわかの雨';
    $description[531] = '不規則なにわかの雨';
    $description[600] = '小雪';
    $description[601] = '雪';
    $description[602] = '大雪';
    $description[611] = 'みぞれ';
    $description[612] = 'にわかみぞれ';
    $description[615] = '光雨と雪';
    $description[616] = '雨や雪';
    $description[620] = '光のにわか雪';
    $description[621] = 'にわか雪';
    $description[622] = '重いにわか雪';
    $description[701] = 'ミスト';
    $description[711] = '煙';
    $description[721] = 'ヘイズ';
    $description[731] = '砂、ほこり旋回する';
    $description[741] = '霧';
    $description[751] = '砂';
    $description[761] = 'ほこり';
    $description[762] = '火山灰';
    $description[771] = 'スコール';
    $description[781] = '竜巻';
    $description[800] = '晴天';
    $description[801] = '薄い雲';
    $description[802] = '雲';
    $description[803] = '曇りがち';
    $description[804] = '厚い雲';
    if (array_key_exists($id, $description) === false) {
        return $id;
    }
    return $description[$id];
}
// 風向きを表現する
function _ryusWehatherWindDigree($digree){
    $windDigree = array();
    $windDigree['北'] = array(337.5, 382.5);
    $windDigree['北東'] = array(22.5, 67.5);
    $windDigree['東'] = array(67.5, 112.5);
    $windDigree['南東'] = array(112.5, 157.5);
    $windDigree['南'] = array(157.5, 202.5);
    $windDigree['南西'] = array(202.5, 247.5);
    $windDigree['西'] = array(247.5, 292.5);
    $windDigree['北西'] = array(292.5, 337.5);
    if($digree < 22.5){
        $digree += 360;
    }
    foreach($windDigree as $kazamuki => $fromTo){
        if(($fromTo[0] <= $digree) AND ($digree < $fromTo[1])){
            return $kazamuki;
            break;
        }
    }
    return '';
}
/* ショートコードを追加する */
add_shortcode('ryus_weather', 'ryus_weather');







//追記　
//Twitterコード
/*********************
OGPタグ/Twitterカード設定を出力
*********************/
function my_meta_ogp() {
  if( is_front_page() || is_home() || is_singular() ){
    global $post;
    $ogp_title = '';
    $ogp_descr = '';
    $ogp_url = '';
    $ogp_img = '';
    $insert = '';

    if( is_singular() ) { //記事＆固定ページ
       setup_postdata($post);
       $ogp_title = $post->post_title;
       $ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
       $ogp_url = get_permalink();
       wp_reset_postdata();
    } elseif ( is_front_page() || is_home() ) { //トップページ
       $ogp_title = get_bloginfo('name');
       $ogp_descr = get_bloginfo('description');
       $ogp_url = home_url();
    }

    //og:type
    $ogp_type = ( is_front_page() || is_home() ) ? 'website' : 'article';

    //og:image
    if ( is_singular() && has_post_thumbnail() ) {
       $ps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full');
       $ogp_img = $ps_thumb[0];
    } else {
     $ogp_img = '';
    }

    //出力するOGPタグをまとめる
    $insert .= '<meta property="og:title" content="'.esc_attr($ogp_title).'" />' . "\n";
    $insert .= '<meta property="og:description" content="'.esc_attr($ogp_descr).'" />' . "\n";
    $insert .= '<meta property="og:type" content="'.$ogp_type.'" />' . "\n";
    $insert .= '<meta property="og:url" content="'.esc_url($ogp_url).'" />' . "\n";
    $insert .= '<meta property="og:image" content="'.esc_url($ogp_img).'" />' . "\n";
    $insert .= '<meta property="og:site_name" content="'.esc_attr(get_bloginfo('name')).'" />' . "\n";
    $insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
    $insert .= '<meta name="twitter:site" content="@noschoolpattern" />' . "\n";
    $insert .= '<meta property="og:locale" content="ja_JP" />' . "\n";

    //facebookのapp_id（設定する場合）
    //$insert .= '<meta property="fb:app_id" content="ここにappIDを入力">' . "\n";
    //app_idを設定しない場合ここまで消す

    echo $insert;
  }
} //END my_meta_ogp

add_action('wp_head','my_meta_ogp');//headにOGPを出力
