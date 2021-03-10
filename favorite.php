<?php
@session_start();

$Root = $_SERVER['DOCUMENT_ROOT'];

require_once($Root . "/office_search/config.php");
require_once($Root . "/office_search/php_lib.php");
require_once($Root . "/office_search/html_lib.php");

$search_type = "favorite";
$cookie_data = array();
foreach ($_COOKIE as $key => $value) {
  array_push($cookie_data, (string)$key);
}

?>

<!DOCTYPE html>
<html lang="ja">

<head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="description"
    content="ご希望の広さ、形状、賃料のオフィスがきっと見つかる！アクセス抜群の立地にある全10棟のラインナップを仲介手数料無料でご提案！！移転時期、空室状況、賃料等なんでもお気軽にご相談ください！大阪の貸オフィス・貸事務所なら若杉におまかせください！" />
  <meta name="keywords" content="貸ビル,貸オフィス,soho,ブランドビル,大阪市の貸ビル,レンタルオフィス,オフィススペース,オフィス賃貸,若杉ビル,マンション、マンション家賃,若杉マンション" />


  <title>検討リスト │ 若杉ビル</title>
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

      //matchHeight
      $('.topicsContent').matchHeight();
    });
  </script>

  <style>
    /* index.phpと共通の部分 */
    .main-officeSearch .favorite_ttl {
      font-size: 32px;
    }

    .main-officeSearch .favorite_ttl span {
      position: relative;
      padding-left: 45px;
    }
    .main-officeSearch .favorite_subttl {
		background: #e7f6fb;
		color: #047298;
		font-size: 21px;
		margin: 10px 0 15px;
		padding: 8px 0 8px 15px;
    }
    .main-officeSearch .favorite_ttl span::before {
      background: url(/image_uniq/office_search/favorite_ttl_ico.png) no-repeat;
      background-size: contain;
      content: "";
      display: inline-block;
      height: 31px;
      position: absolute;
      top: 50%;
      left: 0%;
      transform: translateY(-50%);
      -webkit-transform: translateY(-50%);
      -ms-transform: translateY(-50%);
      width: 34px;
    }

    @media screen and (max-width:767px) {
      .main-officeSearch .search_ttl {
        font-size: 21px;
        margin-bottom: 10px;
      }
	  .main-officeSearch .favorite_subttl {
		font-size: 18px;
		}
    }

    /* index.phpと共通の部分 END */

    .searchResult {
      background: #eff6f8;
      padding: 30px;
      margin-bottom: 20px;
    }

    .searchResult .searchResult_inner {
      position: relative;
    }

    .searchResult .searchResult_body {
      background: #fff;
      box-sizing: border-box;
      padding: 10px 15px;
      width: 74%;
    }

    .searchResult .searchResult_body table {
      display: inline-block;
      padding: 5px 0;
      vertical-align: middle;
    }

    .searchResult .searchResult_body th,
    .searchResult .searchResult_body td {
      line-height: 40px;
      vertical-align: top;
    }

    .searchResult .searchResult_body td {
      padding: 0 30px 0 10px;
      min-width: 52px;
    }

    .searchResult .searchResult_body td>span {
      color: red;
      font-size: 24px;
      font-weight: bold;
      padding-right: 2px;
    }

    .searchResult .searchResult_body th {
      white-space: nowrap;
    }

    .searchResult .searchResult_body th span {
      background: #047298;
      color: #fff;
      display: inline-block;
      font-weight: bold;
      padding: 0 10px;
    }

    .searchResult .searchResult_return {
      position: absolute;
      top: 50%;
      right: 0;
      text-align: center;
      transform: translate(0, -50%);
      width: 24%;
    }

    .searchResult .searchResult_return img {
      vertical-align: middle;
    }

    /* SP */
    @media screen and (max-width:767px) {
      .searchResult {
        padding: 20px;
      }

      .searchResult .searchResult_body {
        margin-bottom: 10px;
        width: 100%;
      }

      .searchResult .searchResult_return {
        position: static;
        transform: none;
        width: 100%;
      }

      .searchResult .searchResult_body table {
        display: block;
      }

      .searchResult .searchResult_body th,
      .searchResult .searchResult_body td {
        font-size: 14px;
        line-height: 25px;
        display: block;
      }

      .searchResult .searchResult_body th {
        text-align: left;
        margin-bottom: 5px;
        width: 65px;
      }

      .searchResult .searchResult_body td {
        padding: 0 20px 0 5px;
        margin-bottom: 10px;
      }

      .searchResult .searchResult_body td>span {
        font-size: 18px;
      }
    }
  </style>
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
            検討リスト<span class="SubMvTtl_en">FAVORITE</span>
          </h2>
        </div>
      </div>

      <div class="breadcrumbs">
        <ul class="breadcrumbs_lists l-inner">
          <li><a href="/">HOME</a></li>
          <li>検討リスト</li>
        </ul>
      </div>
      <!--       オフィス検索　start -->
      <section class="offceSearchSection">

        <section class="showcase topSection topSection-topics">
          <div class="l-inner">
            <h3 id="bukken_mark" class="ts_tit favorite_ttl u-pt60"><span>検討リスト</span></h3>
            <h4 class="favorite_subttl">オフィスビルの検討リスト</h4>
            <ul class="l-grid l-gutter-m ts_lists">
              <?php

                // 物件データを取得（全ビル）
                $data_bukken = getJSON(BLDG_OFFICE_JSON);

                // 物件データがあれば
                if ($data_bukken != null) {


                  // --------------------------------------------
                  // ★絞り込み処理 START

                  $data_new = array();
                  $data_new = getSearchOffice($data_bukken, $search_type, $cookie_data);

                  // ～ 絞り込み処理 END
                  // --------------------------------------------


                  // --------------------------------------------
                  // ★検索情報を取得・出力 START

                  // $search_option = array();
                  // $search_option = getSearchOption($data_new, $search_type, $cookie_data);
                  // htmlSearchOption($search_option);

                  // ～ 検索情報を取得・出力 END
                  // --------------------------------------------

                  foreach ($data_new as $key => $value) {
                    // 物件データを取得する
                    $office_data = getOfficeData($value);

                    // 物件を出力
                    htmlOffice($office_data);
                  }

                }
                ?>

            </ul>

            <h4 class="favorite_subttl">マンションの検討リスト</h4>
            <ul class="l-grid l-gutter-m ts_lists">
              <?php

                // 物件データを取得（全ビル）
                $data_m_bukken = getJSON(MANSION_ROOM_JSON);

                // 物件データがあれば
                if ($data_m_bukken != null) {


                  // --------------------------------------------
                  // ★絞り込み処理 START

                  $data_m_new = array();
                  $data_m_new = getSearchOffice($data_m_bukken, $search_type, $cookie_data);

                  // ～ 絞り込み処理 END
                  // --------------------------------------------


                  // --------------------------------------------
                  // ★検索情報を取得・出力 START

                  // $search_option = array();
                  // $search_option = getSearchOption($data_new, $search_type, $cookie_data);
                  // htmlSearchOption($search_option);

                  // ～ 検索情報を取得・出力 END
                  // --------------------------------------------

                  foreach ($data_m_new as $key => $value) {
                    // 物件データを取得する
                    $room_data = getRoomData($value);

                    // 物件を出力
                    htmlRoom($room_data);
                  }

                }
                ?>

            </ul>
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