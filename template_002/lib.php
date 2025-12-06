<?php

// 랜더링 함수

// require_once 한번만 실행

function views($page,$datas=[]){
    extract($datas); 
    
    require_once("../views/template/header.php");
    require_once("../views/{$page}.php");
    require_once("../views/template/footer.php");
}