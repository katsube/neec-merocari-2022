<?php
/**
 * カテゴリー名返却 API
 *
 * リクエストパラメータ
 *   1. category_cd : カテゴリーCD
 *
 * レスポンス
 *   {
 *    "head":{
 *      "status": true,
 *      "time": 1234567890
 *    },
 *    "data": {
 *       "cd": "WOM",
 *       "name":"xxx"
 *     }
 *   }
 */

//-----------------------------------------
// ライブラリ
//-----------------------------------------
require_once('../lib/common.php');
require_once('../../../model/category.php');

//-----------------------------------------
// リクエストパラメータを取得
//-----------------------------------------
$cd = empty($_GET['category_cd']) ? null : $_GET['category_cd'];

// cdが指定されていない場合はエラー
if($cd === null || preg_match('/^[0-9A-Z]{3}$/', $cd) !== 1){
	response(false, 'カテゴリーCDが正しく指定されていません');
	exit;
}

//-----------------------------------------
// 検索結果を返却
//-----------------------------------------
try{
	$category = new CategoryModel();
	$data = $category->find($cd);
	response(true, $data);
}
catch(PDOException $e){
	response(false, $e->getMessage());
	exit;
}