<?php
/**
 * 商品を新規登録する
 *
 */

//--------------------------------------------------
// ライブラリ
//--------------------------------------------------
require_once(dirname(__FILE__).'/../../model/product.php');

//--------------------------------------------------
// メイン処理
//--------------------------------------------------
//--------------------------
// データの受け取り
//--------------------------
$name        = empty($_POST['name'])?  null:$_POST['name'];
$price       = empty($_POST['price'])? null:$_POST['price'];
$category    = [];
$category[]  = empty($_POST['category1'])?    null:$_POST['category1'];
$category[]  = empty($_POST['category2'])?    null:$_POST['category2'];
$category[]  = empty($_POST['category3'])?    null:$_POST['category3'];
$image_url   = empty($_POST['image_url'])?    null:$_POST['image_url'];
$description = empty($_POST['description'])?	null:$_POST['description'];

// カテゴリー配列からnullを削除
$category = array_filter($category, function($val){
	return $val !== null;
});

//--------------------------
// データの検証
//--------------------------
// ToDo: 検証処理を追加

//--------------------------
// データの登録
//--------------------------
try{
	$product = new ProductModel();
	$product->begin();
	$product->create([$name, $price, $image_url, $description], $category);
	$product->commit();

	// リダイレクト
	header('Location: done.php');
}
catch(PDOException $e){
	$product->rollback();

	echo '<pre>';
	var_dump($_POST);
	echo $e->getMessage();
	echo '</pre>';
}