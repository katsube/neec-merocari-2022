<?php
/**
 * 商品検索 API（全文検索）
 *
 * リクエストパラメータ
 *   1. keyword: キーワード
 *
 * レスポンス
 *   {
 *    "head":{
 *      "status": true,
 *      "time": 1234567890
 *    },
 *    "data":[
 *      {"id":1, "name":"xxx", "price":123, "image_url":"http://〜"},
 *      {"id":2, "name":"xxx", "price":123, "image_url":"http://〜"},
 *      {"id":3, "name":"xxx", "price":123, "image_url":"http://〜"}
 *    ]
 *   }
 */

//-----------------------------------------
// ライブラリ
//-----------------------------------------
require_once('../lib/common.php');
require_once('../../../model/product.php');

//-----------------------------------------
// リクエストパラメータを取得
//-----------------------------------------
$keyword = empty($_GET['keyword']) ? null : $_GET['keyword'];

// キーワードが指定されていない場合はエラー
if($keyword === null || $keyword === ''){
	response(false, 'キーワードが正しく指定されていません');
	exit;
}

//-----------------------------------------
// 検索結果を返却
//-----------------------------------------
try{
	$product = new ProductModel();
	$data = $product->findKeyword($keyword);
	response(true, $data);
}
catch(PDOException $e){
	response(false, $e->getMessage());
	exit;
}