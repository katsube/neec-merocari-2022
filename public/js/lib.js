/**
 * 数字を3桁ごとにカンマ区切りにする
 *
 * @param {number|string} num
 * @returns {string}
 */
function separateNumber(num){
	return Number(num).toLocaleString();
}

/**
 * 検索結果の商品情報をカードにして返す
 *
 * @param {object} data {id:1, name:'商品名', price:1000, image_url:'画像のURL'}
 * @returns {HTMLElement}
 */
function createCardItem(data){
  const div = document.createElement('div');
  div.classList.add('card', 'product-card', 'ms-3', 'mt-3');
  div.style.width = '18rem';
  div.style.maxWidth = '350px';
  div.innerHTML = `<div class="card-body">
      <img src="${data['image_url']}" class="card-img-top">
      <h5 class="card-title">${data['name']}</h5>
        <span class="fw-bold text-danger">¥${separateNumber(data['price'])}円</span>
    </div>`;

  // カードがクリックされたら詳細ページへ
  div.addEventListener('click', (e)=>{
    location.href = '/buyer/detail.php?id=' + data['id'];
  });

  return(div);
}