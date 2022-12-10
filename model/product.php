<?php
/**
 * ProductModel Class
 *
 * @example
 *   try{
 * 	   $product = new ProductModel();
 * 	   $product->begin();
 * 	   $product->create([$name, $price, $category, $image_url, $description]);
 * 	   $product->commit();
 *   }
 *   catch(PDOException $e){
 * 	   echo $e->getMessage();
 *   }
 */

//--------------------------------------------------
// ライブラリ
//--------------------------------------------------
require_once(dirname(__FILE__).'/base.php');

class ProductModel extends BaseModel{
	function __construct(){
		parent::__construct();
	}

	/**
	 * 商品を新規登録する
	 *
	 * @param array $data 商品情報 [name, price, category, image_url, description]
	 * @return boolean
	 */
	function create($data){
		$sql = 'INSERT INTO Product (name,price,category_cd,image_url,description,created_at) '
					.'VALUES (?,?,?,?,?,now())';
		$ret = $this->execute($sql, $data);		// 成功したらtrue, 失敗したらfalseが返る
		return($ret);
	}

	/**
	 * カテゴリーで商品を検索する
	 *
	 * @param string $category
	 * @return array
	 */
	function findCategory($category){
		$sql = 'SELECT id, name, price, image_url FROM Product WHERE category_cd = ?';
		$this->execute($sql, [$category]);
		return( $this->fetchAll() );
	}

	/**
	 * 商品をIDで検索する
	 *
	 * @param integer $id
	 * @return array
	 */
	function find($id){
		$sql = 'SELECT A.id, A.name, A.price, A.image_url, A.description, A.category_cd, B.name as "category_name", A.created_at FROM Product A, Category B WHERE id = ? AND A.category_cd = B.cd';
		$this->execute($sql, [$id]);
		return( $this->fetch() );
	}
}