// 3秒間メッセージを表示する
var msg = document.querySelector('.js-flash-message');
setTimeout(function(){
  msg.classList.add('c-flash-message-animation');
}, 3000);
