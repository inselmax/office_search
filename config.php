<?php

/* ------------------------------------------------------------------------

  * シート情報

------------------------------------------------------------------------ */

// ビル一覧（JSON）
define('BLDG_JSON', 'https://spreadsheets.google.com/feeds/list/1Phknes_OqbWbQNB_W2kBamKXaHIGMpJ5dLuH-Zri8Bw/od6/public/values?alt=json');

// ビル物件一覧（JSON）
define('BLDG_OFFICE_JSON', 'https://spreadsheets.google.com/feeds/list/11Aa7EVPys8iC5AxE5X_X5CwJDZs2GyvM2Y7uTthWOts/od6/public/values?alt=json');

// マンション物件一覧（JSON）
define('MANSION_ROOM_JSON', 'https://spreadsheets.google.com/feeds/list/1_nngxRQRFD-RwQkrUc3XpA6BbfxMWJkgo4H70nSPHVc/od6/public/values?alt=json');



/* ------------------------------------------------------------------------

  * ビル情報

------------------------------------------------------------------------ */

// 各ビル対応エリア（名前）
define('BLDG_AREA_NAME',[
        '01' => '南森町',
        '02' => '南森町',
        '03' => '南森町',
        '04' => '南森町',
        '05' => '西梅田',
        '06' => '西梅田',
        '07' => '東梅田',
        '08' => '梅田',
        '09' => '中津',
        '10' => '京橋'
      ]);

// 各ビル対応エリア（名前）
define('AREA_NAME',[
        '01' => '南森町',
        '02' => '西梅田',
        '03' => '東梅田',
        '04' => '梅田',
        '05' => '中津',
        '06' => '京橋'
      ]);

// エリア（クラス）
define('BLDG_AERA_CLASS',[
        '01' => 'minamimorimachi',
        '02' => 'minamimorimachi',
        '03' => 'minamimorimachi',
        '04' => 'minamimorimachi',
        '05' => 'nishiumeda',
        '06' => 'nishiumeda',
        '07' => 'higashiumeda',
        '08' => 'umeda',
        '09' => 'nakatsu',
        '10' => 'kyoubashi'
      ]);

// ビル（スラッグ）
define('BLDG_SLUG',[
        '01' => 'center_bldg_honkan',
        '02' => 'center_bldg_bekkan',
        '03' => 'grand_bldg_honkan',
        '04' => 'grand_bldg_bekkan',
        '05' => 'osakaekimae_bldg',
        '06' => 'nishiumeda_bldg',
        '07' => 'higashiumeda_bldg',
        '08' => 'umeda_bldg',
        '09' => 'wakasugi_bldg_nakatsu',
        '10' => 'new_bldg'
      ]);

// ビル（最上階）
define('BLDG_TOP_FLOOR',[
        '01' => '17',
        '02' => '10',
        '03' => '11',
        '04' => '13',
        '05' => '19',
        '06' => '10',
        '07' => '14',
        '08' => '8',
        '09' => '10',
        '10' => '10'
      ]);

// ビル（オプション）
define('BLDG_OPTION',[
        'A' => '24H利用',
        'B' => '個別空調',
        'C' => '光回線',
        'D' => '貸会議室',
        'E' => '駐車場有',
        'F' => 'ビル前ポスト',
        'G' => '管理人常駐',
        'H' => '管理人巡回',
        'I' => '駅直結',
        'J' => '駅スグ',
        'K' => '手数料無料',
        'L' => 'ＯＡ対応可',
        'M' => 'トイレリニューアル',
        'N' => '給湯室リニューアル',
        'O' => '空調リニューアル',
        'P' => 'EVリニューアル',
        'Q' => '防犯カメラ',
        'R' => 'セキュリティ',
        'S' => '貸会議室近隣あり（自社）',
        'T' => '駐車場近隣あり（自社）',
        'U' => 'ビルマルチ空調',
        'V' => '17階休憩室',
        '1fk' => '1Fコンビニ',
        '10fmin' => '高階層(10階以上)',
        '3fmin' => '低階層(3階以上)',
        'fmax' => '最上階',
        '1fshop' => '1F店舗空物件'
      ]);

// テーマ検索リスト（名前）
define('SEARCH_THEME_NAME',[
        '01' => 'SOHO・創業オフィス',
        '02' => '駅チカ･駅直結',
        '03' => '貸会議室あり',
        '04' => '貸駐車場あり',
        '05' => '１F店舗空物件',
        '06' => '外装・内装リニューアル',
        '07' => '１Fコンビニ',
        '08' => '管理人常駐'
      ]);


/* ------------------------------------------------------------------------

  * マンション情報

------------------------------------------------------------------------ */


// エリア（名前）
define('MANSION_AREA_NAME',[
    '01' => '旭区',
    '02' => '旭区',
    '03' => '都島区'
]);

// エリア（クラス）
define('MANSION_AERA_CLASS',[
    '01' => 'minamimorimachi',
    '02' => 'minamimorimachi',
    '03' => 'minamimorimachi'
  ]);

// ビル（スラッグ）
define('MANSION_SLUG',[
    '01' => 'shato',
    '02' => 'royal',
    '03' => 'espoir'
]);



/* ------------------------------------------------------------------------

  * その他設定

------------------------------------------------------------------------ */

// 1ページあたりの表示
define('DISPLAY_OF_PAGE', 12);