<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>メロカリ</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<?php
		// header.phpを埋め込む
		require('./common/header_buyer.php');

		// カテゴリ一覧を表示
		require_once('../model/category.php');
		$category = new CategoryModel();
		$categories = $category->getAll();

		echo '<main>';
		echo '<section class="py-5 container">';
		echo '<ul class="list-group">';
		for($i=0; $i<count($categories); $i++){
			printf('<li class="list-group-item list-group-item-action"><a href="/buyer/category.php?category_cd=%s">%s</a></li>'
								, $categories[$i]['cd']
								, $categories[$i]['name']
						);
		}
		echo '</ul>';
		echo '</section>';
		echo '</main>';

		// footer.phpを埋め込む
		require('./common/footer.php');
	?>
</body>
</html>
