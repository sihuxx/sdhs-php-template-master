<?php

// 렌더링 함수 페이지

function views($page,$datas=[]){ // 각 경로마다 어떤 페이지를 보여줄지 지정하는 함수
    extract((array)$datas); // $data는 객체로 받기 때문에 array로 형변환 후 키값을 변수로 변환함
    require_once("./views/template/header.php"); // 헤더 섹션 렌더링함
    require_once("./views/{$page}.php"); // 받은 주소 값을 렌더링함
    require_once("./views/template/footer.php"); // 푸터 섹션 렌더링함
}