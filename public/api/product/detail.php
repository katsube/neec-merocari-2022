<?php
/**
 * 商品検索 API
 *
 * リクエストパラメータ
 *   1. id: 商品ID
 *
 * レスポンス
 *   {
 *    "head":{
 *      "status": true,
 *      "time": 1234567890
 *    },
 *    "data": {
 *       "id":1,
 *       "name":"xxx",
 *       "price":123,
 *       "image_url":"http://〜",
 *       "description":"xxx",
 *       "category":[{"cd":"WOM", "name":"レディース"},{...}],
 *       "created_at":1234567890
 *     }
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
$id = empty($_GET['id']) ? null : $_GET['id'];

// idが指定されていない場合はエラー
if($id === null || preg_match('/^[0-9]{1,}$/', $id) !== 1){
	response(false, '商品IDが正しく指定されていません');
	exit;
}

//-----------------------------------------
// 検索結果を返却
//-----------------------------------------
try{
	$product = new ProductModel();
	$data = $product->find($id);
	response(true, $data);
}
catch(PDOException $e){
	response(false, $e->getMessage());
	exit;
}