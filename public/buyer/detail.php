<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>商品詳細 | メロカリ</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://kit.fontawesome.com/ffe4634c5a.js" crossorigin="anonymous"></script>
	<style>
		dt { float: left; }
		dd { margin-left: 80px; }

		#detail{ display: none; }
		#notfound{ display: none; }

		#name{
			font-size: 1.8rem;
		}
		#price{
			font-size: 1.3rem;
			font-weight: bold;
			color:red;
		}
		#btn-buy{
			width: 100%;
		}
		#description{
			margin-top: 1rem;
		}
	</style>
</head>
<body>
	<?php
		// header.phpを埋め込む
		require('../common/header_buyer.php');
	?>

	<!-- 商品詳細を表示 -->
	<main class="py-5 container">
		<!-- ローディング -->
		<div id="loading" class="fa-3x">
			<i class="fas fa-circle-notch fa-spin"></i> Now Loading
		</div>

		<!-- 商品が存在しない -->
		<div id="notfound">
			<h3>商品が見つかりませんでした</h3>
			<p>販売が停止中か売約済みの可能性があります。</p>
		</div>

		<!-- 商品詳細 -->
		<div id="detail" class="card">
			<div class="card-body">
				<div class="row">
					<div class="col-6">
						<img id="image" class="img-fluid">
					</div>
					<div class="col-6">
						<h3 id="name"></h3>
						<p id="price"></p>
						<button id="btn-buy" class="btn btn-danger btn-lg">購入する</button>
						<p id="description"></p>

						<dl>
							<dt>カテゴリ：</dt>
							<dd id="category"></dd>
							<dt>販売開始：</dt>
							<dd id="created"></dd>
						</dl>
					</div>
				</div>
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
	// 商品IDを取得
	//--------------------------------
	const params = new URLSearchParams(location.search);
	const id = params.get('id');
	if( id === null || ! id.match(/^([0-9]{1,})$/) ){
		console.log(id);
		alert('商品IDが正しく指定されていません');
		location.href = '/';
	}

	//--------------------------------
	// APIからカテゴリ一覧を取得
	//--------------------------------
	const buff = await fetch('/api/product/detail.php?id=' + id)
	const json = await buff.json();

	// エラー処理
	if( json['status'] === false ){
		alert('データを正常に取得できませんでした');
	}
	// 商品が存在しない
	if( json['data'] === false ){
		document.querySelector('#loading').style.display = 'none';
		document.querySelector('#notfound').style.display = 'block';
		return;
	}

	//--------------------------------
	// 商品を表示
	//--------------------------------
	const data = json['data'];
	setValue('name',         data['name']);
	setValue('image',       data['image_url']);
	setValue('price',       data['price']);
	setValue('description', data['description']);
	setValue('category',    data['category']);
	setValue('created',     data['created_at']);

	// ローディングを非表示
	document.querySelector('#loading').style.display = 'none';
	document.querySelector('#detail').style.display = 'block';
});

document.querySelector('#btn-buy').addEventListener('click', (e)=>{
	e.preventDefault();
	alert('ToDo: 購入処理');
})

/**
 * データを差し込む
 *
 * @param string name
 * @param string value
 * @return void
 */
function setValue(name, value){
	const element = document.querySelector('#' + name);

	switch(name){
		case 'price':
			element.textContent = '¥' + separateNumber(value);
			break;
		case 'image':
			element.setAttribute('src', value);
			break;
		case 'category':
			element.innerHTML = createCategoryList(value);
			break;
		default:
			element.textContent = value;
			break;
	}
}

/**
 * カテゴリ一覧を作成
 *
 * @param array categories
 * @return string
 */
function createCategoryList(categories){
	let list = [ ];
	for( let i = 0; i < categories.length; i++ ){
		const c = categories[i];
		list.push(`<a href="/buyer/category.php?category_cd=${c['cd']}">${c['name']}</a>`);
	}
	return(list.join(' / '));
}
</script>
</body>
</html>
