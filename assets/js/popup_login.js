//厳格モード
"use strict";

//表示→非表示機能用変数
const modal = document.querySelector("#myModal");
const modal_count = document.querySelector("animation-wait");

//全体の表示非表示機能
window.onload = function ScreenIn() {
  modal.style.display = "block";
}

//3秒後にホームページへ遷移する。
function ScreenOut(){
  window.location.href = 'php/indexs.php';
}

//3秒カウント
setTimeout(ScreenOut, 3300);