<?php
/**
 * 商品検索 API
 *
 * リクエストパラメータ
 *   1. category_cd: カテゴリコード
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
$category_cd = empty($_GET['category_cd']) ? null : $_GET['category_cd'];

// カテゴリコードが指定されていない場合はエラー
if($category_cd === null || preg_match('/^[A-Z]{3}$/', $category_cd) !== 1){
	response(false, 'カテゴリコードが正しく指定されていません');
	exit;
}

//-----------------------------------------
// 検索結果を返却
//-----------------------------------------
try{
	$product = new ProductModel();
	$data = $product->findCategory($category_cd);
	response(true, $data);
}
catch(PDOException $e){
	response(false, $e->getMessage());
	exit;
}