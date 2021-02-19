<?php
@session_start();

$Root = $_SERVER['DOCUMENT_ROOT'];

require_once($Root . "/office_search/config.php");
require_once($Root . "/office_search/html_lib.php");

// セッションを取得
$form_data = array();
if ($_SESSION['FORM_DATA']) {
    $form_data = $_SESSION['FORM_DATA'];
    //var_dump($form_data);
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
	<link rel="stylesheet" href="/office_search/css/style.css">
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

			// エリアチェック
			function inputCheck( $_this, $_formId ) {
				// オブジェクトを格納
				var $_input = $_this.children('input');;
				// 値を格納
				var areaVal = $_input.val();
				// 状態を格納
				var isChecked = $_input.prop('checked');
				// チェック済みの要素を配列に格納（南森町～京橋）
				var checkedList = $($_formId + ' [class="area_item_input"]:checked').map(function(){ return $(this).val(); }).get();
				// チェックをカウント
				var countNum = checkedList.length;

				// 分岐処理
				if( areaVal === "all" ) {
					if( isChecked ) {
						$($_formId + " .area_label.area_item input[type='checkbox']").prop("checked", true);
					}else {
						$($_formId + " .area_label.area_item input[type='checkbox']").prop("checked", false);
					}
				}else {
					// 全部にチェックが入っていれば全エリアにチェックを入れる
					if( countNum > 5 ) {
						$($_formId + " .area_label.area_all input[type='checkbox']").prop("checked", true);
					}else {
						$($_formId + " .area_label.area_all input[type='checkbox']").prop("checked", false);
					}
				}
			}

			// 簡単検索のエリアクリックイベント
			$("#form_kantan .area_label").on('click', function(){
				inputCheck( $(this), "#form_kantan" );
			});

			// こだわり検索のエリアクリックイベント
			$("#form_kodawari .area_label").on('click', function(){
				inputCheck( $(this), "#form_kodawari" );
			});

		});
	</script>

	<style>
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
      htmlSearchForm_01($form_data);
      // こだわり検索
      htmlSearchForm_02($form_data);
      // テーマで検索
      htmlSearchForm_03($form_data);

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