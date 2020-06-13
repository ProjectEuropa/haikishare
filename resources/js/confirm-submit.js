const alertInput = document.querySelector('.js-alert-input');
const alertForm = document.querySelector('.js-alert-form');

alertInput.addEventListener('click', function(){
	const result = window.confirm("商品の購入をキャンセルしますか？");
	console.log(result);

	if (result){
		if (alertForm !== null && alertInput !== null){
				alertInput.setAttribute("disabled", 'true');
				alertForm.submit();
			}

	}else{
    return false;
  }
})
