<?php 
session_start(); // PHP session 시작 함수 => 사용자 정보 저장에 필수
require_once './lib.php'; // 렌더링 함수를 불러옴
require_once './router.php'; // 라우터 함수를 불러옴


$controllerFiles = glob('./controller/*.php');
// $controllerFiles 변수에 controller 폴더 안에 있는 모든 php 파일을 가져옴
foreach($controllerFiles as $file){ // $controllerFiles 안 모든 php 파일을 하나씩 순회하여 각각을 $file 변수에 저장
    require_once($file); 
    // require_once './controller/page.php'; 
    // require_once './controller/users.php'; 와 같은 의미

    /* 
        Q. require_once로 하나씩 불러오는 거랑 의미가 같은데 왜 굳이 foreach를 돌려서 불러오나요?
        controller 폴더 안 파일이 많아졌을 때 사용하는 방식일까요?
    */
}

Router::handleRequest();
// router.php에서 만든 handleRequest() 함수 불러옴으로서
// 웹 요청 감지(GET/POST, URL)/등록된 라우트 중 맞는 페이지 실행