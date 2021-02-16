<?php

// --------------------------------------------------------
// ・JSONを取得する
// $url String
//
// return Array
//
function getJSON( $url ) {

    $sheet_url = $url;
    $json = file_get_contents($sheet_url);
    $json_decode = json_decode($json, true);
    $data = $json_decode['feed']['entry'];

    return $data;

}


// --------------------------------------------------------
// ・物件IDからビルIDを取得する
// $office_id String
//
// return String
//
function getBldgId( $office_id ) {


    $bldg_id = substr($office_id, 0, 2);

    return $bldg_id;

}


// --------------------------------------------------------
// ・物件データから各情報を取得する
// $office_data Array
//
// return Array
//
function getOfficeData( $office_ary ) {

    $office_id = $office_ary['gsx$物件id']['$t'];
    $bldg_id = getBldgId( $office_id );

    $office_data = array(
        // 物件IDを格納
        'office_id' => $office_id,
        // ビル情報
        'bldg_id' => $bldg_id, // ID
        'bldg_name' => $office_ary['gsx$ビル']['$t'], // 名前
        'bldg_slug' => BLDG_SLUG[ $bldg_id ], // スラッグ
        // 物件情報
        'office_floor' => $office_ary['gsx$階数']['$t'], // 階数
        'office_tsubo' => $office_ary['gsx$契約面積坪']['$t'], // 坪数
        'office_thumbnail' => $office_ary['gsx$室内図面url']['$t'], // サムネイルを取得
        'office_create_at' => $office_ary['gsx$登録日']['$t'], // 登録日
        'office_create_at_html' => date("Y/m/d", strtotime($office_ary['gsx$登録日']['$t'])), // 登録日（HTML）
        'office_new' => getHtmlNew( $office_ary['gsx$登録日']['$t'] ), // NEW（HTML）
        'office_state' => $office_ary['gsx$状態']['$t'], // 空き状態
        'office_state_html' => getHtmlStatus( $office_ary['gsx$状態']['$t'] ), // 空き状態（HTML）
        'office_cmt_tit' => $office_ary['gsx$物件コメントタイトル']['$t'], // 物件コメントタイトル
        // エリア情報を格納・取得
        'area_name' => BLDG_AREA_NAME[$bldg_id],
        'area_class' => BLDG_AERA_CLASS[$bldg_id]
    );

    return $office_data;

}


// --------------------------------------------------------
// ・物件データを絞り込む
// $office_ary Array
// $form_data $_POST
//
// return Array
//
function getSearchOffice( $office_ary, $form_data ) {

    $ary = array();
    $submit_type = $form_data['form_submit'];

    switch( $submit_type ) {
        case "tsubo":
            $ary = sortTsubo( $office_ary, $form_data );
            break;
        case "hito":
            $ary = sortHito( $office_ary, $form_data );
            break;
        case "kodawari":
            $ary = sortKodawari( $office_ary, $form_data );
            break;
        case "theme":
            $ary = sortTheme( $office_ary, $form_data );
            break;
        default:
            break;
    }

    return $ary;
}


// --------------------------------------------------------
// ・絞り込み（坪数）
// $office_ary Array
// $form_data $_POST
//
// return Array
//
function sortTsubo( $office_ary, $form_data ) {


    $ary = $office_ary;

    // エリアで絞り込み
    if( empty( $form_data['area_all'] ) ) {
        if( $form_data['area_item'] ) {

            $ary = array();

            foreach ( $office_ary as $key => $value ) {
                if ( in_array($value['gsx$エリア']['$t'], $form_data['area_item'], true) ) {
                    array_push($ary, $value);
                }
            }
        }
    }

    // 坪数で絞り込み
    $min_tsubo = 0;
    $max_tsubo = 999;

    if( !empty($form_data['tsubo_min']) && $form_data['tsubo_min'] > $min_tsubo ) {
        $min_tsubo = $form_data['tsubo_min'];
    }
    if( !empty($form_data['tsubo_max']) && $form_data['tsubo_max'] < $max_tsubo ) {
        $max_tsubo = $form_data['tsubo_max'];
    }

    foreach ( $ary as $key => $value ) {

        $tsubo = $value['gsx$契約面積坪']['$t'];

        if ( $min_tsubo <= $tsubo && $max_tsubo >= $tsubo ) {
        }else {
            unset($ary[$key]);
        }
    }

    return $ary;
}


// --------------------------------------------------------
// ・絞り込み（従業員）
// $office_ary Array
// $form_data $_POST
//
// return Array
//
function sortHito( $office_ary, $form_data ) {

    $ary = $office_ary;

    // エリアで絞り込み
    if( empty( $form_data['area_all'] ) ) {
        if( $form_data['area_item'] ) {

            $ary = array();

            foreach ( $office_ary as $key => $value ) {
                if ( in_array($value['gsx$エリア']['$t'], $form_data['area_item'], true) ) {
                    array_push($ary, $value);
                }
            }
        }
    }

    // 坪数で絞り込み
    $min_tsubo = 0;
    $max_tsubo = 999;

    if( !empty($form_data['hito_min']) && $form_data['hito_min'] > $min_tsubo ) {
        $min_tsubo = $form_data['hito_min'] * 3;
    }
    if( !empty($form_data['hito_max']) && $form_data['hito_max'] < $max_tsubo ) {
        $max_tsubo = $form_data['hito_max'] * 3;
    }

    foreach ( $ary as $key => $value ) {

        $tsubo = $value['gsx$契約面積坪']['$t'];

        if ( $min_tsubo <= $tsubo && $max_tsubo >= $tsubo ) {
        }else {
            unset($ary[$key]);
        }
    }

    return $ary;
}


// --------------------------------------------------------
// ・絞り込み（こだわり）
// $office_ary Array
// $form_data $_POST
//
// return Array
//
function sortKodawari( $office_ary, $form_data ) {

    $ary = $office_ary;

    // エリアで絞り込み
    if( empty( $form_data['area_all'] ) ) {
        if( $form_data['area_item'] ) {

            $ary = array();

            foreach ( $office_ary as $key => $value ) {
                if ( in_array($value['gsx$エリア']['$t'], $form_data['area_item'], true) ) {
                    array_push($ary, $value);
                }
            }
        }
    }

    // 条件で絞り込み
    foreach ( $ary as $key => $value ) {

        // ビルオプションで絞り込み（A～V）
        $icon_array = array();
        $icon_array = explode(",", $value['gsx$ビル設備']['$t']);

        // ビルオプション（除外用）
        $delete_array = array( "未選択", "外装・内装リニューアル", "SOHO" );

        // ビルオプションを整理
        foreach ( $icon_array as $item => $op ) {
            if ( in_array($op, $delete_array, true) ) {
                unset($icon_array[$item]);
            }
        }

        if( $form_data['office_option'] ) {

            foreach ( $form_data['office_option'] as $item => $op ) {
                if ( in_array($op, $icon_array, true) ) {
                }else {
                    unset($ary[$key]);
                    break;
                }
            }
        }

        // ビルIDを取得
        $bldg_id = getBldgId( $value['gsx$物件id']['$t'] );

        // 1Fコンビニ
        if( $form_data['office_option_1fk'] ) {
            if ( $bldg_id != "01" && $bldg_id != "05" ) {
                unset($ary[$key]);
            }
        }

        // 低階層(3階以上)
        if( $form_data['office_option_3fmin'] ) {
            if ( intval($value['gsx$階数']['$t']) <= 3 ) {
                unset($ary[$key]);
            }
        }

        // 高階層(10階以上)
        if( $form_data['office_option_10fmin'] ) {
            if ( intval($value['gsx$階数']['$t']) <= 10 ) {
                unset($ary[$key]);
            }
        }

        // 最上階
        if( $form_data['office_option_fmax'] ) {
            if ( $value['gsx$階数']['$t'] !== BLDG_TOP_FLOOR[$bldg_id] ) {
                unset($ary[$key]);
            }
        }

        // 1F店舗空物件
        if( $form_data['office_option_1fshop'] ) {
            if ( $bldg_id == "04" && $value['gsx$階数']['$t'] == '1' ) {
            }else {
                unset($ary[$key]);
            }
        }

    }

    return $ary;
}


// --------------------------------------------------------
// ・絞り込み（テーマ）
// $office_ary Array
// $form_data $_POST
//
// return Array
//
function sortTheme( $office_ary, $form_data ) {

    $ary = array();

    switch( $form_data['theme_type'] ) {

        // SOHO・創業オフィス
        case "01":
            foreach ( $office_ary as $key => $value ) {
                $icon_array = array();
                $icon_array = explode(",", $value['gsx$ビル設備']['$t']);
                if ( in_array( 'SOHO', $icon_array, true) ) {
                    array_push($ary, $value);
                }
            }
            break;

        // 駅チカ･駅直結
        case "02":
            $ary = $office_ary;
            break;

        // 貸会議室あり
        case "03":
            foreach ( $office_ary as $key => $value ) {
                $bldg_id = getBldgId( $value['gsx$物件id']['$t'] );
                if ( $bldg_id === '01' || $bldg_id === '05' ) {
                    array_push($ary, $value);
                }
            }
            break;

        // 貸駐車場あり
        case "04":
            foreach ( $office_ary as $key => $value ) {
                $bldg_id = getBldgId( $value['gsx$物件id']['$t'] );
                if ( $bldg_id === '02' || $bldg_id === '03' ) {
                    array_push($ary, $value);
                }
            }
            break;

        // 1F店舗空物件
        case "05":
            foreach ( $office_ary as $key => $value ) {
                $bldg_id = getBldgId( $value['gsx$物件id']['$t'] );
                if (  $bldg_id === '04' && $value['gsx$階数']['$t'] === '1' ) {
                    array_push($ary, $value);
                }
            }
            break;

        // 外装・内装リニューアル
        case "06":
            foreach ( $office_ary as $key => $value ) {
                $icon_array = array();
                $icon_array = explode(",", $value['gsx$ビル設備']['$t']);
                if ( in_array( '外装・内装リニューアル', $icon_array, true) ) {
                    array_push($ary, $value);
                }
            }
            break;

        // １Fコンビニ
        case "07":
            foreach ( $office_ary as $key => $value ) {
                $bldg_id = getBldgId( $value['gsx$物件id']['$t'] );
                if ( $bldg_id === '01' || $bldg_id === '05' ) {
                    array_push($ary, $value);
                }
            }
            break;

        // 管理人常駐
        case "08":
            foreach ( $office_ary as $key => $value ) {
                $icon_array = array();
                $icon_array = explode(",", $value['gsx$ビル設備']['$t']);
                if ( in_array( 'G', $icon_array, true) ) {
                    array_push($ary, $value);
                }
            }
            break;
        default:
            $ary = $office_ary;
            break;
    }

    return $ary;
}


// --------------------------------------------------------
// ・検索情報を取得する
// $sort_data　Array
// $form_type String
// $form_data　$_POST
//
// return Array
//
function getSearchOption( $sort_data, $form_type, $form_data ) {

    // 物件数を格納
    $res_count = count( $sort_data );
    $option_name = '';
    $custom_html = '';

    // 検索フォームで分岐
    switch( $form_type ) {

        // 坪数で検索
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
            $option_content = '';
            if( $form_data['area_item'] ) {
                foreach ( $form_data['area_item'] as $key => $value ) {
                    if( $key < 1 ) {
                        $option_content .= AREA_NAME[ $value ];
                    }else {
                        $option_content .= ',' . AREA_NAME[ $value ];
                    }
                }
            }else {
                $option_content = '全エリア';
            }

            $custom_html = <<<EOM
            <dl>
                <dt>広さ</dt>
                <dd>{$min_tsubo}坪～{$max_tsubo}坪</dd>
            </dl>
            EOM;
            break;

        // 従業員数で検索
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
            $option_content = '';
            if( $form_data['area_item'] ) {
                foreach ( $form_data['area_item'] as $key => $value ) {
                    if( $key < 1 ) {
                        $option_content .= AREA_NAME[ $value ];
                    }else {
                        $option_content .= ',' . AREA_NAME[ $value ];
                    }
                }
            }else {
                $option_content = '全エリア';
            }

            $custom_html = <<<EOM
            <dl>
                <dt>従業員数</dt>
                <dd>{$min_hito}人～{$max_hito}人</dd>
            </dl>
            EOM;
            break;

        // こだわり検索
        case "kodawari":
            $option_name = '検索条件';
            $option_content = '';
            if( $form_data['area_item'] ) {
                foreach ( $form_data['area_item'] as $key => $value ) {
                    if( $key < 1 ) {
                        $option_content .= AREA_NAME[ $value ];
                    }else {
                        $option_content .= ',' . AREA_NAME[ $value ];
                    }
                }
            }else {
                $option_content = '全エリア';
            }

            // その他オプション
            if( $form_data['office_option'] ) {
                foreach ( $form_data['office_option'] as $key => $value ) {
                    $option_content .= ',' . BLDG_OPTION[ $value ];
                }
            }

            // 1Fコンビニ
            if( $form_data['office_option_1fk'] ) {
                $option_content .= ',' . BLDG_OPTION[ $form_data['office_option_1fk'] ];
            }
            // 高層階10F以上
            if( $form_data['office_option_10fmin'] ) {
                $option_content .= ',' . BLDG_OPTION[ $form_data['office_option_10fmin'] ];
            }
            // 低層階3F以上
            if( $form_data['office_option_3fmin'] ) {
                $option_content .= ',' . BLDG_OPTION[ $form_data['office_option_3fmin'] ];
            }
            // 最上階
            if( $form_data['office_option_fmax'] ) {
                $option_content .= ',' . BLDG_OPTION[ $form_data['office_option_fmax'] ];
            }
            // 1F店舗空物件
            if( $form_data['office_option_1fshop'] ) {
                $option_content .= ',' . BLDG_OPTION[ $form_data['office_option_1fshop'] ];
            }


            break;

        // テーマで検索
        case "theme":
            $option_name = 'テーマ';
            $option_content = SEARCH_THEME_NAME[$form_data['theme_type']];
            break;

        default:
            break;
    }

    $search_option = array(
        "count" => $res_count,
        "option_name" => $option_name,
        "option_content" => $option_content,
        "custom_html" => $custom_html
    );

    return $search_option;

}


// --------------------------------------------------------
// ・ページナビの情報を取得する
// $office_data Array
// $page_current Int
//
// return Array
//
function getPageNavi( $office_data, $page_current ) {

    // 1ページあたりの表示数
    $show_num = DISPLAY_OF_PAGE;

    $start_num = ( $page_current - 1 ) * $show_num;
    if ( $page_current == 1 ) {
        $start_num = 0;
    }

    $end_num = ( $page_current * $show_num ) + 1;

    $total = count( $office_data );
    if( $total % $show_num === 0 ) {
        $total_page = $total / $show_num;
    }else {
        $total_page = floor( $total / $show_num ) + 1;
    }
    // $total_page = floor($total / $show_num) + 1;
    // for( $i = 0; $i < 10; $i++ ) {
    //     if( $total == ( $show_num * ( $i + 1 ) ) ) {
    //         $total_page = $i;
    //     }
    // }

    $option = array(
        'start_num' => $start_num,
        'end_num' => $end_num,
        'total_page' => $total_page,
    );

    return $option;

}


// --------------------------------------------------------
// ・エスケープ処理
// $str value
//
// return string
//
function escStr( $str ) {

    return htmlspecialchars($str, ENT_QUOTES, 'utf-8');

}