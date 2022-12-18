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
	 * @param array $data 商品情報 [name, price, image_url, description]
	 * @param array $category カテゴリー [category_cd, category_cd, ...]
	 * @return boolean
	 */
	function create($data, $category){
		//-----------------------
		// 商品を追加
		//-----------------------
		$sql1 = 'INSERT INTO Product (name, price, image_url, description, created_at) '
					.'VALUES (?,?,?,?,now())';
		$ret1 = $this->execute($sql1, $data);		// 成功したらtrue, 失敗したらfalseが返る
		if( !$ret1 ){
			throw new PDOException('商品の登録に失敗しました');
		}
		$id = $this->lastInsertId();

		//-----------------------
		// 商品のカテゴリーを追加
		//-----------------------
		$sql2 = 'INSERT INTO ProductCategory (product_id, category_cd) VALUES (?,?)';
		for($i=0; $i<count($category); $i++){
			$ret2 = $this->execute($sql2, [$id, $category[$i]]);
			if( !$ret2 ){
				throw new PDOException('カテゴリーの登録に失敗しました');
			}
		}

		return(true);
	}

	/**
	 * カテゴリーで商品を検索する
	 *
	 * @param string $category
	 * @return array
	 */
	function findCategory($category){
		$sql = <<<SQL
			SELECT A.id, A.name, A.price, A.image_url
			FROM Product A JOIN ProductCategory B
							ON A.id = B.product_id
			WHERE B.category_cd = ?
		SQL;

		$this->execute($sql, [$category]);
		return( $this->fetchAll() );
	}

	/**
	 * キーワードで商品を検索する
	 *
	 * @param string $keyword
	 * @return array
	 */
	function findKeyword($keyword){
		$sql = 'SELECT id, name, price, image_url FROM Product WHERE name LIKE ?';
		$q = sprintf('%%%s%%', $keyword); 	// name like "%キーワード%"
		$this->execute($sql, [$q]);
		return( $this->fetchAll() );
	}

	/**
	 * 商品をIDで検索する
	 *
	 * @param integer $id
	 * @return array
	 */
	function find($id){
		// 商品情報を検索
		$sql = 'SELECT id, name, price, image_url, description, created_at FROM Product WHERE id = ?';
		$this->execute($sql, [$id]);
		$product = $this->fetch();

		// カテゴリーを検索
		$product['category'] = $this->category($id);

		return($product);
	}

	/**
	 * 商品IDのカテゴリーを取得する
	 *
	 * @param int $id
	 * @return array
	 */
	function category($id){
		$sql = <<<SQL
			SELECT	A.category_cd as "cd",
							B.name as "name"
			FROM 	ProductCategory A JOIN Category B
							ON A.category_cd = B.cd
			WHERE A.product_id = ?
			ORDER BY B.sortnum
		SQL;

		$this->execute($sql, [$id]);
		return( $this->fetchAll() );
	}
}