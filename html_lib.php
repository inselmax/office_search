<?php

// --------------------------------------------------------
// ・簡単検索
//
// HTML
//
function htmlSearchForm_01()
{
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
							<label><input type="checkbox" name="area_all" value="all"> 全エリア</label>
							<?php
                                    foreach (AREA_NAME as $key => $value) {
                                        echo '<label><input type="checkbox" name="area_item[]" value="' . sprintf('%02d', ($key)) . '"> ' . $value . '</label>';
                                    } ?>
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
								<input type="text" name="tsubo_min"> 坪～　<input type="text" name="tsubo_max"> 坪
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
								<input type="text" name="hito_min"> 人～　<input type="text" name="hito_max"> 人
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
//
// HTML
//
function htmlSearchForm_02()
{
    ?>
<section class="SearchSect SearchSect-kodawari">
	<div class="l-inner search_inner">
		<dl class="SearchSect_wrap">
			<dt class="search_subttl search_subttl-02"><span class="SearchSubttl_ico">こだわり検索</span> <span
					class="small-txt">※複数選択可能</span></dt>
			<dd class="search_cont">
				<form id="form_kodawari" action="/office_search/search.php#bukken_mark" method="post"
					enctype="multipart/form-data">
					<div class="SearchBy SearchBy-area">
						<div class="SearchBy_ttl"><span>まずはエリアを選択</span></div>
						<div class="SearchBy_cont">
							<label><input type="checkbox" name="area_all" value="all"><span class="label_check">
									全エリア</span></label>
							<?php
                                foreach (AREA_NAME as $key => $value) {
                                    echo '<label><input type="checkbox" name="area_item[]" value="' . sprintf('%02d', ($key)) . '"> <span class="label_check">' . $value . '</span></label>';
                                } ?>
						</div>
						<div>
							<div class="SearchBy SearchBy-kodawari">
								<div class="SearchBy_ttl"><span>こだわり条件を選択</span></div>
								<div class="SearchBy_cont SearchBy_cont-kodawari">
									<label><input type="checkbox" name="office_option[]" value="J"> <span
											class="label_check">駅スグ</span></label>
									<label><input type="checkbox" name="office_option[]" value="I"> <span
											class="label_check">駅直結</span></label>
									<label><input type="checkbox" name="office_option[]" value="D"> <span
											class="label_check">貸会議室</span></label>
									<label><input type="checkbox" name="office_option[]" value="E"> <span
											class="label_check">貸駐車場</span></label>
									<label><input type="checkbox" name="office_option_1fk" value="1fk"> <span
											class="label_check">1Fコンビニ</span></label>
									<label><input type="checkbox" name="office_option[]" value="P"> <span
											class="label_check">EVリニューアル</span></label>
									<label><input type="checkbox" name="office_option[]" value="O"> <span
											class="label_check">空調リニューアル</span></label>
									<label><input type="checkbox" name="office_option[]" value="N"> <span
											class="label_check">給湯室リニューアル</span></label>
									<label><input type="checkbox" name="office_option[]" value="M"> <span
											class="label_check">トイレリニューアル</span></label>
									<label><input type="checkbox" name="office_option[]" value="B"> <span
											class="label_check">個別空調</span></label>
									<label><input type="checkbox" name="office_option[]" value="C"> <span
											class="label_check">光回線</span></label>
									<label><input type="checkbox" name="office_option[]" value="L"> <span
											class="label_check">OAフロア対応</span></label>
									<label><input type="checkbox" name="office_option[]" value="F"> <span
											class="label_check">ビル前ポスト</span></label>
									<label><input type="checkbox" name="office_option[]" value="G"> <span
											class="label_check">管理人常駐</span></label>
									<label><input type="checkbox" name="office_option[]" value="Q"> <span
											class="label_check">防犯カメラ</span></label>
									<label><input type="checkbox" name="office_option[]" value="A"> <span
											class="label_check">24時間利用</span></label>
									<label><input type="checkbox" name="office_option_10fmin" value="10fmin"> <span
											class="label_check">高階層(10階以上)</span></label>
									<label><input type="checkbox" name="office_option_3fmin" value="3fmin"> <span
											class="label_check">低階層(3階以上)</span></label>
									<label><input type="checkbox" name="office_option_fmax" value="fmax"> <span
											class="label_check">最上階</span></label>
									<label><input type="checkbox" name="office_option_1fshop" value="1fshop"> <span
											class="label_check">1F店舗空物件</span></label>
								</div>
							</div>
						</div>
						<div class="SearchCont_btn">
							<button id="resetBtn" class="clear_btn"><img src="/image_uniq/office_search/clear_btn.png"
									alt=""></button>
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
//
// HTML
//
function htmlSearchForm_03()
{
    ?>
<section class="SearchSect SearchSect-theme">
	<div class="l-inner search_inner">
		<div class="SearchSect_wrap">
			<p class="search_subttl search_subttl-03"><span class="SearchSubttl_ico">テーマで検索</span> </p>
			<div class="search_cont">
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
	if( !empty($form_data['stype']) && !empty($form_data['theme']) ) {
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
    <div>
      <dl>
        <dt>検索結果</dt>
        <dd>{$search_option['count']}件</dd>
      </dl>
      <dl>
        <dt>{$search_option['option_name']}</dt>
        <dd>{$search_option['option_content']}</dd>
      </dl>
      {$search_option['custom_html']}
      <p><a href="/office_search/">戻る</a></p>
    </div>
  EOM;

    echo $option_html;
}
