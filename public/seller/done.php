<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>出品完了</title>
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
					<h1 class="fw-light">出品が完了しました！</h1>
					<form action="form.php">
						<button class="btn btn-secondary mt-5 ">
							前のページへもどる
						</button>
					</form>
				</div>
			</div>
		</section>
	</main>
	<?php
		// footer.phpを埋め込む
		require('../common/footer.php');
	?>
</body>
</html>
