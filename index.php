<?php
@session_start();

$Root = $_SERVER['DOCUMENT_ROOT'];
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
      <div class="l-inner search_inner">
		<h2 class="search_ttl">オフィス物件検索</h2>
      </div>
	  <?php
      require_once($Root . "/office_search/html_lib.php");
      // 簡単検索
      htmlSearchForm_01();
      // こだわり検索
      htmlSearchForm_02();
      // テーマで検索
      htmlSearchForm_03();

      // セッションを削除
      if( $_SESSION['FORM_DATA'] ) {
        unset($_SESSION['FORM_DATA']);
      }
      ?>

    </section>

      <?php
      require_once($Root . "/parts/slider-contact.php");
      require_once($Root . "/parts/footer.php");
      ?>

  </div>
</body>

</html>
