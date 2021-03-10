<?php

$Root = $_SERVER['DOCUMENT_ROOT'];

require_once($Root . "/office_search/config.php");
require_once($Root . "/office_search/php_lib.php");



// --------------------------------------------------------
// ・簡単検索
// $session_data Array
//
// HTML
//
function htmlSearchForm_01( $session_data ) {

	$form_flg = false;
	if( !empty($session_data['form_submit']) && $session_data['form_submit'] === "hito" || $session_data['form_submit'] === "tsubo" ) {
		$form_flg = true;
	}

?>

<section class="SearchSect SearchSect-easy">
	<div class="l-inner search_inner">
		<dl class="SearchSect_wrap">
			<dt class="search_subttl search_subttl-01"><span class="SearchSubttl_ico">簡単検索</span></dt>
			<dd class="search_cont">
				<form id="form_kantan" action="/office_search/search.php#bukken_mark" method="post"
					enctype="multipart/form-data">
					<div class="SearchBy SearchBy-area">
						<div class="SearchBy_ttl"><span>まずはエリアを選択</span></div>
						<div class="SearchBy_cont">
							<label class="area_label area_all"><input type="checkbox" name="area_all" value="all" <?php if($session_data['area_all'] && $form_flg) echo 'checked'; ?>> 全エリア</label>
							<?php
								$area_item_flg = null;
								if( $session_data['area_item'] && $form_flg ) {
									$area_item_flg = true;
								}
								foreach (AREA_NAME as $key => $value) {
									if( $area_item_flg ) {
										$checked = "";
										if ( in_array(sprintf('%02d', ($key)), $session_data['area_item'], true) ) {
											$checked = "checked";
										}
									}
									echo '<label class="area_label area_item"><input class="area_item_input" type="checkbox" name="area_item[]" value="' . sprintf('%02d', ($key)) . '" ' . $checked . '> ' . $value . '</label>';
								}
							?>
						</div>
					</div>
					<div class="SearchBy SearchBy-extent">
						<div class="SearchBy_ttl"><span>広さで検索</span></div>
						<div class="SearchBy_cont">
							<p class="u-pb5">
								<a href="/image_uniq/graph_img.png" class="search_size_lightbox" data-lightbox="areaimg"
									rel="lightbox">業種ごとの1人当たりの目安坪数</a>
							</p>
							<div class="SearchBy_inputWrap">
							<input type="text" name="tsubo_min" value="<?php if($session_data['tsubo_min'] && $form_flg) echo escString($session_data['tsubo_min']); ?>"> 坪～　<input type="text" name="tsubo_max" value="<?php if($session_data['tsubo_max'] && $form_flg) echo escString($session_data['tsubo_max']); ?>"> 坪
							</div>
							<div class="SearchBy_buttonWrap">
								<button type="submit" name="form_submit" value="tsubo"
									class="SearchBtn SearchBtn-blue"><img src="/image_uniq/office_search/search_btn.png"
										alt=""></button>
							</div>
						</div>
					</div>
					<div class="SearchBy SearchBy-numb">
						<div class="SearchBy_ttl"><span>従業員数で検索</span></div>
						<div class="SearchBy_cont">
							<p class="small-txt u-pb5">※1人あたり3坪計算</p>
							<div class="SearchBy_inputWrap">
							<input type="text" name="hito_min" value="<?php if($session_data['hito_min'] && $form_flg) echo escString($session_data['hito_min']); ?>"> 人～　<input type="text" name="hito_max" value="<?php if($session_data['hito_max'] && $form_flg) echo escString($session_data['hito_max']); ?>"> 人
							</div>
							<div class="SearchBy_buttonWrap">
								<button type="submit" name="form_submit" value="hito"
									class="SearchBtn SearchBtn-blue"><img src="/image_uniq/office_search/search_btn.png"
										alt=""></button>
							</div>
						</div>
					</div>
				</form>
			</dd>
		</dl>
	</div>
</section>
<?php
}


// --------------------------------------------------------
// ・こだわり検索
// $session_data Array
//
// HTML
//
function htmlSearchForm_02( $session_data ) {

	$form_flg = false;
	if( !empty($session_data['form_submit']) && $session_data['form_submit'] === "kodawari" ) {
		$form_flg = true;
	}

?>
<section class="SearchSect SearchSect-kodawari">
	<div class="l-inner search_inner">
		<dl class="SearchSect_wrap">
			<dt class="search_subttl search_subttl-02 search_subttl-acco <?php if($form_flg) echo 'active'; ?>"><span class="SearchSubttl_ico">こだわり検索</span>
				<span class="small-txt">※複数選択可能</span></dt>
			<dd class="search_cont" style="<?php if($form_flg) echo 'display: block'; ?>">
				<form id="form_kodawari" action="/office_search/search.php#bukken_mark" method="post"
					enctype="multipart/form-data">
					<div class="SearchBy SearchBy-area">
						<div class="SearchBy_ttl"><span>まずはエリアを選択</span></div>
						<div class="SearchBy_cont">
							<label class="area_label area_all"><input type="checkbox" name="area_all" value="all" <?php if($session_data['area_all'] && $form_flg) echo 'checked'; ?>><span class="label_check">全エリア</span></label>
							<?php
								$area_item_flg = null;
								if( $session_data['area_item'] && $form_flg ) {
									$area_item_flg = true;
								}
                                foreach (AREA_NAME as $key => $value) {
									if( $area_item_flg ) {
										$checked = "";
										if ( in_array(sprintf('%02d', ($key)), $session_data['area_item'], true) ) {
											$checked = "checked";
										}
									}
                                    echo '<label class="area_label area_item"><input class="area_item_input" type="checkbox" name="area_item[]" value="' . sprintf('%02d', ($key)) . '" ' . $checked . '> <span class="label_check">' . $value . '</span></label>';
                                }
							?>
						</div>
						<div>
							<div class="SearchBy SearchBy-kodawari">
								<div class="SearchBy_ttl"><span>こだわり条件を選択</span></div>
								<div class="SearchBy_cont SearchBy_cont-kodawari">
									<?php
										$op_ary = array();
										if( $session_data['office_option'] && $form_flg ) {
											$op_ary = $session_data['office_option'];
										}
									?>
									<label><input <?php if(!empty($op_ary) && in_array("J", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="J"> <span class="label_check">駅スグ</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("I", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="I"> <span class="label_check">駅直結</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("D", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="D"> <span class="label_check">貸会議室</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("E", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="E"> <span class="label_check">貸駐車場</span></label>
									<label><input <?php if($session_data['office_option_1fk'] && $form_flg) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option_1fk" value="1fk"> <span class="label_check">1Fコンビニ</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("P", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="P"> <span class="label_check">EVリニューアル</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("O", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="O"> <span class="label_check">空調リニューアル</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("N", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="N"> <span class="label_check">給湯室リニューアル</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("M", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="M"> <span class="label_check">トイレリニューアル</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("B", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="B"> <span class="label_check">個別空調</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("C", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="C"> <span class="label_check">光回線</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("L", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="L"> <span class="label_check">OAフロア対応</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("F", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="F"> <span class="label_check">ビル前ポスト</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("G", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="G"> <span class="label_check">管理人常駐</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("Q", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="Q"> <span class="label_check">防犯カメラ</span></label>
									<label><input <?php if(!empty($op_ary) && in_array("A", $op_ary, true)) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option[]" value="A"> <span class="label_check">24時間利用</span></label>
									<label><input <?php if($session_data['office_option_10fmin'] && $form_flg) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option_10fmin" value="10fmin"> <span class="label_check">高階層(10階以上)</span></label>
									<label><input <?php if($session_data['office_option_3fmin'] && $form_flg) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option_3fmin" value="3fmin"> <span class="label_check">低階層(3階以上)</span></label>
									<label><input <?php if($session_data['office_option_fmax'] && $form_flg) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option_fmax" value="fmax"> <span class="label_check">最上階</span></label>
									<label><input <?php if($session_data['office_option_1fshop'] && $form_flg) echo 'checked'; ?> class="office_option_input" type="checkbox" name="office_option_1fshop" value="1fshop"> <span class="label_check">1F店舗空物件</span></label>
								</div>
							</div>
						</div>
						<div class="SearchCont_btn">
							<span id="resetBtn" class="clear_btn"><img src="/image_uniq/office_search/clear_btn.png"
									alt=""></span>
							<button type="submit" name="form_submit" value="kodawari"
								class="SearchBtn SearchBtn-blue"><img
									src="/image_uniq/office_search/search_btn_orange.png" alt=""></button>
						</div>
				</form>
	</div>
	</div>
</section>
<?php
}


// --------------------------------------------------------
// ・テーマで検索
// $session_data Array
//
// HTML
//
function htmlSearchForm_03( $session_data ) {

	$form_flg = false;
	if( !empty($session_data['stype']) && $session_data['stype'] === "theme" ) {
		$form_flg = true;
	}

?>
<section class="SearchSect SearchSect-theme">
	<div class="l-inner search_inner">
		<div class="SearchSect_wrap">
			<p class="search_subttl search_subttl-03 search_subttl-acco <?php if($form_flg) echo 'active'; ?>"><span class="SearchSubttl_ico">テーマで検索</span>
			</p>
			<div class="search_cont" style="<?php if($form_flg) echo 'display: block'; ?>">
				<!-- <form id="form_theme" action="/office_search/search.php#bukken_mark" method="post"
					enctype="multipart/form-data">
					<div>
						<?php
            foreach (SEARCH_THEME_NAME as $key => $value) {
                $checked = '';
                if ($key < 1) {
                    $checked = 'checked';
                }
                echo '<label class="theme_label"><input class="hide" type="radio" name="theme_type" value="' . sprintf('%02d', ($key)) . '" ' . $checked . '>' . $value . '</label>';
            } ?>
				<input type="hidden" name="form_submit" value="theme">
				<input class="hide" type="submit">
			</div>
			</form> -->
			<ul class="ts_menu l-grid l-gutter-s">
				<li class="l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-6-sp">
					<p class="ButtonD-light ButtonD-icon ButtonD-arrow">
						<a href="/office_search/search.php?stype=theme&theme=01">
							<span class="ButtonD_inner ButtonD_inner-01">SOHO・創業<br class="is-Tab_Sp">オフィス</span>
						</a>
					</p>
				</li>
				<li class="l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-6-sp">
					<p class="ButtonD-light ButtonD-icon ButtonD-arrow">
						<a href="/office_search/search.php?stype=theme&theme=02">
							<span class="ButtonD_inner ButtonD_inner-05">駅チカ･駅直結</span>
						</a>
					</p>
				</li>
				<li class="l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-6-sp">
					<p class="ButtonD-light ButtonD-icon ButtonD-arrow">
						<a href="/office_search/search.php?stype=theme&theme=03">
							<span class="ButtonD_inner ButtonD_inner-02">貸会議室あり</span>
						</a>
					</p>
				</li>
				<li class="l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-6-sp">
					<p class="ButtonD-light ButtonD-icon ButtonD-arrow">
						<a href="/office_search/search.php?stype=theme&theme=04">
							<span class="ButtonD_inner ButtonD_inner-08">貸駐車場あり</span>
						</a>
					</p>
				</li>
				<li class="l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-6-sp">
					<p class="ButtonD-light ButtonD-icon ButtonD-arrow">
						<a href="/office_search/search.php?stype=theme&theme=05">
							<span class="ButtonD_inner ButtonD_inner-06">１F店舗空物件</span>
						</a>
					</p>
				</li>
				<li class="l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-6-sp">
					<p class="ButtonD-light ButtonD-icon ButtonD-arrow">
						<a href="/office_search/search.php?stype=theme&theme=06">
							<span class="ButtonD_inner ButtonD_inner-03">外装・内装<br>リニューアル</span>
						</a>
					</p>
				</li>
				<li class="l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-6-sp">
					<p class="ButtonD-light ButtonD-icon ButtonD-arrow">
						<a href="/office_search/search.php?stype=theme&theme=07">
							<span class="ButtonD_inner ButtonD_inner-07">１Fコンビニ</span>
						</a>
					</p>
				</li>
				<li class="l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-6-sp">
					<p class="ButtonD-light ButtonD-icon ButtonD-arrow">
						<a href="/office_search/search.php?stype=theme&theme=08">
							<span class="ButtonD_inner ButtonD_inner-04">管理人常駐</span>
						</a>
					</p>
				</li>
			</ul>
		</div>
	</div>
	</div>
</section>
<?php
}

// --------------------------------------------------------
// ・NEWを取得する
// $date String
//
// return String(HTML)
//
function getHtmlNew($date)
{
    $t1 = strtotime(date('y-m-d h:i:s', time()));
    $t2 = strtotime($date);

    $html = '<span class="topicsContent_new">NEW</span>';
    if (ceil(($t1 - $t2) / 86400) > 30) {
        $html = '';
    }

    return $html;
}


// --------------------------------------------------------
// ・空き状態を取得する
// $state String
//
// return String(HTML)
//
function getHtmlStatus($state)
{
    $html = '<p class="topicsContent_state topicsContent_state-will">商談中</p>';

    if ($state == '空き予定') {
        $html = '<p class="topicsContent_state topicsContent_state-will">空き予定</p>';
    } elseif ($state == '空きあり') {
        $html = '<p class="topicsContent_state topicsContent_state-now">空きあり</p>';
    }

    return $html;
}


// --------------------------------------------------------
// ・物件データ
// $office_data Array
//
// HTML
//
function htmlOffice($office_data)
{
    $office_html = <<<EOM
    <li class="ts_list l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-12-sp">
      <article class="topicsContent">
        <div class="topicsContent_inner">
          <div class="topicsContent_header">
          <p class="topicsContent_area topicsContent_area-{$office_data['area_class']}">{$office_data['area_name']}エリア</p>
            <div class="topicsContent_image">
              <a href="/building/{$office_data['bldg_slug']}/intro.php?office={$office_data['office_id']}">
                <img src="{$office_data['office_thumbnail']}" alt="">
                <div class="extent">{$office_data['office_tsubo']}<span class="extent_s-txt">坪</span></div>
              </a>
            </div>
          </div>
          <div class="topicsContent_body">
            <div class="topicsContent_date_sp"><time datetime="{$office_data['office_create_at_html']}">{$office_data['office_create_at_html']}</time>{$office_data['office_new']}</div>
            <div class="topicsContent_date"><time datetime="{$office_data['office_create_at_html']}">{$office_data['office_create_at_html']}</time>{$office_data['office_new']}</div>
            {$office_data['office_state_html']}
            <div class="topicsContent_tit l-clearfix">
              <h1 class="topicsContent_name">{$office_data['bldg_name']}</h1>
            </div>
            <div class="topicsContent_info l-clearfix"><p class="topicsContent_floor">[坪数] {$office_data['office_tsubo']} [階数] {$office_data['office_floor']}</p></div>
            <p class="topicsContent_desc">{$office_data['office_cmt_tit']}</p>
            <p class="topicsContent_btn ButtonD-light folder">
              <a class="bldg_id" href="javascript:void(0);" onclick="setCookie(this)" data-id="{$office_data['office_id']}">
                <span class="ButtonA_inner">検討リストに入れる</span>
              </a>
            </p>
          </div>
        </div>
      </article>
    </li>
  EOM;

    echo $office_html;
}


// --------------------------------------------------------
// ・物件データ
// $room_data Array
//
// HTML
//
function htmlRoom($room_data)
{
    $room_html = <<<EOM
    <li class="ts_list l-grid_item l-grid_item-3 l-grid_item-4-tab l-grid_item-12-sp">
      <article class="topicsContent">
        <div class="topicsContent_inner">
          <div class="topicsContent_header">
          <p class="topicsContent_area topicsContent_area-{$room_data['area_class']}">{$room_data['area_name']}エリア</p>
            <div class="topicsContent_image">
              <a href="/mansion/{$room_data['mansion_slug']}/intro.php?room={$room_data['room_id']}">
                <img src="{$room_data['room_thumbnail']}" alt="">
                <div class="extent">{$room_data['room_tsubo']}<span class="extent_s-txt">坪</span></div>
              </a>
            </div>
          </div>
          <div class="topicsContent_body">
            <div class="topicsContent_date_sp"><time datetime="{$room_data['office_create_at_html']}">{$room_data['office_create_at_html']}</time>{$room_data['office_new']}</div>
            <div class="topicsContent_date"><time datetime="{$room_data['office_create_at_html']}">{$room_data['office_create_at_html']}</time>{$room_data['office_new']}</div>
            {$room_data['office_state_html']}
            <div class="topicsContent_tit l-clearfix">
              <h1 class="topicsContent_name">{$room_data['mansion_name']}</h1>
            </div>
            <div class="topicsContent_info l-clearfix"><p class="topicsContent_floor">[間取] {$room_data['room_madori']} [面積] {$room_data['room_tsubo']}m&sup2; [階数] {$room_data['room_floor']}</p></div>
            <p class="topicsContent_desc">{$room_data['room_cmt_tit']}</p>
            <p class="topicsContent_btn ButtonD-light folder">
              <a class="bldg_id" href="javascript:void(0);" onclick="setCookie(this)" data-id="{$room_data['room_id']}">
                <span class="ButtonA_inner">検討リストに入れる</span>
              </a>
            </p>
          </div>
        </div>
      </article>
    </li>
  EOM;

    echo $room_html;
}


// --------------------------------------------------------
// ・ページナビ
// $page_current Int
// $total_page Int
// $form_data Array
//
// HTML
//
function htmlPageNavi($page_current, $total_page, $form_data)
{
    $search_prm = '';
    if (!empty($form_data['stype']) && !empty($form_data['theme'])) {
        $search_prm = '&stype=' . $form_data['stype'] . '&theme=' . $form_data['theme'] ;
    }

    echo '<div class="page-navi"><span class="page-show pages">' . $page_current . '&nbsp;/&nbsp;' . $total_page . '</span>';

    if ($page_current != 1) {
        echo '<a class="page-back pages page_button" href="/office_search/search.php?page=1' . $search_prm . $search_prm . '">«</a>';
    }
    if ($page_current > 2) {
        echo '<a class="page-reg pages page_button" href="/office_search/search.php?page=' . ($page_current - 2) . $search_prm . '">' . ($page_current - 2) . '</a>';
    }
    if ($page_current > 1) {
        echo '<a class="page-reg pages page_button" href="/office_search/search.php?page=' . ($page_current - 1) . $search_prm . '">' . ($page_current - 1) . '</a>';
    }
    echo '<span class="page-curr pages page_button">' . $page_current . '</span>';
    if ($page_current < $total_page) {
        echo '<a class="page-reg pages page_button" href="/office_search/search.php?page=' . ($page_current + 1) . $search_prm . '">' . ($page_current + 1) . '</a>';
    }
    if ($page_current < $total_page - 1) {
        echo '<a class="page-reg pages page_button" href="/office_search/search.php?page=' . ($page_current + 2) . $search_prm . '">' . ($page_current + 2) . '</a>';
    }
    if ($page_current < $total_page) {
        echo '<a class="page-font pages page_button" href="/office_search/search.php?page=' . $total_page . $search_prm . '">»</a>';
    }

    echo '</div>';
}


// --------------------------------------------------------
// ・検索情報
// $search_option　Array
//
// HTML
//
function htmlSearchOption($search_option)
{
    $option_html = <<<EOM
    <div class="searchResult">
      <div class="searchResult_inner l-clearfix">
        <div class="searchResult_body">
          <table>
            <th><span>検索結果</span></th>
            <td><span>{$search_option['count']}</span>件</td>
            <th><span>{$search_option['option_name']}</span></th>
            <td>{$search_option['option_content']}</td>
          {$search_option['custom_html']}
          </table>
        </div>
        <p class="searchResult_return"><a href="/office_search/"><img src="/image_uniq/office_search/search_returnBtn.png" alt="条件を変えて再検索"></a></p>
      </div>
    </div>
  EOM;

    echo $option_html;
}
