<?php

// 랜더링 페이지

GET("/",function(){ // (/) 페이지에 접속하면
    views('home'); 
    // views() 함수에 'home' 파라미터를 받아서 인덱스 페이지에 home 페이지를 렌더링 할 수 있게 한다
});

GET("/users/profile",function(){ // (/users/profile) 페이지에 접속하면
    views("users/profile",[...$_GET]);
    // views() 함수에 'users/profile' 파라미터를 받아서 인덱스 페이지에 profile 페이지를 렌더링 할 수 있게 한다
    
    // view() 함수에 GET 요청으로 받은 값을 extract로 키 값만 변수로 변환하여
    // users/profile 페이지에서 바로 $id 변수를 사용할 수 있게 한다
});