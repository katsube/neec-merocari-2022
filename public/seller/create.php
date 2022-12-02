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
$name        = empty($_POST['name'])?         null:$_POST['name'];
$price       = empty($_POST['price'])?        null:$_POST['price'];
$category    = empty($_POST['category'])?     null:$_POST['category'];
$image_url   = empty($_POST['image_url'])?    null:$_POST['image_url'];
$description = empty($_POST['description'])?	null:$_POST['description'];

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
	$product->create([$name, $price, $category, $image_url, $description]);
	$product->commit();

	// リダイレクト
	header('Location: done.php');
}
catch(PDOException $e){
	echo '<pre>';
	var_dump($_POST);
	echo $e->getMessage();
	echo '</pre>';
}