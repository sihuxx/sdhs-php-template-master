<?php

// 렌더링 페이지

GET("/",function(){ // (/) url에 접속하면
    views('home'); // home.php 페이지를 렌더링한다.
});

GET("/users/{id}",function($id){ // (/users/{id}) 주소로 접근하면
    $datas = (object)[]; // 데이터 담을 빈 객체 생성 후 
    $datas->id = $id; // url 에서 {id} 부분을 받아 $id에 저장
    views("users/profile",$datas); // "users/profile" 화면을 렌더링하며 $datas 값을 넘겨줌
});

GET("/users/{id}/{board}",function($id,$board){ // (/users/{id}{board}) 주소로 접근하면
    $datas = (object)[]; // 데이터 담을 빈 객체 생성 후
    $datas->id = $id; // url 첫번째 값 {id} 부분을 받아 $id에 저장
    $datas->board = $board; // url 두번째 값 {board} 부분을 바다 $board에 저장
    views("users/board",$datas); // "users/board" 화면을 렌더링하며 $datas 값을 넘겨줌
});