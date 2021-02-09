<?php
@session_start();

$Root = $_SERVER['DOCUMENT_ROOT'];

require_once($Root . "/office_search/config.php");
require_once($Root . "/office_search/php_lib.php");
require_once($Root . "/office_search/html_lib.php");

// フォームデータをセット
$form_data = array();
if( $_POST ) {
  $_SESSION['FORM_DATA'] = $_POST;
  $form_data = $_POST;
}elseif( $_SESSION['FORM_DATA'] ) {
  $form_data = $_SESSION['FORM_DATA'];
}

// 現在のページを取得
$page_current = 1;
if (!empty($_GET["page"]) && $_GET["page"] != "") {
  $page_current = $_GET["page"];
}

?>

<!DOCTYPE html>
<html lang="ja">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="ご希望の広さ、形状、賃料のオフィスがきっと見つかる！アクセス抜群の立地にある全10棟のラインナップを仲介手数料無料でご提案！！移転時期、空室状況、賃料等なんでもお気軽にご相談ください！大阪の貸オフィス・貸事務所なら若杉におまかせください！" />
	<meta name="keywords" content="貸ビル,貸オフィス,soho,ブランドビル,大阪市の貸ビル,レンタルオフィス,オフィススペース,オフィス賃貸,若杉ビル,マンション、マンション家賃,若杉マンション" />


  <title>オフィス検索 │ 若杉ビル</title>
  <!-- <title>若杉ビル│大阪市の貸ビル、賃貸オフィススペースの若杉</title> -->


  <?php
  require_once($Root . "/parts/ogp.php");
  echo ogpSouceCode('');
  ?>

  <link rel="stylesheet" href="/css/font-awesome.min.css">
  <link rel="stylesheet" href="/slick/slick.css">
	<link rel="stylesheet" href="/slick/slick-theme.css">
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/lightbox/css/lightbox.min.css">
  <!-- <link rel="stylesheet" href="/noto_serif/css/noto-serif.css"> -->
  <!-- <link rel="stylesheet" href="/noto_serif/css/default.css"> -->
  <link href="https://fonts.googleapis.com/css?family=Noto+Serif+JP:300,500&amp;subset=japanese" rel="stylesheet">

  <script src="/js/jquery.min.js"></script> <!-- 最新版があればダウンロード ※~IE8対応の場合は、jQuery1.xの最新版 -->
  <script src="/js/smoothscroll.js"></script>
  <script src="/js/setcookie2.js"></script>
  <script src="/js/jquery.matchHeight.js"></script>
  <script src="/js/common.js"></script>
  <script src="/slick/slick.min.js"></script>
 <script src="/lightbox/lightbox.min.js"></script>
  <!-- /javascript -->

  <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
<![endif]-->

  <script>
        // ---------------slick slider-----------------
        $(function() {
          $('.js-slick01').slick({
          autoplay: false,
          autoplaySpeed: 5000,
          arrows: true,
          dots: false,
          slidesToShow: 4,
          slidesToScroll: 4,
          //レスポンシブでの動作を指定
          responsive: [{
            breakpoint: 1520, //ブレイクポイントを指定
            settings: {
              arrows: false,
              slidesToShow: 3,
            }
          }, {
            breakpoint: 1200, //ブレイクポイントを指定
            settings: {
              arrows: false,
              slidesToShow: 3,
            }
          },
           {
            breakpoint: 767,
            // settings: 'unslick',
            settings: {
              arrows: true,
              dots: true,
              centerMode: true,
				      centerPadding: '40px',
              slidesToShow: 1,
            }
          },
           {
            breakpoint: 400,
            // settings: 'unslick',
            settings: {
              arrows: true,
              dots: true,
              centerMode: true,
				      centerPadding: '20px',
              slidesToShow: 1,
            }
          }
        ],
        });
  });
  </script>
</head>

<body>
  <div class="wrap wrap-officeSearch">

    <?php
    require_once($Root . "/parts/header.php");
    ?>

    <section class="main main-officeSearch l-main">

      <div class="subMv subMv-building">
        <div class="subMv_inner">
          <h2 class="subMv_tit">
            オフィス検索<span class="SubMvTtl_en">OFFICE SEARCH</span>
          </h2>
        </div>
      </div>

      <div class="breadcrumbs">
        <ul class="breadcrumbs_lists l-inner">
          <li><a href="/">HOME</a></li>
          <li>オフィス検索</li>
        </ul>
      </div>
      <!--       オフィス検索　start -->
      <section class="offceSearchSection">

        <section class="showcase topSection topSection-topics">
          <div class="l-inner">
            <h3 id="bukken_mark" class="ts_tit heading01 u-pt60">見つかった物件</h3>
            <ul class="l-grid l-gutter-m ts_lists">
              <?php

              // 物件データを取得（全ビル）
              $data_bukken = getJSON( BLDG_OFFICE_JSON );

              // 物件データがあれば
              if( $data_bukken != null ){


                // --------------------------------------------
                // ▼絞り込み処理 START

                $data_new = array();
                $data_new = getSortOffice( $data_bukken, $form_data );

                // ▲絞り込み処理 END
                // --------------------------------------------


                // ページャー情報を取得
                $PageNavi =  getPageNavi( $data_new, $page_current );

                // カウント用
                $show_count = 0;

                foreach ($data_new as $key => $value) {

                  $show_count++;

                  if( $show_count > $PageNavi['start_num'] ) {

                    if( $show_count == $PageNavi['end_num'] ) {
                      break;
                    }

                    // 物件データを取得する
                    $office_data = getOfficeData( $value );

                    // 物件を出力
                    htmlOffice( $office_data );

                  }
                }
                ?>

              </ul>

            <?php
              // ページナビを出力
              htmlPageNavi( $page_current, $PageNavi['total_page'] );
            }
             ?>

          </div>
        </section>

      </section>
      <!--  オフィス検索 END -->


    </section>

      <?php
      require_once($Root . "/parts/slider-contact.php");
      require_once($Root . "/parts/footer.php");
      ?>

  </div>
</body>

</html>
