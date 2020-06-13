// キャンセルなどの重要な場合はform-submitと同じ機能プラスconfirm()でダイアログを出す
const alertInput = document.querySelector('.js-alert-input');
const alertForm = document.querySelector('.js-alert-form');
if (alertForm !== null && alertInput !== null){
	alertInput.addEventListener('click', function(){
		const result = window.confirm("商品の購入をキャンセルしますか？");
		console.log(result);

		if (result){
			// OKの時
			alertInput.setAttribute("disabled", 'true');
			alertForm.submit();

		}else{
			// キャンセルの時
	    return false;
	  }
	})
}
