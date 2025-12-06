<?php 
session_start(); // 세션 (저장) 기능 활성화

require_once '../lib.php'; // 랜더링 함수 로딩
require_once '../router.php'; // 라우터 로딩

require_once '../controller/page.php'; // 랜더링 페이지 로딩
require_once '../controller/actions.php'; // 요청 정리 페이지


Router::handleRequest(); // 라우터 실행