<?php

/* ----------------------------
 * PHP の汎用関数をまとめました
 ---------------------------- */


// -----------------------------------------------------------------------------
// パラメータを配列に入れなおす
// -----------------------------------------------------------------------------

// -----------------------------------------------------------------------------
// echo(); を e(); でできるようにする
// -----------------------------------------------------------------------------
function e ($var) {
    echo ( $var );
}

// -----------------------------------------------------------------------------
// var_dump(); を d(); でできるようにする
// -----------------------------------------------------------------------------
function d() {
    echo '<pre style="background:#fff;color:#333;';
    echo 'border:1px solid #ccc;margin:2px;padding:';
    echo '4px;font-family:monospace;font-size:14px">';
    foreach (func_get_args() as $v) var_dump($v);
    echo '</pre>';
}

// -----------------------------------------------------------------------------
// htmlエスケープ(htmlspecialchars)をh();で
// -----------------------------------------------------------------------------
function h($str){
    if(is_array($str)){
        return array_map( "h", $str );
    }else{
        return htmlspecialchars($str, ENT_QUOTES);
    }
}

// -----------------------------------------------------------------------------
// MySqlのエスケープを q(); で
// -----------------------------------------------------------------------------
function q($str){
    if(is_array($str)){
        return array_map( "e" , $str );
    }else{
        return mysql_real_escape_string( $str );
    }
}

