function checkForm(){
    if(document.form1.name1.value == "" || document.form1.EMail.value == ""||document.form1.age1.value == "" || document.form1.contents.value == ""){
        alert("必須項目を入力して下さい。");
        return false;
    }else{
        window.location.href = 'php/form.php';
    }
}
