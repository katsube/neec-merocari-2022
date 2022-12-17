<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>商品一覧 | メロカリ</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/ffe4634c5a.js" crossorigin="anonymous"></script>
	<style>
		.product-card{
			cursor: pointer;
		}
		.card{
			float: left;
			margin-right: 5px;
		}
		#cards{
			display: none;
		}
		#notfound{
			display: none;
		}
	</style>
</head>
<body>
	<?php
		// header.phpを埋め込む
		require('../common/header_buyer.php');
	?>

	<main class="py-5 container">
		<h1 id="title" class="mb-3"></h1>

		<!-- ローディング -->
		<div id="loading" class="fa-3x">
			<i class="fas fa-circle-notch fa-spin"></i> Now Loading
		</div>

		<!-- 商品が存在しない -->
		<div id="notfound">
			<div class="alert alert-warning">
				<h3>商品が見つかりませんでした</h3>
				<p>このカテゴリに登録されている商品が存在しません。</p>
			</div>
		</div>

		<!-- 商品一覧 -->
		<div id="cards" class="card-group">
		</div>

		<!-- 前のページに戻る -->
		<div class="mb-3">
			<p style="clear:both"></p>
			<a href="javascript:history.back();"><i class="fas fa-chevron-left"></i> 前のページに戻る</a>
		</div>
	</main>

	<?php
		// footer.phpを埋め込む
		require('../common/footer.php');
	?>

<script src="/js/lib.js"></script>
<script>
window.addEventListener('load', async ()=>{
	//--------------------------------
	// カテゴリーを取得
	//--------------------------------
	const params = new URLSearchParams(location.search);
	const category = params.get('category_cd');
	if( category === null || ! category.match(/^([a-zA-Z0-9]{3})$/) ){
		alert('カテゴリーが正しく指定されていません');
		location.href = '/';
	}

	//--------------------------------
	// APIからカテゴリ名を取得
	//--------------------------------
	const buff1 = await fetch('/api/category/name.php?category_cd=' + category);
	const json1 = await buff1.json();

	// エラーチェック
	if( json1['status'] === false ){
		alert('データを正常に取得できませんでした');
	}
	if( json1['data'] === false ){
		alert('カテゴリーが存在しません');
		location.href = '/';
	}

	// カテゴリ名を表示
	document.querySelector('#title').textContent = json1['data']['name'];

	//--------------------------------
	// APIからカテゴリ一覧を取得
	//--------------------------------
	const buff2 = await fetch('/api/product/search.php?category_cd=' + category)
	const json2 = await buff2.json();

	// エラーチェック
	if( json2['status'] === false ){
		alert('データを正常に取得できませんでした');
	}
	// 商品が存在しない場合
	if( json2['data'].length === 0 ){
		document.querySelector('#loading').style.display = 'none';
		document.querySelector('#notfound').style.display = 'block';
		return;
	}

	//--------------------------------
	// 商品一覧を表示
	//--------------------------------
	const cards = document.querySelector('#cards');
	for(let i=0; i<json2['data'].length; i++){
		const card = createCardItem(json2['data'][i]);
		cards.appendChild(card);
	};

	// ローディングを非表示
	document.querySelector('#loading').style.display = 'none';
	document.querySelector('#cards').style.display = 'block';
});
</script>
</body>
</html>
