<?php
require_once('../../model/category.php');

try{
	// カテゴリー一覧を取得
	$category = new CategoryModel();
	$categories = $category->getAll();

	// プルダウンメニューを作成
	$category_options = '';
	for($i=0; $i<count($categories); $i++){
		$category_options .= sprintf('<option value="%s">%s</option>', $categories[$i]['cd'], $categories[$i]['name']);
	}
}
catch(PDOException $e){
	echo $e->getMessage();
	exit;
}
?><!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>商品情報入力</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
	<?php
		// header.phpを埋め込む
		require('../common/header_seller.php');
	?>
	<main>
		<section class="py-5 text-center container">
			<div class="row py-lg-5">
				<div class="col-lg-6 col-md-8 mx-auto">
					<h1 class="fw-light">出品する</h1>
					<p class="lead text-muted">登録すると1秒で販売を開始できます</p>
				</div>
			</div>
		</section>
		<div class="container py-4 px-4 bg-light">
			<form id="addform" action="create.php" method="POST">
				<div class="mb-4">
					<label class="form-label fw-bold" for="name">商品名</label>
					<span class="badge bg-danger">必須</span>
					<span class="text-muted">〜64文字</span>
					<input class="form-control" type="text" name="name" id="name" placeholder="例: Nintendo Switch">
				</div>
				<div class="mb-4">
					<label class="form-label fw-bold" for="price">価格</label>
					<span class="badge bg-danger">必須</span>
					<span class="text-muted">100〜99,999円</span>
					<input class="form-control w-25" type="number" name="price" id="price" placeholder="例: 9800">
				</div>
				<div class="mb-4">
					<label class="form-label fw-bold" for="category">カテゴリ</label>
					<span class="badge bg-danger">必須</span>
					<select name="category" class="form-select w-50">
						<option value="">▼選択してください▼</option>
						<?= $category_options ?>
					</select>
				</div>
				<div class="mb-4">
					<label class="form-label fw-bold" for="image_url">画像URL</label>
					<span class="badge bg-danger">必須</span>
					<span class="text-muted">半角文字のみ。〜256byte</span>
					<input class="form-control" type="url" name="image_url" id="image_url" placeholder="例: https://example.com/xxx.png">
				</div>
				<div class="mb-4">
					<label class="form-label fw-bold" for="description">商品説明</label>
					<span class="badge bg-success">任意</span>
					<span class="text-muted">〜1024byte</span>
					<textarea class="form-control" name="description" id="description" cols="30" rows="10" placeholder="例:&#13;ご購入後2日以内に発送します。&#13;ノーリターン・ノークレームでお願いします！"></textarea>
				</div>
				<div class="mb-2 text-center">
					<button class="btn btn-primary btn-lg w-50" type="submit">販売を開始する</button>
				</div>
			</form>
		</div>
	</main>

	<?php
		// footer.phpを埋め込む
		require('../common/footer.php');
	?>

<script>
document.querySelector("#addform").addEventListener("submit", (e)=>{
	e.preventDefault();

	// ToDo: 入力チェック

	// 確認する
	if( confirm("本当にこの内容で販売を開始しますか？") ){
		e.target.submit();
	}
});
</script>
</body>
</html>
