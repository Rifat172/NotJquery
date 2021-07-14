function send(expr=""){

    let tempexpr = document.getElementsByName("expression")[0].value;
    if(tempexpr!==""){
        expr = tempexpr;
    }

    const request = new XMLHttpRequest();
    const url = "server.php";
    const params = "expression="+expr;

    request.responseType = "json";
    request.open("POST", url, true);
    request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    
    request.addEventListener("readystatechange", () =>{
        if(request.readyState===4 && request.status === 200){
            print(request.response);
        }
    });
    
    request.send(params);
    return true;
 }

 /**
  * Выводит массив с историями на экран
  * 
  * @param {array} array 
  */
 function print(array){
    const html = document.getElementById("result_form");
    html.innerHTML="";
    for(let history of array){
        html.innerHTML += "Выражение: "+history.expression + " Результат: "+(history.success==0? "false":"true") + "<br/>";
    }
 }

 /**
  * функция выполняется при полной загрузки страницы. Выполняет запрос на сервер, если в ссылке указано выражение
  */
 function load(){
    let expr = $_GET("expression");
    if(expr){
        send(expr);
    }
 }

  /**
  * Находит в ссылке значение с нужным параметром 
  * @param {string} key 
  * @returns string or bool 
  */
 function $_GET(key) {
    var p = window.location.href;
    p = p.match(new RegExp(key + '=([^&=]+)'));
    return p ? p[1] : false;
}