<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>商品検索 | メロカリ</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/ffe4634c5a.js" crossorigin="anonymous"></script>
	<style>
		#result{ display: none; }
		#notfound{ display: none; }

		#keyword{ font-weight: bold;}

		.product-card{
			cursor: pointer;
		}
		.card{
			float: left;
			margin-right: 5px;
		}
	</style>
</head>
<body>
	<?php
		// header.phpを埋め込む
		require('../common/header_buyer.php');
	?>

	<!-- 検索結果を表示 -->
	<main class="py-5 container">
		<h1>キーワード検索</h1>
		<p>「<span id="keyword"></span>」で商品を検索</p>

		<!-- ローディング -->
		<div id="loading" class="fa-3x">
			<i class="fas fa-circle-notch fa-spin"></i> Now Loading
		</div>

		<!-- 商品が存在しない -->
		<div id="notfound">
			<div class="alert alert-warning" role="alert">
				<h3 class="fs-4">商品が見つかりませんでした</h3>
				<p class="fs-6">キーワードを変更して再度お試しください</p>
			</div>
		</div>

		<!-- 検索結果 -->
		<div id="result">
			<div id="cards" class="card-group">
			</div>
		</div>

		<!-- 前のページに戻る -->
		<div class="mb-3">
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
	// キーワードを取得
	//--------------------------------
	const params = new URLSearchParams(location.search);
	const keyword = params.get('keyword');
	if( keyword === null || keyword === "" ){
		alert('キーワードが正しく入力されていません');
		location.href = '/';
	}

	// キーワードを表示
	document.querySelector('#keyword').textContent = keyword;

	//--------------------------------
	// APIからカテゴリ一覧を取得
	//--------------------------------
	const buff = await fetch('/api/product/fulltext.php?keyword=' + encodeURI(keyword))
	const json = await buff.json();

	// エラー処理
	if( json['status'] === false ){
		alert('データを正常に取得できませんでした');
	}
	// 商品が存在しない
	if( json['data'] === false || json['data'].length === 0 ){
		document.querySelector('#loading').style.display = 'none';
		document.querySelector('#notfound').style.display = 'block';
		return;
	}

	//--------------------------------
	// 商品を表示
	//--------------------------------
	const cards = document.querySelector('#cards');
	for(let i=0; i<json['data'].length; i++){
		const card = createCardItem(json['data'][i]);
		cards.appendChild(card);
	};

	// ローディングを非表示
	document.querySelector('#loading').style.display = 'none';
	document.querySelector('#result').style.display = 'block';
});
</script>
</body>
</html>
