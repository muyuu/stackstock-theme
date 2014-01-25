<?php
/* -------------------------------------
 * ブラウザ判別
 * $bworserName に格納
 ------------------------------------ */
// UserAgent の取得
function getUA () {
  $ua = getenv('HTTP_USER_AGENT');

  // 取得したUAをブラウザごとに判別
  // strpos(); は文字列の中に特定の文字列があったら
  // 特定の文字が最初に現れる位置を返す
  // つまり特定の文字があればtrue
  // なければ false なので判定として使える
  if ( strpos($ua, 'IEMobile' ) ) {
    $browserName = 'iemobile';
  } else if ( strpos($ua, 'MSIE 6' ) ) {
    $browserName = 'ie6';
  } else if ( strpos($ua, 'MSIE 7' ) ) {
    $browserName = 'ie7';
  } else if ( strpos($ua, 'MSIE 8' ) ) {
    $browserName = 'ie8';
  } else if ( strpos($ua, 'MSIE 9' ) ) {
    $browserName = 'ie9';
  } else if ( strpos($ua, 'Firefox' ) ) {
    $browserName = 'firefox';
  } else if ( strpos($ua, 'iPhone' ) ) {
    $browserName = 'iphone';
  } else if ( strpos($ua, 'iPad' ) ) {
    $browserName = 'ipad';
  } else if ( strpos($ua, 'Android' ) ) {
    // Mobileが含まれていた場合はタブレットではない
    if ( strpos($ua, "Mobile") ) {
      $browserName = 'andriodMobile';
    } else {
      $browserName = 'andriod';
    }
  } else if ( strpos($ua, 'Chrome' ) ) {
    $browserName = 'chrome';
  } else if ( strpos($ua, 'Safari' ) ) {
    $browserName = 'safari';
  } else {
    $browserName = "Unknown";
  }
  return $browserName;
}
//var_dump (getUA());

/* --------------------------------------
 * 各関数の真偽関数
 * 特定のブラウザの場合にtrueになるように
 ------------------------------------- */
function is_ie6 () {
  if ( getUA () == "ie6" ) {
    return true;
  } else {
    return false;
  }
}

function is_ie7 () {
  if ( getUA () == "ie7" ) {
    return true;
  } else {
    return false;
  }
}

function is_ie8 () {
  if ( getUA () == "ie8" ) {
    return true;
  } else {
    return false;
  }
}

function is_ie9 () {
  if ( getUA () == "ie9" ) {
    return true;
  } else {
    return false;
  }
}

function is_ie10 () {
  if ( getUA () == "ie10" ) {
    return true;
  } else {
    return false;
  }
}

function is_firefox () {
  if ( getUA () == "firefox" ) {
    return true;
  } else {
    return false;
  }
}

function is_chrome () {
  if ( getUA () == "chrome" ) {
    return true;
  } else {
    return false;
  }
}

function is_safari () {
  if ( getUA () == "safari" ) {
    return true;
  } else {
    return false;
  }
}

function is_iphone () {
  if ( getUA () == "iphone" ) {
    return true;
  } else {
    return false;
  }
}

function is_ipad () {
  if ( getUA () == "ipad" ) {
    return true;
  } else {
    return false;
  }
}

function is_android () {
  if ( getUA () == "andriodMobile" ) {
    return true;
  } else {
    return false;
  }
}

function is_androidTablet () {
  if ( getUA () == "andriod" ) {
    return true;
  } else {
    return false;
  }
}

function is_smartphone () {
  if ( is_iphone() || is_android() ) {
    return true;
  } else {
    return false;
  }
}

function is_tablet () {
  if ( is_ipad() || is_androidTablet() ) {
    return true;
  } else {
    return false;
  }
}

/* --------------------------------------
 * ブラウザ名出力関数
 * デバッグ用にブラウザ名表示
 ------------------------------------- */
function disp_deviceName() {
  echo "<p class=''>お使いのブラウザは";
  if ( is_ie6 () ) {
    echo "ie6";
  }
  if ( is_ie6 () ) {
    echo "ie6";
  }
  if ( is_ie7 () ) {
    echo "ie7";
  }
  if ( is_ie8 () ) {
    echo "ie8";
  }
  if ( is_ie9 () ) {
    echo "ie9";
  }
  if ( is_ie10 () ) {
    echo "ie10";
  }
  if ( is_firefox () ) {
    echo "Firefox";
  }
  if ( is_chrome () ) {
    echo "Chrome";
  }
  if ( is_safari () ) {
    echo "Safari";
  }
  if ( is_iphone () ) {
    echo "iPhone";
  }
  if ( is_ipad () ) {
    echo "iPad";
  }
  if ( is_android () ) {
    echo "Android";
  }
  if ( is_androidTablet () ) {
    echo "Androi タブレット";
  }
  if ( is_smartphone () ) {
    echo "かつスマートフォン";
  }
  if ( is_tablet () ) {
    echo "かつタブレット";
  }
  echo "です</p>";
}

/* --------------------------------------
 * 各種サポート関数
 * 特定の機能・要素に対応してる場合にtrue
 ------------------------------------- */

// SVGサポート
function is_svgSupport () {
  if ( is_ie6() || is_ie7() || is_ie8() ) {
    return false;
  } else {
    return true;
  }
}

// 透過pngサポート
function is_alphaPngSupport () {
  if ( is_ie6() ) {
    return false;
  } else {
    return true;
  }
}

// HTML5サポート
function is_html5Support () {
  if ( is_ie6() || is_ie7() || is_ie8()) {
    return false;
  } else {
    return true;
  }
}

