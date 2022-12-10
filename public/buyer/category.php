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
		<!-- ローディング -->
		<div id="loading" class="fa-3x">
			<i class="fas fa-circle-notch fa-spin"></i> Now Loading
		</div>

		<!-- 商品が存在しない -->
		<div id="notfound">
			<h3>商品が見つかりませんでした</h3>
			<p>このカテゴリに登録されている商品が存在しません。</p>
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
	// APIからカテゴリ一覧を取得
	//--------------------------------
	const buff = await fetch('/api/product/search.php?category_cd=' + category)
	const json = await buff.json();

	// エラーチェック
	if( json['status'] === false ){
		alert('データを正常に取得できませんでした');
	}
	// 商品が存在しない場合
	if( json['data'].length === 0 ){
		document.querySelector('#loading').style.display = 'none';
		document.querySelector('#notfound').style.display = 'block';
		return;
	}

	//--------------------------------
	// 商品一覧を表示
	//--------------------------------
	const cards = document.querySelector('#cards');
	for(let i=0; i<json['data'].length; i++){
		const data = json['data'][i];
		const div = document.createElement('div');
		div.classList.add('card', 'product-card', 'ms-3', 'mt-3');
		div.style.width = '18rem';
		div.innerHTML = `<div class="card-body">
				<img src="${data['image_url']}" class="card-img-top">
				<h5 class="card-title">${data['name']}</h5>
					<span class="fw-bold text-danger">¥${separateNumber(data['price'])}円</span>
			</div>`;

		// カードがクリックされたら詳細ページへ
		div.addEventListener('click', (e)=>{
			location.href = '/buyer/detail.php?id=' + data['id'];
		});

		cards.appendChild(div);
	};

	// ローディングを非表示
	document.querySelector('#loading').style.display = 'none';
	document.querySelector('#cards').style.display = 'block';
});
</script>
</body>
</html>
