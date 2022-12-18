<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>メロカリ</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/ffe4634c5a.js" crossorigin="anonymous"></script>
</head>
<body>
	<?php
		// header.phpを埋め込む
		require('./common/header_buyer.php');
	?>
	<main class="container">
		<section class="py-5">
			<div class="row">
				<div class="col-sm-2 col-xs-1"></div>
				<div class="col-sm-8 col-xs-10">
					<form action="/buyer/search.php">
						<div class="input-group">
							<input type="text" name="keyword" class="form-control form-control-lg" style="width:50%" placeholder="キーワードを入力">
							<button class="btn btn-primary btn-lg">検索</button>
						</div>
					</form>
				</div>
				<div class="col-sm-2 col-xs-1"></div>
			</div>
		</section>

	<?php
		// カテゴリ一覧を表示
		require_once('../model/category.php');
		$category = new CategoryModel();
		$categories = $category->getAll();

		echo '<section class="py-5">';
		echo '<ul class="list-group">';
		for($i=0; $i<count($categories); $i++){
			printf('<li class="list-group-item list-group-item-action"><a href="/buyer/category.php?category_cd=%s">%s</a></li>'
								, $categories[$i]['cd']
								, $categories[$i]['name']
						);
		}
		echo '</ul>';
		echo '</section>';
		?>

		</main>

	<?php
		// footer.phpを埋め込む
		require('./common/footer.php');
	?>
</body>
</html>
