const input = document.querySelector('.js-input');
const form = document.querySelector('.js-form');
console.log('aaa');
console.log(form);
console.log(input);
if (form != null && input != null){
  input.addEventListener('click', function(){
    input.setAttribute("disabled", 'true');
    form.submit();
  })
}else{
}
