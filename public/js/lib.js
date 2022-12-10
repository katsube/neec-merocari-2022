/**
 * 数字を3桁ごとにカンマ区切りにする
 *
 * @param {number|string} num
 * @returns {string}
 */
function separateNumber(num){
	return Number(num).toLocaleString();
}
