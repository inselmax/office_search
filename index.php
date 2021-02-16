<?php
@session_start();

$Root = $_SERVER['DOCUMENT_ROOT'];

require_once($Root . "/office_search/config.php");
require_once($Root . "/office_search/html_lib.php");

// セッションを取得
$form_data = array();
if ($_SESSION['FORM_DATA']) {
	$form_data = $_SESSION['FORM_DATA'];
	var_dump($form_data);
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

	<script>
		$(function() {
			// // テーマ検索（submit実行）
			// $('.theme_label').on('click', function() {
			// 	$('#form_theme').submit();
			// });

			// こだわり検索（リセット）
			$('#resetBtn').on('click', function() {
				$('.SearchBy_cont-kodawari .office_option_input').prop('checked', false);
			});

			//アコーディオン
			$('.search_subttl.search_subttl-acco').on('click', function() {
				var $_target = $(this).next();
				if (!$(this).hasClass('active')) {
					$(this).addClass('active');
					$_target.slideDown();
				} else {
					$(this).removeClass('active');
					$_target.slideUp();
				}
			});
		});
	</script>

	<style>
		.hide {
			display: none;
		}

		.main-officeSearch .SearchSect {
			font-size: 16px;
			padding: 10px 0;
		}

		.main-officeSearch .search_ttl {
			font-size: 32px;
		}

		.main-officeSearch .search_ttl span {
			position: relative;
			padding-left: 45px;
		}

		.main-officeSearch .search_ttl span::before {
			background: url(/image_uniq/office_search/search_ttl_ico.png) no-repeat;
			background-size: contain;
			content: "";
			display: inline-block;
			height: 36px;
			position: absolute;
			top: 50%;
			left: 0%;
			transform: translateY(-50%);
			-webkit-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			width: 36px;
		}

		.SearchSect_wrap {
			border: solid 1px #2778be;
			padding: 10px;
		}

		.SearchSect-kodawari .SearchSect_wrap {
			border: solid 1px #d9752b;
		}

		.SearchSect_wrap .search_subttl {
			background: #3299cf;
			color: #FFF;
			padding: 8px 0;
			font-size: 24px;
			font-weight: bold;
		}

		/* アコーディオン */
		.SearchSect_wrap .search_subttl.search_subttl-acco {
			cursor: pointer;
			position: relative;
		}

		.SearchSect_wrap .search_subttl.search_subttl-acco:after {
			content: "\f055";
			font-family: 'FontAwesome';
			font-size: 36px;
			position: absolute;
			top: 50%;
			right: 20px;
			transform: translate(0, -50%);
		}

		.SearchSect_wrap .search_subttl.search_subttl-acco.active:after {
			content: "\f056";
		}

		.SearchSect_wrap .search_subttl.search_subttl-acco+.search_cont {
			display: none;
		}

		.SearchSect_wrap .search_subttl-02 {
			background: #d9752b;
		}

		.SearchSect_wrap .search_subttl .SearchSubttl_ico {
			position: relative;
			margin-left: 20px;
			padding-left: 45px;
		}

		.SearchSect_wrap .search_subttl-02 .SearchSubttl_ico {
			padding-left: 35px;
		}

		.SearchSect_wrap .search_subttl .SearchSubttl_ico::before {
			content: "";
			display: inline-block;
			height: 25px;
			position: absolute;
			top: 50%;
			left: 0%;
			transform: translateY(-50%);
			-webkit-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
			width: 31px;
		}

		.SearchSect-easy .search_subttl .SearchSubttl_ico::before {
			background: url(/image_uniq/office_search/subttl01_ico.png) no-repeat;
			background-size: contain;
		}

		.SearchSect-kodawari .search_subttl .SearchSubttl_ico::before {
			background: url(/image_uniq/office_search/subttl02_ico.png) no-repeat;
			background-size: contain;
			height: 28px;
			width: 28px;
		}

		.SearchSect-theme .search_subttl .SearchSubttl_ico::before {
			background: url(/image_uniq/office_search/subttl03_ico.png) no-repeat;
			background-size: contain;
			height: 30px;
			width: 30px;
		}

		.SearchSect_wrap .search_cont {
			background: #eff6f8;
			padding: 15px;
		}

		.SearchSect-kodawari .SearchSect_wrap .search_cont {
			background: #f8f2ef;
		}

		.SearchSect_wrap .search_cont .SearchBy {
			padding: 5px 0;
		}

		.SearchSect_wrap .search_cont .SearchBy-kodawari {
			padding: 25px 0;
		}

		.SearchSect_wrap .search_cont .SearchBy_ttl {
			background: #047298;
			color: #FFF;
			display: table-cell;
			font-size: 17px;
			font-weight: 600;
			padding-left: 47px;
			padding-right: 10px;
			position: relative;
			vertical-align: middle;
			width: 250px;
		}

		.SearchSect-kodawari .SearchSect_wrap .SearchBy_ttl {
			background: none;
			color: #d9752b;
			padding-left: 32px;
		}

		.SearchBy .SearchBy_ttl span::before {
			content: "";
			display: inline-block;
			position: absolute;
			top: 50%;
			left: 7%;
			transform: translateY(-50%);
			-webkit-transform: translateY(-50%);
			-ms-transform: translateY(-50%);
		}

		.SearchSect-kodawari .SearchBy_ttl span::before {
			left: 0;
		}

		.SearchBy-area .SearchBy_ttl span:before {
			background: url(/image_uniq/office_search/area_ico.png) no-repeat;
			background-size: contain;
			height: 24px;
			width: 24px;
		}

		.SearchSect-kodawari .SearchBy-area span:before {
			background: url(/image_uniq/office_search/area_ico_orange.png) no-repeat;
			background-size: contain;
			height: 24px;
			width: 24px;
		}

		.SearchSect-kodawari .SearchBy-kodawari span:before {
			background: url(/image_uniq/office_search/kodawari_ico.png) no-repeat;
			background-size: contain;
			height: 23px;
			width: 23px;
		}

		.SearchBy-extent .SearchBy_ttl span:before {
			background: url(/image_uniq/office_search/extent_ico.png) no-repeat;
			background-size: contain;
			height: 22px;
			width: 22px;
		}

		.SearchBy-numb .SearchBy_ttl span:before {
			background: url(/image_uniq/office_search/numb_ico.png) no-repeat;
			background-size: contain;
			height: 19px;
			width: 24px;
		}

		.SearchSect_wrap .search_cont .SearchBy_cont {
			background: #FFF;
			display: table-cell;
			padding: 25px;
			width: 1130px;
		}

		.SearchSect-kodawari .search_cont .SearchBy_cont {
			display: grid;
			gap: 1.25%;
			grid-template-columns: 13.1% 13.1% 13.1% 13.1% 13.1% 13.1% 13.1%;
			margin-top: 15px;
			width: auto;
		}

		.SearchSect-kodawari .search_cont .SearchBy_cont-kodawari {
			display: grid;
			gap: 1.25%;
			grid-template-columns: 18.8% 18.8% 18.8% 18.8% 18.8%;
		}

		.SearchBy_cont-kodawari label {
			margin-bottom: 8px;
		}

		.search_cont .SearchBy_cont .search_size_lightbox {
			padding-left: 0;
		}

		.SearchSect-easy .SearchBy_cont label {
			display: inline-block;
		}

		.search_cont .SearchBy_cont label {
			padding-right: 25px;
		}

		.SearchSect-kodawari .SearchBy_cont>label {
			padding-right: 0;
			text-align: center;
		}

		.search_cont .SearchBy_cont .SearchBy_inputWrap {
			display: inline-block;
		}

		.search_cont .SearchBy_cont .SearchBy_buttonWrap {
			display: inline-block;
		}

		.search_cont .SearchBy_cont input {
			margin-right: 8px;
			padding: 8px 0;
			max-width: 100px
		}

		.SearchSect-kodawari .SearchBy_cont input[type="checkbox"] {
			display: none;
			/*デフォルトのチェックボックスを非表示にする*/
		}

		.SearchSect-kodawari .SearchBy_cont input[type="checkbox"]+.label_check {
			border: solid 1px #dedede;
			cursor: pointer;
			display: inline-block;
			padding: 8px 0;
			position: relative;
			width: 100%;
		}

		.SearchBy_cont input:checked+.label_check {
			background: #f19149;
			color: #FFF;
		}

		.SearchSect .SearchSect_wrap .SearchCont_btn {
			text-align: center;
		}

		/* ボタンフォーカスリセット */
		.SearchSect button:focus {
			outline: none;
		}

		.SearchSect .SearchSect_wrap .SearchBtn {
			background: none;
			border: none;
			cursor: pointer;
			margin-left: 15px;
			padding: 0;
			vertical-align: middle;
			margin-top: 3px;
		}

		.SearchSect .SearchSect_wrap .clear_btn {
			background: none;
			border: none;
			cursor: pointer;
			vertical-align: middle;
		}

		/* テーマで検索 */
		.SearchSect.SearchSect-theme .SearchSect_wrap {
			border: 1px solid #f46991;
		}

		.SearchSect .search_subttl.search_subttl-03 {
			background: #f46991;
		}

		.SearchSect-theme .SearchSect_wrap .search_cont {
			background: #f8eff4;
		}

		/* SP */
		@media screen and (max-width:767px) {

			/* セクション全体 */
			.SearchSect_wrap {
				padding: 5px;
			}

			.SearchSect_wrap .search_cont {
				font-size: 14px;
				padding: 10px;
			}

			.SearchSect_wrap .search_cont .SearchBy_cont {
				box-sizing: border-box;
				padding: 15px;
				width: 100%;
			}

			/* 見出し */
			.SearchSect_wrap .search_subttl {
				font-size: 16px;
			}

			.SearchSect_wrap .search_subttl .small-txt {
				font-size: 11px;
			}

			/* アコーディオン */
			.SearchSect_wrap .search_subttl.search_subttl-acco:after {
				font-size: 24px;
				right: 10px;
			}

			/* 簡単検索 */
			.SearchSect-easy .SearchSect_wrap .search_cont .SearchBy_cont {
				display: block;
			}

			.SearchSect-easy .SearchSect_wrap .search_cont .SearchBy_ttl {
				box-sizing: border-box;
				display: block;
				font-size: 16px;
				padding: 5px 5px 5px 50px;
				width: 100%;
			}

			.SearchSect-easy .SearchBy .SearchBy_ttl span::before {
				left: 4.5%;
			}

			.SearchSect-easy .search_cont .SearchBy_cont label {
				padding: 0;
				width: 50%;
			}

			.SearchSect-easy .search_cont .SearchBy_cont label:first-child {
				width: 100%;
			}

			.SearchSect-easy .search_cont .SearchBy_cont .SearchBy_inputWrap {
				display: block;
				margin: 0 0 10px;
				width: 280px;
			}

			.SearchSect-easy .search_cont .SearchBy_cont .SearchBy_buttonWrap {
				display: block;
				text-align: left;
				width: 100%;
			}

			.SearchSect .SearchSect_wrap .SearchBtn {
				margin-left: 0;
			}

			/* こだわり検索 */
			.SearchSect-kodawari .search_cont .SearchBy_cont {
				gap: 2%;
				grid-template-columns: 49% 49%;
			}
		}
	</style>
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
				<h2 class="search_ttl"><span>オフィス物件検索</span></h2>
			</div>
			<?php
      // 簡単検索
      htmlSearchForm_01( $form_data );
      // こだわり検索
      htmlSearchForm_02( $form_data );
      // テーマで検索
      htmlSearchForm_03();

      // セッションを削除
      if ($_SESSION['FORM_DATA']) {
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