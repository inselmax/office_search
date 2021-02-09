<?php

// --------------------------------------------------------
// ・簡単検索
//
// HTML
//
function htmlSearchForm_01() {
?>
  <div>
    <p>簡単検索</p>
    <div>
      <form action="/office_search/search.php#bukken_mark" method="post" enctype="multipart/form-data">
        <div>
          <p>エリアを選択</p>
          <label><input type="checkbox" name="area_all" value="all"> 全エリア</label>
          <label><input type="checkbox" name="area_item[]" value="01"> 南森町</label>
          <label><input type="checkbox" name="area_item[]" value="02"> 西梅田</label>
          <label><input type="checkbox" name="area_item[]" value="03"> 東梅田</label>
          <label><input type="checkbox" name="area_item[]" value="04"> 梅田</label>
          <label><input type="checkbox" name="area_item[]" value="05"> 中津</label>
          <label><input type="checkbox" name="area_item[]" value="06"> 京橋</label>
        <div>
        <div>
          <p>広さで検索</p>
          <input type="text" name="tsubo_min">坪～<input type="text" name="tsubo_max">坪
          <button type="submit" name="form_submit" value="tsubo">検索する</button>
        <div>
        <div>
          <p>従業員数で検索</p>
          <input type="text" name="hito_min">人～<input type="text" name="hito_max">人
          <button type="submit" name="form_submit" value="hito">検索する</button>
        <div>
      </form>
    </div>
  </div>
<?php
}


// --------------------------------------------------------
// ・こだわり検索
//
// HTML
//
function htmlSearchForm_02() {
?>
  <div>
    <p>こだわり検索 ※複数選択可能</p>
    <div>
      <form action="/office_search/search.php#bukken_mark" method="post" enctype="multipart/form-data">
        <div>
          <label><input type="checkbox" name="form_02_area[]" value="all"> 全エリア</label>
          <label><input type="checkbox" name="form_02_area[]" value="01"> 南森町</label>
          <label><input type="checkbox" name="form_02_area[]" value="02"> 西梅田</label>
          <label><input type="checkbox" name="form_02_area[]" value="03"> 東梅田</label>
          <label><input type="checkbox" name="form_02_area[]" value="04"> 梅田</label>
          <label><input type="checkbox" name="form_02_area[]" value="05"> 中津</label>
          <label><input type="checkbox" name="form_02_area[]" value="06"> 京橋</label>
        <div>
        <div>
          <label><input type="checkbox" name="form_02_option[]" value="1"> 南森町</label>
        <div>
        <div>
          <input type="button" id="resetBtn" value="条件をクリア">
          <button type="submit" name="form_submit" value="kodawari">検索する</button>
        <div>
      </form>
    </div>
  </div>
<?php
}


// --------------------------------------------------------
// ・テーマで検索
//
// HTML
//
function htmlSearchForm_03() {
  ?>
    <div>
      <p>テーマで検索</p>
      <div>
        <form action="/office_search/search.php#bukken_mark" method="post" enctype="multipart/form-data">
          <div>
            <input type="button" id="resetBtn" value="条件をクリア">
            <button type="submit" name="form_submit" value="theme">検索する</button>
          <div>
        </form>
      </div>
    </div>
  <?php
  }


// --------------------------------------------------------
// ・NEWを取得する
// $date String
//
// return String(HTML)
//
function getHtmlNew( $date ) {

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
function getHtmlStatus( $state ) {

  $html = '<p class="topicsContent_state topicsContent_state-will">商談中</p>';

  if ($state == '空き予定') {
    $html = '<p class="topicsContent_state topicsContent_state-will">空き予定</p>';
  }elseif ($state == '空きあり') {
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
function htmlOffice( $office_data ) {

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
//
// HTML
//
function htmlPageNavi( $page_current, $total_page ) {

  echo '<div class="page-navi"><span class="page-show pages">' . $page_current . '&nbsp;/&nbsp;' . $total_page . '</span>';

    if ($page_current != 1) {
      echo '<a class="page-back pages page_button" href="/office_search/search.php?&page=1">«</a>';
    }
    if ($page_current > 2) {
      echo '<a class="page-reg pages page_button" href="/office_search/search.php?&page=' . ($page_current - 2) . '">' . ($page_current - 2) . '</a>';
    }
    if ($page_current > 1) {
      echo '<a class="page-reg pages page_button" href="/office_search/search.php?&page=' . ($page_current - 1) . '">' . ($page_current - 1) . '</a>';
    }
    echo '<span class="page-curr pages page_button">' . $page_current . '</span>';
    if ($page_current < $total_page) {
      echo '<a class="page-reg pages page_button" href="/office_search/search.php?&page=' . ($page_current + 1) . '">' . ($page_current + 1) . '</a>';
    }
    if ($page_current < $total_page - 1) {
      echo '<a class="page-reg pages page_button" href="/office_search/search.php?&page=' . ($page_current + 2) . '">' . ($page_current + 2) . '</a>';
    }
    if ($page_current < $total_page) {
      echo '<a class="page-font pages page_button" href="/office_search/search.php?&page=' . $total_page . '">»</a>';
    }

  echo '</div>';

}


// --------------------------------------------------------
// ・検索情報
// $sort_data　Array
// $form_type String
// $form_data　$_POST
//
// HTML
//
function htmlSearchOption( $sort_data, $form_type, $form_data ) {

  // 物件数を格納
  $res_count = count( $sort_data );
  $option_name = '';
  $custom_html = '';

  switch( $form_type ) {
    case "tsubo":

        $min_tsubo = 0;
        $max_tsubo = 999;

        if( !empty($form_data['tsubo_min']) && $form_data['tsubo_min'] > $min_tsubo ) {
          $min_tsubo = $form_data['tsubo_min'];
        }
        if( !empty($form_data['tsubo_max']) && $form_data['tsubo_max'] < $max_tsubo ) {
            $max_tsubo = $form_data['tsubo_max'];
        }

        $option_name = 'エリア';
        $option_content = 'hoge';
        $custom_html = <<<EOM
          <dl>
            <dt>広さ</dt>
            <dd>{$min_tsubo}坪～{$max_tsubo}坪</dd>
          </dl>
        EOM;
        break;

    case "hito":

        $min_hito = 0;
        $max_hito = 999;

        if( !empty($form_data['hito_min']) && $form_data['hito_min'] > $min_hito ) {
          $min_hito = $form_data['hito_min'];
        }
        if( !empty($form_data['hito_max']) && $form_data['hito_max'] < $max_hito ) {
            $max_hito = $form_data['hito_max'];
        }

        $option_name = 'エリア';
        $option_content = 'hoge';
        $custom_html = <<<EOM
          <dl>
            <dt>従業員数</dt>
            <dd>{$min_hito}人～{$max_hito}人</dd>
          </dl>
        EOM;
        break;

    case "kodawari":
        $option_name = '検索条件';
        $option_content = 'hoge';
        break;

    case "theme":
        $option_name = '検索条件';
        $option_content = 'hoge';
        break;

    default:
        break;
  }

  $option_html = <<<EOM
    <div>
      <dl>
        <dt>検索結果</dt>
        <dd>{$res_count}件</dd>
      </dl>
      <dl>
        <dt>{$option_name}</dt>
        <dd>{$option_content}</dd>
      </dl>
      {$custom_html}
      <p><a href="/office_search/">戻る</a></p>
    </div>
  EOM;

  echo $option_html;

}