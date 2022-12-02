<?php
/**
 * CategoryModel Class
 */

//--------------------------------------------------
// ライブラリ
//--------------------------------------------------
require_once(dirname(__FILE__).'/base.php');

class CategoryModel extends BaseModel{
	function __construct(){
		parent::__construct();
	}

	/**
	 * すべてのカテゴリを返却する
	 *
	 * @param string [$sort='asc'] ソート順 asc or desc
	 * @return array
	 */
	function getAll($sort='asc'){
		$sql = 'SELECT cd, name FROM Category ORDER BY sortnum';
		if( $sort === 'desc' ){
			$sql .= ' DESC';
		}

		$this->execute($sql);
		return( $this->fetchAll() );
	}
}